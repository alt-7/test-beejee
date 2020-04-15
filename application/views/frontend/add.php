<?php
/**
 * @package Chocolife.me
 * @author  Altynbek <akhmedov.a@chocolife.kz>
 */
?>

<header class="masthead"></header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="/add" method="post" class="addTask">
                <div class="control-group">
                    <div class="form-group controls">
                        <p><input type="text" class="form-control" name="name" placeholder="Имя"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group controls">
                        <p><input type="text" class="form-control" name="email" placeholder="E-mail"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group controls">
                        <p><textarea rows="5" class="form-control" name="text" placeholder="Задача"></textarea></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>
