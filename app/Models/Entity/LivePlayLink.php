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
 * 播放地址链接表

 * @Entity()
 * @Table(name="live_play_link")
 * @uses      LivePlayLink
 */
class LivePlayLink extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $gameId 比赛ID
     * @Column(name="game_id", type="integer", default=0)
     */
    private $gameId;

    /**
     * @var string $playPlatform 播放平台
     * @Column(name="play_platform", type="string", length=50, default="")
     */
    private $playPlatform;

    /**
     * @var string $playUrl 播放地址
     * @Column(name="play_url", type="string", length=100, default="")
     */
    private $playUrl;

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
     * 比赛ID
     * @param int $value
     * @return $this
     */
    public function setGameId(int $value): self
    {
        $this->gameId = $value;

        return $this;
    }

    /**
     * 播放平台
     * @param string $value
     * @return $this
     */
    public function setPlayPlatform(string $value): self
    {
        $this->playPlatform = $value;

        return $this;
    }

    /**
     * 播放地址
     * @param string $value
     * @return $this
     */
    public function setPlayUrl(string $value): self
    {
        $this->playUrl = $value;

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
     * 比赛ID
     * @return int
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * 播放平台
     * @return string
     */
    public function getPlayPlatform()
    {
        return $this->playPlatform;
    }

    /**
     * 播放地址
     * @return string
     */
    public function getPlayUrl()
    {
        return $this->playUrl;
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
