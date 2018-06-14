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
 * @Entity()
 * @Table(name="live_news")
 * @uses      LiveNews
 */
class LiveNews extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $title 新闻标题
     * @Column(name="title", type="string", length=100, default="")
     */
    private $title;

    /**
     * @var string $link 链接地址
     * @Column(name="link", type="string", length=100, default="")
     */
    private $link;

    /**
     * @var int $type 0:文字，1：视频
     * @Column(name="type", type="tinyint", default=0)
     */
    private $type;

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
     * 新闻标题
     * @param string $value
     * @return $this
     */
    public function setTitle(string $value): self
    {
        $this->title = $value;

        return $this;
    }

    /**
     * 链接地址
     * @param string $value
     * @return $this
     */
    public function setLink(string $value): self
    {
        $this->link = $value;

        return $this;
    }

    /**
     * 0:文字，1：视频
     * @param int $value
     * @return $this
     */
    public function setType(int $value): self
    {
        $this->type = $value;

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
     * 新闻标题
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 链接地址
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * 0:文字，1：视频
     * @return int
     */
    public function getType()
    {
        return $this->type;
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
