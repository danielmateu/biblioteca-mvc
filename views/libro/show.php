<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - edición</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
</head>

<body>
    <?= Template::getLogin() ?>
    <?= Template::getHeader('Edición de libro') ?>
    <?= Template::getMenu() ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main>

        <h2>
            <?= $libro->titulo ?>
        </h2>

        <div>
            <p>
                <strong>Autor:</strong>
                <?= $libro->autor ?>

                <br>

                <strong>Editorial:</strong>

                <?= $libro->editorial ?>

                <br>

                <strong>ISBN:</strong>

                <?= $libro->isbn ?>

                <br>

                <strong>Edad recomendada:</strong>

                <?= " $libro->edadrecomendada años" ?>
            </p>
        </div>

        <div>
            <!-- Botones para volver, editar y borrar -->
            <a class="button" href="/Libro">Volver</a>
            <a class="button" href="/Libro/edit/<?= $libro->id ?>">Editar</a>
            <a class="button" href="/Libro/delete/<?= $libro->id ?>">Borrar</a>
        </div>





    </main>

    <?= Template::getFooter() ?>
</body>

</html>