<?php
/**
 * redis单例类
 * User: 姜伟
 * Date: 2017/3/5 0005
 * Time: 12:32
 */
namespace DesignPatterns\Singletons;

use Constant\ErrorCode;
use Exception\Redis\RedisException;
use Log\Log;
use Tool\Tool;
use Traits\SingletonTrait;

class RedisSingleton {
    use SingletonTrait;

    /**
     * 数据库索引
     * @var int
     */
    private $dbIndex = 0;
    /**
     * 客户端连接名称
     * @var string
     */
    private $clientName = '';
    /**
     * @var \Redis
     */
    private $conn = null;
    /**
     * @var int
     */
    private $connTime = 0;

    private function __construct() {
        $this->init();
    }

    public function __destruct(){
        if(!is_null($this->conn)){
            $this->conn->close();
        }
        self::$instance = null;
    }

    private $configs = null;

    public function setConfig($config){
        $this->config = $config;
    }
    /**
     * @throws \Exception\Redis\RedisException
     */
    private function init() {
        $this->conn = null;

        if(!empty($this->config)){
            $configs = $this->config;
        }else{
            $configs =  Tool::getYaconfConfig('redis.' . SY_ENV . SY_PROJECT);
        }

        $host = Tool::getArrayVal($configs, 'host','127.0.0.1');
        $port = Tool::getArrayVal($configs, 'port',6379);
        $pwd = Tool::getArrayVal($configs, 'password', '');
        $dbIndex = 5;

        try {
            $redis = new \Redis();
            if (!$redis->connect($host, $port)) {
                throw new RedisException('Redis连接出错', ErrorCode::REDIS_CONNECTION_ERROR);
            }
            if (!empty($pwd)) {
                try{
                    $redis->auth($pwd);
                }catch (\RedisException $e){
                    throw new RedisException('Redis鉴权失败', ErrorCode::REDIS_AUTH_ERROR);
                }
            }
            if (!$redis->select($dbIndex)) {
                throw new RedisException('Redis切换数据库出错', ErrorCode::REDIS_CONNECTION_ERROR);
            }

            $this->dbIndex = $dbIndex;
            $this->clientName = hash('crc32b', microtime(true) . Tool::createNonceStr(6));
            if (!$redis->client('setname', $this->clientName)) { //设置客户端名称
                $this->clientName = '';
            }

            $this->conn = $redis;
            $this->connTime = Tool::getNowTime();
        } catch (RedisException $e) {
            throw $e;
        } catch (\Exception $e) {

            $msg  = 'Error: ' . $e->getMessage().PHP_EOL; // 获取错误信息
            $msg .= $e->getTraceAsString().PHP_EOL; // 获取字符串类型的异常追踪信息
            $msg .= '异常行号：' . $e->getLine().PHP_EOL; // 异常发生所在行
            $msg .= '所在文件：' . $e->getFile().PHP_EOL; // 异常发生所在文件绝对路径
            echo $msg;
            //            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
            throw new RedisException('Redis初始化出错'.$e->getMessage(), ErrorCode::REDIS_CONNECTION_ERROR);
        }
    }

    /**
     * @return \DesignPatterns\Singletons\RedisSingleton
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \Redis
     */
    public function getConn() {
        if(is_null($this->conn)){
            $this->init();
        }
        return $this->conn;
    }

    /**
     * 切换数据库
     * @param int $dbIndex 数据库索引
     * @throws \Exception\Redis\RedisException
     */
    public function changeDb(int $dbIndex) {
        if ($dbIndex < 0) {
            throw new RedisException('数据库索引不合法', ErrorCode::REDIS_CONNECTION_ERROR);
        }

        $this->getCurrentDb();
        if ($dbIndex != $this->dbIndex) {
            if(!$this->conn->select($dbIndex)){
                throw new RedisException('切换数据库失败', ErrorCode::REDIS_CONNECTION_ERROR);
            }

            $this->dbIndex = $dbIndex;
        }
    }

    /**
     * 获取当前数据库索引
     * @return int
     */
    public function getCurrentDb() {
        if(strlen($this->clientName) > 0){
            $clients = $this->conn->client('list');
            foreach ($clients as $eClient) {
                if($eClient['name'] == $this->clientName){
                    if($eClient['db'] != $this->dbIndex){
                        $this->dbIndex = (int)$eClient['db'];
                    }

                    break;
                }
            }
        }

        return $this->dbIndex;
    }

    /**
     * 关闭连接
     */
    public function close() {
        $this->conn->close();
        self::$instance = null;
    }

    /**
     * 检测连接
     */
    public function checkConn() {
        if (is_null($this->conn)) {
            $this->init();
        } else {
            try {
                $res = $this->conn->ping();
                if ($res !== '+PONG') {
                    Log::error('redis check fail,check result is ' . $res);

                    $this->init();
                }
            } catch (\Exception $e) {
                Log::error('redis connect fail-' . $e->getMessage(), $e->getCode(), $e->getTraceAsString());

                $this->init();
            }
        }
    }

    public function reConnect() {
        $nowTime = time();
        if (is_null($this->conn)) {
            $this->init();
        } else if ($nowTime - $this->connTime >= 15) {
            $this->conn->close();
            $this->init();
        }
    }
}
