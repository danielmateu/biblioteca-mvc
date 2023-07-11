<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Home</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>

    <?= Template::getHeaderAlt('Usuarios') ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>


    <main>

        <section>

            <div class="d-flex align-items-center justify-content-between">

                <?php if (Login::oneRole(['ROLE_ADMIN'])) : ?>
                    <button class="btn btn-secondary mb-3"><a class="list-group-item" href="/User/create">Crear nuevo usuario</a></button>
                <?php endif; ?>
                <div>
                    <?=
                    $paginator->stats()
                    ?>
                </div>
            </div>

            <!-- Si es admin, mostramos botón para crear nuevos usuarios -->

            <!-- Tabla que muestra a todos los users -->

            <table class="table table-dark table-striped table-hover rounded-3">
                <thead>
                    <tr>
                        <th scope="col" class="">Foto</th>
                        <th scope="col" class="">Nombre</th>
                        <th scope="col" class="">Email</th>

                        <th scope="col" class="">Acciones</th>
                    </tr>
                </thead>

                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?> " alt="Portada del usuario" width="100px" class="cover-mini">
                        </td>
                        <td><?= $user->displayname ?></td>
                        <td><?= $user->email ?></td>

                        <td class="">
                            <button class="btn btn-secondary"><a class="list-group-item" href=" /User/show/<?= $user->id ?>">🔎</a></button>
                            <?php if (Login::oneRole(['ROLE_ADMIN'])) : ?>

                                <button class="btn btn-secondary"><a class="list-group-item" href="/User/edit/<?= $user->id ?>">✏️</a></button>
                                <button class="btn btn-secondary"><a class="list-group-item" href="/User/delete/<?= $user->id ?>">🗑️</a></button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <!-- Paginación -->
            <?= $paginator->links() ?>



        </section>


    </main>

    <?= Template::getAltFooter() ?>




</body>

</html>