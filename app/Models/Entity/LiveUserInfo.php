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
 * 用户表

 * @Entity()
 * @Table(name="live_user_info")
 * @uses      LiveUserInfo
 */
class LiveUserInfo extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $phone 手机号
     * @Column(name="phone", type="integer", default=0)
     */
    private $phone;

    /**
     * @var string $password 密码,
     * @Column(name="password", type="char", length=32)
     * @Required()
     */
    private $password;

    /**
     * @var string $nikeName 用户昵称
     * @Column(name="nike_name", type="string", length=50, default="")
     */
    private $nikeName;

    /**
     * @var int $status 状态, 1:正常,0:禁用
     * @Column(name="status", type="tinyint", default=1)
     */
    private $status;

    /**
     * @var int $lastLoginTime 最后一次登录时间
     * @Column(name="last_login_time", type="integer", default=0)
     */
    private $lastLoginTime;

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
     * 手机号
     * @param int $value
     * @return $this
     */
    public function setPhone(int $value): self
    {
        $this->phone = $value;

        return $this;
    }

    /**
     * 密码,
     * @param string $value
     * @return $this
     */
    public function setPassword(string $value): self
    {
        $this->password = $value;

        return $this;
    }

    /**
     * 用户昵称
     * @param string $value
     * @return $this
     */
    public function setNikeName(string $value): self
    {
        $this->nikeName = $value;

        return $this;
    }

    /**
     * 状态, 1:正常,0:禁用
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value): self
    {
        $this->status = $value;

        return $this;
    }

    /**
     * 最后一次登录时间
     * @param int $value
     * @return $this
     */
    public function setLastLoginTime(int $value): self
    {
        $this->lastLoginTime = $value;

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
     * 手机号
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * 密码,
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * 用户昵称
     * @return string
     */
    public function getNikeName()
    {
        return $this->nikeName;
    }

    /**
     * 状态, 1:正常,0:禁用
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 最后一次登录时间
     * @return int
     */
    public function getLastLoginTime()
    {
        return $this->lastLoginTime;
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
