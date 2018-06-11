<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/6/6
 * Time: 下午9:46
 */

namespace App\Http\Service;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class UploadToQiNiu
{
    public $token;
    public $uploadMgr;
    Const URL_ADDRESS='http://7xikr3.com1.z0.glb.clouddn.com/';
    public function __construct()
    {
        $accessKey = "fd18vB9dQIFsHW3Bl9F1VaIG0karpTsyr-tuxk_k";
        $secretKey = "h7gO5V84pk8Mwjh-oE2DETtGk3umhFbCyreGjiuE";
        $bucket = "workplace-ant";
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 生成上传 Token
        $this->token = $auth->uploadToken($bucket);
        $this->uploadMgr=new UploadManager();
    }


    /**
     * 上传至七牛服务器
     * 
     * @param $filePath
     * @param $key
     * @return mixed
     * @throws \Exception
     * @create_at 18/6/7 上午11:55
     * @author 王玉翔
     */
    public function uploadThroughPath($filePath,$key)
    {
        list($ret, $err) = $this->uploadMgr->putFile($this->token, $key, $filePath);
        if ($err !== null) {
            throw new \Exception($err);
        } else {
            return self::URL_ADDRESS.$key;
        }
    }
    
    
}