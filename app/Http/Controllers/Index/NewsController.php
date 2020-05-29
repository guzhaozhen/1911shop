<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**引入model */
use App\News;

/**1.引入redis */
use Illuminate\Support\Facades\Redis;

class NewsController extends Controller
{
    /**内侧题列表展示 */
    public function index(){
        $page = request()->page?:1;

        /**搜索 */
        $title = request()->title;
        $where = [];
        if($title){
            $where[] = ['title','like',"%$title%"];
        }

        //2.从缓存中取值
        $news = Redis::get('news_'.$page.'_'.$title);

        //3.
        if(!$news){
             $pageSize = config('app.pageSize');
            // dd($pageSize);
            $news = News::where($where)->paginate($pageSize);
            // dd($news);
            //4.
            $news = serialize($news);
            //5.
            Redis::setex('news_'.$page.'_'.$title,60,$news);
        }

            //6.
            $news = unserialize($news);
       
        return view('index.news',['news'=>$news,'title'=>$title]);
    }
}
