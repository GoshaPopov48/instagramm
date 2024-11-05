<?php

use App\Application\Config\Config;
use App\Application\views\View;
use App\Application\Alerts\Alert;
use App\Application\Alerts\Error;
use App\Application\Auth\Auth;

$message = '';
if (Alert::success()) {
    $message = Alert::success();
}
?>
<!doctype html>
<html lang="<?= Config::get('app.lang') ?>">
<head>
    <?php View::component('head'); ?>
    <title><?= $title ?></title
</head>
<body>
<main class="main">
    <?php View::component('nav'); ?>
    <h2>Вход</h2>
    <form action="login" method="post">

        <?php

        if ($message): ?>
        <div class="alert alert-success" role="alert">
            <?= $message ?>
            <?php endif;

            if ($message): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>

        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control <?= Error::has('email') ? 'is-invalid' : '' ?>"
                   id="email" aria-describedby="emailHelp">
        </div>
        <div id="validationServerUsernameFeedback" class="invalid-feedback">
            <?= Error::get('email') ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password"
                   class="form-control <?= Error::has('password') ? 'is-invalid' : '' ?>" id="password">
        </div>
        <div id="validationServerUsernameFeedback" class="invalid-feedback">
            <?= Error::get('password') ?>
        </div>
        <div class="mb-3">
            <p>Нет аккаунта? <a href="registr">Регистрируйся</a></p>
        </div>
        <button type="submit" class="btn btn-success">Войти</button>
    </form>
</main>
</body>
</html>