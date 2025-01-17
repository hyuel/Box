<?php
/**
 * Created by PhpStorm.
 * User: 作者
 * Date: 2018/9/13 0013
 * Time: 7:21
 */
namespace Wx\OpenMini;

use Constant\ErrorCode;
use Exception\Wx\WxOpenException;
use Tool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

/**
 * 修改已设置的类目
 * @package Wx\OpenMini
 */
class CategorySetModify extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 类目信息列表
     * @var array
     */
    private $categories = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/wxopen/modifycategory?access_token=';
        $this->appId = $appId;
        $this->reqData['categories'] = [];
    }

    public function __clone()
    {
    }

    /**
     * @param array $categoryInfo
     * @throws \Exception\Wx\WxOpenException
     */
    public function addCategory(array $categoryInfo)
    {
        if (empty($categoryInfo)) {
            throw new WxOpenException('类目信息不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        $this->reqData['categories'][] = $categoryInfo;
    }

    public function getDetail() : array
    {
        if (empty($this->reqData['categories'])) {
            throw new WxOpenException('类目信息不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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
