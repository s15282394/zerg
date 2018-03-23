<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/20
 * Time: 14:37
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = ['user_id','delete_time','update_time'];
    protected $autoWriteTimestamp = true;
}