<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/22 0022
 * Time: 10:12
 */
namespace Tool;

use SyConstant\Project;
use Traits\SimpleTrait;

final class ProjectTool
{
    use SimpleTrait;

    /**
     * 加密密码
     * @param string $pwd 密码明文
     * @param string $salt 加密盐
     * @return string
     */
    public static function encryptPassword(string $pwd, string $salt) : string
    {
        return hash('sha256', $pwd . $salt);
    }

    /**
     * 检测密码是否正确
     * @param string $pwd 密码明文
     * @param string $salt 加密盐
     * @param string $sign 当前密文
     * @return bool
     */
    public static function checkPassword(string $pwd, string $salt, string $sign)
    {
        $nowSign = hash('sha256', $pwd . $salt);
        return $nowSign === $sign;
    }

    /**
     * 格式化字符串
     * @param string $inStr 输入的字符串
     * @param int $formatType 格式化的类型
     *     必然会做的处理:去除js代码,表情符号和首尾空格
     *     1：去除字符串中的特殊符号，并将多个空格缩减成一个英文空格
     *     2：将字符串中的连续多个空格缩减成一个英文空格
     *     3：去除前后空格
     * @return string
     */
    public static function filterStr(string $inStr, int $formatType = 1) : string
    {
        if (strlen($inStr . '') > 0) {
            $patterns = [
                "'<script[^>]*?>.*?</script>'si",
                '/[\xf0-\xf7].{3}/',
            ];
            $replaces = [
                '',
                '',
            ];
            if ($formatType == 1) {
                $patterns[] = '/[\\\%\'\"\<\>\?\@\&\^\$\#\_]+/';
                $patterns[] = '/\s+/';
                $replaces[] = '';
                $replaces[] = ' ';
            } elseif ($formatType == 2) {
                $patterns[] = '/\s+/';
                $replaces[] = ' ';
            }

            $saveStr = preg_replace($patterns, $replaces, $inStr);
            return trim($saveStr);
        }

        return '';
    }

    /**
     * 获取语言类型
     * @return string
     */
    public static function getLanguageType() : string
    {
        return $_POST[Project::DATA_KEY_LANGUAGE_TAG] ?? Project::LANG_TYPE_DEFAULT;
    }

    //==============================以下是需要使用到那数据库胡=======================//

    /**
     * 更新微信开放平台授权公众号信息
     * @param string $appId 授权公众号app id
     * @param array $data
     */
    public static function updateWxOpenAuthorizerInfo(string $appId, array $data)
    {
//        $entity = CjdB2cMysqlFactory::WxopenAuthorizerEntity();
//        $ormResult1 = $entity->getContainer()->getModel()->getOrmDbTable();
//        $ormResult1->where('`component_appid`=? AND `authorizer_appid`=?', [WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId(), $appId,]);
//        $entity->getContainer()->getModel()->update($ormResult1, [
//            'authorizer_refreshtoken' => $data['authorizer_refreshtoken'],
//            'authorizer_allowpower' => Tool::jsonEncode($data['authorizer_allowpower'], JSON_UNESCAPED_UNICODE),
//            'authorizer_info' => Tool::jsonEncode($data['authorizer_info'], JSON_UNESCAPED_UNICODE),
//            'updated' => Tool::getNowTime(),
//        ]);
//        unset($ormResult1, $entity);

        $where = [];
        $where['component_appid'] = WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId();
        $where['authorizer_appid'] = $appId;
        $authorizerInfo = Db::name('wxopen_authorizer')->where($where)->update([
            'authorizer_refreshtoken' => $data['authorizer_refreshtoken'],
            'authorizer_allowpower' => Tool::jsonEncode($data['authorizer_allowpower'], JSON_UNESCAPED_UNICODE),
            'authorizer_info' => Tool::jsonEncode($data['authorizer_info'], JSON_UNESCAPED_UNICODE),
            'updated' => Tool::getNowTime(),
        ]);

    }

}
