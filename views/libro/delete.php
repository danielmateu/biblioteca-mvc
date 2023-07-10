<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Eliminación Libro</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="/js/Preview.js"></script>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?=
    Template::getHeaderAlt("Eliminando: $libro->titulo")
    ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <h2>Quieres eliminar <?= $libro->titulo ?>?</h2>

        <!-- Formulario para edicion de libro -->
        <div class="card my-4 col-md-6 ">
            <img src="<?= BOOK_IMAGE_FOLDER . '/' . ($libro->portada ?? DEFAULT_BOOK_IMAGE) ?> " alt="Portada del libro" class="card-img-top p-4" width="100px">

        </div>

        <form class="form" method="POST" action="/Libro/destroy">
            <!-- <h2>Creación de Libros</h2> -->

            <!-- Input oculto que contiene el ID del libro a eliminar -->
            <input type="hidden" name="id" value="<?= $libro->id ?>">

            <input type="submit" value="Eliminar Libro" class="btn btn-danger" name="borrar" value="Borrar">
        </form>


    </main>

    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/libro">Volver</a>
        <a class="btn btn-secondary" href="/libro/edit/<?= $libro->id ?>">Editar</a>
        <!-- <a class="btn btn-danger" href="/libro/delete/<?= $libro->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>