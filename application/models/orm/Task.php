<?php
/**
 * @package Chocolife.me
 * @author  Altynbek <akhmedov.a@chocolife.kz>
 */
namespace application\models\orm;

class Task extends Base
{
    const PERFORMED     = 1;
    const NOT_PERFORMED = 0;

    public static $table = 'tasks';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var integer
     */
    protected $status;

    /**
     * @var integer
     */
    protected $modify_id;

    /**
     * @var string
     */
    protected $created_at;

    /**
     * @var string
     */
    protected $updated_at;

    protected static function getTableName(): string
    {
        return static::$table;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getModifyId(): int
    {
        return $this->modify_id;
    }

    /**
     * @param int $modify_id
     */
    public function setModifyId(int $modify_id)
    {
        $this->modify_id = $modify_id;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdatedAt(string $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @param $post
     */
    public static function add($post)
    {
        $date = new \DateTime();
        $task = new self();
        $task->setName($post['name']);
        $task->setEmail($post['email']);
        $task->setText($post['text']);
        $task->setStatus(self::NOT_PERFORMED);
        $task->setCreatedAt($date->format('Y-m-d H:i:s'));
        $task->setUpdatedAt($date->format('Y-m-d H:i:s'));
        $task->save();
    }
}
