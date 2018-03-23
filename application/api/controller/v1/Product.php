<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/18
 * Time: 12:18
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ProductException;

class Product
{
    public function getRecent($count=15){
        (new Count())->goCheck();

        $product = ProductModel::getMostRecent(($count));

        if($product->isEmpty()){
            throw new ProductException();
        }
        $product = $product->hidden(['summary']);
        return $product;
    }

    public function getAllInCategory($id){
        (new IDMustBePositiveInt())->goCheck();

        $product = ProductModel::getProductByCategoryID($id);
        if($product->isEmpty()){
            throw  new ProductException();
        }

        return $product;
    }

    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $product = ProductModel::getProductDetail($id);
        if(!$product){
            throw new ProductException();
        }

        return $product;
    }

    public function deleteOne($id){

    }

}