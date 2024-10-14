<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/17 0017
 * Time: 17:46
 */

namespace Constant\Wx;


class Project
{
    const WXMINI_TYPE_PLAT_MINI = 1; //小程序类型-平台小程序
    const WXMINI_TYPE_SHOP_MINI = 2; //小程序类型-商户小程序
    const WXMINI_AUDIT_STATUS_UNDO = -1; //小程序审核状态-未提交审核
    const WXMINI_AUDIT_STATUS_SUCCESS = 0; //小程序审核状态-审核成功
    const WXMINI_AUDIT_STATUS_FAIL = 1; //小程序审核状态-审核失败
    const WXMINI_AUDIT_STATUS_HANDING = 2; //小程序审核状态-审核中
    const WXMINI_OPTION_STATUS_UN_UPLOAD = 1; //小程序操作状态-未上传
    const WXMINI_OPTION_STATUS_UPLOADED = 2; //小程序操作状态-已上传
    const WXMINI_OPTION_STATUS_APPLY_AUDIT = 3; //小程序操作状态-审核中
    const WXMINI_OPTION_STATUS_AUDIT_SUCCESS = 4; //小程序操作状态-审核成功
    const WXMINI_OPTION_STATUS_AUDIT_FAIL = 5; //小程序操作状态-审核失败
    const WXMINI_OPTION_STATUS_RELEASED = 6; //小程序操作状态-已发布
    const WXMINI_EXPIRE_TOKEN = 7000; //小程序token超时时间,单位为秒
    const WXMINI_DEFAULT_CLIENT_IP = '127.0.0.1'; //默认客户端IP
    const WXMINI_TEMPLATE_TAG_BUY_SUCCESS = 'a001'; //模板标识-购买成功
    const STATION_CONFIG_LEVEL_FIRST = 1; //层级-第一级
    const STATION_CONFIG_LEVEL_SECOND = 2; //层级-第二级
    const STATION_CONFIG_TAG_WXMINI = 'wm01'; //标识-小程序配置
    const STATION_CONFIG_TAG_WXMINI_LATEST_CODE = 'wm010001'; //标识-小程序最新代码
    const STATION_CONFIG_TAG_WXMINI_LATEST_VERSION = 'wm010002'; //标识-小程序最新版本
    const STATION_CONFIG_TAG_WXMINI_LATEST_DESC = 'wm010003'; //标识-小程序最新描述
    const STATION_CONFIG_TAG_WXMINI_DOMAIN_WEB = 'wm010004'; //标识-小程序业务域名
    const STATION_CONFIG_TAG_WXMINI_DOMAIN_SERVER = 'wm010005'; //标识-小程序服务域名

//校验器常量
    const VALIDATOR_STRING_TYPE_REQUIRED = 'string_required'; //字符串类型-必填
    const VALIDATOR_STRING_TYPE_MIN = 'string_min'; //字符串类型-最小长度
    const VALIDATOR_STRING_TYPE_MAX = 'string_max'; //字符串类型-最大长度
    const VALIDATOR_STRING_TYPE_REGEX = 'string_regex'; //字符串类型-正则表达式
    const VALIDATOR_STRING_TYPE_PHONE = 'string_phone'; //字符串类型-手机号码
    const VALIDATOR_STRING_TYPE_TEL = 'string_tel'; //字符串类型-联系方式
    const VALIDATOR_STRING_TYPE_EMAIL = 'string_email'; //字符串类型-邮箱
    const VALIDATOR_STRING_TYPE_URL = 'string_url'; //字符串类型-URL链接
    const VALIDATOR_STRING_TYPE_JSON = 'string_json'; //字符串类型-JSON
    const VALIDATOR_STRING_TYPE_SIGN = 'string_sign'; //字符串类型-请求签名
    const VALIDATOR_STRING_TYPE_BASE_IMAGE = 'string_baseimage'; //字符串类型-base64编码图片
    const VALIDATOR_STRING_TYPE_IP = 'string_ip'; //字符串类型-IP
    const VALIDATOR_STRING_TYPE_LNG = 'string_lng'; //字符串类型-经度
    const VALIDATOR_STRING_TYPE_LAT = 'string_lat'; //字符串类型-纬度
    const VALIDATOR_STRING_TYPE_NO_JS = 'string_nojs'; //字符串类型-不允许js脚本
    const VALIDATOR_STRING_TYPE_NO_EMOJI = 'string_noemoji'; //字符串类型-不允许emoji表情
    const VALIDATOR_STRING_TYPE_ZH = 'string_zh'; //字符串类型-中文,数字,字母
    const VALIDATOR_STRING_TYPE_ALNUM = 'string_alnum'; //字符串类型-数字,字母
    const VALIDATOR_STRING_TYPE_ALPHA = 'string_alpha'; //字符串类型-字母
    const VALIDATOR_STRING_TYPE_DIGIT = 'string_digit'; //字符串类型-数字
    const VALIDATOR_STRING_TYPE_LOWER = 'string_lower'; //字符串类型-小写字母
    const VALIDATOR_STRING_TYPE_UPPER = 'string_upper'; //字符串类型-大写字母
    const VALIDATOR_STRING_TYPE_DIGIT_LOWER = 'string_digitlower'; //字符串类型-数字,小写字母
    const VALIDATOR_STRING_TYPE_DIGIT_UPPER = 'string_digitupper'; //字符串类型-数字,大写字母
    const VALIDATOR_STRING_TYPE_SY_TOKEN = 'string_sytoken'; //字符串类型-框架令牌
    const VALIDATOR_STRING_TYPE_JWT = 'string_jwt'; //字符串类型-会话JWT
    const VALIDATOR_INT_TYPE_REQUIRED = 'int_required'; //整数类型-必填
    const VALIDATOR_INT_TYPE_MIN = 'int_min'; //整数类型-最小值
    const VALIDATOR_INT_TYPE_MAX = 'int_max'; //整数类型-最大值
    const VALIDATOR_INT_TYPE_IN = 'int_in'; //整数类型-取值枚举
    const VALIDATOR_INT_TYPE_BETWEEN = 'int_between'; //整数类型-取值区间
    const VALIDATOR_DOUBLE_TYPE_REQUIRED = 'double_required'; //浮点数类型-必填
    const VALIDATOR_DOUBLE_TYPE_MIN = 'double_min'; //浮点数类型-最小值
    const VALIDATOR_DOUBLE_TYPE_MAX = 'double_max'; //浮点数类型-最大值
    const VALIDATOR_DOUBLE_TYPE_BETWEEN = 'double_between'; //浮点数类型-取值区间

