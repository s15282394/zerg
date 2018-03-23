<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/18
 * Time: 13:27
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule=[
        'count'=>'isPositiveInteger|between:1,15'
    ];
}