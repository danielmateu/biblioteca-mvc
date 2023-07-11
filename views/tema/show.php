<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Detalle Tema</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>
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


    </main>
    <!-- Botones para volver, editar y borrar -->
    <div class="d-flex justify-content-center gap-2">
        <a class="btn btn-primary" href="/Tema">Volver</a>
        <?php if (Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) : ?>
            <a class="btn btn-secondary" href="/Tema/edit/<?= $tema->id ?>">Editar</a>
            <a class="btn btn-danger" href="/Tema/delete/<?= $tema->id ?>">Borrar</a>
        <?php endif; ?>
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>