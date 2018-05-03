<?php
/**
 * 验证类
 * Date: 2018/5/2
 * Time: 15:47
 */
namespace App\Common\Tool;

use App\Lib\Valitron\Validator;

class Valitron{

    /**
     * 登录时表单验证
     * @param $data
     * @param $field
     * @return array|bool
     */
    public static function valitronSignin($data,$field)
    {
        $comArr = array_combine($field,$field);
        $Validator = new Validator($data);
        $Validator->rule("required",$field);  //不能为空
        $Validator->rule('phone',[$comArr['phone_num']]); //检查电话
        $Validator->rule('length',[$comArr['code']],4);   //检查CODE
        $Validator->rule('equals',[$comArr['token']],[$comArr['cookieToken']]);
        $Validator->labels([
            'phone' => '手机号',
            'code' => '验证码'
        ]);
        if ($Validator->validate()){
            return true;
        }else{
            return $Validator->errors();
        }
    }

    /**
     * 发短信基本验证
     * @param $data
     * @param $field
     * @return array|bool
     */
    public static function valitronSendSms($data,$field)
    {
        $Validator = new Validator($data);
        $Validator->rule("required",$field);  //不能为空
        $Validator->rule('phone',['phone']); //检查电话
        $Validator->labels([
            'phone' => '手机号',
            'code'  => '验证码'
        ]);
        $message_list = array(
            'phonerequired' => '手机号不能为空',
            'phonephone' => '手机号不正确,请重新输入'
        );
        if ($Validator->validate($message_list)){
            return true;
        }else{
            return $Validator->errors();
        }
    }

    /**
     * 判断两个值是否相等
     * @param $str1
     * @param $str2
     */
    public static function valitronEquals($str1,$str2)
    {
        $data = ['str1' => $str1,'str2' => $str2];
        $Validator = new Validator($data);
        $Validator->rule('equals',$str1,[$str2]);
        if ($Validator->validate()) {
            return true;
        }
        return false;
    }

    /**
     * 验证手机号
     * @param string $phone
     * @return array|bool
     */
    public static function valitronPhone($phone = '')
    {
        $data = ['phone' => $phone];
        $Validator = new Validator($data);
        $Validator->rule("required",['phone']);  //不能为空
        $Validator->rule('phone',['phone']); //检查电话
        $Validator->labels([
            'phone' => '手机号',
        ]);
        if ($Validator->validate()){
            return true;
        }else{
            return $Validator->errors();
        }
    }

    /**
     * 检查字符是否为空
     * @param $str
     * @return array|bool
     */
    public static function valitronString($str)
    {
        $data = ['str' => $str];
        $Validator = new Validator($data);
        $Validator->rule("required",['str']);  //不能为空
        if ($Validator->validate()){
            return true;
        }else{
            return $Validator->errors();
        }
    }



}


