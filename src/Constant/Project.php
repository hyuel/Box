<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/26 0026
 * Time: 15:24
 */

namespace Constant;


use Traits\SimpleTrait;
class Project {
    use SimpleTrait;

    //数据常量
    const DATA_KEY_SESSION_TOKEN = 'sytoken'; //键名-session标识
    const DATA_KEY_CACHE_UNIQUE_ID = self::REDIS_PREFIX_UNIQUE_ID . 'uniqueid'; //键名-缓存唯一ID


    //公共常量
    const COMMON_PAGE_DEFAULT = 1; //默认页数
    const COMMON_LIMIT_DEFAULT = 10; //默认分页限制

    //REDIS常量 以sy000开头的前缀为框架内部前缀,以sy+3位数字开头的前缀为公共模块前缀
    const REDIS_PREFIX_SESSION = 'sy000001_'; //前缀-session
    const REDIS_PREFIX_SESSION_LIST = 'sy000002_'; //前缀-session列表
    const REDIS_PREFIX_SYS_LIST = 'sy000003_'; //前缀-系统信息列表
    const REDIS_PREFIX_SYS_SOCKET_LIST = 'sy000004_'; //前缀-系统信息列表
    const REDIS_PREFIX_CODE_IMAGE = 'sy001000_'; //前缀-验证码图片
    const REDIS_PREFIX_UNIQUE_ID = 'sy001001_'; //前缀-唯一ID
    const REDIS_PREFIX_MESSAGE_QUEUE = 'sy001002_'; //前缀-消息队列
    const REDIS_PREFIX_IMAGE_DATA = 'sy001003_'; //前缀-图片缓存
    const REDIS_PREFIX_IM_ADMIN = 'sy001004_'; //前缀-im管理账号缓存
    const REDIS_PREFIX_KAFKA_MESSAGE_OFFSET = 'sy001005_'; //前缀-kafka消息位移缓存
    const REDIS_PREFIX_PAY_HASH = 'sy001006_'; //前缀-支付哈希
    const REDIS_PREFIX_WX_ACCOUNT = 'sy002000_'; //前缀-微信公众号
    const REDIS_PREFIX_WX_COMPONENT_ACCOUNT = 'sy002001_'; //前缀-微信开放平台账号
    const REDIS_PREFIX_WX_COMPONENT_AUTHORIZER = 'sy002002_'; //前缀-微信开放平台授权公众号
    const REDIS_PREFIX_WX_NATIVE_PRE = 'sy002003_'; //前缀-微信扫码预支付
    const REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT = 'sy002004_'; //前缀-企业微信服务商账号
    const REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT_SUITE = 'sy002005_'; //前缀-企业微信服务商套件
    const REDIS_PREFIX_WX_PROVIDER_CORP_AUTHORIZER = 'sy002006_'; //前缀-服务商授权企业微信
    const REDIS_PREFIX_WX_CORP = 'sy002007_'; //前缀-企业微信
    const REDIS_PREFIX_WX_CONGIF = 'sy001008_'; //前缀-微信配置
    const REDIS_PREFIX_TIMER_QUEUE = 'sy003000_'; //前缀-定时器队列
    const REDIS_PREFIX_TIMER_CONTENT = 'sy003001_'; //前缀-定时器内容
    const REDIS_PREFIX_PRINT_FEYIN_ACCOUNT = 'sy004000_'; //前缀-飞印打印账号
    const REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT = 'sy005000_'; //前缀-企业钉钉服务商账号
    const REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT_SUITE = 'sy005001_'; //前缀-企业钉钉服务商套件
    const REDIS_PREFIX_DINGTALK_PROVIDER_AUTHORIZER = 'sy005002_'; //前缀-服务商授权企业钉钉
    const REDIS_PREFIX_DINGTALK_CORP = 'sy005003_'; //前缀-企业钉钉
    const REDIS_PREFIX_ROLE_POWERS = 'sya01005_'; //前缀-角色权限列表
    const REDIS_PREFIX_ROLE_LIST = 'sya01006_'; //前缀-角色列表
    const REDIS_PREFIX_REGION_LIST = 'sya01007_'; //前缀-地区缓存
    const REDIS_PREFIX_STATION_CONFIG_MAP = 'sya01008_'; //前缀-系统配置缓存
    const REDIS_PREFIX_SMS_SYSTEM_CODE = 'sya01009_'; //前缀-系统验证码短信
    const REDIS_PREFIX_ALLIANCE_REGION_LIST = 'sya01010_'; //前缀-联盟地区缓存
    const REDIS_PREFIX_ALLIANCE_WX = 'sya01011_'; //前缀-联盟微信缓存
    const REDIS_PREFIX_CLASSIFY_GOODS_LIST = 'sya01012_'; //前缀-商品分类列表缓存
    const REDIS_PREFIX_CLASSIFY_COMMUNITY_LIST = 'sya01013_'; //前缀-社区分类列表缓存
    const REDIS_PREFIX_ALLIANCE_AD_LIST = 'sya01014_'; //前缀-联盟广告列表缓存
    const REDIS_PREFIX_ORDER_HASH = 'sya01015_'; //前缀-订单哈希缓存
    const REDIS_PREFIX_SECKILL_NUM = 'sya01016_'; //前缀-秒杀数量缓存
    const REDIS_PREFIX_ALLIANCE_GUIDE = 'sya01017_'; //前缀-联盟引导缓存
    const REDIS_PREFIX_ALLIANCE_SIGN = 'sya01018_'; //前缀-联盟签到缓存
    const REDIS_PREFIX_USER_SIGN = 'sya01019_'; //前缀-用户签到缓存
    const REDIS_PREFIX_ALLIANCE_SHARE = 'sya01020_'; //前缀-联盟分享缓存
    const REDIS_PREFIX_BARGAIN_JOIN = 'sya01021_'; //前缀-参与砍价缓存
    const REDIS_PREFIX_ALLIANCE_ENTER = 'sya01022_'; //前缀-联盟入驻缓存
    const REDIS_PREFIX_COMMUNITY_STICK = 'sya01023_'; //前缀-社区帖子置顶缓存
    const REDIS_PREFIX_SHOP_STATIC_INFO = 'sya01024_'; //前缀-店铺统计信息缓存
    const REDIS_PREFIX_ALLIANCE_STATIC_INFO = 'sya01025_'; //前缀-联盟统计信息缓存
    const REDIS_PREFIX_ALLIANCE_USER_STATIC_INFO = 'sya01026_'; //前缀-联盟用户统计信息缓存
    const REDIS_PREFIX_ALLIANCE_ORDER_STATIC_INFO = 'sya01027_'; //前缀-联盟订单统计信息缓存
    const REDIS_PREFIX_ALLIANCE_MONEY_STATIC_INFO = 'sya01028_'; //前缀-联盟金额统计信息缓存
    const REDIS_PREFIX_POST_FRONT_STATISTICAL = 'sya01029_'; //前缀-前端获取帖子统计信息缓存
    const REDIS_PREFIX_POST_RELEASE = 'sya01030_'; //前缀-帖子发布缓存
    const REDIS_PREFIX_ALLIANCE_CONFIG_PARTNER = 'sya01031_'; //前缀-联盟合伙人配置缓存
    const REDIS_PREFIX_ALLIANCE_CONFIG_POST = 'sya01032_'; //前缀-联盟帖子配置缓存
    const REDIS_PREFIX_ALLIANCE_CONFIG_RECOMMEND = 'sya01033_'; //前缀-联盟推荐配置缓存
    const REDIS_PREFIX_USER_STATIC_INFO = 'sya01034_'; //前缀-用户统计信息缓存
    const REDIS_PREFIX_ALLIANCE_SET = 'sya01035_'; //前缀-联盟设置缓存
    const REDIS_PREFIX_ALLIANCE_STATIC_PART_INFO = 'sya01036_'; //前缀-联盟统计部分信息缓存
    const REDIS_PREFIX_ALLIANCE_STATIC_VIP_INFO = 'sya01037_'; //前缀-联盟vip统计信息缓存
    const REDIS_PREFIX_ALLIANCE_PROPAGANDA = 'sya01038_'; //前缀-联盟宣传广告缓存
    const REDIS_PREFIX_CLASSIFY_GOODS_SHOP = 'sya01039_'; //前缀-店铺商品分类列表缓存
    const REDIS_PREFIX_ALLIANCE_NAVIGATION_MENU = 'sya01040_'; //前缀-联盟底部菜单列表缓存
    const REDIS_PREFIX_ALLIANCE_KEYWORDS_CLASSIFY = 'sya01041_'; //前缀-联盟分类关键词列表缓存
    const REDIS_PREFIX_CLASSIFY_PRODUCT_SHOP = 'sya01042_'; //前缀-店铺商品分类商品缓存
    const REDIS_PREFIX_USER_MONEY_STATISTICAL = 'sya01043_'; //前缀-用户统计推广金额缓存
    const REDIS_PREFIX_ALLIANCE_CONFIG_DEFAULT_AID = 'sya01044_'; //前缀-默认联盟ID配置缓存
    const REDIS_PREFIX_ALLIANCE_TOOL_MENU = 'sya01045_'; //前缀-联盟工具菜单列表缓存
    const REDIS_PREFIX_ORDER_INFO = 'sya02001_'; //前缀-订单列表缓存
    const REDIS_PREFIX_IMAGE_INFO = 'sya02002_'; //前缀-图片缓存


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

