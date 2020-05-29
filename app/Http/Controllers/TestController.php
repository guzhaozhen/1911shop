<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index(){
        echo '这是首页';
    }

    public function add(){
       $post = request()->post();
       dump($post);
       return view('add');
    }

    public function addDo(Request $request){
        /**接受所有值*/
        // $post = $request->all();
        // $post = $request->input();
        $post = $request->post();
        dump($post);

        /**只接收一个值*/
        // $name = $request->name;
        // $name = $request->post('name');
        // $name = $request->input('name');
        // dd($name);

        /**排除接受的值 */
        // $data = $request->except(['name','pwd']);
        // dump($data);

        /**只接收的值 */
        // $data = $request->only(['name','pwd']);
        // dd($data);
        return view('add');
    }

    public function goods($id,$name){
        echo $id.'-'.$name;
    }
    
    public function show($id=0){
        echo $id;
    }

    public function detail($id,$name=null){
        echo $id.'-'.$name;
    }

}
