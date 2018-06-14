<?php
/**
 * 定时任务
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Tasks;

use Swoft\App;
use Swoft\Bean\Annotation\Inject;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use Swoft\Task\Bean\Annotation\Scheduled;
use Swoft\Task\Bean\Annotation\Task;
use App\Models\Logic\LiveGameLogic;


/**
 * cron task
 *
 * @Task("cron")
 */
class CronTask
{
    /**
     * @\Swoft\Bean\Annotation\Inject("ZhiBoBa")
     * @var \App\Common\Cron\ZhiBoBa
     */
    private $zhiBoBa;

    /**
     * crontab 直播吧抓取 定时任务
     * 每周日1点执行
     *
     * @Scheduled(cron="* 0 0 * * *")
     */
    public function cronZhiBo8Task()
    {
        echo "grab zhiboba start \r\n";
        $this->zhiBoBa->beginGrab();
        echo "grab zhiboba end \r\n";
        return true;
    }


    /**
     * crontab 直播吧新闻抓取 定时任务
     * 每10分钟执行
     *
     * @Scheduled(cron="0 *\/10 * * * *")
     */
    public function cronZhiBo8NewsTask()
    {
        echo "grab zhiboba news start \r\n";
        $result = $this->zhiBoBa->beginGrabNews();
        echo "共抓取".$result."条新闻";
        echo "grab zhiboba news end \r\n";
        return true;
    }

    /**
     * crontab 修改比赛状态，每天凌晨1点执行，将前一天的所有比赛状态改为已结束
     *
     * @Scheduled(cron="* 0 1 * * *")
     */
   public function cronUpdateGameStatus()
   {
       /* @var LiveGameLogic $logic */
       $logic = App::getBean(LiveGameLogic::class);
       $date = date('Y-m-d',strtotime("-1 days"));
       $logic->updateGameStatus($date,$date,3);
   }


}
