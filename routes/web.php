<?php

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

Route::get('/', function () {
    return view('welcome');
});




Route::get('/StudentController/login','StudentController@login');
Route::post('/StudentController/dologin','StudentController@dologin');

Route::group(['middleware' => ['login']], function () {
    Route::get('/StudentController/index','StudentController@index');
    Route::get('/StudentController/add','StudentController@add');
    Route::post('/StudentController/doadd','StudentController@doadd');
    Route::get('/StudentController/delete','StudentController@delete');
    Route::get('/StudentController/update','StudentController@update');
    Route::get('/StudentController/doupdate','StudentController@doupdate');
    Route::get('/StudentController/del','StudentController@del');
    Route::get('/StudentController/register','StudentController@register');
    Route::post('/StudentController/doregister','StudentController@doregister');
    Route::get('/StudentController/upload','StudentController@upload');
    Route::post('/StudentController/doupload','StudentController@doupload');

    //加入购物车
    Route::get('/Car/create','Car@create');
    Route::get('/Car/index','Car@index');
});
    Route::get('/Index/index','IndexController@index');
    Route::get('/Index/pro','IndexController@pro');


    
    //后台登录注册
    Route::get('/User/login','User@admin_login');
    Route::post('/User/dologin','User@dologin');
    Route::get('/User/register','User@admin_register');
    Route::post('/User/doregister','User@doregister');
    
   

Route::group(['middleware' => ['User']], function () {
  
    //商品
    Route::get('/Goods/index','GoodsController@index');
    Route::get('/Goods/add','GoodsController@add');
   
    Route::post('/Goods/doadd','GoodsController@doadd');
    Route::get('/Goods/del','GoodsController@del');
     

    //商品
        Route::group(['middleware' => ['update']], function () {
  
            Route::get('/Goods/update','GoodsController@update');
            Route::post('/Goods/doupdate','GoodsController@doupdate');

        });

Route::group(['middleware' => ['state']], function () {
  
    //用户
    Route::get('/User/index','User@admin_index');    
    Route::get('/User/add','User@admin_add');    
    Route::post('/User/do_add','User@do_add');    
    Route::get('/User/state','User@state');   

});

});


Route::get('pay','PayController@do_pay');
Route::get('return_url','PayController@return_url');//同步
Route::post('notify_url','PayController@notify_url');//异步
