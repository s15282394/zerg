<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/20
 * Time: 20:42
 */

namespace app\lib\enum;


class OrderStatusEnum
{
//1:未支付，
    const UNPAID = 1;
//2：已支付，
    const PAID = 2;
//3：已发货 ,
    const DELIVERED = 3;
// 4: 已支付，但库存不足
    const PAID_BUT_OUT_OF = 4;
}