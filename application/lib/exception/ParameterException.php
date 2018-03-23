<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/12
 * Time: 20:57
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    // http 状态码 404,200
    public $code=400;

    //错误具体信息
    public $msg='参数错误';

    //自定义的错误代码
    public $errorCode=10000;

}