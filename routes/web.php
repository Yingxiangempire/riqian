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


$router->get('/', 'IndexController@index');


$router->get('/wechat', 'Wechat\WechatController@serve');
$router->get('/test', 'TestController@test');
// 路由
$router->post('/auth/login', 'AuthController@postLogin');

$router->get('/oauth', 'Wechat\AuthController@oauth');
$router->get('/auth/callback', 'Wechat\AuthController@callback');

$router->post('/editor', function () use ($router) {
    header("Access-Control-Allow-Origin: *");
    return json_encode(['data'=>['url'=>'http://7xj8z5.com1.z0.glb.clouddn.com/0a8a8e30047169616d3c75749e64c579bfe2a425']]);
});



$router->post('/api/post', function () use ($router) {
    header("Access-Control-Allow-Origin: *");
    return json_encode(['data'=>['imageUrl'=>'http://7xj8z5.com1.z0.glb.clouddn.com/0a8a8e30047169616d3c75749e64c579bfe2a425']]);
});

$router->get('/api/locationAndWeather', function () use ($router) {
    header("Access-Control-Allow-Origin: *");
    return json_encode(['data'=>['weather'=>'qing','location'=>'shanghai']]);
});