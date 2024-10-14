<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/19 0019
 * Time: 11:08
 */

namespace Exception\Wx;

use Exception\BaseException;

class WxMiniException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '微信小程序异常';
    }
}