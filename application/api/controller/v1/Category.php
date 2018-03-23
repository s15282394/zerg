<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/18
 * Time: 18:47
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    public function getAllCategories(){
        $categories = CategoryModel::all([],'img');
        if($categories->isEmpty()){
            throw new CategoryException();
        }
        return $categories;
    }
}