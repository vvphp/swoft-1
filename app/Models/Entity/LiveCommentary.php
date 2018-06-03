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
 * 比赛解说详情表

 * @Entity()
 * @Table(name="live_commentary")
 * @uses      LiveCommentary
 */
class LiveCommentary extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $gameId 比赛ID，对应赛程表ID
     * @Column(name="game_id", type="integer", default=0)
     */
    private $gameId;

    /**
     * @var string $content 解说详情
     * @Column(name="content", type="string", length=255, default="")
     */
    private $content;

    /**
     * @var int $addDate 添加时间
     * @Column(name="add_date", type="integer", default=0)
     */
    private $addDate;

    /**
     * @var int $timeframe 比赛节点
     * @Column(name="timeframe", type="tinyint", default=0)
     */
    private $timeframe;

    /**
     * @var int $halfTime 上下半场 0:上半场 1:下半场
     * @Column(name="half_time", type="tinyint", default=0)
     */
    private $halfTime;

    /**
     * @var int $teamId 球队ID
     * @Column(name="team_id", type="tinyint", default=0)
     */
    private $teamId;

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
     * 比赛ID，对应赛程表ID
     * @param int $value
     * @return $this
     */
    public function setGameId(int $value): self
    {
        $this->gameId = $value;

        return $this;
    }

    /**
     * 解说详情
     * @param string $value
     * @return $this
     */
    public function setContent(string $value): self
    {
        $this->content = $value;

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
     * 比赛节点
     * @param int $value
     * @return $this
     */
    public function setTimeframe(int $value): self
    {
        $this->timeframe = $value;

        return $this;
    }

    /**
     * 上下半场 0:上半场 1:下半场
     * @param int $value
     * @return $this
     */
    public function setHalfTime(int $value): self
    {
        $this->halfTime = $value;

        return $this;
    }

    /**
     * 球队ID
     * @param int $value
     * @return $this
     */
    public function setTeamId(int $value): self
    {
        $this->teamId = $value;

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
     * 比赛ID，对应赛程表ID
     * @return int
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * 解说详情
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * 添加时间
     * @return int
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * 比赛节点
     * @return int
     */
    public function getTimeframe()
    {
        return $this->timeframe;
    }

    /**
     * 上下半场 0:上半场 1:下半场
     * @return int
     */
    public function getHalfTime()
    {
        return $this->halfTime;
    }

    /**
     * 球队ID
     * @return int
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

}
