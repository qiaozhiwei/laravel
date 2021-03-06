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
    });
    

    Route::get('/index/index','index\index@index');
    Route::get('/index/music_upload','index\index@music_upload');
    Route::post('/index/doupload','index\index@doupload');
    Route::get('/index/access_token','index\index@access_token');
    Route::get('/index/img_upload','index\index@img_upload');
    Route::get('/index/qny_token','index\index@qny_token');
    Route::get('/index/cate_create','index\index@cate_create');
    Route::get('/index/cate_index','index\index@cate_index');
    Route::get('/index/cate_update','index\index@cate_update');
    Route::get('/index/vedio','index\index@vedio');
    Route::post('/index/do_mupload','index\index@do_mupload');
    Route::get('/index/upload','index\index@upload');
    Route::get('/index/get_vedio','index\index@get_vedio');
    Route::post('/index/docreate_cate','index\index@docreate_cate');
    Route::get('/index/cate_delete','index\index@cate_delete');
    Route::post('/index/doupdate_cate','index\index@doupdate_cate');
    Route::get('/index/get_img','index\index@get_img');
    Route::get('/user/qq_login','user\user@qq_login');
    Route::get('/index/get_cate','index\index@get_cate');
    Route::get('/index/get_where_cate','index\index@get_where_cate');
    Route::get('/index/create_history','index\index@create_history');
    Route::get('/index/history_index','index\index@history_index');
    Route::get('/index/history_del','index\index@history_del');
    Route::get('/index/song_list','index\index@song_list');

    //留言  练习
    Route::any('/text/index','text@index');
    Route::any('/text/liuyan','text@liuyan');
    Route::any('/text/liuyans','text@liuyans');
    Route::any('/text/send','text@send');

  
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


Route::get('/user/get_code','user\user@get_code');

Route::get('/user/login','user\user@login');
Route::post('/user/dologin','user\user@dologin');


