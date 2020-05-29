<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Cate;
use App\Brand;
use Validator;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $cate = DB::table('cate')->get();
        //ORM 
        $cate = Cate::all();

        //调用无限极分类
        $cateInfo=getCateInfo($cate);
        return view('admin.cate.index',['cateInfo'=>$cateInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //查询分类数据 使用无限极分类
        $cateInfo = Cate::all();
        //调用无限极分类
        $cateInfo=getCateInfo($cateInfo);
        // dd($cateInfo);

       
        // dd($brandInfo);

        return view('admin.cate.create',['cateInfo'=>$cateInfo]);
    }

    

    /**
     * Store a newly created resource in storage.
     *执行添加 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');
        // dump($post);

        //验证
        $validator = Validator::make($post,[ 
            'cate_name' => 'required|unique:cate', 
            'cate_desc' => 'required',
         ],[
                'cate_name.required'=>'分类名称必填',
                'cate_name.unique'=>'分类名称已存在',
                'cate_desc.required'=>'分类描述必填',
         ]);

        if ($validator->fails()) { 
            return redirect('/cate/create') ->withErrors($validator) ->withInput();
        }

        $res = DB::table('cate')->insert($post);
        if($res){
            return redirect('/cate/index');
        }else{
            return redirect('/cate/create');
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
     *修改视图页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo $id;
        //查询分类数据 使用无限极分类
        $cate = DB::table('cate')->get();
        //调用无限极分类
        $cateInfo=getCateInfo($cate);

        $cate = DB::table('cate')->where('cate_id',$id)->first();
        return view('admin.cate.edit',['cate'=>$cate,'cateInfo'=>$cateInfo]);
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

        $res = DB::table('cate')->where('cate_id',$id)->update($post);
        // dump($res);
        if($res!==false){
            return redirect('/cate/index');   
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
        $res = Cate::destroy($id);
        if($res){
            // return redirect('./cate/index');
            echo json_encode(['code'=>'1','msg'=>'删除成功!']);die;
        }
    }

    public function checkName(){
        $cate_name = request()->cate_name;
        // echo $cate_name;exit;
        $count = Cate::where('cate_name',$cate_name)->count();
        echo $count;
    }
}
