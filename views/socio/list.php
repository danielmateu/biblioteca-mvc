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
        <table>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($socios as $socio) : ?>
                <tr>
                    <td><?= $socio->dni ?></td>
                    <td><?= $socio->nombre ?></td>
                    <td><?= $socio->apellidos ?></td>
                    <td class="acciones">
                        <a href="/socio/show/<?= $socio->id ?>"><span>🔎</span></a>
                        <a href="/socio/edit/<?= $socio->id ?>"><span>✏️</span></a>
                        <a href="/socio/delete/<?= $socio->id ?>"><span>🗑️</span></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </main>

    <?= Template::getFooter() ?>
</body>

</html>