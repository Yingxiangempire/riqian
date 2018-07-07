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
use App\Model\PostUserRecord;
use App\Http\Service\UploadToQiNiu;

class Post extends BaseAction
{

    const SUB_CONTENT_LENGTH=20;//日记摘要长度
    const POST_USER_RECORDS_ROW_COUNT=50;//发表日签的用户记录表每条数据存储用户个数
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
       //分表存储日记内容
       $post->content_id=$this->addContent($data['content']);
       key_exists('is_public',$data)?($post->is_public=$data['is_public']):'';
       //创建日签获取日签图片地址
       $image=new ImageConduct();
       $key= $image->getPicKey($data['user_id'],$data['tag'],$data['weather'],$data['location'],$subContent,$data['postfix']);
       $post->pic=$key;
       $post->save();
       //添加发表过日签用户的纪录
       $this->addPostUserRecord($data['user_id']);
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

    /**
     * 
     * 
     * @param $page
     * @param $userId
     * @return array
     * @create_at 18/6/19 下午11:29
     * @author 王玉翔
     */
    public static function getUserPostList($page,$userId)
    {
        $result=PostModel::where('userId',$userId)->paginate($page);
        if($result){
            $users=json_decode($result->users,true);
            $postLinks=[];
            foreach ($users as $user){
                $postLinks[]=UploadToQiNiu::URL_ADDRESS.$user.date('Ymd');
            }
            return $postLinks;
        }else{
            return [];
        }
    }



    /**
     * 获取今日日签列表
     * 
     * @param $page
     * @return array
     * @create_at 18/6/16 下午1:45
     * @author 王玉翔
     */
    public static function getPostList($page)
    {
        $result=PostUserRecord::where('date',strtotime(date('Y-m-d')))->where('page',$page)->select(['users'])->first();
        if($result){
            $users=json_decode($result->users,true);
            $postLinks=[];
            foreach ($users as $user){
                $postLinks[]=UploadToQiNiu::URL_ADDRESS.$user.date('Ymd');
            }
            return $postLinks;
        }else{
           return [];
        }
    }

    /**
     * 添加发表日签的用户集合纪录
     *
     * @param $userId
     * @return bool
     * @create_at 18/6/17 上午11:08
     * @author 王玉翔
     */
    public function addPostUserRecord($userId)
    {
        //todo 缓存页数缓存用户,直接添加或更新
        $record=PostUserRecord::where('date',strtotime(date('Y-m-d')))->select(['users'])->orderBy('page','DESC')->get();
        if($record){
            $users=json_decode($record->users,true);
            $page=$record->page;
            //判断存储用户数是否满足分页条件
            if(count($users)<self::POST_USER_RECORDS_ROW_COUNT) {
                $users[] = $userId;
                $record->users = json_encode($users);
            }else{
                $record=new PostUserRecord();
                $record->date=strtotime(date('Y-m-d'));
                $record->users=json_encode([$userId]);
                $record->page=$page+1;
            }
        }else{
            $record=new PostUserRecord();
            $record->date=strtotime(date('Y-m-d'));
            $record->users=json_encode([$userId]);
            $record->page=1;
        }
        return $record->save();
    }
    
}