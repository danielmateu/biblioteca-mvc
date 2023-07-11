<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Detalle Libro</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Detalles de $libro->titulo") ?>

    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main>





    </main>

    <div class="d-flex justify-content-center gap-2">
        <a class="btn btn-primary" href="/libro">Volver</a>
        <a class="btn btn-secondary" href="/libro/edit/<?= $libro->id ?>">Editar</a>
        <a class="btn btn-danger" href="/libro/delete/<?= $libro->id ?>">Borrar</a>
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>