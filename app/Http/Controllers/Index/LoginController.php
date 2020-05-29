<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/**短信验证 */
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
/**邮箱验证 */
use App\Mail\sendCode;
use Illuminate\Support\Facades\Mail;   //门面

use App\Member;

class LoginController extends Controller
{
//     AccessKey ID
// LTAI4GER8g8ba9p67un2DB1s
// AccessKey Secret
// VoAg6R2AZRZ2DzKfpVnAYkiyQyWrhM

    /**登录 */
    public function login(){
        return view('index.log');
    }

    /**注册 */
    public function reg(){
        return view('index.reg');
    }

    public function sendSms(){
        $mobile = request()->username;
        // echo $mobile;
        $reg = '/^1[3|4|5|6|7|8|9]\d{9}$/';
        if(!preg_match($reg,$mobile)){
            echo json_encode(['code'=>'00001','msg'=>'请输入正确的手机']);die;
        }
     
        $code = rand(100000,999999);   /**随机生成验证码 */
        //发送短信验证码
        $result = $this->send($mobile,$code);
        // $result['Message']='OK';

        if($result['Message']=='OK'){
            session(['code'=>['name'=>$mobile,'code'=>$code]]);
            request()->session()->save();
            dump(request()->session()->all());
            echo json_encode(['code'=>'00000','msg'=>'发送成功,请注意接收']);die;
        }
    }

    /**短信验证 */
    public function send($mobile,$code){
        AlibabaCloud::accessKeyClient('LTAI4GER8g8ba9p67un2DB1s', 'VoAg6R2AZRZ2DzKfpVnAYkiyQyWrhM')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                ->product('Dysmsapi')
                                // ->scheme('https') // https | http
                                ->version('2017-05-25')
                                ->action('SendSms')
                                ->method('POST')
                                ->host('dysmsapi.aliyuncs.com')
                                ->options([
                                                'query' => [
                                                'RegionId' => "cn-hangzhou",
                                                'PhoneNumbers' => $mobile,
                                                'SignName' => "旭东小院",
                                                'TemplateCode' => "SMS_185245317",
                                                'TemplateParam' => "{code:$code}",
                                                ],
                                            ])
                                ->request();
                    return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }
    }

    /**邮箱发送验证码 */
    public function sendEmail(){
        $email = request()->username;
        // echo $email;
        $reg = '/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/';
        if(!preg_match($reg,$email)){
            echo json_encode(['code'=>'00001','msg'=>'请输入正确的邮箱']);die;
        }

        $code = rand(100000,999999);   /**随机生成验证码 */
        //使用邮箱发送验证码
        Mail::to($email)->send(new sendCode($code));
        session(['code'=>['name'=>$email,'code'=>$code]]);
        request()->session()->save();
    }

    /**注册执行 */
    public function regdo(Request $request){
        $post = $request->except('_token');
        // dump($post);
        $code = $request->session()->get('code');
        // dd($code);
        
        //判断验证码是否一致
        if($post['username']!=$code['name'] || $post['code']!=$code['code']){
            // echo 123;die;
            return redirect('/reg')->with('msg','您的验证码错误');
        }

        //验证密码是否一致
        if($post['pwd']!==$post['repwd']){
            return redirect('/reg')->with('msg','您的两次密码不一致');

        }

        //入库
        $reg = '/^1[3|4|5|6|7|8|9]\d{9}$/';
        if(preg_match($reg,$post['username'])){
            $post['mobile'] = $post['username'];
        }

        $reg = '/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/';
        if(preg_match($reg,$post['username'])){
            $post['member_email'] = $post['username'];
        }

        unset($post['username']);
        unset($post['repwd']);
        unset($post['code']);
        $post['pwd'] = encrypt($post['pwd']);

        $res = Member::insert($post);
        if($res){
            return redirect('/login');
        }
    }

    /**执行登录 */
    public function logindo(Request $request){
        $post = $request->except('_token');
        // dump($post);

        //判断是手机号登录还是邮箱登录
        $where = [];
        $reg = '/^1[3|4|5|6|7|8|9]\d{9}$/';
        if(preg_match($reg,$post['username'])){
            $where['mobile'] = $post['username'];
        }

        $reg = '/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/';
        if(preg_match($reg,$post['username'])){
            $where['member_email'] = $post['username'];
        }

        //根据手机号或者邮箱查询一下这个用户
        $user = Member::where($where)->first();
        // dd($user);
        if(decrypt($user->pwd)!=$post['pwd']){
            // echo 123;die;
            return redirect('/login')->with('msg','用户名或者密码有误!');
        }

        session(['user'=>$user]);

        //如果有回调地址,跳转到回调地址
        if($post['refer']){
            return redirect($post['refer']);
        }

        return redirect('/');
    }





}
