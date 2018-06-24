<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/6/4
 * Time: 下午9:24
 */

namespace App\Http\Controllers;


use App\Action\Post;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Service\ImageConduct;

class PostController extends AuthedBaseController
{


    public function myList(){
//        $page=$this->getInput('page','1');
        $page=1;
        $data=Post::getUserPostList($page,$this->user['id']);
        return $this->apiReturn($data);
    }

    /**
     * 获取日签图片列表(分页)
     *
     * @return mixed
     * @create_at 18/6/16 下午1:51
     * @author 王玉翔
     */
    public function index()
    {
//        $page=$this->getInput('page','1');
        $page=1;
        $data=Post::getPostList($page);
        return $this->apiReturn($data);
    }

    /**
     * 生成日签图片
     *
     * @return mixed
     * @throws \Exception
     * @create_at 18/6/9 下午12:35
     * @author 王玉翔
     */
    public function add()
    {
        $data['user_id']=$this->user['id'];
        $data['weather']=$this->getInputOrFail('weather');
        $data['location']=$this->getInputOrFail('location');
        $data['tag']=$this->getInputOrFail('tag');
        $image=explode('.',$this->getInputOrFail('images'));
        $data['postfix']=end($image);
        $data['content']=$this->getInputOrFail('content');
        $data['is_public']=$this->getInput('is_public',1);
        //创建生成图片
        $postAction=new Post();
        return $this->apiReturn($postAction->add($data));
    }
    
}