<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**闭包路由 */
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('hello', function () {
   echo "hello welocome to 1911";
});

/**走控制器路由 */
Route::get('index','TestController@index');

/**三种提交方式 */
//1.控制器方法
// Route::get('add','TestController@add');

//2.闭包路由
// Route::get('add', function () {
//     return view('add');
//  });


//3.路由视图
//  Route::view('add','add');
 Route::post('addDo','TestController@addDo');

 /**注册一个路由支持多种请求方式 */
//  Route::any('add','TestController@add');
Route::match(['get','post'],'add','TestController@addDo');

/**必选参数 */   //正则
Route::get('user/{id}', function ($id) { 
    return 'User ' . $id; 
})->where('id','\d+');

// Route::get('goods/{id}', function ($id) { 
//     return 'goods ' . $id; 
// });
//传一个
// Route::get('goods/{id}','TestController@goods');
//传多个
Route::get('goods/{id}/{name}','TestController@goods')->where(['id'=>'\d+','name'=>'[a-zA-Z]+']);

/**可选参数 */
Route::get('show/{id?}','TestController@show');
Route::get('detail/{id}/{name?}','TestController@detail');

Route::domain('admin.1911.com')->group(function () {
    Route::get('/','Admin\GoodsController@index')->middleware('login'); 
    /**商品品牌模块 */
    Route::prefix('brand')->middleware('login')->group(function(){
        Route::get('index','Admin\BrandController@index');     //展示
        Route::get('create','Admin\BrandController@create');   //添加
        Route::post('store','Admin\BrandController@store');     //执行添加
        Route::get('edit/{id}','Admin\BrandController@edit');   //修改视图
        Route::post('update/{id}','Admin\BrandController@update');  //修改
        Route::get('destroy/{id}','Admin\BrandController@destroy');  //删除
        Route::post('checkName','Admin\BrandController@checkName');
    });


    /**商品分类 */
    Route::prefix('cate')->middleware('login')->group(function(){
        Route::get('/index','Admin\CateController@index');     //展示
        Route::get('create','Admin\CateController@create');   //添加视图
        Route::post('store','Admin\CateController@store');     //执行添加
        Route::get('edit/{id}','Admin\CateController@edit');   //修改视图
        Route::post('update/{id}','Admin\CateController@update');  //修改
        Route::get('destroy/{id}','Admin\CateController@destroy');  //删除
        Route::post('checkName','Admin\CateController@checkName');
    });

    /**商品管理 */
    Route::prefix('goods')->middleware('login')->group(function(){
        Route::get('/index','Admin\GoodsController@index');     //展示
        Route::get('create','Admin\GoodsController@create');   //添加视图
        Route::post('store','Admin\GoodsController@store');     //执行添加
        Route::get('edit/{id}','Admin\GoodsController@edit');   //修改视图
        Route::post('update/{id}','Admin\GoodsController@update');  //修改
        Route::get('destroy/{id}','Admin\GoodsController@destroy');  //删除 
        Route::post('checkName','Admin\GoodsController@checkName');
    });

    /**管理员管理 */
    Route::prefix('admin')->middleware('login')->group(function(){
        Route::get('/index','Admin\AdminController@index');     //展示
        Route::get('create','Admin\AdminController@create');   //添加视图
        Route::post('store','Admin\AdminController@store');     //执行添加
        Route::get('edit/{id}','Admin\AdminController@edit');   //修改视图
        Route::post('update/{id}','Admin\AdminController@update');  //修改
        Route::get('destroy/{id}','Admin\AdminController@destroy');  //删除 
    });


    Route::get('/login','Admin\LoginController@index');
    Route::post('/logindo','Admin\LoginController@logindo'); 
    Route::get('/logout','Admin\LoginController@logout');

    //cookie练习
    Route::get('/setcookie','Admin\LoginController@setcookie');
    Route::get('/getcookie','Admin\LoginController@getcookie');

});




/**文章模块 */
Route::prefix('article')->middleware('login')->group(function(){
    Route::get('index','Admin\ArticleController@index');     //展示
    Route::get('create','Admin\ArticleController@create');   //添加
    Route::post('store','Admin\ArticleController@store');     //执行添加
    Route::get('edit/{id}','Admin\ArticleController@edit');   //修改视图
    Route::post('update/{id}','Admin\ArticleController@update');  //修改
    Route::get('destroy/{id}','Admin\ArticleController@destroy');  //删除
});




Route::domain('www.1911.com')->group(function () {
/**微商城前台首页 */
Route::get('/','Index\IndexController@index')->name('shop_index');
Route::get('/login','Index\LoginController@login');  //登录
Route::post('/logindo','Index\LoginController@logindo');
Route::get('/reg','Index\LoginController@reg');   //注册
Route::post('/regdo','Index\LoginController@regdo');
Route::get('/sendSms','Index\LoginController@sendSms');   //短信发送验证码
Route::get('/sendEmail','Index\LoginController@sendEmail');   //邮箱发送验证码

Route::get('/goods/{goods_id}','Index\GoodsController@index')->name('shop_goods');
Route::get('/addcar','Index\GoodsController@addcar');
Route::get('/cart','Index\CartController@index')->middleware('checkmember')->name('shop_cart');

Route::get('/news','Index\NewsController@index');



});