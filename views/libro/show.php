<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Detalle Libro</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Detalles de $libro->titulo") ?>

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

        <!-- Mostramos los ejemplares-->
        <div>
            <h3>Ejemplares</h3>
            <ul>
                <?php foreach ($ejemplares as $ejemplar) : ?>
                    <li>
                        <?= "<strong>Año de edición</strong>: $ejemplar->anyo, " ?>
                        <?= "<strong>Ediciones</strong>: $ejemplar->edicion, " ?>
                        <?= "<strong>Estado</strong>: $ejemplar->estado, " ?>
                        <?= "<strong>Características</strong>: $ejemplar->caracteristicas" ?>
                    </li>
                <?php endforeach ?>
            </ul>

        </div>

        <!-- Botones para volver, editar y borrar -->
        <div class="d-flex justify-content-center gap-2">
            <a class="btn btn-primary" href="/libro">Volver</a>
            <a class="btn btn-secondary" href="/libro/edit/<?= $libro->id ?>">Editar</a>
            <a class="btn btn-danger" href="/libro/delete/<?= $libro->id ?>">Borrar</a>
        </div>


    </main>

    <?= Template::getAltFooter() ?>
</body>

</html>