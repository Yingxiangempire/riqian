<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/6/3
 * Time: 下午1:08
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Cookie as SCookie;
use Auth;
use Illuminate\Support\Facades\Storage;

class IndexController extends AuthedBaseController
{
    public function index()
    {
        \Illuminate\Support\Facades\View::addExtension('html', 'php');

        return response(view('index'))->withCookie(new SCookie('sid', 'sid9999', time() + 3600));
    }

    public function request()
    {
        header("Access-Control-Allow-Origin: *");
        return json_encode(['data' => ['weather' => '晴朗', 'location' => '张江高科']]);
    }


    public function tags()
    {
        header("Access-Control-Allow-Origin: *");
        $tags = ['生活', '感悟', '纪念', '游记', '愿望'];
        return json_encode($tags);
    }

    public function imageUpload()
    {
        header("Access-Control-Allow-Origin: *");
        $file = Request::file('img');
        $uploadPath = 'userImage/'.$this->user['id'];
        if (!Storage::exists($uploadPath)) {
            Storage::makeDirectory($uploadPath, 0777, true, true);
        }
        if (($_FILES["img"]["type"] == "image/gif")

            || ($_FILES["img"]["type"] == "image/jpeg")

            || ($_FILES["img"]["type"] == "image/jpg")

            || ($_FILES["img"]["type"] == "image/png")

            || ($_FILES["img"]["type"] == "image/pjpeg")
        ) // && ($_FILES["file"]["size"] < 20000)) // 小于20k

        {
            if ($_FILES["img"]["error"] > 0) {
                $info = $_FILES["img"]["error"]; // 错误代码
                return $this->response->error($info)->setStatusCode(400);
            } else {
                $filename = $_FILES['img']['name']; // 得到文件全名
                $dotArray = explode('.', $filename); // 以.分割字符串，得到数组
                $type = end($dotArray); // 得到最后一个元素：文件后缀
                $path = $uploadPath.'/'.date('Ymd').'.'.$type;
                Storage::put($path, file_get_contents($file->getRealPath()));
                return ['result'=>0,'data'=>['url'=>'http://'.Request::getHost().'/'.$path]];
            }
        }
    }

}