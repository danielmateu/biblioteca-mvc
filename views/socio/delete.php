<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Eliminando Socio</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Eliminando: $socio->nombre $socio->apellidos") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <h2>Quieres eliminar a <?= "$socio->nombre $socio->apellidos" ?>?</h2>

        <div class="card my-4 col-md-6 ">
            <img src="<?= SOCIO_IMAGE_FOLDER . '/' . ($socio->foto ?? DEFAULT_SOCIO_IMAGE) ?> " alt="Foto de perfil" class="card-img-top p-4" width="100px">

        </div>

        <!-- Formulario para eliminacion de Socio -->
        <form class="form" method="POST" action="/Socio/destroy">

            <!-- Input oculto que contiene el ID del socio a eliminar -->
            <input type="hidden" name="id" value="<?= $socio->id ?>">

            <input type="submit" value="Eliminar Socio" class="btn btn-danger" name="borrar" value="Borrar">
        </form>

        <div class="d-flex justify-content-center gap-2">
            <!-- Botones para volver, editar y borrar -->
            <a class="btn btn-primary" href="/socio">Volver</a>
            <a class="btn btn-secondary" href="/socio/edit/<?= $socio->id ?>">Editar</a>
            <!-- <a class="btn btn-danger" href="/socio/delete/<?= $socio->id ?>">Borrar</a> -->
        </div>

    </main>

    <?= Template::getAltFooter() ?>
</body>

</html>