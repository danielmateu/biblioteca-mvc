<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Lista de libros</title>
    <?= (TEMPLATE)::getCss() ?>
</head>

<body>
    <?= (TEMPLATE)::getLogin() ?>
    <?= (TEMPLATE)::getHeader('Lista de libros') ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getSuccess() ?>
    <?= (TEMPLATE)::getError() ?>

    <main>
        <!-- <h1><?= APP_NAME ?></h1>
        <h2>Lista de libros</h2> -->
        <!-- Tabla que muestra los libros -->

        <table>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>ISBN</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($libros as $libro) : ?>
                <tr>
                    <td><?= $libro->titulo ?></td>
                    <td><?= $libro->autor ?></td>
                    <td><?= $libro->editorial ?></td>
                    <td><?= $libro->isbn ?></td>
                    <td>
                        <a href="/Libro/show/<?= $libro->id ?>">Ver</a>
                        <a href="/Libro/edit/<?= $libro->id ?>">Editar</a>
                        <a href="/Libro/delete/<?= $libro->id ?>">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </main>

    <?= Template::getFooter() ?>
</body>

</html>