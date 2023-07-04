<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
</head>

<body>
    <?= Template::getLogin() ?>
    <?= Template::getHeader("Socio: $socio->nombre $socio->apellidos") ?>
    <?= Template::getMenu() ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main>

    </main>

    <?= Template::getFooter() ?>
</body>

</html>