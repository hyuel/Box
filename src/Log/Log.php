<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 20:17
 */
namespace Log;

use Tool\Dir;
use Traits\SimpleTrait;

/**
 * 使用SeasLog写日志
 * 如果windows不能写日志 在php.ini中设置 seaslog.level = 8
 * 参考资料
 * http://www.imooc.com/wenda/detail/588813
 * https://www.imooc.com/qadetail/119739
*/
final class Log
{
    use SimpleTrait;

    public static function log($msg, $level = SEASLOG_INFO)
    {
        if(!extension_loaded("SeasLog")){
            return [];
        }
        \SeasLog::setLogger('api');
        
        if(defined('LOG_HEADER')){
            $log = LOG_HEADER . PHP_EOL;
        }else{
            $log = '';
        }

        if (is_string($msg)) {
            $log .= $msg;
        } else {
            $log .= print_r($msg, true);
        }

        switch ($level) {
            case SEASLOG_DEBUG:
                \SeasLog::debug($log);
                break;
            case SEASLOG_INFO:
                \SeasLog::info($log);
                break;
            case SEASLOG_WARNING:
                \SeasLog::warning($log);
                break;
            case SEASLOG_ERROR:
                \SeasLog::error($log);
                break;
            default:
                \SeasLog::info($log);
                break;
        }
    }

    public static function debug($msg)
    {
        self::log($msg, SEASLOG_DEBUG);
    }

    public static function info($msg)
    {
        self::log($msg, SEASLOG_INFO);
    }

    public static function warn($msg)
    {
        self::log($msg, SEASLOG_WARNING);
    }

    /**
     * 打印错误日志
     * @param string $msg 日志主要内容
     * @param int|string $code 错误码
     * @param string $trace 异常堆栈信息
     */
    public static function error(string $msg, $code = 0, string $trace = '')
    {
        $content = 'code=' . $code . PHP_EOL . 'msg=' . $msg . PHP_EOL;
        if (strlen($trace . '') == 0) {
            $trackArr = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            foreach ($trackArr as $key => $eTrack) {
                $content .= '#' . $key . ' ';
                if (!empty($eTrack['file'])) {
                    $content .= $eTrack['file'];
                }
                if (!empty($eTrack['line'])) {
                    $content .= '[' . $eTrack['line'] . ']:';
                }
                $content .= ' ';
                if (empty($eTrack['type'])) {
                    $content .= $eTrack['function'];
                } else {
                    $content .= $eTrack['class'] . $eTrack['type'] . $eTrack['function'];
                }
                if (empty($eTrack['args'])) {
                    $content .= '()';
                } else {
                    $content .= '(' . implode(', ', $eTrack['args']) . ')';
                }
                $content .= PHP_EOL;
            }
        } else {
            $content .= $trace;
        }

        self::log($content, SEASLOG_ERROR);
        unset($content, $trackArr, $eTrack);
    }

    /**
     * 日志路径设置
     * @param string $basePath 基目录
     * @param string $logger 存储目录
     */
    public static function setPath(string $basePath, string $logger = '',string $logHeaer = '')
    {
        if (!is_dir($basePath . '/' . $logger)) {
            Dir::create($basePath . '/' . $logger);
        }

        \SeasLog::setBasePath($basePath);
        \SeasLog::setLogger($logger);
        if(!empty($logHeaer)){
            if(defined('LOG_HEADER')){
                define('LOG_HEADER',$logHeaer);
            }
        }
    }
}
