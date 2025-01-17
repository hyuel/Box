<?php
/**
 * Created by PhpStorm.
 * User: 作者
 * Date: 18-9-12
 * Time: 下午10:47
 */
namespace Wx\OpenCommon;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxOpenException;
use Tool\Tool;
use Wx\WxBaseOpenCommon;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class AuthorizerAccessToken extends WxBaseOpenCommon
{
    /**
     * 刷新令牌
     * @var string
     */
    private $refreshToken = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_authorizer_token?component_access_token=';
        $this->reqData['component_appid'] = WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId();
        $this->reqData['authorizer_appid'] = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $refreshToken
     * @throws \Exception\Wx\WxOpenException
     */
    public function setRefreshToken(string $refreshToken)
    {
        if (strlen($refreshToken) > 0) {
            $this->reqData['authorizer_refresh_token'] = $refreshToken;
        } else {
            throw new WxOpenException('刷新令牌不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['authorizer_refresh_token'])) {
            throw new WxOpenException('刷新令牌不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
//        if (!isset($this->reqData['refresh_token'])) {
//            throw new WxOpenException('刷新令牌不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
//        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken($this->reqData['component_appid']);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);

        $sendData = Tool::jsonDecode($sendRes);
        if (!isset($sendData['authorizer_access_token'])) {
            $errmsg = isset($sendData['errmsg']) ? $sendData['errmsg'] : '';
            throw new WxOpenException('获取授权者access token失败'.$errmsg, ErrorCode::WXOPEN_POST_ERROR);
        }

        return $sendData;
    }
}
