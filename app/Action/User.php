<?php

namespace App\Action;

/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/5/13
 * Time: 下午2:48
 */
use App\User as UserModel;
use Illuminate\Support\Facades\Hash;


class User extends BaseAction
{

    /**
     * 创建或者更新用户
     *
     * @param $data
     * @param null $id
     * @return bool
     * @throws \Exception
     * @create_at 18/5/13 下午3:28
     * @author 王玉翔
     */
    public function addOrUpdateUser($data, $id = null)
    {
        $user = $id ? UserModel::find($id) : new UserModel();
        if ($data['openid'] || $data['phone']) {
            if($id){
                return $user->update($data);
            }else{
                return $user->insertGetId($data);
            }
        } else {
            throw new \Exception('用户信息不完整,创建失败');
        }
    }


    /**
     * 微信回调后添加新用户
     *
     * @param $wechatUser
     * @return bool
     * @throws \Exception
     * @create_at 18/5/13 下午3:33
     * @author 王玉翔
     */
    public function findOrCreateUser($wechatUser)
    {
        $user=UserModel::where('openid',$wechatUser->id)->get()->toArray();
        if($user){
            return $user[0]['id'];
        }else{
            $data['nick_name']=$wechatUser->nickname;
            $data['password']=Hash::make($wechatUser->id);
            $data['avatar']=$wechatUser->avatar;
            $data['name']=$wechatUser->name;
            $data['openid']=$wechatUser->id;
            return $this->addOrUpdateUser($data);
        }
    }

}