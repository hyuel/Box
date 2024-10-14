<?php
/**
 * Created by PhpStorm.
 * User: 作者
 * Date: 2018/9/13 0013
 * Time: 8:11
 */
namespace Wx\OpenMini;

use Constant\ErrorCode;
use Tool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class CodeRollback extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';

    /**
     * curl配置数组
     * @var array
     */
    protected $curlConfigs = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/revertcoderelease?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }


    public function getHistory() : array
    {
        $resArr = [
            'code' => 0,
            'message'=> ''
        ];
        $token = WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $token . '&action=get_history_version';
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData['version_list'];
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
