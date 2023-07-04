<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
</head>

<body>
    <?= Template::getLogin() ?>
    <?= Template::getHeader("Eliminando: $socio->nombre $socio->apellidos") ?>
    <?= Template::getMenu() ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <h2>Quieres eliminar a <?= "$socio->nombre $socio->apellidos" ?>?</h2>

        <!-- Formulario para eliminacion de Socio -->
        <form class="form" method="POST" action="/Socio/destroy">

            <!-- Input oculto que contiene el ID del socio a eliminar -->
            <input type="hidden" name="id" value="<?= $socio->id ?>">

            <input type="submit" value="Eliminar Socio" class="button" name="borrar" value="Borrar">
        </form>



    </main>

    <?= Template::getFooter() ?>
</body>

</html>