    //微信开放平台常量
    const WX_COMPONENT_AUTHORIZER_STATUS_CANCEL = 0; //授权公众号状态-取消授权
    const WX_COMPONENT_AUTHORIZER_STATUS_ALLOW = 1; //授权公众号状态-允许授权
    const WX_COMPONENT_AUTHORIZER_EXPIRE_TOKEN = 7000; //授权公众号token超时时间,单位为秒
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED = 1; //授权公众号操作类型-允许授权
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_UNAUTHORIZED = 2; //授权公众号操作类型-取消授权
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED_UPDATE = 3; //授权公众号操作类型-更新授权

    //企业微信服务商常量
    const WX_PROVIDER_CORP_AUTHORIZER_STATUS_CANCEL = 0; //企业微信状态-取消授权
    const WX_PROVIDER_CORP_AUTHORIZER_STATUS_ALLOW = 1; //企业微信状态-允许授权
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CREATE = 1; //企业微信操作类型-成功授权
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CANCEL = 2; //企业微信操作类型-取消授权
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CHANGE = 3; //企业微信操作类型-变更授权

    //微信商户号常量
    const WX_SHOP_STATUS_DISABLE = 0; //商户号状态-无效
    const WX_SHOP_STATUS_ENABLE = 1; //商户号状态-有效
    const WX_CONFIG_BASE_STATUS_DISABLE = 0; //状态-无效
    const WX_CONFIG_BASE_STATUS_ENABLE = 1; //状态-有效
    const WX_CONFIG_AUTHORIZE_STATUS_EMPTY = -1; //第三方授权状态-不存在
    const WX_CONFIG_AUTHORIZE_STATUS_NO = 0; //第三方授权状态-未授权
    const WX_CONFIG_AUTHORIZE_STATUS_YES = 1; //第三方授权状态-已授权
    const WX_CONFIG_CORP_STATUS_DISABLE = 0; //企业微信状态-无效
    const WX_CONFIG_CORP_STATUS_ENABLE = 1; //企业微信状态-有效
    const WX_CONFIG_DEFAULT_CLIENT_IP = '127.0.0.1'; //默认客户端IP


