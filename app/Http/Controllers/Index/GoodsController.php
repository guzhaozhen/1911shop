<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
/**2..引入memcached */
use Illuminate\Support\Facades\Cache;
/**引入redis */
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    /**详情页 */
    public function index($goods_id){
        //当前访问量
        // $visit = Cache::add('visit_'.$goods_id,1)?1:Cache::increment('visit_'.$goods_id);


        //Redis
        $visit = Redis::setnx('visit_'.$goods_id,1)?:Redis::incr('visit_'.$goods_id);


        //  //3..获取memcached 
        //  $goods = Cache::get('goods_'.$goods_id);

        //使用redis
        $goods = Redis::get('goods_'.$goods_id);

        //  dump($goods);
        if(!$goods){
            echo "DB==";
            $goods = Goods::find($goods_id);

            //dd($goods);
            // Cache::put('goods_'.$goods_id,$goods,60); 
            
            
            //使用redis
            $goods = serialize($goods);
            Redis::setex('goods_'.$goods_id,5,$goods);
        }

        $goods = unserialize($goods);
       return view('index.goods',['goods'=>$goods,'visit'=>$visit]);
    }

    /**加入购物车 */
    public function addcar(Request $request){
        $goods_id = $request->goods_id;
        $buy_number = $request->buy_number;
        // echo $goods_id.'='.$buy_number;

        /**1.判断是否登录 */
        $user = session('user');
        if(!$user){
            echo json_encode(['code'=>'1','msg'=>'用户未登录']);die;
        }

        /**2.判断商品是否上架 下架:提示商品下架 */
        $goods = Goods::find($goods_id);
        if($goods->is_on_sale!=1){
            echo json_encode(['code'=>'2','msg'=>'对不起,商品已下架']);die;
        }

        /**3.判断库存 购买数量大于库存 提示库存不足 */
        if($buy_number>$goods->goods_number){
            echo json_encode(['code'=>'3','msg'=>'商品库存不足']);die;
        }

        /**4.判断购物车内是否加入过此商品  有此商品(udate)  购买数量相加  加完后再次判断库存 没有:add 入库*/
        $where=['user_id'=>$user->member_id,'goods_id'=>$goods_id];
        $cart = Cart::where($where)->first();
        // dump($cart);
        if(!$cart){
            //没有： add 入库
            $data = [
                'user_id'=>$user->member_id,
                'goods_id'=>$goods_id,
                'goods_name'=>$goods->goods_name,
                'goods_img'=>$goods->goods_img,
                'buy_number'=>$buy_number,
                'goods_price'=>$goods->goods_price,
                'addtime'=>time()
            ];
            $res = Cart::create($data);
        }else{
            //更新
            $buy_number = $buy_number+$cart->buy_number;
            // echo $buy_number;die;
            if($buy_number>=$goods->goods_number){
                $buy_number = $goods->goods_number;
            }
        
            $res = Cart::where($where)->update(['buy_number'=>$buy_number]);
            // dd($res);
        }
        if($res!==false){
            echo json_encode(['code'=>'4','msg'=>'加入成功']);die;
        }
    }
}
