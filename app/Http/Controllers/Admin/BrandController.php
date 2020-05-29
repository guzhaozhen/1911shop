<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
/**引入memcached */
use Illuminate\Support\Facades\Cache;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->page??1;
        $brand_name = request()->brand_name;
        $brand = Cache::get('brand_'.$page.'_'.$brand_name);
        if(!$brand){
            $where=[];
            if($brand_name){
                 $where[] = ['brand_name','like',"%$brand_name%"];
            }
        $pageSize = config('app.pageSize');
        //$brand = DB::table('brand')->orderBy('brand_id','desc')->paginate($pageSize);
        // dd($brand);
        
        //ORM
        $brand = Brand::getBrandIndex($pageSize,$where);

        Cache::put('brand_'.$page.'_'.$brand_name,$brand,60);
      }
        //ajax分页
        if(request()->ajax()){
            return view('admin.brand.ajaxindex',['brand'=>$brand,'brand_name'=>$brand_name]);
      }
        
        return view('admin.brand.index',['brand'=>$brand,'brand_name'=>$brand_name]);
    }
    /**
     * Show the form for creating a new resource.
     *添加页
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**第二种验证 */
    // public function store(StoreBrandPost $request)

    public function store(Request $request)
    {
        /**第一种验证 */
        // $validatedData = $request->validate([ 
        //     'brand_name' => 'required|unique:brand', 
        //     'brand_url' => 'required',
        // ],[
        //     'brand_name.required'=>'品牌名称必填',
        //     'brand_name.unique'=>'品牌名称已存在',
        //     'brand_url.required'=>'品牌网址必填',
        // ]);


        $post = $request->except('_token');
        //  dump($post);

        /**第三种验证 */
        $validator = Validator::make($post,[ 
            'brand_name' => 'required|unique:brand', 
            'brand_url' => 'required',
         ],[
                'brand_name.required'=>'品牌名称必填',
                'brand_name.unique'=>'品牌名称已存在',
                'brand_url.required'=>'品牌网址必填',
         ]);
        
         if ($validator->fails()) { 
             return redirect('/brand/create') ->withErrors($validator) ->withInput();
             }


        /**文件上传 */
        //1.判断有没有文件上传
        if ($request->hasFile('brand_logo')) { 
            $post['brand_logo']= upload('brand_logo');
            // dd($img);
        }
        // dd($post);
        
        //$res = DB::table('brand')->insert($post);

        //ORM 添加第一种方法
        // $brand = new Brand; 
        // $brand->brand_name = $post['brand_name']; 
        // $brand->brand_url = $post['brand_url'];
        // $brand->brand_logo = $post['brand_logo'];
        // $brand->brand_desc = $post['brand_desc'];
        // $res = $brand->save();

        //ORM 添加第二种方法
        //$res = Brand::insert($post);

        //ORM 添加第三种方法
        $res = Brand::create($post);

        if($res){
            return redirect('/brand/index');
        }else{
            return redirect('/brand/create');
        }
    }

    
    /**
     * Display the specified resource.
     *后台预览详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo $id;
        //$brand = DB::table('brand')->where('brand_id',$id)->first(); 

        //ORM
        $brand = Brand::find($id);
        // dd($brand);
        return view('admin.brand.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except('_token');
        // dump($post);
        // dd($id);

        if ($request->hasFile('brand_logo')) { 
            $post['brand_logo']= upload('brand_logo');
        }

        //$res = DB::table('brand')->where('brand_id',$id)->update($post);
    
        //ORM 更新第一种方法
        // $brand = Brand::find($id);
        // $brand->brand_name = $post['brand_name']; 
        // $brand->brand_url = $post['brand_url'];
        // if(isset($post['brand_logo'])){
        //     $brand->brand_logo = $post['brand_logo']; 
        // }
        // $brand->brand_desc = $post['brand_desc'];
        // $res = $brand->save();

        //ORM 更新第二种方法
        $res = Brand::where('brand_id',$id)->update($post);

        // dump($res);
        if($res!==false){
            return redirect('/brand/index');   
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

        //$res = DB::table('brand')->where('brand_id',$id)->delete();

        //ORM
        $res = Brand::destroy($id);
        
        if($res){
            return redirect('/brand/index');  
        }
    }

    public function checkName(){
        $brand_name = request()->brand_name;
        // echo $brand_name;exit;
        $count = Brand::where('brand_name',$brand_name)->count();
        echo $count;
    }

}
