<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Goods;
use App\Cate;

/**2..引入memcached */
use Illuminate\Support\Facades\Cache;
/**引入redis */
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function index(){

        //3..获取memcached 
        // $slice = Cache::get('slice');
        //使用辅助函数
        // $slice = cache('slice');

        //使用redis
        $slice = Redis::get('slice');
        
        // var_dump($slice);
        // dump($slice);
        //4.判断 没有就去数据库里查
        if(!$slice){
             echo "DB==";
             //5. 入库 首页幻灯片
            $slice = Goods::getSliceData();
            // dd($slice);
            //6.存入缓存 并且存入时间
            // Cache::put('slice',$slice,60*60);

            //辅助函数
            // cache(['slice'=>$slice],60);


            //使用redis
            $slice = serialize($slice);
            Redis::setex('slice',60,$slice);

        }
        $slice = unserialize($slice);

        // die;
       
        //获取顶级分类
        $cate = Cate::getTopData();
        // dd($cate);
        return view('index.index',compact('slice','cate'));
    }
}
