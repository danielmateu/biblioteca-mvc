<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <!-- Use de la funcion shorten para acortar la longitud del titulo -->
    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Editando: $tema->tema") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <!-- Formulario para edicion de libro -->

        <form class="form" method="POST" action="/Tema/update">

            <!-- Input oculto que contiene el ID del tema a actualizar -->
            <input type="hidden" name="id" value="<?= $tema->id ?>">
            <div class="mb-3">
                <label for="tema">Tema</label>
                <input type="text" name="tema" value="<?= $tema->tema ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion">descripcion</label>
                <input type="text" name="descripcion" value="<?= $tema->descripcion ?>" required>
            </div>

            <input type="submit" value="Editar tema" class="button" name="actualizar" value="Actualizar">
        </form>



        <!-- Botón que nos redirija a la lista de libros -->
        <!-- <div class="d-flex justify-content-center gap-2">
            <a class="btn btn-primary" href="/tema">Volver</a>
            <a class="btn btn-secondary" href="/tema/edit/<?= $tema->id ?>">Editar</a>
            <a class="btn btn-danger" href="/tema/delete/<?= $tema->id ?>">Borrar</a>
        </div> -->

        <div class="d-flex justify-content-center gap-2">
            <!-- Botones para volver, editar y borrar -->
            <a class="btn btn-primary" href="/tema">Volver</a>
            <!-- <a class="btn btn-secondary" href="/tema/edit/<?= $tema->id ?>">Editar</a> -->
            <a class="btn btn-danger" href="/tema/delete/<?= $tema->id ?>">Borrar</a>
        </div>

    </main>

    <?= Template::getAltFooter() ?>
</body>

</html>