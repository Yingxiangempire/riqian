<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/6/4
 * Time: 下午10:10
 */

namespace App\Action;

use App\Model\Content;
use App\Model\Post as PostModel;
use App\Http\Controllers\Service\ImageConduct;

class Post extends BaseAction
{

    const SUB_CONTENT_LENGTH=20;
    /**
     * 添加新日记
     * 
     * @param $data
     * @return mixed
     * @create_at 18/6/4 下午10:28
     * @author 王玉翔
     */
   public  function add($data){
       $post=new PostModel();
       $post->user_id=$data['user_id'];
       $post->weather=$data['weather'];
       $post->location=$data['location'];
       $post->tag=$data['tag'];
       $subContent=mb_substr($data['content'],0,self::SUB_CONTENT_LENGTH);
       $post->sub_content=$subContent;
       $post->words=mb_strlen($data['content']);
       $post->content_id=$this->addContent($data['content']);
       key_exists('is_public',$data)?($post->is_public=$data['is_public']):'';
       $image=new ImageConduct();
       $key= $image->getPicKey($data['user_id'],$data['tag'],$data['weather'],$data['location'],$subContent);
       $post->pic=$key;
       $post->save();
       return ['imageUrl'=>$key];
   }

    /**
     * 添加内容至内容表中
     * 
     * @param $content
     * @return mixed
     * @create_at 18/6/4 下午10:27
     * @author 王玉翔
     */
    private static function addContent($content)
    {
        $postContent=New Content();
        return $postContent->insertGetId(['content'=>$content,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
    }
    
}