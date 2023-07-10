<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Lista de libros</title>
    <?= (TEMPLATE)::getCss() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?= Template::getMenuBootstrap() ?>
    <?= (TEMPLATE)::getHeaderAlt('Lista de libros') ?>

    <?= (TEMPLATE)::getSuccess() ?>
    <?= (TEMPLATE)::getError() ?>

    <main>
        <!-- <h1><?= APP_NAME ?></h1>
        <h2>Lista de libros</h2> -->
        <!-- Tabla que muestra los libros -->
        <a href="/Libro/create" class="btn btn-outline-primary mb-2">Crear Libro</a>

        <table class="table table-dark table-striped table-hover rounded-3">
            <thead>
                <tr>
                    <th scope="col" class="">Portada</th>
                    <th scope="col" class="">Título</th>
                    <th scope="col" class="">Autor</th>
                    <th scope="col" class="">Editorial</th>
                    <!-- <th scope="col" class="">ISBN</th> -->
                    <th scope="col" class="">Acciones</th>
                </tr>
            </thead>

            <?php foreach ($libros as $libro) : ?>
                <tr>
                    <td><img src="<?= BOOK_IMAGE_FOLDER . '/' . ($libro->portada ?? DEFAULT_BOOK_IMAGE) ?> " alt="Portada del libro" width="100px" class="cover-mini">
                    </td>
                    <td><?= $libro->titulo ?></td>
                    <td><?= $libro->autor ?></td>
                    <td><?= $libro->editorial ?></td>
                    <!-- <td><?= $libro->isbn ?></td> -->
                    <td class="">
                        <a class="" href=" /Libro/show/<?= $libro->id ?>">🔎</a>
                        <a class="" href="/Libro/edit/<?= $libro->id ?>">✏️</a>
                        <a class="" href="/Libro/delete/<?= $libro->id ?>">🗑️</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

        <div class="d-flex justify-content-center gap-2">
            <!-- Botones para volver, editar y borrar -->
            <a class="btn btn-outline-primary" href="/">Volver</a>
            <!-- <a class="btn btn-outline-secondary" href="/libro/edit/<?= $libro->id ?>">Editar</a>
            <a class="btn btn-outline-danger" href="/libro/delete/<?= $libro->id ?>">Borrar</a> -->
        </div>

    </main>

    <?= Template::getAltFooter() ?>
    <!-- Scrip de JS para bootstrap -->

</body>

</html>