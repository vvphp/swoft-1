<?php
namespace App\Models\Entity;

use Swoft\Db\Model;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Types;

/**
 * 球队表

 * @Entity()
 * @Table(name="live_team_table")
 * @uses      LiveTeamTable
 */
class LiveTeamTable extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $teamName 球队名
     * @Column(name="team_name", type="string", length=100, default="")
     */
    private $teamName;

    /**
     * @var string $teamLogo 球队logo
     * @Column(name="team_logo", type="string", length=100, default="")
     */
    private $teamLogo;

    /**
     * @var string $sportsCategory 运动类别
     * @Column(name="sports_category", type="string", length=50, default="")
     */
    private $sportsCategory;

    /**
     * @var int $addDate 添加时间
     * @Column(name="add_date", type="integer", default=0)
     */
    private $addDate;

    /**
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * 球队名
     * @param string $value
     * @return $this
     */
    public function setTeamName(string $value): self
    {
        $this->teamName = $value;

        return $this;
    }

    /**
     * 球队logo
     * @param string $value
     * @return $this
     */
    public function setTeamLogo(string $value): self
    {
        $this->teamLogo = $value;

        return $this;
    }

    /**
     * 运动类别
     * @param string $value
     * @return $this
     */
    public function setSportsCategory(string $value): self
    {
        $this->sportsCategory = $value;

        return $this;
    }

    /**
     * 添加时间
     * @param int $value
     * @return $this
     */
    public function setAddDate(int $value): self
    {
        $this->addDate = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 球队名
     * @return string
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * 球队logo
     * @return string
     */
    public function getTeamLogo()
    {
        return $this->teamLogo;
    }

    /**
     * 运动类别
     * @return string
     */
    public function getSportsCategory()
    {
        return $this->sportsCategory;
    }

    /**
     * 添加时间
     * @return int
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

}
