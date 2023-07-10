<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Creación Temas</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Crea un tema nuevo") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <!-- Formulario para creación del tema -->

        <form class="form col-6" method="POST" action="/Tema/store">

            <div class="mb-3">
                <label for="tema" class="form-label">Tema</label>
                <input type="text" name="tema" id="tema" class="form-control" placeholder="Introduce el tema" required>
            </div>
            <!-- Descripcion -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">descripcion</label>
                <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Introduce la descripcion" required autocomplete="off" maxlength="1500"></textarea>
            </div>

            <!-- Botón de envío -->
            <input type="submit" value="Crear Tema" class="button" name="Guardar">
        </form>


    </main>
    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/tema">Volver</a>
        <!-- <a class="btn btn-secondary" href="/tema/edit/<?= $tema->id ?>">Editar</a>
        <a class="btn btn-danger" href="/tema/delete/<?= $tema->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>