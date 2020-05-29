<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Admin;
/**门面cookie引入 */
use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function logindo(Request $request){
        $post = $request->except('_token');
        // dd($post)

        $admin = Admin::where('admin_name',$post['admin_name'])->first();

        if(!$admin){
            return redirect('./login')->with('msg','用户名或者密码错误');
        }

        if(decrypt($admin->admin_pwd)!=$post['admin_pwd']){
            return redirect('./login')->with('msg','用户名或者密码错误');
        }

        /**判断七天免登录 */
        if(isset($post['isremember'])){
            Cookie::queue('admin',serialize($admin),60*24*7);
        }

        session(['admin'=>$admin]);

        return redirect('./goods/index');
    }

    //存cookie
    public function setcookie(){
        //1.
        //return response('欢迎来到 Laravel 学院')->cookie( 'name', '乐柠', 1);
        //2.门面
        //Cookie::queue(Cookie::make('name', '北京沙河', 1));
        //3.
        //Cookie::queue('name', '河北宣化', 1);
        Cookie::queue('name', 'china', 1);

    }

    //获取cookie
    public function getcookie(){
        //1.使用Illuminate\Http\Request 实例的cookie方法从请求中获取Cookie的值
        //echo request()->cookie('name');
        //2.可以使用 Cookie 门面获取 Cookie 值
        echo Cookie::get('name');
    }

    /**退出登录 */
    public function logout(){
        request()->session()->flush();
        return redirect('./login');
    }

}
