<?php
/**
 * @package Chocolife.me
 * @author  Altynbek <akhmedov.a@chocolife.kz>
 */

namespace application\models\orm;

class User extends Base
{
    public static $table = 'users';

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
    protected $login;

    /**
     * @var integer
     */
    protected $is_confirmed;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $auth_token;

    /**
     * @var integer
     */
    protected $role_id;

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
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    /**
     * @return int
     */
    public function getisConfirmed(): int
    {
        return $this->is_confirmed;
    }

    /**
     * @param int $is_confirmed
     */
    public function setIsConfirmed(int $is_confirmed)
    {
        $this->is_confirmed = $is_confirmed;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->auth_token;
    }

    /**
     * @param string $auth_token
     */
    public function setAuthToken(string $auth_token)
    {
        $this->auth_token = $auth_token;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     */
    public function setRoleId(int $role_id)
    {
        $this->role_id = $role_id;
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

    public static function getUser()
    {
        if (!empty($_SESSION)) {
            return self::findOneBy(['login' => $_SESSION['admin']]);
        }
    }
}
