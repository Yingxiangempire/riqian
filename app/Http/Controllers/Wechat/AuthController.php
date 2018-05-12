<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/5/12
 * Time: 下午10:39
 */

namespace App\Http\Controllers\Wechat;


use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function oauth()
    {
        $app = app('wechat.official_account');
        return $app->oauth->scopes(['snsapi_userinfo'])
            ->redirect();
    }

    public function callback()
    {
        $app = app('wechat.official_account');
        $user = $app->oauth->user();
        var_dump($user);die;
    }

}