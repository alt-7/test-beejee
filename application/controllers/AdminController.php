<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;
use application\models\orm\Task;
use application\models\orm\User;
use application\lib\Arr;

class AdminController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }

    public function loginAction()
    {
        $model = $this->model->loadModel('admin');
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('admin/tasks');
        }
        if (!empty($_POST)) {
            $post = Arr::map($_POST);
            try {
                $model->login($post);
            } catch (\Exception $e) {
                $this->view->message('error', $e->getMessage());
                return;
            }
            $_SESSION['admin'] = $post['login'];
            $this->view->location('admin/tasks');
        }
        $this->view->render('Вход', 'admin/login');
    }

    public function tasksAction()
    {
        $listTasks  = Task::findAll();
        $pagination = new Pagination($this->route, count($listTasks));
        $tasks      = Admin::getTasks($this->route);
        $this->view->render('Задачи', 'admin/tasks', [
            'pagination' => $pagination->get(),
            'tasks'      => $tasks,
            ]);
    }

    public function editAction()
    {
        $task = Task::getById($this->route['id']);
        if (!$task) {
            $this->view->errorCode(404);
        }
        if (!empty($_POST['submit'])) {
            $post = Arr::map($_POST);
            if (iconv_strlen(trim($task->getText())) !== iconv_strlen(trim($post['text']))) {
                $userId = User::getUser()->getId();
                $task->setText($post['text']);
                $task->setModifyId($userId);
            }
            $task->setStatus($post['status']);
            $task->save();
            $this->view->redirect('admin/tasks');
        }
        $this->view->render('Редактировать пост', 'admin/edit', [
            'task' => $task,
        ]);
    }

    public function logoutAction()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('admin/login');
    }
}
