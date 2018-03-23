<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/20
 * Time: 11:22
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在,请检查ID';
    public $errorCode = 80000;
}