    //微信配置常量
    const WX_CONFIG_STATUS_DISABLE = 0; //状态-无效
    const WX_CONFIG_STATUS_ENABLE = 1; //状态-有效
    const WX_CONFIG_AUTHORIZE_STATUS_EMPTY = -1; //第三方授权状态-不存在
    const WX_CONFIG_AUTHORIZE_STATUS_NO = 0; //第三方授权状态-未授权
    const WX_CONFIG_AUTHORIZE_STATUS_YES = 1; //第三方授权状态-已授权
    const WX_CONFIG_CORP_STATUS_DISABLE = 0; //企业微信状态-无效
    const WX_CONFIG_CORP_STATUS_ENABLE = 1; //企业微信状态-有效
    const WX_CONFIG_DEFAULT_CLIENT_IP = '127.0.0.1'; //默认客户端IP

    //微信商户号常量
    const WX_SHOP_STATUS_DISABLE = 0; //商户号状态-无效
    const WX_SHOP_STATUS_ENABLE = 1; //商户号状态-有效
    const WX_CONFIG_BASE_STATUS_DISABLE = 0; //状态-无效
    const WX_CONFIG_BASE_STATUS_ENABLE = 1; //状态-有效

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
    const TIME_EXPIRE_LOCAL_API_SIGN_CACHE = 300; //超时时间-本地api签名缓存,单位为秒
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
    const TIME_TASK_CLEAR_API_SIGN = 300000; //任务时间-清理api签名,单位为毫秒
    const TIME_TASK_CLEAR_LOCAL_USER = 300000; //任务时间-清理本地用户信息,单位为毫秒
    const TIME_TASK_CLEAR_LOCAL_WX = 300000; //任务时间-清理本地微信,单位为毫秒
    const TIME_TASK_REFRESH_TOKEN_EXPIRE = 540000; //任务时间-刷新令牌到期时间,单位为毫秒

