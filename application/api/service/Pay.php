<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/20
 * Time: 17:53
 */

namespace app\api\service;


use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay',EXTEND_PATH,'.API.php');

class Pay
{
    private $orderID;
    private $orderNO;

    function __construct($orderID)
    {
        if(!$orderID)
        {
            throw new Exception('订单号不允许为NULL');
        }
        $this->orderID=$orderID;
    }

    public function pay()
    {

        $this->checkOrderValid();
        $orderService = new Order();
        $status= $orderService->checkOrderStock($this->orderID);
        if(!$status['pass'])
        {
            return $status;
        }

        return $this->makeWxPreOrder($status['orderPrice']);

    }

    private function makeWxPreOrder($totalPrice)
    {
        //openid
        $openid =Token::getCurrentTokenVar('openid');
        if(!$openid)
        {
            throw new TokenException();
        }
        $wxOrderData= new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNO);
        $wxOrderData->SetTrade_type('JSAPI');
        $wxOrderData->SetTotal_fee($totalPrice*100);
        $wxOrderData->SetBody('零食商贩');
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url('');

        return $this->getPaySignature($wxOrderData);
    }

    private function getPaySignature($wxOrderData)
    {
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        if($wxOrder['return_code']!='SUCCESS'||
            $wxOrder['result_code']!='SUCCESS')
        {
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
        }

        //prepay_id
        //
        $this->recordPreOrder($wxOrder);
        $signature = $this->sign($wxOrder);
        return $signature;
    }

    private function sign($wxOrder)
    {
        $jsApiPaydata = new \WxPayJsApiPay();
        $jsApiPaydata->SetAppid(config('wx.app_id'));
        $jsApiPaydata->SetTimeStamp((string)time());
        $rand =md5(time().mt_rand(0,1000));
        $jsApiPaydata->SetNonceStr($rand);

        $jsApiPaydata->SetPackage('prepay_id='.$wxOrder[prepay_id]);
        $jsApiPaydata->SetSignType('md5');

        $sign = $jsApiPaydata->MakeSign();

        $rawValues=$jsApiPaydata->GetValues();
        $rawValues['paySign']=$sign;

        unset($rawValues['appid']);

        return $rawValues;
    }

    private function recordPreOrder($wxOder)
    {
        \app\api\model\Order::where('id','=',$this->orderID)
        ->update(['prepay_id'=>$wxOder['prepay_id']]);
    }

    private function checkOrderValid()
    {
        $order = \app\api\model\Order::where('id','=',$this->orderID)
            ->find();
        if(!$order){
            throw  new OrderException();
        }

        if(!Token::isValidOperate($order->user_id))
        {
            throw new TokenException([
                'msg'=>'订单与用户是不匹配',
                'errorCode'=>10003
            ]);
        }

        if($order->status!=OrderStatusEnum::UNPAID){
            throw new OrderException([
                'msg'=>'订单已支付过啦',
                'errorCode'=>80003,
                'code'=>400
            ]);
        }
        $this->orderNO=$order->order_no;
        return true;
    }
}