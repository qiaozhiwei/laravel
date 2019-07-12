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

    //商品
    Route::get('/Goods/index','GoodsController@index');
    Route::get('/Goods/add','GoodsController@add');
    Route::get('/Index/index','IndexController@index');
    Route::post('/Goods/doadd','GoodsController@doadd');
    Route::get('/Goods/del','GoodsController@del');
    Route::get('/Goods/update','GoodsController@update');
    Route::post('/Goods/doupdate','GoodsController@doupdate');
});