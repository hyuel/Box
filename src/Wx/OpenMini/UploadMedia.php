<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/4/19 0019
 * Time: 9:34
 * Author: oywb
 * Author: iishappyabu@163.com
 */

namespace Wx\OpenMini;

use Constant\ErrorCode;
use Exception\Wx\WxOpenException;
use Tool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class UploadMedia extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';

    private $file_path = '';


    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/uploadmedia?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $file_path
     */
    public function setFilePath(string $file_path)
    {
        $this->file_path = $file_path;
        if (empty($file_path)) {
            throw new WxOpenException('上传审核图片不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        $this->reqData['media'] = '@' . realpath($this->file_path);
    }


    public function getDetail(): array
    {
        if (!isset($this->reqData['media'])) {
            throw new WxOpenException('审核列表不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        $resArr = [
            'code' => 0,
        ];
        $token = WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $api_url = $this->serviceUrl . $token;
        $file = realpath($this->file_path);
        $post_data['media'] = new \CURLFile($file);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sendRes = curl_exec($ch);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }
        return $resArr;
    }
}