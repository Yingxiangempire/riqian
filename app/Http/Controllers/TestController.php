<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/5/13
 * Time: 下午1:07
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{

    public function test()
    {
        $useAction=new \App\Action\User();
        return $useAction->addOrUpdateUser(['openid'=>'ssss','password'=>'wangyuxiang']);



        return redirect('/');
        $userModel=new User();
        $userModel->name='wangyuxiang';
        $userModel->email='wangyuxiang@km.co';
        $userModel->password= Hash::make('wangyuxiang');
        $userModel->save();
    }

}