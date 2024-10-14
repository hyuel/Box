<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/17 0017
 * Time: 16:24
 */

namespace Exception;


class BaseException extends \Exception
{
    public $tipName = '';

    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