//新闻
    Route::get('/news/index','news@index');
    Route::get('/news/add','news@add');
    Route::post('/news/doadd','news@doadd');
    Route::get('/news/login','news@login');
    Route::post('/news/dologin','news@dologin');
    Route::get('/news/delete','news@delete');
    Route::get('/news/pro','news@pro');
    Route::get('/data','news@data');


    Route::get('/wechat/get_info','wechat@get_info');
    Route::get('/wechat/get_list','wechat@get_list');
    Route::get('/wechat/pro','wechat@pro');
    Route::get('/wechat/access_token','wechat@access_token');
    Route::get('/wechat/login','wechat@login');
    Route::get('/wechat/code','wechat@code');
    Route::get('/wechat/xxoo','wechat@xxoo');
    Route::get('/wechat/ooxx','wechat@ooxx');
    Route::get('/wechat/view_index','wechat@view_index');
    Route::get('/wechat/del','wechat@del');
    Route::get('/wechat/upload','wechat@upload');
    Route::post('/wechat/doupload','wechat@doupload');
    Route::get('/wechat/get_source','wechat@get_source');
    Route::get('/wechat/source_index','wechat@source_index');
    Route::get('/wechat/upload_permanent','wechat@upload_permanent');
    Route::post('/wechat/do_upload_permanent','wechat@do_upload_permanent');
    Route::get('/wechat/del_source','wechat@del_source');
    //标签管理
    Route::get('/wechat/create_label','wechat@create_label');
    Route::post('/wechat/do_create_label','wechat@do_create_label');
    Route::get('/wechat/label_index','wechat@label_index');
    Route::get('/wechat/del_label','wechat@del_label');
    Route::get('/wechat/update_label','wechat@update_label');
    Route::post('/wechat/do_update_label','wechat@do_update_label');
    Route::get('/wechat/label_user_list','wechat@label_user_list');
    Route::get('/wechat/set_label','wechat@set_label');
    Route::get('/wechat/do_set_label','wechat@do_set_label');
    Route::get('/wechat/wechat_index','wechat@wechat_index');
    Route::get('/wechat/label_unset','wechat@label_unset');
    Route::get('/wechat/see_label','wechat@see_label');
    Route::get('/wechat/label_delete','wechat@label_delete');
    Route::get('/wechat/wechat_del_access_token','wechat@wechat_del_access_token');
    Route::get('/wechat/push_info','wechat@push_info');
    Route::post('/wechat/do_push_info','wechat@do_push_info');
    Route::get('/wechat/ticket','wechat@ticket');
    Route::get('/ceshi/a','ceshi@a');
    Route::post('/wechat/even','wechat@even');
    Route::get('/wechat/menu','wechat@menu');
    Route::get('/wechat/a','wechat@a');
    // //一级菜单
    // Route::get('/wechat/menu_add_one','wechat@menu_add_one');
    // Route::post('/wechat/doadd_one','wechat@doadd_one');
    //二级菜单
    Route::get('/wechat/menu_add','wechat@menu_add');
    Route::post('/wechat/doadd','wechat@doadd');
    //菜单列表
    Route::get('/wechat/menu_index','wechat@menu_index');
    Route::get('/wechat/menu_del','wechat@menu_del');
    Route::get('/wechat/push','wechat@push');
    Route::get('/wechat/push_two','wechat@push_two');

    //分销
    Route::get('/distribution/index','distribution@index');
    Route::get('/distribution/ticket','distribution@ticket');
    Route::get('/distribution/get_label','distribution@get_label');
    Route::get('/distribution/pro','distribution@pro');


    //表白
    Route::get('/express/add','express@add');
    Route::get('/express/doadd','express@doadd');
    Route::any('/express/index','express@index');
    Route::any('/express/mine','express@mine');
    Route::any('/express/add_mine','express@add_mine');
    Route::any('/express/push','express@push');
    Route::any('/express/user','express@user');
    Route::any('/text/info','text@info');
    Route::any('/wechat/user','wechat@user');
    //油价
    Route::any('/price/get_info','price@get_info');

    //b卷练习
    Route::get('/haoyan/create_menu','haoyan@create_menu');    
    Route::post('/haoyan/docreate','haoyan@docreate');    
    Route::get('/haoyan/index','haoyan@index');    
    //签到
    Route::get('/sign/add','sign@add');    
    Route::get('/sign/create_menu','sign@create_menu');    
    Route::get('/sign/index','sign@index');    
    Route::post('/sign/docreate','sign@docreate');    
    Route::get('/wechat/file_get_contents','wechat@file_get_contents');    
    Route::post('/wechat/san','wechat@san');
    //写接口
    Route::get('/member/show','api\member@show');    
    Route::get('/member/get_info','api\member@get_info');    
    Route::get('/member/get_GoodsInfo','api\member@get_GoodsInfo');
    Route::post('/member/Goods_info','api\member@Goods_info');

    Route::get('/member/create','api\member@create');
    Route::post('/member/docreate','api\member@docreate');
    Route::get('/member/index','api\member@index');
    Route::get('/member/index1','api\member@index1');
    Route::get('/member/query','api\member@query');
    Route::get('/member/del','api\member@del');
    Route::get('/member/update','api\member@update');
    Route::post('/member/doupdate','api\member@doupdate');
    Route::get('/member/xxoo','api\member@xxoo');
    Route::get('/member/a','api\member@a');
    //resful风格
    Route::resource('/ziyuan','api\ziyuan');
    //周考
    Route::get('/goodsinfo/create','api\goodsinfo@create');
    Route::post('/goodsinfo/docreate','api\goodsinfo@docreate');
    Route::get('/goodsinfo/index','api\goodsinfo@index');
    Route::get('/goodsinfo/getinfo','api\goodsinfo@getinfo');
    //加密解密
    Route::get('/goodsinfo/encryption','api\goodsinfo@encryption');
    Route::get('/goodsinfo/Decrypt','api\goodsinfo@Decrypt');
    Route::get('/goodsinfo/code','api\goodsinfo@code');
    Route::get('/goodsinfo/aes','api\goodsinfo@aes');
    Route::get('/goodsinfo/rsa','api\goodsinfo@rsa');
    Route::get('/goodsinfo/rsa_code','api\goodsinfo@rsa_code');
    Route::get('/goodsinfo/deCode','api\goodsinfo@deCode');
    Route::get('/goodsinfo/xxoo','api\goodsinfo@xxoo');
    //商城
    Route::get('/goods/style','good\goods@style');
    Route::post('/goods/dostyle','good\goods@dostyle');
    Route::get('/goods/cate','good\goods@cate');
    Route::post('/goods/docate','good\goods@docate');
    Route::get('/goods/create_goods','good\goods@create_goods');
    Route::get('/goods/commit','good\goods@commit');
    Route::get('/goods/type','good\goods@type');
    Route::post('/goods/dotype','good\goods@dotype');
    Route::get('/goods/yi','good\goods@yi');
    Route::get('/goods/type_index','good\goods@type_index');
    Route::get('/goods/style_index','good\goods@style_index');
    Route::get('/goods/style_list','good\goods@style_list');
    Route::get('/goods/del','good\goods@del');
    Route::get('/goods/test','good\goods@test');
    Route::get('/goods/info','good\goods@info');
    Route::get('/goods/search','good\goods@search');
    Route::get('/goods/vedio','good\goods@vedio');
    Route::get('/goods/auth','good\goods@auth');
    Route::get('/goods/auth_index','good\goods@auth_index');
    

    //考试
    Route::get('/test/request_index','api\test@request_index');
    Route::get('/test/register','api\test@register');
    Route::get('/test/do_register','api\test@do_register');
    Route::post('/test/order','api\test@order');

      //登陆
      Route::get('/live_user/login','live\live_user@login');
      Route::post('/live_user/dologin','live\live_user@dologin');

    
    
    //球赛后台管理系统
   

        Route::group(['middleware' => ['live_users']], function () {
        Route::get('/live_user/list','live\live_user@list');
        Route::get('/live_user/create','live\live_user@create');
        Route::post('/live_user/docreate','live\live_user@docreate');
        Route::get('/live_user/index','live\live_user@index');
        Route::get('/live_user/create_team','live\live_user@create_team');
        Route::post('/live_user/docreate_team','live\live_user@docreate_team');
        
});
        
