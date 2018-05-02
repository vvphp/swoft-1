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



}


