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
 * 后台管理员表

 * @Entity()
 * @Table(name="live_admin_user")
 * @uses      LiveAdminUser
 */
class LiveAdminUser extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $userName 用户名
     * @Column(name="user_name", type="string", length=50)
     * @Required()
     */
    private $userName;

    /**
     * @var string $password 密码
     * @Column(name="password", type="string", length=32, default="0")
     */
    private $password;

    /**
     * @var int $isLive 0:管理员,1:直播员
     * @Column(name="is_live", type="tinyint", default=0)
     */
    private $isLive;

    /**
     * @var int $status 1:正常状态,0:禁用状态,3:正在直播状态
     * @Column(name="status", type="tinyint", default=1)
     */
    private $status;

    /**
     * @var string $name 直播员姓名
     * @Column(name="name", type="string", length=50)
     * @Required()
     */
    private $name;

    /**
     * @var string $nikename 直播员昵称
     * @Column(name="nikename", type="string", length=100)
     * @Required()
     */
    private $nikename;

    /**
     * @var int $addDate 添加时间
     * @Column(name="add_date", type="integer", default=0)
     */
    private $addDate;

    /**
     * @var int $lastLoginDate 最后一次登录时间
     * @Column(name="last_login_date", type="integer", default=0)
     */
    private $lastLoginDate;

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
     * 用户名
     * @param string $value
     * @return $this
     */
    public function setUserName(string $value): self
    {
        $this->userName = $value;

        return $this;
    }

    /**
     * 密码
     * @param string $value
     * @return $this
     */
    public function setPassword(string $value): self
    {
        $this->password = $value;

        return $this;
    }

    /**
     * 0:管理员,1:直播员
     * @param int $value
     * @return $this
     */
    public function setIsLive(int $value): self
    {
        $this->isLive = $value;

        return $this;
    }

    /**
     * 1:正常状态,0:禁用状态,3:正在直播状态
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value): self
    {
        $this->status = $value;

        return $this;
    }

    /**
     * 直播员姓名
     * @param string $value
     * @return $this
     */
    public function setName(string $value): self
    {
        $this->name = $value;

        return $this;
    }

    /**
     * 直播员昵称
     * @param string $value
     * @return $this
     */
    public function setNikename(string $value): self
    {
        $this->nikename = $value;

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
     * 最后一次登录时间
     * @param int $value
     * @return $this
     */
    public function setLastLoginDate(int $value): self
    {
        $this->lastLoginDate = $value;

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
     * 用户名
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * 密码
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * 0:管理员,1:直播员
     * @return int
     */
    public function getIsLive()
    {
        return $this->isLive;
    }

    /**
     * 1:正常状态,0:禁用状态,3:正在直播状态
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 直播员姓名
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 直播员昵称
     * @return string
     */
    public function getNikename()
    {
        return $this->nikename;
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
     * 最后一次登录时间
     * @return int
     */
    public function getLastLoginDate()
    {
        return $this->lastLoginDate;
    }

}
