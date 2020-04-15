<?php
/**
 * @package Chocolife.me
 * @author  Altynbek <akhmedov.a@chocolife.kz>
 */
/**
 * @var $task \application\models\orm\Task
 * @var $countTasks
 */
use application\models\orm\Task;
use application\models\Main;
?>

<header class="masthead"></header>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-md-10 mx-auto">
            <div class="text-right">
                <a href="/add" class="btn btn-primary text-right">Добавить</a>
            </div>
            <br/>
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Имя пользователя
                        <a href="#" class="sort" data-sort="name-asc"><i class="fa fa-sort-asc"></i></a>
                        <a href="#" class="sort" data-sort="name-desc"><i class="fa fa-sort-desc"></i></a>
                    </th>
                    <th scope="col">Email
                        <a href="#" class="sort" data-sort="email-asc"><i class="fa fa-sort-asc"></i></a>
                        <a href="#" class="sort" data-sort="email-desc"><i class="fa fa-sort-desc"></i></a>
                    </th>
                    <th scope="col">Текст задачи</th>
                    <th scope="col">Статус
                        <a href="#" class="sort" data-sort="status-asc"><i class="fa fa-sort-asc"></i></a>
                        <a href="#" class="sort" data-sort="status-desc"><i class="fa fa-sort-desc"></i></a>
                    </th>
                </tr>
                </thead>
                <tbody class="tasks-list">
                <?php  if (empty($tasks)): ?>
                    <tr>
                        <td colspan="3">Список пуст</td>
                    </tr>
                <?php else:
                    foreach ($tasks as $task): ?>
                        <tr>
                            <td><?=htmlentities($task->getName(), ENT_QUOTES); ?></td>
                            <td><?= htmlentities($task->getEmail(), ENT_QUOTES); ?></td>
                            <td><?= htmlentities($task->getText(), ENT_QUOTES); ?></td>
                            <td>
                                <?=$task->getStatus() == Task::PERFORMED ? 'Выполнено' : 'Не выполнено' ?>
                            </td>
                        </tr>
                    <?php endforeach;
                endif; ?>
                </tbody>
            </table>
            <div class="clearfix">
                <?php if (!empty($tasks) && $countTasks > 0 && $countTasks > Main::LIMIT):
                    echo $pagination;
                endif; ?>
            </div>
        </div>
    </div>
</div>
