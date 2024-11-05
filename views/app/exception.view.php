<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>About page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 20px;
    }
</style>
<body>
<div class="alert alert-danger" role="alert">
    <?= $message ?>
</div>
<div class="alert alert-secondary" role="alert">
    <pre><?= $trace ?> </pre>
</div>
</body>
</html>
