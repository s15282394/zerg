<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/19
 * Time: 15:47
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden = ['product_id','delete_time','id'];
}