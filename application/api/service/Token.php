<?php
/**
 * Created by PhpStorm.
 * User: shuibingyuan
 * Date: 2018/3/19
 * Time: 10:28
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;
use app\lib\exception\ForbiddenException;
use app\lib\enum\ScopeEnum;

class Token
{
    public static function generateToken(){
        //32个字符组成一组随机字符串
        $randChars=getRandChars(32);
        //用三组字符串，进行md5加密
        $timestamp=$_SERVER['REQUEST_TIME_FLOAT'];

        $salt=config('secure.token_salt');

        return md5($randChars.$timestamp.$salt);
    }

    public static function getCurrentTokenVar($key){
        $token = Request::instance()
            ->header('token');

        $vars=Cache::get($token);
        if(!$vars){
            throw new TokenException();
        }
        else{
            if(!is_array($vars)){
                $vars = json_decode($vars,true);
            }
            if(array_key_exists($key,$vars)){
                return $vars[$key];
            }
            else{
                throw new Exception();
            }
        }
    }

    public static function getCurrentUid(){
        //token
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }

    //用户和管理员都可以访问
    public static function needPrimaryScope()
    {
        $scope=self::getCurrentTokenVar('scope');
        if($scope){
            if($scope>=ScopeEnum::User){
                return true;
            }
            else{
                throw new ForbiddenException();
            }
        }
        else{
            throw new TokenException();
        }
    }

    //只有用户才能访问的权限
    public static function needExclusiveScope()
    {
        $scope=self::getCurrentTokenVar('scope');
        if($scope){
            if($scope=ScopeEnum::User){
                return true;
            }
            else{
                throw new ForbiddenException();
            }
        }
        else{
            throw new TokenException();
        }
    }

    public static function isValidOperate($checkedUID)
    {
        if (!$checkedUID) {
            throw new Exception('检查UID时必须传入一个被检查的UID');
        }

        $currentOperateUID = self::getCurrentUid();
        if ($currentOperateUID == $checkedUID) {
            return true;
        }
        return false;
    }
}