<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/16
 * Time: 23:59
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkIDs',
    ];

    protected $message=[
        'ids'=>'ids参数必须是以逗号分隔的多个正整数'
    ];

    protected function checkIDs($value){
        $values=explode(',',$value);

        if(empty($values)){
            return false;
        }
        foreach ($values as $id){
            if(!$this->isPositiveInteger($id)){
                return false;
            }
        }

        return true;
    }

}