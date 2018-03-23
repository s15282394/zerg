<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/19
 * Time: 7:29
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule =[
        'code'=>'require|isNotEmpty',
        'uid'=>'require|isNotEmpty'
    ];

    protected $message = [
        'code'=>'没有code还想获取token，做梦哦！',
        'uid'=>'uid无效无法使用系统'
    ];

    protected function checkUserByUid($value)
    {

    }
}