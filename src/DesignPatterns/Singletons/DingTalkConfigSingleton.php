<?php
/**
 * 钉钉配置单例类
 * User: 姜伟
 * Date: 2017/6/17 0017
 * Time: 11:18
 */
namespace DesignPatterns\Singletons;

use DingDing\TalkConfigProvider;
use Tool\Tool;
use Traits\DingTalkConfigTrait;
use Traits\SingletonTrait;

class DingTalkConfigSingleton {
    use SingletonTrait;
    use DingTalkConfigTrait;

    /**
     * 企业服务商公共配置
     * @var \DingDing\TalkConfigProvider
     */
    private $corpProviderConfig = null;

    /**
     * @return \DesignPatterns\Singletons\DingTalkConfigSingleton
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct(){
        $configs = Tool::getConfig('dingtalk.' . SY_ENV . SY_PROJECT);

        //初始化企业服务商公共配置
        $corpProviderConfig = new TalkConfigProvider();
        $corpProviderConfig->setCorpId((string)Tool::getArrayVal($configs, 'provider.corp.id', '', true));
        $corpProviderConfig->setSsoSecret((string)Tool::getArrayVal($configs, 'provider.sso.secret', '', true));
        $corpProviderConfig->setToken((string)Tool::getArrayVal($configs, 'provider.token', '', true));
        $corpProviderConfig->setAesKey((string)Tool::getArrayVal($configs, 'provider.aeskey', '', true));
        $corpProviderConfig->setSuiteId((int)Tool::getArrayVal($configs, 'provider.suite.id', 0, true));
        $corpProviderConfig->setSuiteKey((string)Tool::getArrayVal($configs, 'provider.suite.key', '', true));
        $corpProviderConfig->setSuiteSecret((string)Tool::getArrayVal($configs, 'provider.suite.secret', '', true));
        $corpProviderConfig->setLoginAppId((string)Tool::getArrayVal($configs, 'provider.login.app.id', '', true));
        $corpProviderConfig->setLoginAppSecret((string)Tool::getArrayVal($configs, 'provider.login.app.secret', '', true));
        $corpProviderConfig->setLoginUrlCallback((string)Tool::getArrayVal($configs, 'provider.login.url.callback', '', true));
        $this->corpProviderConfig = $corpProviderConfig;
    }

    private function __clone(){
    }

    /**
     * 获取企业服务商公共配置
     * @return \DingDing\TalkConfigProvider
     */
    public function getCorpProviderConfig() {
        return $this->corpProviderConfig;
    }
}