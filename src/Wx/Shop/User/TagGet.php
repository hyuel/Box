<?php
/**
 * Created by PhpStorm.
 * User: 作者
 * Date: 2018/12/13 0013
 * Time: 15:12
 */
namespace Wx\Shop\User;

use Constant\ErrorCode;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class TagGet extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['tags'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
