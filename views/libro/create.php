<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?= Template::getLogin() ?>
    <?= Template::getHeader('Lista de libros') ?>
    <?= Template::getMenu() ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main>
        <h1><?= APP_NAME ?></h1>
        <h2>Crear Libro</h2>
        <!-- Formulario para creación de libro -->



    </main>

    <?= Template::getFooter() ?>
</body>

</html>