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

use App\Models\Logic\LiveTeamLogic;
use App\Models\Logic\LiveMatchLogic;
use App\Models\Logic\LiveGameLogic;
use App\Models\Logic\LivePlayLogic;
use GuzzleHttp\Client;

require_once App::getAlias('@vendor') .'/electrolinux/phpquery/phpQuery/phpQuery.php';

/**
 * @\Swoft\Bean\Annotation\Bean("ZhiBoBa")
 */
class  ZhiBoBa{
    /**
     * 抓取URL
     * @var string
     */
    private $url = 'https://www.zhibo8.cc/';

    /**
     * 赛会ID
     * @var int
     */
    private $match_id = 0;

    /**
     * 主队ID
     * @var int
     */
    private $home_team_id = 0;

    /**
     * 客队ID
     * @var int
     */
    private $visiting_team_id = 0;

    /**
     * 比赛ID
     * @var int
     */
    private $game_id = 0;


    /**
     * 开始抓取
     * @param string $url
     * @return \phpQuery|\QueryTemplatesParse|\QueryTemplatesSource|\QueryTemplatesSourceQuery|string
     */
    public function beginGrab($url='')
    {
        $grabUrl = !empty($url) ? $url : $this->url;
        $client = new Client();
        $res  = $client->request('GET', $grabUrl);
        $body = $res->getBody()->getContents();
        \phpQuery::newDocumentHTML($body);
        foreach( pq(".box") as $html){
            $data = [];
            $title = pq($html)->find('h2')->attr('title');
            $liList = pq($html)->find("li");
            foreach($liList as $index => $liHtml){
                $liveArr = [];
                $data[$index]['title'] = trim($title);
                $data[$index]['label'] = pq($liHtml)->attr("label");
                $data[$index]['data-time'] = pq($liHtml)->attr("data-time");
                $content = pq($liHtml)->html();
                $contentArr = $this->processContent($content);
                $key = 0 ;
                foreach(pq($liHtml)->find("a") as $aHtml){
                    $liveArr[$key]['text'] = pq($aHtml)->text();
                    $href = pq($aHtml)->attr("href");
                    $urlInfo = parse_url($href);
                    if(!isset($urlInfo['scheme'])){
                        $href = "https://".trim($href,"/");                       
                    }
                    $liveArr[$key]['href'] = $href;
                    $key++;
                }
                $data[$index] = array_merge($data[$index],$contentArr);
                $data[$index]['live'] = $liveArr;
            }
            $this->saveGrabData($data);
        }
        return 1;
    }


    /**
     * 将数据保存到mysql中
     * @param $data
     */
    private  function saveGrabData($data)
    {
        if(empty($data)){
             return true;
        }
        foreach($data as $index => $value){
                   $this->saveLiveTeam($value);
                   $this->saveLiveMatch($value);
                   $this->saveLiveGame($value);
                   $this->saveLivePlayLink($value);
        }
    }

    /**
     * 写入球队表 live_team_table
     * @param $value
     * @return boolean
     */
    private function saveLiveTeam($value)
    {
        if(empty($value['home_team']) && empty($value['visiting_team'])){
             return true;
        }
        /* @var LiveTeamLogic $logic */
        $logic = App::getBean(LiveTeamLogic::class);
        $sports_category = $this->processLabel($value['label']);
        if(!empty($value['home_team'])){
            $live_team = [
                'team_name'  => $value['home_team'],
                'team_logo'  => $value['home_team_micro'],
                'sports_category' => $sports_category
            ];
           $this->home_team_id = $logic->saveLiveTeam($live_team);
        }
        if(!empty($value['visiting_team'])){
            $live_team = [
                'team_name'  => $value['visiting_team'],
                'team_logo'  => $value['visiting_team_micro'],
                'sports_category' => $sports_category
            ];
         $this->visiting_team_id = $logic->saveLiveTeam($live_team);
        }
        return true;
    }

    /**
     * 写入 赛会表 live_match_table
     * @param $value
     * @return boolean
     */
    private function saveLiveMatch($value)
    {
        if(!isset($value['competition_category']) || empty($value['competition_category'])){
            return false;
        }
        /* @var LiveMatchLogic $logic */
        $logic = App::getBean(LiveMatchLogic::class);
        $save = [
            'competition_name'  => $value['competition_category'],
        ];
        $this->match_id =  $logic->saveLiveMatch($save);
   }


    /**
     * 写入比赛 赛程表 live_game_schedule
     * @param $value
     */
    private function saveLiveGame($value)
    {
        $game_date = trim($value['title']);
        $data_time = str_replace($game_date,'',$value['data-time']);
        $save = [
               'match_id' => $this->match_id,
               'live_member_id' => 1,
               'game_date' => $game_date,
               'data_time' => trim($data_time),
               'label' => $value['label'],
               'home_team_id' => $this->home_team_id,
               'visiting_team_id' => $this->visiting_team_id
         ];
        /* @var LiveGameLogic $logic */
        $logic = App::getBean(LiveGameLogic::class);
        $this->game_id = $logic->saveLiveGame($save);
    }

    /**
     * 写入播放地址链接表 live_play_link
     * @param $value
     */
    private function saveLivePlayLink($value)
    {
        /* @var LivePlayLogic $logic */
        $logic = App::getBean(LivePlayLogic::class);
        $logic->saveLivePlay($this->game_id,$value['live']);
    }


    /**
     * 处理 label数据
     * @param $label
     * @return string
     */
    private function processLabel($label)
    {
        $labelRel = str_replace(['其他','篮球公园','中超'],'',$label);
        $labelArr = explode(',',$labelRel);
        if(empty($labelArr)){
            return $label;
        }
        $label =  implode(',',$labelArr);
        return trim($label,',');
    }

    /**
     * 处理content内容
     * @param $content
     * @return array
     */
    public function processContent($content)
    {
        if(empty($content)){
            return [];
        }
        //匹配超链接字符串
        preg_match("/<a.*\/a>/i",$content,$matches);
       //匹配图片链接地址
        preg_match_all("/src=(.*)>/iU", $content, $imagesMatch);
        $linkHtml = isset($matches[0]) ? $matches[0]:'';
        $imagesList = isset($imagesMatch[1]) ?  $imagesMatch[1] : [];
        if(!empty($linkHtml)){
            $content = str_replace($linkHtml,'',$content);
        }
        $contentTag = strip_tags($content);
        $contentArr = explode(' ',$contentTag);
        unset($contentArr[0]);
        $contentArr = array_filter($contentArr,function($val){
            if(empty($val) || $val=='-'){
                return false;
            }
            return true;
        });
        $contentArr = array_values($contentArr);
        if(count($contentArr) >= 3){
            $teamMicro = isset($imagesList[0]) ? "https:".trim($imagesList[0],'"') : '';
            $visitingTeam = isset($imagesList[1]) ? "https:".trim($imagesList[1],'"') : '';
            array_splice($contentArr,2,0,["2" => $teamMicro]);
            array_splice($contentArr,5,0,["5" => $visitingTeam]);
        }
        if(count($contentArr) < 3){
            $contentArr = array_pad($contentArr,5,'');
        }
        $gameArr = array('competition_category','home_team','home_team_micro','visiting_team','visiting_team_micro');
        $contentArr = array_combine($gameArr,$contentArr);
        return $contentArr;
    }

}


