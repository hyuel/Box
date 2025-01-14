<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/10/9 0009
 * Time: 14:10
 */
namespace DesignPatterns\Singletons;

use Cache\Lite\CacheLite;
use Tool\Dir;
use Traits\SingletonTrait;

class CacheFileSingleton {
    use SingletonTrait;

    /**
     * @var \Cache\Lite\CacheLite
     */
    private $cache = null;

    private $cacheDir = '/tmp/cache/lite';

    private function __construct() {
        Dir::create($thi->cacheDir);

        $this->cache = new CacheLite([
            'cacheDir' => $thi->cacheDir . '/', //必须以/结尾
            'lifeTime' => 300,
        ]);
    }

    /**
     * @return \Cache\Lite\CacheLite
     */
    public static function getInstance() {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance->cache;
    }
}