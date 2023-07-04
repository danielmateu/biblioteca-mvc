<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Eliminación Libro</title>
    <link rel="stylesheet" href="/css/style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
</head>

<body>
    <?= Template::getLogin() ?>
    <!-- Use de la funcion shorten para acortar la longitud del titulo -->
    <?=
    $tituloAcortado = shorten($libro->titulo, 15);
    ?>
    <?=
    Template::getHeader("Eliminando: $tituloAcortado")
    ?>
    <?= Template::getMenu() ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <h2>Quieres eliminar <?= $libro->titulo ?>?</h2>

        <!-- Formulario para edicion de libro -->
        <form class="form" method="POST" action="/Libro/destroy">
            <!-- <h2>Creación de Libros</h2> -->

            <!-- Input oculto que contiene el ID del libro a eliminar -->
            <input type="hidden" name="id" value="<?= $libro->id ?>">

            <input type="submit" value="Eliminar Libro" class="button" name="borrar" value="Borrar">
        </form>



    </main>

    <?= Template::getFooter() ?>
</body>

</html>