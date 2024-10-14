<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/30 0030
 * Time: 18:25
 */

namespace Wx\Errorcode;

/**
 * ��ҵ������������
 * Class CashErrorCode
 * @package Wx\Errorcode
 */
class CashErrorCode
{
    const ERROR_CODE = [
        "NO_AUTH" => "û�иýӿ�Ȩ��" ,
        "AMOUNT_LIMIT" => "����" ,
        "PARAM_ERROR" => "��������" ,
        "OPENID_ERROR" => "Openid����" ,
        "SEND_FAILED" => "�������" ,
        "NOTENOUGH" => "����" ,
        "SYSTEMERROR" => "ϵͳ��æ�����Ժ����ԡ�" ,
        "NAME_MISMATCH" => "����У�����" ,
        "SIGN_ERROR" => "ǩ������" ,
        "XML_ERROR" => "Post���ݳ���" ,
        "FATAL_ERROR" => "�������������һ��" ,
        "FREQ_LIMIT" => "����Ƶ�����ƣ����Ժ����ԡ�" ,
        "MONEY_LIMIT" => "�Ѿ��ﵽ���ո����ܶ�����/�Ѵﵽ��������û��������" ,
        "CA_ERROR" => "�̻�API֤��У�����" ,
        "V2_ACCOUNT_SIMPLE_BAN" => "�޷���δʵ���û�����" ,
        "PARAM_IS_NOT_UTF8" => "��������а�����utf8�����ַ�" ,
        "SENDNUM_LIMIT" => "���û����ո��������������,������Ҫ����롾΢��֧���̻�ƽ̨-��Ʒ����-��ҵ�����Ǯ-��Ʒ���á������޸�" ,
        "RECV_ACCOUNT_NOT_ALLOWED" => "�տ��˻������տ��˻��б�" ,
        "PAY_CHANNEL_NOT_ALLOWED" => "���̻���δ����API��������" ,
    ];
}