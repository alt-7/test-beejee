<?php

namespace application\models;

use application\core\Model;
use application\lib\Db;
use application\models\orm\User;

/**
 * @package application\models
 * @var $user User
 */
class Admin extends Model
{
    const ADMIN = 1;

    public function login($post)
    {
        $user = User::findOneBy(['login' => $post['login'], 'password' => $post['password']], 'OR');
        if (empty($post['login']) || empty($post['password'])) {
            throw new \Exception('Поле не должно быть пустым');
        }
        if (empty($user)) {
            throw new \Exception('Пользователь не найден');
        }
        if ($user->getLogin() != $post['login']) {
            throw new \Exception('Ввели логин неправильно');
        }
        if (!password_verify($post['password'], $user->getPassword())) {
            throw new \Exception('Ввели пароль неправильно');
        }
        if ($user->getRoleId() !== self::ADMIN) {
            throw new \Exception('У вас нет прав администратора');
        }
        return true;
    }

    public static function getTasks(array $route)
    {
        $max   = 10;
        $start = ((($route['page'] ?? 1) - 1) * $max);
        return Db::select('SELECT * FROM tasks ORDER BY id ASC LIMIT '.$max.' OFFSET '.$start);
    }
}
