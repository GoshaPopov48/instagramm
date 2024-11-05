<?php

use App\Application\Auth\Auth;
use App\Application\Config\Config;
use App\Application\views\View;
use App\Models\Post;

$user = Auth::user();
$posts = (new Post())->find('user_id', $user->id(), true);
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
    <h2><?= $pageTitle ?></h2>
    <div class="profile">
        <img src="assets/img/dogs.jpg" class="profile_avatar" alt="Изображение профиля">
        <div class="profile_info">
            <h5 class="profile_info--name"> <?= $user->getName() ?></h5>
            <p class="profile_info--email"> <?= $user->getEmail() ?></p>
            <p class="profile_info--registr">Дата регистрации: <?= $user->createdAt() ?></p>
        </div>
    </div>
    <hr>
    <h5>Опубликовать</h5>
    <form action="post/publish" method="post" enctype="multipart/form-data">
        <div class="mb-3 mt-2">
            <label for="foimageclass=" class="form-labe">Изображение</label>
            <input class="form-control" name="image" type="file" id="image">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Опубликовать</button>
    </form>
    <hr>
    <h5>Мои Публикации</h5>
    <div class="row row-cols-1 row-cols-md-3 mb-2 g-4 mt-1 posts">
        <?php
        foreach ($posts as $post) {

            ?>
            <div class="col">
                <div class="card">
                    <img src="<?= $post->GetImage() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text"><?= $post->getDescription() ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>


    </div>

</main>
</body>
</html>