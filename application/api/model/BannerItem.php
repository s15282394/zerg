<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/16
 * Time: 21:10
 */

namespace app\api\model;


use think\Model;

class BannerItem extends Model
{
    protected $hidden=['id','img_id','banner_id','delete_time','update_time'];
    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }

}