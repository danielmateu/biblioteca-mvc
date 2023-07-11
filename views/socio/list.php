<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Lista de socios</title>
    <?= (TEMPLATE)::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= (TEMPLATE)::getMenuBootstrap() ?>
    <?= (TEMPLATE)::getHeaderAlt('Lista de socios') ?>
    <?= (TEMPLATE)::getSuccess() ?>
    <?= (TEMPLATE)::getError() ?>

    <main>

        <a href="/Socio/create" class="btn btn-outline-primary mb-2 ">Crear Socio</a>

        <table class="table table-dark  table-striped table-hover rounded-3">
            <tr>
                <th>Foto</th>
                <th class="d-none d-md-table-cell">DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($socios as $socio) : ?>
                <tr>
                    <td><img src="<?= SOCIO_IMAGE_FOLDER . '/' . ($socio->foto ?? DEFAULT_SOCIO_IMAGE) ?> " alt="Imagen de perfil" class="cover-mini">
                    </td>
                    <td class="d-none d-md-table-cell"><?= $socio->dni ?></td>
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

    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/">Volver</a>
        <!-- <a class="btn btn-secondary" href="/socio/edit/<?= $socio->id ?>">Editar</a> -->
        <!-- <a class="btn btn-danger" href="/socio/delete/<?= $socio->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>