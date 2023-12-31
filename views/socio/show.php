<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Detalle Socio</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>

</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Socio: $socio->nombre $socio->apellidos") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main>

        <div class="d-flex justify-content-between">

            <p class='col-6'>
                <!-- DNI -->
                <strong>DNI:</strong>
                <?= $socio->dni ?>

                <br>
                <!-- Nombre del socio -->
                <strong>Nombre:</strong>
                <?= "$socio->nombre $socio->apellidos" ?>

                <br>
                <!-- Población -->
                <strong>Población:</strong>
                <?= $socio->poblacion ?>
            </p>

            <div class="card p-4">
                <!-- No se encuentra la imagen... -->
                <img src="<?= SOCIO_IMAGE_FOLDER . '/' . ($socio->foto ?? DEFAULT_SOCIO_IMAGE) ?> " alt="Imagen de perfil" class="card-img-top" width="100px">
                <!-- No se encuentra la imagen... -->
                <div class="card-body">
                    <p class="card-text text-center"><?= "$socio->nombre $socio->apellidos" ?></p>
                </div>
            </div>
        </div>

    </main>

    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/socio">Volver</a>
        <a class="btn btn-secondary" href="/socio/edit/<?= $socio->id ?>">Editar</a>
        <a class="btn btn-danger" href="/socio/delete/<?= $socio->id ?>">Borrar</a>
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>