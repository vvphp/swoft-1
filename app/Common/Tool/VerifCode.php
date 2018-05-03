<?php
/**
 * 验证码类
 * Date: 2018/5/2
 * Time: 19:30
 */
namespace App\Common\Tool;


class  VerifCode{

    /**
     * 生成短信验证码 字母+数字
     * @param int $len
     */
    public static  function  generatingVerificationCode($len=4)
    {
        $arr = range('a','z');
        shuffle($arr);
        $intArr = range(1,99);
        shuffle($intArr);
        $code = $intArr[0].$arr[1].$intArr[1].$arr[0];
        $code = substr($code,0,$len);
        if(strlen($code) < $len){
            $code = str_pad($code,$len,mt_rand(0,9));
        }
        return $code;
    }

}


