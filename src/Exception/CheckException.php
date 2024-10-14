<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/17 0017
 * Time: 16:15
 */

namespace Exception;

use Exception\BaseException;

class CheckException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '检查异常';
    }
}
