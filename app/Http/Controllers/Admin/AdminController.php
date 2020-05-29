<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Admin;

use App\Http\Requests\StoreAdminPost;

use Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *展示列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('app.pageSize');
        
        
        //ORM
        $adminInfo = Admin::orderBy('admin_id','desc')->paginate($pageSize);

        //ajax分页
        if(request()->ajax()){
            return view('admin.admin.ajaxindex',['adminInfo'=>$adminInfo]);
        }
        
        return view('admin.admin.index',['adminInfo'=>$adminInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminPost $request)
    {
        $post = $request->except('_token');
        $post['admin_time'] = time();
        $post['admin_pwd'] = encrypt($post['admin_pwd']);
        //  dump($post);

        /**文件上传 */
        //1.判断有没有文件上传
        if ($request->hasFile('admin_logo')) { 
            $post['admin_logo']= $this->upload('admin_logo');
            // dd($img);
        }
        // dd($post);

        //ORM 添加
        $res = Admin::create($post);

        if($res){
            return redirect('/admin/index');
        }else{
            return redirect('/admin/create');
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
     *修改视图页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        //ORM
        $adminInfo = Admin::find($id);
        $adminInfo->admin_pwd = decrypt($adminInfo->admin_pwd);

        // dd($brand);
        return view('admin.admin.edit',['adminInfo'=>$adminInfo]);
    }

    /**
     * Update the specified resource in storage.
     *修改执行
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdminPost $request, $id)
    {
        $post = $request->except('_token');
        // dump($post);
        // dd($post);

        if ($request->hasFile('admin_logo')) { 
            $post['admin_logo']= $this->upload('admin_logo');
            // dd($img);
        }

        //ORM 更新第二种方法
        $res = Admin::where('admin_id',$id)->update($post);

        // dump($res);
        if($res!==false){
            return redirect('/admin/index');   
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
        //ORM
        $res = Admin::destroy($id);
        
        if($res){
            return redirect('/admin/index');  
        }
    }
}
