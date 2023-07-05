<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Detalle Tema</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Tema: $tema->tema") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main>

        <div class="">
            <p>
                <strong>Tema:</strong>
                <?= $tema->tema ?>
                <br>
                <strong>Descripción:</strong>
                <?= "$tema->descripcion" ?>
                <br>
            </p>


        </div>

        <!-- Botones para volver, editar y borrar -->
        <!-- <div>
            <a class="button" href="/Libro">Volver</a>
            <a class="button" href="/Libro/edit/<?= $libro->id ?>">Editar</a>
            <a class="button" href="/Libro/delete/<?= $libro->id ?>">Borrar</a>
        </div> -->

        <!-- Botones para volver, editar y borrar -->
        <div class="d-flex justify-content-center gap-2">
            <a class="btn btn-primary" href="/Tema">Volver</a>
            <a class="btn btn-secondary" href="/Tema/edit/<?= $tema->id ?>">Editar</a>
            <a class="btn btn-danger" href="/Tema/delete/<?= $tema->id ?>">Borrar</a>
        </div>

    </main>

    <?= Template::getAltFooter() ?>
</body>

</html>