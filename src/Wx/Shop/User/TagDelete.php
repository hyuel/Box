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

class TagDelete extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 标签ID
     * @var int
     */
    private $id = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param int $id
     * @throws \Exception\Wx\WxException
     */
    public function setId(int $id)
    {
        if ($id > 0) {
            $this->reqData['id'] = $id;
        } else {
            throw new WxException('标签ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['id'])) {
            throw new WxException('标签ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode([
            'tag' => $this->reqData,
        ], JSON_UNESCAPED_UNICODE);
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
