<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Lista Temas</title>
    <?= (TEMPLATE)::getCss() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <?= (TEMPLATE)::getMenuBootstrap() ?>
    <?= (TEMPLATE)::getHeaderAlt('Lista de socios') ?>
    <?= (TEMPLATE)::getSuccess() ?>
    <?= (TEMPLATE)::getError() ?>

    <main>

        <a href="/Tema/create" class="btn btn-outline-primary">Crear Tema</a>

        <table class="table table-dark  table-striped table-hover rounded-3">
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

        <div class="d-flex justify-content-center gap-2">
            <!-- Botones para volver, editar y borrar -->
            <a class="btn btn-primary" href="/tema">Volver</a>
            <!-- <a class="btn btn-secondary" href="/tema/edit/<?= $tema->id ?>">Editar</a> -->
            <!-- <a class="btn btn-danger" href="/tema/delete/<?= $tema->id ?>">Borrar</a> -->
        </div>

    </main>

    <?= Template::getAltFooter() ?>
</body>

</html>