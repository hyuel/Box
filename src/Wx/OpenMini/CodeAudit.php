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

class CodeAudit extends WxBaseOpenMini
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
    private $preview_info = [];
    private $feedback_stuff = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/submit_audit?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param array $auditList
     * @throws \Exception\Wx\WxOpenException
     */
    public function setAuditList(array $auditList)
    {
        $auditNum = count($auditList);
        if ($auditNum == 0) {
            throw new WxOpenException('审核列表不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        } elseif ($auditNum > 5) {
            throw new WxOpenException('审核列表数量不能超过5个', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $this->reqData['item_list'] = $auditList;
    }

    /**
     * @param array $preview_info
     */
    public function setPreviewInfo(array $preview_info)
    {
        $this->preview_info = $preview_info;
        $infoNum = count($this->preview_info);
        if ($infoNum == 0) {
            throw new WxOpenException('审核图片不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        $this->reqData['preview_info'] = $preview_info;

    }

    /**
     * @param array $feedback_stuff
     */
    public function setFeedbackStuff(array $feedback_stuff)
    {
        $this->feedback_stuff = $feedback_stuff;
        $infoNum = count($this->feedback_stuff);
        if ($infoNum == 0) {
            throw new WxOpenException('media_id 列表不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        $this->reqData['feedback_stuff'] = $preview_info;
        $this->feedback_stuff = $feedback_stuff;
    }



    public function getDetail() : array
    {
        if (!isset($this->reqData['item_list'])) {
            throw new WxOpenException('审核列表不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];
        try{
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
        }catch (\Exception $e){
            echo 'error:'.$e->getMessage().' '.$e->getTraceAsString();
        }

        return $resArr;
    }
}
