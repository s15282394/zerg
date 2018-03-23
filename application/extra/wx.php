<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/19
 * Time: 7:51
 */
return [
    'app_id'=>'wxfe5648f82ed968cc',
    'app_secret'=>'197e7040870d259311362337aa04f37a',
    // 微信使用code换取用户openid及session_key的url地址
    'login_url' => "https://api.weixin.qq.com/sns/jscode2session?" .
        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code"
];