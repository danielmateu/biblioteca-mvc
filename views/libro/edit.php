<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Edición Libro</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <!-- Use de la funcion shorten para acortar la longitud del titulo -->
    <?= Template::getMenuBootstrap() ?>
    <?=
    Template::getHeaderAlt("Editando: $libro->titulo")
    ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <!-- Formulario para edicion de libro -->

        <form class="form" method="POST" action="/Libro/update">
            <!-- <h2>Creación de Libros</h2> -->

            <!-- Input oculto que contiene el ID del libro a actualizar -->
            <input type="hidden" name="id" value="<?= $libro->id ?>">

            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Introduce el ISBN" value="<?= $libro->isbn ?>" required>
            </div>
            <!-- Titulo -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Introduce el nombre" value="<?= $libro->titulo ?>" required>
            </div>
            <!-- Editorial -->
            <div class="mb-3">
                <label for="editorial" class="form-label">Editorial</label>
                <input type="text" name="editorial" id="editorial" placeholder="Introduce la editorial" class="form-control" value="<?= $libro->editorial ?>" required>
            </div>
            <!-- Autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" name="autor" id="autor" class="form-control" placeholder="Introduce el autor" value="<?= $libro->autor ?>" required>
            </div>
            <!-- Idioma -->
            <div class="mb-3">
                <label for="idioma" class="form-label">Idioma</label>
                <select name="idioma" id="idioma" class="form-select" required>
                    <option value="Castellano">Castellano</option>
                    <option value="Català">Català</option>
                    <option value="Otros">Otros</option>
                </select>
            </div>
            <!-- Ediciones -->
            <div class="mb-3">
                <label for="ediciones" class="form-label">Edición</label>
                <input type="number" name="ediciones" id="ediciones" class="form-control" placeholder="número de edición" value="<?= $libro->ediciones ?>" required>
            </div>

            <!-- Edad recomendada -->
            <div class="mb-3">
                <label for="edad_recomendada" class="form-label">Edad recomendada</label>
                <input type="number" name="edadrecomendada" id="edadrecomendada" class="form-control" min=0 placeholder="Edad recomendada" value="<?= $libro->edadrecomendada ?>" required>
            </div>

            <!-- Portada -->
            <!-- <div class="mb-3">
                <label for="portada" class="form-label">Portada</label>
                <input type="file" name="portada" id="portada" class="form-control">
            </div> -->
            <input type="submit" value="Editar Libro" class="button" name="actualizar" value="Actualizar">
        </form>

        <!-- Mostramos los ejemplares-->
        <div>
            <h3>Ejemplares</h3>

            <!-- Si hay ejemplares, mostrarlos -->
            <?php
            if (!empty($ejemplares)) {

                // Mostrar los ejemplares
                foreach ($ejemplares as $ejemplar) {

                    echo "<li class='d-flex align-items-center  gap-2'>$ejemplar";

                    // Si el ejemplar no tiene prestamos, mostrar el botón de borrar
                    if (!$ejemplar->hasMany('Prestamo')) {
                        echo "<a class='btn btn-outline-danger' href='/Ejemplar/destroy/$ejemplar->id'>Borrar</a>";
                    }

                    echo "</li>";

                    // echo "<p><strong>Id</strong>: $ejemplar->id, <strong>Id Libro</strong>: $ejemplar->idlibro - <strong>Año de edición</strong>: $ejemplar->anyo, $ejemplar->estado, $ejemplar->caracteristicas. <strong>Precio</strong>: $ejemplar->precio €</p>";
                }
            } else {
                // Si no hay ejemplares, mostrar un mensaje
                echo "<p class='alert alert-danger'>No hay ejemplares</p>";
            }

            ?>

            <!-- Boton para crear nuevo ejemplar -->
            <div class="d-flex mb-4">
                <a class="btn btn-outline-success" href="/ejemplar/create/<?= $libro->id ?>">Nuevo Ejemplar</a>
            </div>

        </div>

        <!-- Botón que nos redirija a la lista de libros -->
        <div class="d-flex justify-content-center gap-2">
            <!-- Botones para volver, editar y borrar -->
            <a class="btn btn-primary" href="/libro">Volver</a>
            <!-- <a class="btn btn-secondary" href="/libro/edit/<?= $libro->id ?>">Editar</a> -->
            <a class="btn btn-danger" href="/libro/delete/<?= $libro->id ?>">Borrar</a>
        </div>

    </main>

    <?= Template::getAltFooter() ?>
</body>

</html>