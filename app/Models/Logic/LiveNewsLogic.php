<?php
/**
 * 新闻标题表 逻辑层
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
use App\Models\Dao\LiveNewsDao;

/**
 * 用户逻辑层
 * 同时可以被controller server task使用
 *
 * @Bean()
 * @uses      LiveNewsLogic
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveNewsLogic
{

    /**
     *
     * @Inject()
     * @var LiveNewsDao
     */
    private  $LiveNewsDao;

    /**
     * 根据 title 查询是否存在，如果不存在则插入，如果存在则直接返回true
     * @param $data
     * @return bool|mixed
     */
    public function saveLiveNews($data)
    {
        if(empty($data['title'])){
              return 0;
        }
        return $this->LiveNewsDao->saveLiveNews($data);
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
       return   $this->LiveNewsDao->getNewsList($where,$orderBy,$start,$limit);
    }


    /**
     * 根据类别查询新闻列表
     * @param $type
     * @param int $start
     * @param int $limit
     * @return array
     */
    public function getNewsListByType($type,$start=0,$limit=10)
    {
          $where = ['type' => $type];
          $order = ['id' => 'DESC'];
          return  $this->getNewsList($where,$order,$start,$limit);
    }



}
