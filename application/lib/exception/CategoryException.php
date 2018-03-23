<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/18
 * Time: 18:56
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;
    public $msg='指定的类目不存在，请检查';
    public $errorCode=50000;
}