    //支付宝支付常量
    const ALI_PAY_STATUS_DISABLE = 0; //状态-无效
    const ALI_PAY_STATUS_ENABLE = 1; //状态-有效

    //钉钉配置常量
    const DINGTALK_CONFIG_CORP_STATUS_DISABLE = 0; //企业钉钉状态-无效
    const DINGTALK_CONFIG_CORP_STATUS_ENABLE = 1; //企业钉钉状态-有效

    //本地缓存常量
    const LOCAL_CACHE_TAG_WX_ACCOUNT = '001'; //标识-微信账号
    const LOCAL_CACHE_TAG_WXOPEN_AUTHORIZER = '002'; //标识-微信开放平台授权者

    //时间常量
    const TIME_EXPIRE_LOCAL_USER_CACHE = 300; //超时时间-本地用户缓存,单位为秒
    const TIME_EXPIRE_LOCAL_API_SIGN_CACHE = 30; //超时时间-本地api签名缓存,单位为秒
    const TIME_EXPIRE_LOCAL_WXSHOP_REFRESH = 600; //超时时间-本地微信商户号更新,单位为秒
    const TIME_EXPIRE_LOCAL_WXSHOP_CLEAR = 3600; //超时时间-本地微信商户号清理,单位为秒
    const TIME_EXPIRE_LOCAL_WXCORP_REFRESH = 600; //超时时间-本地企业微信更新,单位为秒
    const TIME_EXPIRE_LOCAL_WXCORP_CLEAR = 3600; //超时时间-本地企业微信清理,单位为秒
    const TIME_EXPIRE_LOCAL_WXCACHE_CLEAR = 300; //超时时间-本地微信缓存清理,单位为秒
    const TIME_EXPIRE_LOCAL_ALIPAY_REFRESH = 600; //超时时间-本地支付宝支付更新,单位为秒
    const TIME_EXPIRE_LOCAL_ALIPAY_CLEAR = 3600; //超时时间-本地支付宝支付清理,单位为秒
    const TIME_EXPIRE_LOCAL_DINGTALK_CORP_REFRESH = 600; //超时时间-本地企业钉钉更新,单位为秒
    const TIME_EXPIRE_LOCAL_DINGTALK_CORP_CLEAR = 3600; //超时时间-本地企业钉钉清理,单位为秒
    const TIME_EXPIRE_SESSION = 259200; //超时时间-session,单位为秒
    const TIME_EXPIRE_SWOOLE_CLIENT_HTTP = 3000; //超时时间-http服务客户端,单位为毫秒
    const TIME_EXPIRE_SWOOLE_CLIENT_RPC = 3000; //超时时间-rpc服务客户端,单位为毫秒
    const TIME_EXPIRE_SWOOLE_CLIENT_SYNC_REQUEST = 1.5; //超时时间-swoole同步客户端请求,单位为秒
    const TIME_EXPIRE_LOCAL_JPUSH_APP_REFRESH = 600; //超时时间-本地极光推送应用更新,单位为秒
    const TIME_EXPIRE_LOCAL_JPUSH_APP_CLEAR = 3600; //超时时间-本地极光推送应用清理,单位为秒
    const TIME_EXPIRE_LOCAL_JPUSH_GROUP_REFRESH = 600; //超时时间-本地极光推送分组更新,单位为秒
    const TIME_EXPIRE_LOCAL_JPUSH_GROUP_CLEAR = 3600; //超时时间-本地极光推送分组清理,单位为秒
    const TIME_TASK_CLEAR_LOCAL_USER = 300000; //任务时间-清理本地用户信息,单位为毫秒
    const TIME_TASK_CLEAR_LOCAL_WX = 300000; //任务时间-清理本地微信,单位为毫秒
    const TIME_TASK_REFRESH_TOKEN_EXPIRE = 540000; //任务时间-刷新令牌到期时间,单位为毫秒
    const TIME_TASK_CODE_WEBHOOK = 3000; //任务时间-代码WebHook,单位为毫秒

