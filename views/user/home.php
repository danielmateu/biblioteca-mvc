<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Home</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <?= Template::getMenuBootstrap() ?>

    <?= Template::getHeaderAlt('Home') ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>


    <main>
        <h1><?= "Hello $user->displayname! Welcome to your Dashboard" ?></h1>

        <!-- Mostramos foto del usuario -->

        <div class="card col-6">
            <!-- No se encuentra la imagen... -->
            <img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?> " alt="Foto del usuario" class="card-img-top" width="100px">
            <!-- No se encuentra la imagen... -->
            <div class="card-body">
                <!-- MOstramos la info del User -->
                <p class="card-text"><strong>Nombre:</strong> <?= " $user->displayname" ?> </p>
                <p class="card-text"><strong>Email:</strong> <?= " $user->email" ?> </p>
                <p class="card-text"><strong>Teléfono:</strong> <?= " $user->phone" ?> </p>
                <!-- Rol -->

                <!-- Si es admin, mostrar el link a la gestión de usuarios -->
                <?php if (Login::oneRole(['ROLE_ADMIN'])) : ?>
                    <a class="btn btn-secondary" href="/User/list/">Ver usuarios</a>
                <?php endif; ?>

            </div>
        </div>


    </main>

    <?= Template::getAltFooter() ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>