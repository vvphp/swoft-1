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
 * 比赛 赛程表

 * @Entity()
 * @Table(name="live_game_schedule")
 * @uses      LiveGameSchedule
 */
class LiveGameSchedule extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $matchId 赛会_id
     * @Column(name="match_id", type="smallint", default=0)
     */
    private $matchId;

    /**
     * @var int $liveMemberId 解说员ID
     * @Column(name="live_member_id", type="smallint", default=0)
     */
    private $liveMemberId;

    /**
     * @var string $gameDate 比赛日期
     * @Column(name="game_date", type="string", length=50, default="0")
     */
    private $gameDate;

    /**
     * @var string $dataTime 比赛时间
     * @Column(name="data_time", type="string", length=20, default="0")
     */
    private $dataTime;

    /**
     * @var string $label 标签
     * @Column(name="label", type="string", length=100, default="")
     */
    private $label;

    /**
     * @var int $homeTeamId 主队ID
     * @Column(name="home_team_id", type="integer", default=0)
     */
    private $homeTeamId;

    /**
     * @var int $visitingTeamId 客队ID
     * @Column(name="visiting_team_id", type="integer", default=0)
     */
    private $visitingTeamId;

    /**
     * @var int $homeTeamScore 主队分数
     * @Column(name="home_team_score", type="tinyint", default=0)
     */
    private $homeTeamScore;

    /**
     * @var int $visitingTeamScore 客队分数
     * @Column(name="visiting_team_score", type="tinyint", default=0)
     */
    private $visitingTeamScore;

    /**
     * @var int $victoryDefeat 胜负关系, 1:主队胜,2:客队胜,3:平局,0:无状态
     * @Column(name="victory_defeat", type="tinyint", default=0)
     */
    private $victoryDefeat;

    /**
     * @var int $liveStatus 直播状态: 1:未开始 2:正在直播,3:已结束
     * @Column(name="live_status", type="tinyint", default=1)
     */
    private $liveStatus;

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
     * 赛会_id
     * @param int $value
     * @return $this
     */
    public function setMatchId(int $value): self
    {
        $this->matchId = $value;

        return $this;
    }

    /**
     * 解说员ID
     * @param int $value
     * @return $this
     */
    public function setLiveMemberId(int $value): self
    {
        $this->liveMemberId = $value;

        return $this;
    }

    /**
     * 比赛日期
     * @param string $value
     * @return $this
     */
    public function setGameDate(string $value): self
    {
        $this->gameDate = $value;

        return $this;
    }

    /**
     * 比赛时间
     * @param string $value
     * @return $this
     */
    public function setDataTime(string $value): self
    {
        $this->dataTime = $value;

        return $this;
    }

    /**
     * 标签
     * @param string $value
     * @return $this
     */
    public function setLabel(string $value): self
    {
        $this->label = $value;

        return $this;
    }

    /**
     * 主队ID
     * @param int $value
     * @return $this
     */
    public function setHomeTeamId(int $value): self
    {
        $this->homeTeamId = $value;

        return $this;
    }

    /**
     * 客队ID
     * @param int $value
     * @return $this
     */
    public function setVisitingTeamId(int $value): self
    {
        $this->visitingTeamId = $value;

        return $this;
    }

    /**
     * 主队分数
     * @param int $value
     * @return $this
     */
    public function setHomeTeamScore(int $value): self
    {
        $this->homeTeamScore = $value;

        return $this;
    }

    /**
     * 客队分数
     * @param int $value
     * @return $this
     */
    public function setVisitingTeamScore(int $value): self
    {
        $this->visitingTeamScore = $value;

        return $this;
    }

    /**
     * 胜负关系, 1:主队胜,2:客队胜,3:平局,0:无状态
     * @param int $value
     * @return $this
     */
    public function setVictoryDefeat(int $value): self
    {
        $this->victoryDefeat = $value;

        return $this;
    }

    /**
     * 直播状态: 1:未开始 2:正在直播,3:已结束
     * @param int $value
     * @return $this
     */
    public function setLiveStatus(int $value): self
    {
        $this->liveStatus = $value;

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
     * 赛会_id
     * @return int
     */
    public function getMatchId()
    {
        return $this->matchId;
    }

    /**
     * 解说员ID
     * @return int
     */
    public function getLiveMemberId()
    {
        return $this->liveMemberId;
    }

    /**
     * 比赛日期
     * @return string
     */
    public function getGameDate()
    {
        return $this->gameDate;
    }

    /**
     * 比赛时间
     * @return string
     */
    public function getDataTime()
    {
        return $this->dataTime;
    }

    /**
     * 标签
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * 主队ID
     * @return int
     */
    public function getHomeTeamId()
    {
        return $this->homeTeamId;
    }

    /**
     * 客队ID
     * @return int
     */
    public function getVisitingTeamId()
    {
        return $this->visitingTeamId;
    }

    /**
     * 主队分数
     * @return int
     */
    public function getHomeTeamScore()
    {
        return $this->homeTeamScore;
    }

    /**
     * 客队分数
     * @return int
     */
    public function getVisitingTeamScore()
    {
        return $this->visitingTeamScore;
    }

    /**
     * 胜负关系, 1:主队胜,2:客队胜,3:平局,0:无状态
     * @return int
     */
    public function getVictoryDefeat()
    {
        return $this->victoryDefeat;
    }

    /**
     * 直播状态: 1:未开始 2:正在直播,3:已结束
     * @return mixed
     */
    public function getLiveStatus()
    {
        return $this->liveStatus;
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
