<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/30 0030
 * Time: 17:51
 */

namespace Tool;


class MiniTool
{

    /**
     * 密文解密
     * @param string $encryptXml 密文，对应POST请求的数据
     * @param string $appId 开放平台app id
     * @param string $appToken 开放平台消息校验token
     * @param string $msgSignature 签名串，对应URL参数的msg_signature
     * @param string $nonceStr 随机串，对应URL参数的nonce
     * @param string $timestamp 时间戳 对应URL参数的timestamp
     * @return array
     * @throws \Exception\Wx\WxOpenException
     */
    public static function decryptMsg(string $encryptXml, string $appId, string $appToken, string $msgSignature, string $nonceStr, string $timestamp = '') : array
    {
        if ($timestamp) {
            $nowTime = $timestamp . '';
        } else {
            $nowTime = Tool::getNowTime() . '';
        }

        $signature = self::getSha1Val($appToken, $nowTime, $nonceStr, $encryptXml);
        if ($signature != $msgSignature) {
            throw new WxOpenException('签名验证错误', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        try {
            //用当前的key校验密文
            $res = self::decrypt($encryptXml, $appId, 'new');
        } catch (\Exception $e) {
            //用上次的key校验密文
            $res = self::decrypt($encryptXml, $appId, 'old');
        }

        return $res;
    }
    /**
     * 发起POST网络提交
     * @params string $url : 网络地址
     * @params json $data ： 发送的json格式数据
     */
    public static  function https_post($url , $data=array()){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // POST数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;

    }
    /**
     * 发起GET网络提交
     * @params string $url : 网络地址
     */
    public static function https_get($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE) ;
        curl_setopt($curl, CURLOPT_TIMEOUT,60);
        if (curl_errno($curl)) {
            return 'Errno'.curl_error($curl);
        }
        else{$result=curl_exec($curl);}
        curl_close($curl);
        return $result;
    }
}