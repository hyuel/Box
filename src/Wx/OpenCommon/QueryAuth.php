<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/5 0005
 * Time: 12:53
 */

namespace Wx\OpenCommon;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Tool\Tool;
use Wx\WxBaseOpenCommon;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class QueryAuth extends WxBaseOpenCommon
{
    /**
     * @var string
     */
    private $urlPreAuth = '';
    private $urlAuthCallback = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token=';
        $this->urlPreAuth = 'https://mp.weixin.qq.com/cgi-bin/componentloginpage';
        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        $this->reqData['component_appid'] = $openCommonConfig->getAppId();
        $this->urlAuthCallback = $openCommonConfig->getUrlAuthCallback();
    }

    public function __clone()
    {
    }

    public function setAuth_code($authorization_code){
        $this->reqData['authorization_code'] = $authorization_code;
    }

    public function getDetail() : array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken($this->reqData['component_appid']);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        return $sendData;
    }
}
