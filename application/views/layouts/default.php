<?php
use application\models\orm\User;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title; ?></title>
        <link href="/public/styles/bootstrap.css" rel="stylesheet">
        <link href="/public/styles/main.css" rel="stylesheet">
        <link href="/public/styles/font-awesome.css" rel="stylesheet">
        <script src="/public/scripts/jquery.js"></script>
        <script src="/public/scripts/popper.js"></script>
        <script src="/public/scripts/bootstrap.js"></script>
        <script src="/public/scripts/form.js"></script>
        <script src="/public/scripts/sort.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="/">BeeJee</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <?php if (!empty(User::getUser())): ?>
                            <li class="nav-item">
                                <a href="/admin/tasks" class="nav-link"><?= User::getUser()->getLogin() ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/logout">Выйти</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/login">Войти</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </nav>
        <?php echo $content; ?>
        <hr>
    </body>
</html>
