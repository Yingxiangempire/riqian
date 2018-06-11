<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/6/4
 * Time: 下午9:31
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AuthedBaseController extends Controller
{
    public $user;

    /**
     * AuthedBaseController constructor.
     */
    public function __construct()
    {
        $this->user=Auth::user()->toArray();
//        $this->user=User::find(8)->toArray();
    }

    /**
     * 封装获取必要参数
     *
     * @param $key
     * @return mixed
     * @throws \Exception
     * @create_at 18/6/5 下午11:04
     * @author 王玉翔
     */
    public function getInputOrFail($key)
    {
        $result= Input::get($key);
        if ($result){
            return $result;
        }else{
            throw new \Exception('参数错误',40100);
        }
    }

    /**
     * 封装获取参数
     *
     * @param $key
     * @param $default
     * @return mixed
     * @create_at 18/6/5 下午11:04
     * @author 王玉翔
     */
    public function getInput($key,$default='')
    {
        return Input::get($key,$default);
    }

    /**
     * 格式化接口返回数据
     *
     * @param $data
     * @return mixed
     * @create_at 18/6/9 下午12:34
     * @author 王玉翔
     */
    public function apiReturn($data)
    {
        $data=is_array($data)?$data:array($data);
        if(key_exists('status',$data)){
            return json_encode($data);
        }else{
            return json_encode(['status'=>0,'data'=>$data]);
        }
    }
}