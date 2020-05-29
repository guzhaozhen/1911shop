<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Article;
use App\Atype;

use App\Http\Requests\StoreArticlePost;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atypeInfo = Atype::all();

        $articleInfo = Article::join('atype','article.c_id','=','atype.c_id')->get();
        return view('admin.article.index',['atypeInfo'=>$atypeInfo,'articleInfo'=>$articleInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $atypeInfo = Atype::all();
        // dump($atypeInfo);

        return view('admin.article.create',['atypeInfo'=>$atypeInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->except('_token');
        $data['w_time'] = time();

        //判断文件有没有上传
        if ($request->hasFile('w_logo')) { 
            $data['w_logo']=upload('w_logo');
        }


        $validatedData = $request->validate([ 
            'w_title' => 'required|unique:article',
            'w_author' => 'required', 
        ],[
            'w_title.required'=>'文章标题必填',
            'w_title.unique'=>'文章标题已存在',
            'w_author.required'=>'文章作者必填',
        ]);


        $res = Article::insert($data);
        if($res){
            return redirect('/article/index');
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
        $atypeInfo = Atype::all();

        $articleInfo = Article::find($id);
        // dd($atypeInfo);
        return view('admin.article.edit',['atypeInfo'=>$atypeInfo,'articleInfo'=>$articleInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except('_token');

        //判断文件有没有上传
        if ($request->hasFile('w_logo')) { 
            $data['w_logo']=upload('w_logo');
        }

        $res = Article::where('w_id',$id)->update($data);

        if($res!==false){
            return redirect('article/index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Article::destroy($id);
        if($res){
            return redirect('/article/index');
        }

    }
}
