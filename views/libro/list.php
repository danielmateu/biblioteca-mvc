<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Lista de libros</title>
    <?= (TEMPLATE)::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->

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
        <div class="d-flex align-items-center justify-content-between">

            <?php if (Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) : ?>
                <a href="/Libro/create" class="btn btn-outline-primary mb-2">Crear Libro</a>
            <?php endif; ?>

            <div>
                <?=
                $paginator->stats()
                ?>
            </div>
        </div>

        <!-- Buscador y filtrador de libros -->
        <!-- <form action="/Libro/list" method="get" class="d-flex justify-content-between gap-2 col-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar por título" name="search" value="">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
            </div>

            <div class="input-group mb-3">
                <select class="form-select" name="filter">
                    <option value="all">Todos</option>
                    <option value="titulo">Titulo</option>
                    <option value="autor">Autor</option>
                    <option value="editorial">Editorial</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Filtrar</button>
            </div>
        </form> -->

        <table class="table table-dark table-striped table-hover rounded-3">
            <thead>
                <tr>
                    <th scope="col" class="">Portada</th>
                    <th scope="col" class="">Título</th>
                    <th scope="col" class="d-none d-md-table-cell">Autor</th>
                    <th scope="col" class="d-none d-md-table-cell">Editorial</th>
                    <!-- <th scope="col" class="">ISBN</th> -->
                    <th scope="col" class="">Acciones</th>
                </tr>
            </thead>

            <?php foreach ($libros as $libro) : ?>
                <tr>
                    <td><img src="<?= BOOK_IMAGE_FOLDER . '/' . ($libro->portada ?? DEFAULT_BOOK_IMAGE) ?> " alt="Portada del libro" width="100px" class="cover-mini">
                    </td>
                    <td><?= $libro->titulo ?></td>
                    <td class="d-none d-md-table-cell "><?= $libro->autor ?></td>
                    <td class="d-none d-md-table-cell"><?= $libro->editorial ?></td>
                    <!-- <td><?= $libro->isbn ?></td> -->
                    <td class="">
                        <button class="btn btn-secondary"><a class="list-group-item" href=" /Libro/show/<?= $libro->id ?>">🔎</a></button>
                        <?php if (Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) : ?>
                            <button class="btn btn-secondary"><a class="list-group-item" href="/Libro/delete/<?= $libro->id ?>">🗑️</a></button>
                            <button class="btn btn-secondary"><a class="list-group-item" href="/Libro/edit/<?= $libro->id ?>">✏️</a></button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

        <!-- Paginación -->

        <!--  -->
        <?= $paginator->links() ?>


    </main>
    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-outline-primary" href="/">Volver</a>

    </div>

    <?= Template::getAltFooter() ?>
    <!-- Scrip de JS para bootstrap -->

</body>

</html>