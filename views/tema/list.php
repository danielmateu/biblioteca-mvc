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
                <th>ID</th>
                <th>Tema</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($temas as $tema) : ?>
                <tr>
                    <td><?= $tema->id ?></td>
                    <td><?= $tema->tema ?></td>
                    <td><?= $tema->descripcion ?></td>
                    <td class="acciones">
                        <a href="/tema/show/<?= $tema->id ?>"><span>🔎</span></a>
                        <a href="/tema/edit/<?= $tema->id ?>"><span>✏️</span></a>
                        <a href="/tema/delete/<?= $tema->id ?>"><span>🗑️</span></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </main>

    <?= Template::getFooter() ?>
</body>

</html>