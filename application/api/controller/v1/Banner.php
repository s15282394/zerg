<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/10
 * Time: 22:56
 */

namespace app\api\controller\v1;

use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;

class Banner
{
    /**
     * 获取制定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id
     *
     */
    public function getBanner($id)
    {
        (new IDMustBePositiveInt())->goCheck();


        $banner = BannerModel::getBannerByID($id);
        //$banner->hidden(['update_time']);
        if(!$banner){
            throw  new BannerMissException();
        }



        return $banner;
    }

}