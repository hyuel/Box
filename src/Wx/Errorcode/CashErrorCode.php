<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/30 0030
 * Time: 18:25
 */

namespace Wx\Errorcode;

/**
 * 企业付款错误代码类
 * Class CashErrorCode
 * @package Wx\Errorcode
 */
class CashErrorCode
{
    const ERROR_CODE = [
        "NO_AUTH" => "没有该接口权限" ,
        "AMOUNT_LIMIT" => "金额超限" ,
        "PARAM_ERROR" => "参数错误" ,
        "OPENID_ERROR" => "Openid错误" ,
        "SEND_FAILED" => "付款错误" ,
        "NOTENOUGH" => "余额不足" ,
        "SYSTEMERROR" => "系统繁忙，请稍后再试。" ,
        "NAME_MISMATCH" => "姓名校验出错" ,
        "SIGN_ERROR" => "签名错误" ,
        "XML_ERROR" => "Post内容出错" ,
        "FATAL_ERROR" => "两次请求参数不一致" ,
        "FREQ_LIMIT" => "超过频率限制，请稍后再试。" ,
        "MONEY_LIMIT" => "已经达到今日付款总额上限/已达到付款给此用户额度上限" ,
        "CA_ERROR" => "商户API证书校验出错" ,
        "V2_ACCOUNT_SIMPLE_BAN" => "无法给未实名用户付款" ,
        "PARAM_IS_NOT_UTF8" => "请求参数中包含非utf8编码字符" ,
        "SENDNUM_LIMIT" => "该用户今日付款次数超过限制,如有需要请进入【微信支付商户平台-产品中心-企业付款到零钱-产品设置】进行修改" ,
        "RECV_ACCOUNT_NOT_ALLOWED" => "收款账户不在收款账户列表" ,
        "PAY_CHANNEL_NOT_ALLOWED" => "本商户号未配置API发起能力" ,
    ];
}