<?php
/**
 * PHP 加密解密类
 * Date: 2018/5/2
 * Time: 19:30
 */
namespace App\Common\McrYpt;

class DES1 {
    static $key = 'zxr';
    /**
     * @param $input
     * @param int $type
     * @return string
     */
    public static  function encrypt($input, $type = 0) {
        $key = self::$key;
        $size = mcrypt_get_block_size('des', 'ecb');
        $input = self::_pkcs5Pad($input, $size);
        $td = mcrypt_module_open('des', '', 'ecb', '');
        $iv = @mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        @mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = $type == 0 ? base64_encode($data) : bin2hex($data);
        return $data;
    }

    /**
     * @param $encrypted
     * @param int $type
     * @return bool|string
     */
    public static function decrypt($encrypted, $type = 0) {
        $key = self::$key;
        $encrypted = $type == 0 ? base64_decode($encrypted) : self::Hex2bin($encrypted);
        $td = mcrypt_module_open('des','','ecb','');
        //使用MCRYPT_DES算法,cbc模式
        $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        $ks = mcrypt_enc_get_key_size($td);
        @mcrypt_generic_init($td, $key, $iv);
        //初始处理
        $decrypted = mdecrypt_generic($td, $encrypted);
        //解密
        mcrypt_generic_deinit($td);
        //结束
        mcrypt_module_close($td);
        $y = self::_pkcs5Unpad($decrypted);
        return $y;
    }

    //解密flash------------
    public static function flashDecrypt($encrypted) {
        $vi=$key='DES1_#.2';
        $tb=mcrypt_module_open(MCRYPT_3DES,'','cbc','');
        mcrypt_generic_init($tb,$key,$vi);
        $cipher=base64_decode($encrypted);
        $pain=mdecrypt_generic($tb,$cipher);
        mcrypt_generic_deinit($tb);
        mcrypt_module_close($tb);
        return $pain;
    }

    private static function _pkcs5Pad ($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    private static function _pkcs5Unpad($text) {
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text))
            return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;
        return substr($text, 0, -1 * $pad);
    }

    public static function Hex2bin($h){
        if (!is_string($h)) return null;
        $r='';
        for ($a=0; $a<strlen($h); $a+=2) {
            $r.=chr(hexdec($h{$a}.$h{($a+1)}));
        }
        return $r;
    }
}

