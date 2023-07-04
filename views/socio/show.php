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

        <div class="">
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

                <!-- Imagen socio -->
                <!-- <strong>Imagen:</strong>
                <br> -->
                <!-- <img src="../../public/images/profile.png" alt="Imagen del socio"> -->
            </p>


        </div>

        <div>
            <!-- Botones para volver, editar y borrar -->
            <a class="button" href="/Socio">Volver</a>
            <a class="button" href="/Socio/edit/<?= $socio->id ?>">Editar</a>
            <a class="button" href="/Socio/delete/<?= $socio->id ?>">Borrar</a>
        </div>

    </main>

    <?= Template::getFooter() ?>
</body>

</html>