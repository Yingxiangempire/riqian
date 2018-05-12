<?php

namespace App\Http\Controllers\wechat;


use Log;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
     

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return "欢迎关注 overtrue！";
        });

        return $app->server->serve();
    }
}
