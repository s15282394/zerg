<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/18
 * Time: 18:47
 */

namespace app\api\model;


use think\Model;

class Category extends Model
{
    protected $hidden =['delete_time','update_time','create_time'];

    public function img(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
}