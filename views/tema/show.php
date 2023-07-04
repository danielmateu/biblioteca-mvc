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
    <?= Template::getHeader("Tema: $tema->tema") ?>
    <?= Template::getMenu() ?>
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

        <div>
            <!-- Botones para volver, editar y borrar -->
            <a class="button" href="/Tema">Volver</a>
            <a class="button" href="/Tema/edit/<?= $tema->id ?>">Editar</a>
            <a class="button" href="/Tema/delete/<?= $tema->id ?>">Borrar</a>
        </div>

    </main>

    <?= Template::getFooter() ?>
</body>

</html>