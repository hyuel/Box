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
     * ���Ľ���
     * @param string $encryptXml ���ģ���ӦPOST���������
     * @param string $appId ����ƽ̨app id
     * @param string $appToken ����ƽ̨��ϢУ��token
     * @param string $msgSignature ǩ��������ӦURL������msg_signature
     * @param string $nonceStr ���������ӦURL������nonce
     * @param string $timestamp ʱ��� ��ӦURL������timestamp
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
            throw new WxOpenException('ǩ����֤����', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        try {
            //�õ�ǰ��keyУ������
            $res = self::decrypt($encryptXml, $appId, 'new');
        } catch (\Exception $e) {
            //���ϴε�keyУ������
            $res = self::decrypt($encryptXml, $appId, 'old');
        }

        return $res;
    }
    /**
     * ����POST�����ύ
     * @params string $url : �����ַ
     * @params json $data �� ���͵�json��ʽ����
     */
    public static  function https_post($url , $data=array()){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // POST����
        curl_setopt($ch, CURLOPT_POST, 1);
        // ��post�ı�������
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;

    }
    /**
     * ����GET�����ύ
     * @params string $url : �����ַ
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