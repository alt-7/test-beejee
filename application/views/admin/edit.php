<?php
/**
 * @var $title
 * @var $task \application\models\orm\Task
 */
use application\models\orm\Task;
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?= $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/edit/<?= $task->getId(); ?>" method="post">
                            <div class="form-group">
                                <label>Имя пользователя</label>
                                <input class="form-control" type="text" disabled
                                       value="<?= htmlspecialchars($task->getName(), ENT_QUOTES); ?>" name="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" disabled
                                       value="<?= htmlspecialchars($task->getEmail(), ENT_QUOTES); ?>" name="email">
                            </div>
                            <div class="form-group">
                                <label>Текст задачи</label>
                                <textarea class="form-control" rows="3" name="text"><?= htmlspecialchars($task->getText(), ENT_QUOTES); ?></textarea>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="status" value="1" checked
                                    <?=$task->getStatus() == Task::PERFORMED ? 'checked' : ''?>>Выполнено
                                <input type="radio" name="status" value="0"
                                    <?=$task->getStatus() != Task::PERFORMED ? 'checked' : ''?>>Не выполнено
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Сохранить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
