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

Route::get('/cai/index','cai@index');
Route::get('/cai/add','cai@add');
Route::post('/cai/doadd','cai@doadd');
Route::get('/cai/cai','cai@cai');
Route::get('/cai/docai','cai@docai');
Route::get('/cai/list','cai@list');

Route::get('/cai/exam','cai@exam');

Route::get('/test/index','test@index');
Route::get('/test/add','test@add');
Route::get('/test/doadd','test@doadd');
Route::get('/test/test','test@test');
Route::get('/test/dotest','test@dotest');
Route::get('/test/list','test@list');
Route::get('/test/pro','test@pro');
Route::get('/in/index','in@index');
Route::get('/in/add','in@add');
Route::get('/in/create','in@create');
Route::get('/in/docreate','in@docreate');
Route::post('/in/doadd','in@doadd');

Route::get('/in/a','in@a');
Route::get('/in/b','in@b');
Route::get('/in/c','in@c');
Route::get('/in/delete','in@delete');
Route::get('/in/links','in@links');
Route::get('/in/link','in@link');
//物业管理
Route::get('/property/add','property@add');
Route::post('/property/doadd','property@doadd');
Route::get('/property/index','property@index');
Route::get('/property/create','property@create');
Route::post('/property/docreate','property@docreate');
Route::get('/property/list','property@list');
Route::get('/property/car','property@car');
Route::get('/property/addcar','property@addcar');
Route::post('/property/doaddcar','property@doaddcar');
Route::get('/property/car_index','property@car_index');
Route::get('/property/unsetcar','property@unsetcar');
Route::get('/property/login','property@login');
Route::post('/property/dologin','property@dologin');
//-----------------------实名-----------------------------------
Route::get('/real/index','real@index');
Route::post('/real/address','real@address');
//--------------------------------------------------------



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
    Route::get('order/order_index','order@order_index');
    Route::get('order/create','order@create');
    Route::get('order/indexs','order@order_indexs');
    Route::get('pay','PayController@do_pay');
    Route::get('return_url','PayController@return_url');//同步
    Route::post('notify_url','PayController@notify_url');//异步
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
        Route::get('/bank/add','bank@add');
        Route::get('/bank/index','bank@index');
        Route::post('/bank/doadd','bank@doadd');

Route::group(['middleware' => ['state']], function () {
  
    //用户
    Route::get('/User/index','User@admin_index');    
    Route::get('/User/add','User@admin_add');    
    Route::post('/User/do_add','User@do_add');    
    Route::get('/User/state','User@state');   

});

});

//新闻
    Route::get('/news/index','news@index');
    Route::get('/news/add','news@add');
    Route::post('/news/doadd','news@doadd');
    Route::get('/news/login','news@login');
    Route::post('/news/dologin','news@dologin');
    Route::get('/news/delete','news@delete');
    Route::get('/news/pro','news@pro');
    Route::get('/data','news@data');


