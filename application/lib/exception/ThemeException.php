<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/17
 * Time: 10:06
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code =404;
    public $msg='指定主题不存在,请检查主题ID';
    public $errorCode=30000;
}