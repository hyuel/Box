<?php
/**
 * Created by PhpStorm.
 * User: 作者
 * Date: 2018/12/13 0013
 * Time: 15:12
 */
namespace Wx\Shop\User;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class InfoRemarkUpdate extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 用户openid
     * @var string
     */
    private $openid = '';
    /**
     * 备注
     * @var string
     */
    private $remark = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $openid
     * @throws \Exception\Wx\WxException
     */
    public function setOpenid(string $openid)
    {
        if (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $openid) > 0) {
            $this->reqData['openid'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $remark
     * @throws \Exception\Wx\WxException
     */
    public function setRemark(string $remark)
    {
        if (strlen($remark) <= 30) {
            $this->reqData['remark'] = $remark;
        } else {
            throw new WxException('备注不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['openid'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['remark'])) {
            throw new WxException('备注不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
