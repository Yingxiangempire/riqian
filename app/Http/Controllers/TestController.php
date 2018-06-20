<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/5/13
 * Time: 下午1:07
 */

namespace App\Http\Controllers;


use App\Action\Post;
use App\Http\Controllers\Service\ImageConduct;
use App\Http\Service\UploadToQiNiu;
use App\Model\PostUserRecord;
use App\User;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{

    public function test()
    {
        $post=PostUserRecord::find(1);
        $post->users=json_encode([7,8,9,10,11,12,13,14,15,16,17,18]);
        $post->save();
die;

//        $postAction=new Post();
//        $post=$postAction->add(['user_id'=>21,'location'=>'甘肃武威','weather'=>12,'tag'=>3,'pic'=>'http://7xj8z5.com1.z0.glb.clouddn.com/0a8a8e30047169616d3c75749e64c579bfe2a425','content'=>'今天是个好日子,明天还是个好提子,aaaaa']);
    
//           $upload=new UploadToQiNiu();
//           $upload->upload('/Users/yuxiangwang/yingxiangriqian/public/0.png','wang');
        $image=new ImageConduct();
        var_dump('dddd');die;
        return $image->getHopePic('8', '', '', '', '我想有个家');
    }

}