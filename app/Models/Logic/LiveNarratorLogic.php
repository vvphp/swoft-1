<?php
/**
 * 解说员表 逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;

use App\Models\Entity\LiveNarratorTable;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;

/**
 *
 * @Bean()
 * @uses      LiveNarratorLogic
 * @version   2018年05月22日
 * @author    zxr <strive965432@gmail.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveNarratorLogic
{
    /**
     * 根据 user_id 查询表中直播员信息
     * @param int $user_id
     * @return mixed
     */
    public function getNarratorById(int $user_id)
    {
        $where = [
            'id' => $user_id
        ];
        $fields = ['id','name','nikename'];
        $result =  LiveNarratorTable::findOne($where, ['fields' => $fields])->getResult();
        if(!empty($result)){
            $result = $result->toArray();
        }
        return $result;
    }

}