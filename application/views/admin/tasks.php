<?php
/**
 * @package Chocolife.me
 * @author  Altynbek <akhmedov.a@chocolife.kz>
 */
/**
 * @var $tasks
 * @var $task \application\models\orm\Task
 */
use application\models\orm\Task;
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Задачи</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (empty($tasks)): ?>
                            <p>Список пуст</p>
                        <?php else: ?>
                            <table class="table">
                                <tr>
                                    <th scope="col">Имя пользователя</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Текст задачи</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Редактировать</th>
                                </tr>
                                <?php foreach ($tasks as $task): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($task['name'], ENT_QUOTES); ?></td>
                                        <td><?= htmlspecialchars($task['email'], ENT_QUOTES); ?></td>
                                        <td><?= htmlspecialchars($task['text'], ENT_QUOTES); ?></td>
                                        <td>
                                            <?=$task['status'] == Task::PERFORMED ? 'Выполнено' : 'Не выполнено'; ?>
                                            <br>
                                            <?php if (!is_null($task['modify_id'])): ?>
                                                <span style="font-size: 10px">отредактировано администратором</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><a href="/admin/edit/<?= $task['id']; ?>" class="btn btn-primary">Редактировать</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php if (!empty($tasks) && count($tasks) >= 10):
                                echo $pagination;
                            endif;
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
