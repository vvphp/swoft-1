<?php
/**
 * 阿里发送短信
 */
namespace App\Common\Sms;

use Swoft\App;

require_once App::getAlias('@lib') .'/Sms/Ali/vendor/autoload.php';

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\SendBatchSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

// 加载区域结点配置
Config::load();

/**
 * Class AliCode
 *
 * Created on 17/10/17.
 * 短信服务API产品的DEMO程序,工程中包含了一个SmsDemo类，直接通过
 * 执行此文件即可体验语音服务产品API功能(只需要将AK替换成开通了云通信-短信服务产品功能的AK即可)
 * 备注:Demo工程编码采用UTF-8
 */
class AliCode
{
    static $acsClient = null;

    private static $config = [];

    /**
     * 获取短信配置
     * @return mixed
     */
    private static function getConfig()
    {
        $config = App::$properties['ali'];
        self::$config = $config;
        return $config;
    }
    /**
     * 取得AcsClient
     *
     * @return DefaultAcsClient
     */
    public static function getAcsClient()
    {
        //产品名称:云通信流量服务API产品,开发者无需替换
        $product = "Dysmsapi";

        //产品域名,开发者无需替换
        $domain = "dysmsapi.aliyuncs.com";

        // TODO 此处需要替换成开发者自己的AK (https://ak-console.aliyun.com/)
        $accessKeyId = self::$config['accessKeyId']; // AccessKeyId

        $accessKeySecret = self::$config['accessKeySecret']; // AccessKeySecret

        // 暂时不支持多Region
        $region = "cn-hangzhou";

        // 服务结点
        $endPointName = "cn-hangzhou";


        if(static::$acsClient == null) {

            //初始化acsClient,暂不支持region化
            $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

            // 增加服务结点
            DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

            // 初始化AcsClient用于发起请求
            static::$acsClient = new DefaultAcsClient($profile);
        }
        return static::$acsClient;
    }


    /** 发送短信
     * @param $phone
     * @param $code
     * @return mixed|SimpleXMLElement
     */
    public static function sendSms($phone,$code)
    {
         self::getConfig();

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($phone);

        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName(self::$config['signName']);

        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode(self::$config['templateCode']);

        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
            "code" => $code,
            "product"=>"dsd"
        ), JSON_UNESCAPED_UNICODE));

        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);
        return $acsResponse;
    }

}
