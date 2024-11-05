<?php

use App\Application\Alerts\Alert;
use App\Application\Alerts\Error;
use App\Application\Config\Config;
use App\Application\views\View;

$message = '';
if (Alert::danger()) {
    $message = Alert::danger(true);
}

?>
<html lang="<?= Config::get('app.lang') ?>">
<head>
    <?php View::component('head'); ?>
    <title><?= $title ?></title>
</head>
<body>
<main class="main">
    <?php View::component('nav'); ?>
    <h2>Регистрация</h2>
    <form action="registr" method="post">
        <?php if ($message): ?>
            <div class="alert alert-danger" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control <?= Error::has('email') ? 'is-invalid' : '' ?>"
                   id="email"
                   aria-describedby="emailHelp">
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?= Error::get('email') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" name="name" class="form-control <?= Error::has('name') ? 'is-invalid' : '' ?>" id="name">
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?= Error::get('name') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password"
                   class="form-control <?= Error::has('password') ? 'is-invalid' : '' ?>"
                   id="password">
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?= Error::get('password') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="password_confirm" class="form-label">Подтверждение пароля</label>
            <input type="password" name="password_confirm"
                   class="form-control <?= Error::has('password') ? 'is-invalid' : '' ?>" id="password_confirm">
        </div>
        <div class="mb-3">
            <p>Есть аккаунта? <a href="login">Авторизируйся</a></p>
        </div>
        <button type="submit" class="btn btn-success">Зарегистрироваться</button>
    </form>
</main>
</body>
</html>