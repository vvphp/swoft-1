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
 * 评论表

 * @Entity()
 * @Table(name="live_comment")
 * @uses      LiveComment
 */
class LiveComment extends Model
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
     * @var string $userId 用户ID
     * @Column(name="user_id", type="integer", default=0)
     */
    private $userId;

    /**
     * @var string $content 内容
     * @Column(name="content", type="string", length=255, default="")
     */
    private $content;

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
     * 用户Id
     * @param int $value
     * @return $this
     */
    public function setUserId(int $value): self
    {
        $this->userId = $value;

        return $this;
    }

    /**
     * 内容
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
     * 用户ID
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * 内容
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

}
