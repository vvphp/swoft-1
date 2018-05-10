<?php
/**
 * 直播吧 赛事 抓取
 * Date: 2018/5/10
 * Time: 19:30
 */
namespace App\Common\Cron;

use Swoft\Cache\Cache;
use Swoft\Bean\Annotation\Inject;
use App\Common\Tool\Valitron;
use App\Common\Tool\Util;
use App\Common\Tool\VerifCode;
use Swoft\Task\Task;
use Swoft\App;

require_once App::getAlias('@vendor') .'/electrolinux/phpquery/phpQuery/phpQuery.php';

/**
 * @\Swoft\Bean\Annotation\Bean("ZhiBoBa")
 */
class  ZhiBoBa{

    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    /**
     * @\Swoft\Bean\Annotation\Inject("Valitron")
     * @var \App\Common\Tool\Valitron
     */
    private $valitron;

    /**
     * 抓取URL
     * @var string
     */
    private $url = 'https://www.zhibo8.cc/';

    /**
     * 开始抓取
     * @param string $url
     * @return \phpQuery|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|string
     */
    public function beginGrab($url='')
    {
        $grabUrl = !empty($url) ? $url : $this->url;
        phpQuery::newDocumentFile($grabUrl);
        return  pq("body")->html();
    }



}