Route::get('/live_user/index_login','live\live_user@index_login');
Route::post('/live_user/index_dologin','live\live_user@index_dologin');
    

    Route::group(['middleware' => ['islogin']], function () {


    Route::get('/live_user/chat','live\live_user@chat');
    Route::get('/live_user/redi','live\live_user@redi');
    Route::get('/live_user/choose_first','live\live_user@choose_first');
    Route::get('/live_user/team_match','live\live_user@team_match');
    Route::get('/live_user/choose_player','live\live_user@choose_player');

    
});
    //抓取
Route::get('/live_user/Grasp','live\live_user@Grasp');
    

    
    
Route::get('/act/create_act','test\act@create_act');
Route::post('/act/docreate_act','test\act@docreate_act');
Route::get('/act/act_index','test\act@act_index');
Route::get('/act/sign','test\act@sign');
Route::post('/act/dosign','test\act@dosign');
Route::get('/act/sign_list','test\act@sign_list');
Route::get('/act/aaa','test\act@aaa');


//cs
Route::get('/cs_user/create_user','cs\user@create_user');
Route::get('/cs_user/list_user','cs\user@list_user');
Route::get('/dis/create_line','cs\dis@create_line');
Route::post('/dis/docreate_line','cs\dis@docreate_line');



Route::get('/tran/addUser','tran\admin@addUser');
Route::get('/tran/adminindex','tran\admin@adminindex');
Route::get('/tran/login','tran\admin@login');
Route::post('/tran/do_adminlogin','tran\admin@do_adminlogin');
Route::post('/tran/doaddUser','tran\admin@doaddUser');
Route::get('/tran/index','tran\admin@index');
Route::get('/tran/addvideo','tran\admin@addvideo');
Route::get('/tran/tran','tran\admin@tran');







    
    
    
    
    
    
    
    

    
    
    

    
    

    

  
    
    

    
    
    
    
    
      
    


    