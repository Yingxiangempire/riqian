<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', 'IndexController@index');//入口


/*************************************微信相关接口**************************************/
$router->get('/wechat', 'Wechat\WechatController@serve');//微信测试
$router->post('/auth/login', 'AuthController@postLogin');//登陆接口
$router->get('/oauth', 'Wechat\AuthController@oauth');//微信授权入口
$router->get('/auth/callback', 'Wechat\AuthController@callback');//微信授权回调
/*************************************微信相关接口end**********************************/

/*************************************接口**********************************************/
$router->post('/api/post', 'PostController@add');//发表日签
$router->get('/api/post', 'PostController@index');//获取日签列表
$router->post('/api/locationAndWeather', 'IndexController@request');//获取地点与天气
$router->post('/api/image', 'IndexController@imageUpload');//添加图片
$router->post('/api/tags', 'IndexController@tags');//获取标签
$router->get('/api/userInfo', 'AuthedBaseController@getUserInfo');//获取用户信息
/*************************************接口end*******************************************/

//$router->group(['middleware' => 'auth:api'], function($router)
//{
//    $router->post('/api/post', 'PostController@add');
//});
/*************************************测试**********************************************/
$router->get('/hope','ImageconductController@getHopePic');
$router->get('/test', 'TestController@test');//测试入口
/*************************************测试end*******************************************/


