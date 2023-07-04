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
    <?= Template::getHeader("Crea un tema nuevo") ?>
    <?= Template::getMenu() ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <!-- Formulario para creación del tema -->

        <form class="form" method="POST" action="/Tema/store">

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

    <?= Template::getFooter() ?>
</body>

</html>