<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/19
 * Time: 8:39
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code=400;
    public $msg='微信服务器接口调用失败';
    public $errorCode=999;
}