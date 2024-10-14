<?php
/**
 * Created by PhpStorm.
 * User: 作者
 * Date: 2018/9/13 0013
 * Time: 7:34
 */
namespace Wx\OpenMini;

use Constant\ErrorCode;
use Exception\Wx\WxOpenException;
use Tool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

/**
 * 参考 https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/Plug-ins_Management.html
 * Class Wxa
 * @package Wx\OpenMini
 */
class PlugInsManagement extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 审核列表
     * @var array
     */
    private $auditList = [];

    /**
     * 插件的 appid
     * @var string
     */
    private $plugin_appid = '';

    /**
     * 操作类型
     * @var string
     */
    private $action = '';

    /**
     * @var string 升级至版本号，要求此插件版本支持快速更新
     */
    private $user_version = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/plugin?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    public function setAction(array $action)
    {
        $this->action = $action;
        $this->reqData['action'] = $action;
    }
    public function setPluginAppid(array $plugin_appid)
    {
        $this->plugin_appid = $plugin_appid;
        $this->reqData['plugin_appid'] = $plugin_appid;
    }
    public function setUserVersion(array $user_version)
    {
        $this->user_version = $user_version;
        $this->reqData['user_version'] = $user_version;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['action'])) {
            throw new WxOpenException('操作类型不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
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
