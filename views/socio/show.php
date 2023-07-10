<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Detalle Socio</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Socio: $socio->nombre $socio->apellidos") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main>

        <div class="d-flex justify-content-between">

            <p>
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

            <div class="">
                <img src="<?= SOCIO_IMAGE_FOLDER . '/' . ($socio->foto ?? DEFAULT_SOCIO_IMAGE) ?> " alt="Imagen de perfil" class="cover-mini">
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