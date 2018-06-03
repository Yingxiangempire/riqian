<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/5/12
 * Time: 下午10:39
 */

namespace App\Http\Controllers\Wechat;


use App\Action\User;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Cookie as SCookie;

class AuthController extends Controller
{

    /**
     * 微信授权请求地址
     *
     * @return mixed
     * @create_at 18/5/13 下午2:39
     * @author 王玉翔
     */
    public function oauth()
    {
        $app = app('wechat.official_account');
        return $app->oauth->scopes(['snsapi_userinfo'])
            ->redirect();
    }

    /**
     * 微信回调后跳转至应用首页
     *
     * @create_at 18/5/13 下午2:38
     * @author 王玉翔
     */
    public function callback()
    {
        $app = app('wechat.official_account');
        $user = $app->oauth->user();
        //附带着openid跳转到首页位置
         $id=$this->getUserInfo($user);
        
        return redirect('/?a=c');
    }

    /**
     * 获取JWTToken
     *
     * @param $user
     * @create_at 18/5/13 下午2:41
     * @author 王玉翔
     */
    private function getJWTToken($user)
    {

    }

    /**
     * 获取用户信息
     * 如果openID不存在,则创建新用户,如果存在则返回用户信息
     *
     * @create_at 18/5/13 下午2:41
     * @author 王玉翔
     */
    private function getUserInfo($user)
    {
         $useAction=new User();
         return $useAction->findOrCreateUser($user);
    }

}