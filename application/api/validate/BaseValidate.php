<?php
/**
 * Created by 七月
 * User: 七月
 * Date: 2017/2/14
 * Time: 12:16
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

/**
 * Class BaseValidate
 * 验证类的基类
 */
class BaseValidate extends Validate
{
    /**
     * 检测所有客户端发来的参数是否符合验证类规则
     * 基类定义了很多自定义验证方法
     * 这些自定义验证方法其实，也可以直接调用
     * @throws ParameterException
     * @return true
     */
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();

        $result = $this->check($params);

        if (!$result) {
            $e = new ParameterException([
                'msg'=>$this->error,
            ]);
//            $e->msg = $this->error;
//            $e->errorCode = 10002;
            throw $e;
        }
        else {
            return true;
        }
    }


    protected function isPositiveInteger($value)
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        else
        {
            return false;
        }

    }

    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result=preg_match($rule,$value);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    protected function isNotEmpty($value,$rule='',$data='',$field='')
    {
        if(empty($value)){
            return false;
        }
        else{
            return true;
        }
    }

    public function getDatabyRule($arrays)
    {
        if(array_key_exists('user_id',$arrays)|
            array_key_exists('uid',$arrays)
        )
        {
            throw new ParameterException([
                'msg'=>'参数中包含有非法的参数名user_id或者uid'
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key=>$value)
        {
            $newArray[$key]=$arrays[$key];
        }
        return $newArray;
    }



}