    //任务常量,4位字符串,数字和字母组成,纯数字的为框架内部任务,其他为自定义任务
    const TASK_TYPE_CLEAR_API_SIGN_CACHE = '0001'; //任务类型-清理api签名缓存
    const TASK_TYPE_CLEAR_LOCAL_USER_CACHE = '0002'; //任务类型-清除本地用户信息缓存
    const TASK_TYPE_CLEAR_LOCAL_WXSHOP_TOKEN_CACHE = '0003'; //任务类型-清除本地微信商户号token缓存
    const TASK_TYPE_CLEAR_LOCAL_WXOPEN_AUTHORIZER_TOKEN_CACHE = '0004'; //任务类型-清除本地微信开放平台授权者token缓存
    const TASK_TYPE_TIME_WHEEL_TASK = '0005'; //任务类型-时间轮任务
    const TASK_TYPE_CLEAR_LOCAL_WX_CACHE = '0006'; //任务类型-清除本地微信缓存
    const TASK_TYPE_REFRESH_TOKEN_EXPIRE = '0007'; //任务类型-刷新令牌到期时间

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

    //小程序
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
    const STATION_CONFIG_TAG_SYS = 'sys01'; //标识-系统配置
    const STATION_CONFIG_TAG_SYS_LOGIN_OUTTIME = 'sys010001'; //标识-系统登录超时时间
    const STATION_CONFIG_TAG_WXMINI = 'wm01'; //标识-小程序配置
    const STATION_CONFIG_TAG_WXMINI_LATEST_CODE = 'wm010001'; //标识-小程序最新代码
    const STATION_CONFIG_TAG_WXMINI_LATEST_VERSION = 'wm010002'; //标识-小程序最新版本
    const STATION_CONFIG_TAG_WXMINI_LATEST_DESC = 'wm010003'; //标识-小程序最新描述
    const STATION_CONFIG_TAG_WXMINI_DOMAIN_WEB = 'wm010004'; //标识-小程序业务域名
    const STATION_CONFIG_TAG_WXMINI_DOMAIN_SERVER = 'wm010005'; //标识-小程序服务域名

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
