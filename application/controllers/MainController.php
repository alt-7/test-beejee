<?php

namespace application\controllers;

use application\core\Controller;
use application\core\View;
use application\lib\Arr;
use application\models\Admin;
use application\models\Main;
use application\models\orm\Task;
use application\lib\Pagination;

class MainController extends Controller
{

    public function indexAction()
    {
        $sort = isset($_GET['sort']) ? Arr::map($_GET['sort']) : '';
        $countTasks = count(Task::findAll());
        $pagination = new Pagination($this->route, $countTasks, Main::LIMIT, $sort);
        $tasks = Main::getTasks($this->route,$sort);
        if ($countTasks > 0 && $countTasks > Main::LIMIT) {

        }
        $this->view->render('Главная страница', 'frontend/index', [
            'pagination' => $pagination->get(),
            'tasks' => $tasks,
            'countTasks' => $countTasks
        ]);
    }

    public function addAction()
    {
        $model = $this->model->loadModel('main');
        if (!empty($_POST)) {
           $post = Arr::map($_POST);
            try {
                $model->validate($post);
            } catch (\Exception $e) {
                $this->view->message('error', $e->getMessage());
                return;
            }
            Task::add($post);
            $this->view->message('success', 'Задача успешно создана');
        }
        $this->view->render('Добавить страницу задачи', 'frontend/add');
    }
}
