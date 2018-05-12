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
use GuzzleHttp\Client;

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
            break;
        }
        print_r($data);
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





        }




        //live_match_table


       // live_play_link


       // live_game_schedule

    }

    /**
     * 写入球队表
     * @param $value
     */
    private function saveLiveTeam($value)
    {
        //live_team_table
        if(empty($value['home_team']) && empty($value['visiting_team'])){
             return true;
        }
        if(!empty($value['home_team'])){
            //先查一下球队是否已经在表里存在
            $where = [
                'team_name' => $value['home_team']
            ];


            $live_team = [
                'team_name'  => $value['home_team'],
                'team_logo'  => $value['home_team_micro'],
                'add_date'   => time(),
                'sports_category' => $this->processLabel($value['label'])
            ];

        }

    }



    
    public function testDba()
    {
        $data = [
             'home_team' => 'NBA',
             'visiting_team' => 'WNBA'
        ];
        $logic = App::getBean(LiveTeamLogic::class); 
        $logic->saveLiveTeam($data);
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
       return implode(',',$labelArr);
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


