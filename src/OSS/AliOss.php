<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/22 0022
 * Time: 0:14
 */

namespace OSS;
require_once __DIR__."/aliyun-oss-php-sdk/autoload.php";
use OSS\OssClient;
use OSS\Core\OssException;

class AliOss
{
    //参考 https://help.aliyun.com/document_detail/31837.html?spm=5176.doc31835.6.572.1aIZuJ
    /**
     * 根据Config配置，得到一个OssClient实例
     *
     * @return OssClient 一个OssClient实例
     */
    public static function getOssClient()
    {
        try {
            $accessKeyId = \Yaconf::get('oss.base.access.key.id');
            $accessKeySecret = \Yaconf::get('oss.base.access.key.secret');
            $endpoint = \Yaconf::get('oss.base.endpoint.domain');
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint, false);
        } catch (OssException $e) {
            printf(__FUNCTION__ . "creating OssClient instance: FAILED\n");
            printf($e->getMessage() . "\n");
            return null;
        }
        return $ossClient;
    }


    public static function getBucketName()
    {
        return $bucket = \Yaconf::get('oss.base.bucket.name');
    }


    public static function toCdnUrl($ossUrl){
        $oss_base_url = \Yaconf::get('oss.base.url');
        $cdn_url = \Yaconf::get('oss.base.cdn.url');
        if(preg_match("/^http(s)?:\\/\\/.+/",$oss_base_url) && preg_match("/^http(s)?:\\/\\/.+/",$cdn_url))
        {
            $file_url = str_replace($oss_base_url,$cdn_url,$ossUrl);
        }else{
            $file_url = $ossUrl;
        }
        return $file_url;
    }

    /**
     * oss上传图片
     *
     * @return array
     * @throws \OSS\Core\OssException
     */
    public static function uploadImage($file,$path = 'pwd',$ossPath='')
    {
        $ossClient  = AliOss::getOssClient();
        $bucketName = AliOss::getBucketName();

        // 文件名
        $fileName = $file['name'];
        // 临时文件位置
        $tmpFile = $file['tmp_name'];
        if(empty($ossPath)){
            // 定义文件存储的oss位置
            $ossPath = $path.'/'.date('Y-m-d').'/'.date('Hi') .mt_rand(10000,99999);
        }
        // 定义oss object
        $object = $ossPath .'.' .AliOss::getExtension($fileName);
        // 执行上传并获取返回 oss 信息
        $result = $ossClient->uploadFile($bucketName, $object, $tmpFile);
        $http_code = isset($result['info']["http_code"]) ? $result['info']["http_code"] : -1;
        $data = [];
        if($http_code == 200){
            $data['code'] = 0;
            $data['msg'] = '上传成功';
            $data['data']['detail'] = $result;
            $ossUrl = $result['oss-request-url'];
            // 如果图片的协议是http，则转换成https
            if (substr($ossUrl, 0, 4) == 'http') {
                $ossUrl = substr_replace($ossUrl, 'https', 0, 4);
            }
            $data['data']['file_url'] = AliOss::toCdnUrl($ossUrl);

            $data['data']['file_name'] = basename($ossUrl);
        }else{
            $data['code'] = $http_code;
            $data['msg'] = '上传失败';
            $data['data']['detail'] = $result;
        }
        return $data;
    }

    /**
     * 返回文件扩展名
     *
     * @param $fileName
     * @return mixed
     */
    private static function getExtension($fileName)
    {
        return pathinfo($fileName)['extension'];
    }

}
