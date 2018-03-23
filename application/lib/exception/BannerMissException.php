<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/11
 * Time: 15:44
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg='请求的Banner不存在';
    public $errorCode=10000;

}