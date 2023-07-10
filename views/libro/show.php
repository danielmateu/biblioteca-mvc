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

        <div class="d-flex justify-content-between">
            <p class="col-6">
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

            <div class="card ">
                <!-- No se encuentra la imagen... -->
                <img src="<?= BOOK_IMAGE_FOLDER . '/' . ($libro->portada ?? DEFAULT_BOOK_IMAGE) ?> " alt="Portada del libro" class="card-img-top" width="100px">
                <!-- No se encuentra la imagen... -->
                <div class="card-body">
                    <p class="card-text">Portada de <?= "$libro->titulo, de $libro->autor" ?> </p>
                </div>
            </div>
        </div>

        <!-- Mostramos los temas -->
        <section>
            <h3>Temas tratados</h3>
            <!-- Si hay temas, mostrarlos -->
            <?php
            if (!empty($temas)) {

                // Mostrar los temas
                foreach ($temas as $tema) {
                    echo "<li> $tema->tema</li>";
                }
            } else {
                // Si no hay temas, mostrar un mensaje
                echo "<p class='alert alert-danger'>No hay temas</p>";
            }

            ?>
        </section>

        <!-- Mostramos los ejemplares-->
        <section>
            <h3>Ejemplares</h3>

            <!-- Si hay ejemplares, mostrarlos -->
            <?php
            if (!empty($ejemplares)) {

                // Mostrar los ejemplares
                foreach ($ejemplares as $ejemplar) {
                    echo "<p><strong>Id</strong>: $ejemplar->id, <strong>Id Libro</strong>: $ejemplar->idlibro - <strong>Año de edición</strong>: $ejemplar->anyo, $ejemplar->estado, $ejemplar->caracteristicas. <strong>Precio</strong>: $ejemplar->precio €</p>";
                }
            } else {
                // Si no hay ejemplares, mostrar un mensaje
                echo "<p class='alert alert-danger'>No hay ejemplares</p>";
            }

            ?>
        </section>

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