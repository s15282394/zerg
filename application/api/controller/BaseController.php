<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/20
 * Time: 9:55
 */

namespace app\api\controller;


use app\api\service\Token as TokenService;


class BaseController
{
    protected function checkPrimaryScope()
    {
        TokenService::needPrimaryScope();
    }

    protected function checkExclusiveScope()
    {
        TokenService::needExclusiveScope();
    }
}