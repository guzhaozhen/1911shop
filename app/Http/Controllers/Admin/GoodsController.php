<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Goods;
use App\Brand;
use App\Cate;
use App\Http\Requests\StoreGoodsPost;
class GoodsController extends Controller
{
    /**展示列表
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // //session应用
        // //存储
        // $request->session()->put('name','xiaoming');
        // session(['class'=>'1911']);

        // //获取
        // echo $request->session()->get('name');
        // echo session('class');
        // //获取所有
        // dump($request->session()->all());


        // //删除
        // $request->session()->forget('name');
        // // dd($request);
        // session(['class'=>'null']);

        // dump($request->session()->get('name'));
        // dump($request->session()->get('class'));


        // //判断session里有没有此键
        // dump($request->session()->has('name'));
        // dump($request->session()->exists('class'));
        // die;


        //查询分类数据    //商品分类
        $cateInfo = Cate::get();
        //调用无限极分类
        $cateInfo = getCateInfo($cateInfo);

        /**搜索 */
        //按照商品名称搜
        $goods_name = request()->goods_name;
        $where=[];
        if($goods_name){
            $where[] = ['goods_name','like',"%$goods_name%"];
        }
        //按照商品分类搜
        $cate_id = request()->cate_id;
        if($cate_id){
            $where[] = ['goods.cate_id','=',$cate_id];
        }
        //按照价格搜  //起始价格
        $startprice = request()->startprice;
        if($startprice){
            $where[] = ['goods.goods_price','>=',$startprice];
        }
        //终点价格
        $endprice = request()->endprice;
        if($endprice){
            $where[] = ['goods.goods_price','<=',$endprice];
        }

        $pageSize = config('app.pageSize');
        // return self::orderBy('goods_id','desc')->paginate($pageSize);
        // $goods = Goods::getGoodsIndex($pageSize);

        //监听sql第一种方法
        //DB::connection()->enableQueryLog();
        $goodsInfo = Goods::select('goods.*','cate_name','brand_name')
                            ->leftjoin('cate','goods.cate_id','=','cate.cate_id')
                            ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
                            ->orderBy('goods_id','desc')
                            ->where($where)
                            ->paginate($pageSize);
        // $logs = DB::getQueryLog();
        // dump($logs);
        
         //ajax分页
         if(request()->ajax()){
             return view('admin/goods/ajaxindex',['cateInfo'=>$cateInfo,'goodsInfo'=>$goodsInfo]);
         }

       
       return view('admin/goods/index',compact('cateInfo','goodsInfo','goods_name','cate_id','startprice','endprice'));
    }

    /**
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //查询分类数据 使用无限极分类
        $cateInfo = Cate::get();
        //调用无限极分类
        $cateInfo = getCateInfo($cateInfo);

        $brandInfo = Brand::select('brand_id','brand_name')->get();

        return view('admin/goods/create',['cateInfo'=>$cateInfo,'brandInfo'=>$brandInfo]);
    }


    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsPost $request)
    {
        $data = $request->except('_token');

       

        //文件上传
        //1.判断文件有没有上传
        if ($request->hasFile('goods_img')) { 
            $data['goods_img']=upload('goods_img');
        }

        //处理相册
        if(isset($data['goods_imgs'])){
            $data['goods_imgs'] = Moreupload('goods_imgs');
            $data['goods_imgs'] = implode('|',$data['goods_imgs']);
        }


        $res = Goods::insert($data);
        // dump($data);
        if($res){
            return redirect('./goods/index');
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *修改视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查询分类数据 使用无限极分类
        $cateInfo = Cate::get();
        //调用无限极分类
        $cateInfo = getCateInfo($cateInfo);

        $brandInfo = Brand::select('brand_id','brand_name')->get();

         //ORM
         $goodsInfo = Goods::find($id);
         // dd($brand);
       

         return view('admin.goods.edit',['goodsInfo'=>$goodsInfo,'cateInfo'=>$cateInfo,'brandInfo'=>$brandInfo]);
    }

    /**
     * Update the specified resource in storage.
     *修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoodsPost $request, $id)
    {
        $post = $request->except('_token');
        // dump($post);
        // dd($post);

        if ($request->hasFile('goods_img')) { 
            $post['goods_img']= upload('goods_img');
        }

        

        //ORM 更新第二种方法
        $res = Goods::where('goods_id',$id)->update($post);

        // dump($res);
        if($res!==false){
            return redirect('/goods/index');   
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo $id;
        //ORM
        $res = Goods::destroy($id); 
        if($res){
            // return redirect('/goods/index'); 
            echo json_encode(['code'=>'00000','msg'=>'删除成功!']);die;
        }
    }

    public function checkName(){
        $goods_name = request()->goods_name;
        // echo $goods_name;exit;
        $count = Goods::where('goods_name',$goods_name)->count();
        echo $count;
    }
}
