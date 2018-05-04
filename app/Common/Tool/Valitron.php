<?php
/**
 * 验证类
 * Date: 2018/5/2
 * Time: 15:47
 */
namespace App\Common\Tool;

use phpDocumentor\Reflection\Types\Boolean;
use App\Lib\Valitron\Validator;
use App\Common\Tool\Util;
use Swoft\Bean\Annotation\Inject;

/**
 * @\Swoft\Bean\Annotation\Bean("Valitron")
 */
class Valitron{

    /**
     * @\Swoft\Bean\Annotation\Inject("Token")
     * @var \App\Common\Tool\Token
     */
    private $token;


    /**
     * 登录时表单验证
     * @param $data
     * @param $field
     * @param $request
     * @return array|bool
     */
    public function valitronSignin($data,$field,$request)
    {
        $token = $this->token->getCookie($request);
        $Validator = new Validator($data);
        $Validator->rule("required",$field);  //不能为空
        $Validator->rule('phone',['phone_num']); //检查电话
        $Validator->rule('lengthbetween',['code'],[4,4]);   //检查CODE
        $Validator->rule('equals',$token,['token']);
        $message_list = array(
            'phone_num.required' => Util::getMsg('login_phone_empty'),
            'phone_num.phone'    =>  Util::getMsg('login_phone_error'),
            'token.required' =>  Util::getMsg('Infoexpired'),
            'code.required'  =>  Util::getMsg('login_input_code'),
            'code.lengthbetween'    =>  Util::getMsg('login_verify_error'),
            'token.equals'          => Util::getMsg('login_token_error'),
        );
        if ($Validator->validate($message_list)){
                $ret =  $this->token->verifyToken($token);
                return $ret;
        }else{
             return  $Validator->errors();
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
            'phone.required' => Util::getMsg('login_phone_empty'),
            'phone.phone'    => Util::getMsg('login_phone_error'),
            'token.required' => Util::getMsg('emptyCookie')
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
        $Validator->rule('equals',$str1,['str2']);
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
        $message_list = array(
            'phone.required' => '手机号不能为空',
            'phone.phone'    => '手机号不正确,请重新输入',
        );
        if ($Validator->validate($message_list)){
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