    //任务常量,4位字符串,数字和字母组成,纯数字的为框架内部任务,其他为自定义任务
    const TASK_TYPE_CLEAR_API_SIGN_CACHE = '0001'; //任务类型-清理api签名缓存
    const TASK_TYPE_CLEAR_LOCAL_USER_CACHE = '0002'; //任务类型-清除本地用户信息缓存
    const TASK_TYPE_CLEAR_LOCAL_WXSHOP_TOKEN_CACHE = '0003'; //任务类型-清除本地微信商户号token缓存
    const TASK_TYPE_CLEAR_LOCAL_WXOPEN_AUTHORIZER_TOKEN_CACHE = '0004'; //任务类型-清除本地微信开放平台授权者token缓存
    const TASK_TYPE_TIME_WHEEL_TASK = '0005'; //任务类型-时间轮任务
    const TASK_TYPE_CLEAR_LOCAL_WX_CACHE = '0006'; //任务类型-清除本地微信缓存
    const TASK_TYPE_REFRESH_TOKEN_EXPIRE = '0007'; //任务类型-刷新令牌到期时间
    const TASK_TYPE_CODE_WEBHOOK = '1000'; //任务类型-代码WebHook

    //消息队列常量
    const MESSAGE_QUEUE_TYPE_REDIS = 'redis'; //类型-redis
    const MESSAGE_QUEUE_TYPE_KAFKA = 'kafka'; //类型-kafka
    const MESSAGE_QUEUE_TYPE_RABBIT = 'rabbit'; //类型-rabbit

    //服务预处理常量,标识长度为5位,第一位固定为/,后四位代表不同预处理操作,其中后四位全为数字的为框架内部预留标识
    const PRE_PROCESS_TAG_HTTP_FRAME_SERVER_INFO = '/0000'; //HTTP服务框架内部标识-服务信息
    const PRE_PROCESS_TAG_HTTP_FRAME_PHP_INFO = '/0001'; //HTTP服务框架内部标识-php环境信息
    const PRE_PROCESS_TAG_HTTP_FRAME_HEALTH_CHECK = '/0002'; //HTTP服务框架内部标识-健康检测
    const PRE_PROCESS_TAG_HTTP_FRAME_REFRESH_TOKEN_EXPIRE = '/0003'; //HTTP服务框架内部标识-更新令牌过期时间
    const PRE_PROCESS_TAG_RPC_FRAME_SERVER_INFO = '/0000'; //RPC服务框架内部标识-服务信息

    //容量常量
    const SIZE_SERVER_PACKAGE_MAX = 6291456; //服务端容量-最大接收数据大小,单位为字节,默认为6M
    const SIZE_CLIENT_SOCKET_BUFFER = 12582912; //客户端容量-连接的缓存区大小,单位为字节,默认为12M
    const SIZE_CLIENT_BUFFER_OUTPUT = 4194304; //客户端容量-单次最大发送数据大小,单位为字节,默认为4M

    //进程池服务标识常量,4位字符串,数字和字母组成,纯数字的为框架内部服务,其他为自定义服务
    const POOL_PROCESS_SERVICE_TAG_ENV_INFO = '0000'; //服务标识-获取环境信息

    //微信小程序常量
    public static $totalWxBaseStatus = [
        self::WX_CONFIG_BASE_STATUS_DISABLE => '无效',
        self::WX_CONFIG_BASE_STATUS_ENABLE => '有效',
    ];
    public static $totalWxMiniType = [
        self::WXMINI_TYPE_PLAT_MINI => '平台小程序',
        self::WXMINI_TYPE_SHOP_MINI => '商户小程序',
    ];
    public static $totalWxMiniAuditStatus = [
        self::WXMINI_AUDIT_STATUS_UNDO => '未提交审核',
        self::WXMINI_AUDIT_STATUS_SUCCESS => '审核成功',
        self::WXMINI_AUDIT_STATUS_FAIL => '审核失败',
        self::WXMINI_AUDIT_STATUS_HANDING => '审核中',
    ];
    public static $totalWxMiniOptionStatus = [
        self::WXMINI_OPTION_STATUS_UN_UPLOAD => '未上传',
        self::WXMINI_OPTION_STATUS_UPLOADED => '已上传',
        self::WXMINI_OPTION_STATUS_APPLY_AUDIT => '审核中',
        self::WXMINI_OPTION_STATUS_AUDIT_SUCCESS => '审核成功',
        self::WXMINI_OPTION_STATUS_AUDIT_FAIL => '审核失败',
        self::WXMINI_OPTION_STATUS_RELEASED => '已发布',
    ];
}