<?php
/**
 * Created by PhpStorm.
 * User: 作者
 * Date: 2018/12/14 0014
 * Time: 16:01
 */
namespace Wx\Shop\Merchant\PostageTemplate;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class TemplateUpdate extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 模板ID
     * @var string
     */
    private $template_id = '';
    /**
     * 模板名称
     * @var string
     */
    private $Name = '';
    /**
     * 支付方式(0-买家承担运费 1-卖家承担运费)
     * @var int
     */
    private $Assumer = 0;
    /**
     * 计费单位(0-按件计费 1-按重量计费 2-按体积计费 目前只支持按件计费,默认为0)
     * @var int
     */
    private $Valuation = 0;
    /**
     * 运费计算列表
     * @var array
     */
    private $TopFee = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/express/update?access_token=';
        $this->appid = $appId;
        $this->reqData['Valuation'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param string $templateId
     * @throws \Exception\Wx\WxException
     */
    public function setTemplateId(string $templateId)
    {
        if (ctype_alnum($templateId)) {
            $this->template_id = $templateId;
        } else {
            throw new WxException('模板ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $name
     * @throws \Exception\Wx\WxException
     */
    public function setName(string $name)
    {
        if (strlen($name) == 0) {
            $this->reqData['Name'] = $name;
        } else {
            throw new WxException('模板名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $assumer
     * @throws \Exception\Wx\WxException
     */
    public function setAssumer(int $assumer)
    {
        if (in_array($assumer, [0, 1], true)) {
            $this->reqData['Assumer'] = $assumer;
        } else {
            throw new WxException('支付方式不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $feeList
     */
    public function setTopFee(array $feeList)
    {
        foreach ($feeList as $eFee) {
            if (isset($eFee['Type']) && ctype_digit($eFee['Type'])) {
                $this->TopFee[$eFee['Type']] = $eFee;
            }
        }
    }

    /**
     * @param array $feeInfo
     * @throws \Exception\Wx\WxException
     */
    public function addFee(array $feeInfo)
    {
        if (isset($feeInfo['Type']) && ctype_digit($feeInfo['Type'])) {
            $this->TopFee[$feeInfo['Type']] = $feeInfo;
        } else {
            throw new WxException('运费计算信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->template_id) == 0) {
            throw new WxException('模板ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['Name'])) {
            throw new WxException('模板名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['Assumer'])) {
            throw new WxException('支付方式不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->TopFee)) {
            throw new WxException('运费计算列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['TopFee'] = array_values($this->TopFee);

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode([
            'template_id' => $this->template_id,
            'delivery_template' => $this->reqData,
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
