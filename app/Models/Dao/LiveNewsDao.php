<?php
/**
 * 新闻标题表 MODEL层 具体的数据库操作
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Dao;

use Swoft\App;
use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use App\Models\Entity\LiveNews;

/**
 * @Bean()
 * @uses      LiveNewsDao
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveNewsDao
{
    private $fields = ['id','title','link','type','add_date'];
    /**
     * 根据 title 查询是否存在，如果不存在则插入，如果存在则直接返回true
     * @param $data
     * @return bool|mixed
     */
    public function saveLiveNews($data)
    {
        if(!empty($data['title'])){
            $result = $this->getNewsIdByTitle($data['title']);
            if(!empty($result)){
                 return $result[0]['id'];
            }
           return  $this->saveNewsByData($data);
        }
        return 0;
    }

    /**
     * 查询新闻列表
     * @param array $where
     * @param array $orderBy
     * @param int $start
     * @param int $limit
     * @return array
     */
    public function getNewsList($where=[],$orderBy=[],$start=0,$limit=10)
    {
        $result = LiveNews::findAll($where, ['fields' => $this->fields,'orderby' => $orderBy,'offset'=>$start,'limit' => $limit])->getResult();
         return empty($result) ? [] : $result->toArray();
    }

    /**
     * 根据 title 查询表中是否已经存在数据
     * @param string $title
     * @param string $symbol
     * @return mixed
     */
    private function getNewsIdByTitle($title='',$symbol='')
    {
        if($symbol == 'like'){
            $where = ['title', 'like', "%".$title."%"];
        }else{
            $where = ['title' => $title];
        }
        $result =  LiveNews::findAll($where, ['fields' => ['id']])->getResult();
        return empty($result) ? [] : $result->toArray();
    }

    /**
     * 插入数据
     * @param $data
     * @return mixed
     */
    private  function saveNewsByData($data)
    {
        $values = [
             [
                'title'  => isset($data['title']) ? trim($data['title']) : '',
                'link'   => isset($data['link']) ? $data['link'] : '',
                'type'   => isset($data['type']) ? $data['type'] : '',
                'add_date' => time(),
             ],
         ];
        return  LiveNews::batchInsert($values)->getResult();
    }

}