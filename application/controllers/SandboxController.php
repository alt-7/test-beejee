<?php
/**
 * @package Chocolife.me
 * @author  Altynbek <akhmedov.a@chocolife.kz>
 */

namespace application\controllers;
use application\core\Controller;
use application\models\Admin;
use application\models\orm\User;

class SandboxController extends Controller
{
    public function indexAction()
    {
        $date = new \DateTime();
        $user = new User();
        $user->setName('Admin');
        $user->setEmail('test@test.ru');
        $user->setLogin('admin');
        $user->setIsConfirmed(1);
        $user->setPassword(password_hash('123', PASSWORD_DEFAULT));
        $user->setRoleId(Admin::ADMIN);
        $user->setCreatedAt($date->format('Y-m-d H:i:s'));
        $user->setUpdatedAt($date->format('Y-m-d H:i:s'));

        if (User::findOneBy(['login' => $user->getLogin()])) {
            debug('Пользователь с таким логином уже существует');
        }
        if (User::findOneBy(['email' => $user->getEmail()])) {
            debug('Пользователь с таким email уже существует');
        }
        $user->save();
        debug();
    }
}
