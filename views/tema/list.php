<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Lista Temas</title>
    <?= (TEMPLATE)::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= (TEMPLATE)::getMenuBootstrap() ?>
    <?= (TEMPLATE)::getHeaderAlt('Lista de socios') ?>
    <?= (TEMPLATE)::getSuccess() ?>
    <?= (TEMPLATE)::getError() ?>

    <main>
        <?php if (Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) : ?>
            <a href="/Tema/create" class="btn btn-outline-primary mb-2">Crear Tema</a>
        <?php endif; ?>




        <table class="table table-dark  table-striped table-hover rounded-3">
            <tr>
                <th class="d-none d-md-table-cell">ID</th>
                <th>Tema</th>
                <th class="d-none d-md-table-cell">Descripción</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($temas as $tema) : ?>
                <tr>
                    <td class="d-none d-md-table-cell"><?= $tema->id ?></td>
                    <td><?= $tema->tema ?></td>
                    <td class="d-none d-md-table-cell"><?= $tema->descripcion ?></td>
                    <td class="acciones">
                        <a href="/tema/show/<?= $tema->id ?>"><span>🔎</span></a>
                        <?php if (Login::oneRole(['ROLE_LIBRARIAN', 'ROLE_ADMIN'])) : ?>
                            <a class="" href="/Tema/edit/<?= $tema->id ?>">✏️</a>
                            <a class="" href="/Tema/delete/<?= $tema->id ?>">🗑️</a>

                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>


    </main>

    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/tema">Volver</a>
        <!-- <a class="btn btn-secondary" href="/tema/edit/<?= $tema->id ?>">Editar</a> -->
        <!-- <a class="btn btn-danger" href="/tema/delete/<?= $tema->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>