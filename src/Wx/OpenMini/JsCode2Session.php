<?php
/**
 * Created by PhpStorm.
 * User: 作者
 * Date: 2018/9/13 0013
 * Time: 7:47
 */
namespace Wx\OpenMini;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxOpenException;
use Tool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class JsCode2Session extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 登录凭证
     * @var string
     */
    private $jsCode = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/sns/component/jscode2session';
        $this->appId = $appId;
        $this->reqData['grant_type'] = 'authorization_code';
        $this->reqData['appid'] = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $jsCode
     * @throws \Exception\Wx\WxOpenException
     */
    public function setJsCode(string $jsCode)
    {
        if (strlen($jsCode) > 0) {
            $this->reqData['js_code'] = $jsCode;
        } else {
            throw new WxOpenException('登录凭证不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['js_code'])) {
            throw new WxOpenException('登录凭证不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $componentAppId = WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId();
        $this->reqData['component_appid'] = $componentAppId;
        $this->reqData['component_access_token'] = WxUtilOpenBase::getComponentAccessToken($componentAppId);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['openid'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
