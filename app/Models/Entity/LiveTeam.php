<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Entity;

use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Model;
use Swoft\Db\Types;

/**
 * 球队实体
 *
 * @Entity()
 * @Table(name="live_team_table")
 * @uses      User
 * @version   2017年08月23日
 * @author    zxr <strive@gmail.com>
 * @copyright Copyright 2010-2016 Swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveTeam extends Model
{
    /**
     * 主键ID
     *
     * @Id()
     * @Column(name="id", type=Types::INT)
     * @var null|int
     */
    private $id;

    /**
     * 球队名
     *
     * @Column(name="team_name", type=Types::STRING, length=100)
     * @Required()
     * @var null|string
     */
    private $team_name = '';

    /**
     * 球队logo
     *
     * @Column(name="team_logo", type=Types::STRING, length=100)
     * @var int
     */
    private  $team_logo = '';

    /**
     * 运动类别
     *
     * @Column(name="sports_category", type=Types::STRING, length=50)
     * @var int
     */
    private $sports_category = '';

    /**
     * 添加时间
     *
     * @Column(name="add_date", type=Types::INT)
     * @var string
     */
    private $add_date = 0;


    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getTeam_name()
    {
        return $this->team_name;
    }

    /**
     * @param null|string $team_name
     */
    public function setTeam_name($team_name)
    {
        $this->team_name = $team_name;
    }

    /**
     * @return null|string
     */
    public function getTeam_logo()
    {
        return $this->team_logo;
    }

    /**
     * @param null|string $team_logo
     */
    public function setTeam_logo($team_logo)
    {
        $this->team_logo = $team_logo;
    }

    /**
     * @return null|string
     */
    public function getSports_category()
    {
        return $this->sports_category;
    }

    /**
     * @param null|string $sports_category
     */
    public function setSports_category($sports_category)
    {
        $this->sports_category = $sports_category;
    }

    /**
     * @return int|null
     */
    public function getAdd_date()
    {
        return $this->add_date;
    }

    /**
     * @param string $add_date
     */
    public function setAdd_date($add_date)
    {
        $this->add_date = $add_date;
    }

}
