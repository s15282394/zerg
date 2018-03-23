<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/19
 * Time: 7:39
 */

namespace app\api\model;


use think\Model;

class User extends BaseModel
{
    public function address()
    {
        return $this->hasOne('UserAddress','user_id','id');
    }

    public static function getByOpenID($openid){
        $user=self::where('openid','=',$openid)
        ->find();
        return $user;
    }
}