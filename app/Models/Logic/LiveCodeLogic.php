<?php
/**
 * 发送短信，邮件逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use Swoft\Bean\Annotation\Inject;
use App\Common\Tool\Valitron;
use App\Common\Tool\Util;

/**
 * 用户逻辑层
 * 同时可以被controller server task使用
 *
 * @Bean()
 * @uses      LiveCodeLogic
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveCodeLogic
{
    /**
     * @\Swoft\Bean\Annotation\Inject("Valitron")
     * @var \App\Common\Tool\Valitron
     */
    private $valitron;

    /**
     * @\Swoft\Bean\Annotation\Inject("SendCode")
     * @var \App\Common\Sms\SendCode
     */
    private $sendCode;

    /**
     * 发送注册验证码
     * @param $phone
     * @param string $token
     * @return json
     */
    public function sendRegisterCode($phone,$token='')
    {
        //检查手机格式
        $check = $this->valitron->valitronPhone($phone);
        if(is_array($check)){
            $msgArr = array_pop($check);
            return Util::showMsg([],$msgArr[0],'0');
        }
        //验证token
        if(!empty($token)){
            $session = session()->all();
            $sessionToken = $session['_token'];
            //token验证
            $check = $this->valitron->valitronEquals($token,$sessionToken);
            if(!$check){
                return Util::showMsg([],'Infoexpired','0');
            }
        }
        //不能超过5次
        $countCheck = $this->sendCode->checkGreaterTotalNumber($phone);
        if(!$countCheck){
            return Util::showMsg([],'smsSendLimit','0');
        }
       $res =  $this->sendCode->sendSms($phone);
       if(!$res){
            return Util::showMsg([],'smsCodeError','0');
        }
        if(!empty($token)){
            $session['_token'] = '';
            session()->put($session);
       }
        return Util::showMsg([],'smsSendSuccess','0');
    }

}
