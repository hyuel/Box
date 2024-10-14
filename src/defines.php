<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/18 0018
 * Time: 20:49
 */

$frameLibsDir = __DIR__;
if (substr($frameLibsDir, -1) == '/') {
    define('SY_FRAME_LIBS_ROOT', $frameLibsDir);
} else {
    define('SY_FRAME_LIBS_ROOT', $frameLibsDir . '/');
}


//是否连接数据库
if (!defined('SY_DATABASE')) {
    define('SY_DATABASE', true);
}
//是否连接memcache
if (!defined('SY_MEMCACHE')) {
    define('SY_MEMCACHE', false);
}
//是否本地缓存微信账号数据
if (!defined('SY_LC_WX_ACCOUNT')) {
    define('SY_LC_WX_ACCOUNT', false);
}
//是否本地缓存微信开放平台账号数据
if (!defined('SY_LC_WXOPEN_AUTHORIZER')) {
    define('SY_LC_WXOPEN_AUTHORIZER', false);
}
//请求异常处理类型 true:框架处理 false:项目处理
if (!defined('SY_REQ_EXCEPTION_HANDLE_TYPE')) {
    define('SY_REQ_EXCEPTION_HANDLE_TYPE', true);
}
//jwt会话有效时间,单位为秒
if (!defined('SY_SESSION_JW_EXPIRE')) {
    define('SY_SESSION_JW_EXPIRE', 86400);
}
if (!is_int(SY_SESSION_JW_EXPIRE)) {
    exit('jwt会话有效时间必须为整数' . PHP_EOL);
} elseif (SY_SESSION_JW_EXPIRE < 3600) {
    exit('jwt会话有效时间必须不小于3600秒' . PHP_EOL);
}
//jwt会话刷新标识有效时间,单位为秒
define('SY_SESSION_JW_RID_EXPIRE', (SY_SESSION_JW_EXPIRE + 180));

//淘宝环境链接
if (!defined('SY_TAOBAO_ENV')) {
    define('SY_TAOBAO_ENV', 'https://eco.taobao.com/router/rest');
}


//令牌密钥
if (!defined('SY_TOKEN_SECRET')) {
    define('SY_TOKEN_SECRET', '');
}

//Http响应的错误状态码
if (!defined('SY_HTTP_RSP_CODE_ERROR')) {
    define('SY_HTTP_RSP_CODE_ERROR', 200);
}
