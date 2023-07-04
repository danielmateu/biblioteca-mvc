<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <?= (TEMPLATE)::getCss() ?>
</head>

<body>
    <?= (TEMPLATE)::getLogin() ?>
    <?= (TEMPLATE)::getHeader('Lista de socios') ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getSuccess() ?>
    <?= (TEMPLATE)::getError() ?>

    <main>
        <!-- <h1><?= APP_NAME ?></h1>
        <h2>Lista de socios</h2> -->
        <!-- Tabla que muestra los socios -->

        <table>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($socios as $socio) : ?>
                <tr>
                    <td><?= $socio->dni ?></td>
                    <td><?= $socio->nombre ?></td>
                    <td><?= $socio->apellidos ?></td>
                    <td>
                        <a href="/socio/show/<?= $socio->id ?>">Ver</a>
                        <a href="/socio/edit/<?= $socio->id ?>">Editar</a>
                        <a href="/socio/delete/<?= $socio->id ?>">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </main>

    <?= Template::getFooter() ?>
</body>

</html>