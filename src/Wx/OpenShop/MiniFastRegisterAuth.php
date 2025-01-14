<?php
/**
 * Created by PhpStorm.
 * User: 作者
 * Date: 18-9-13
 * Time: 上午12:45
 */
namespace Wx\OpenShop;

use DesignPatterns\Singletons\WxConfigSingleton;
use Wx\WxBaseOpenShop;

class MiniFastRegisterAuth extends WxBaseOpenShop
{
    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://mp.weixin.qq.com/cgi-bin/fastregisterauth';
        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        $this->reqData['component_appid'] = $openCommonConfig->getAppId();
        $this->reqData['appid'] = $appId;
        $this->reqData['copy_wx_verify'] = 1;
        $this->reqData['redirect_uri'] = $openCommonConfig->getUrlMiniFastRegister();
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        return [
            'url' => $this->serviceUrl . '?' . http_build_query($this->reqData),
        ];
    }
}
