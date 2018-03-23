<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/19
 * Time: 10:54
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code=401;
    public $msg='Token已过期或无效Token';
    public $errorCode=10001;
}