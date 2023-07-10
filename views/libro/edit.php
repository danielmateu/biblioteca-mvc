<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Edición Libro</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
    <script src="/js/Preview.js"></script>
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

        <div class="align-items-start justify-content-center gap-4">
            <!-- Formulario para edicion de libro -->

            <form class="form" method="POST" action="/Libro/update" enctype="multipart/form-data">
                <div class="d-flex align-items-start gap-4">

                    <div class="col-6">
                        <!-- Input oculto que contiene el ID del libro a actualizar -->
                        <input type="hidden" name="id" value="<?= $libro->id ?>">
                        <!-- ISBN -->
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
                            <label for="edadrecomendada" class="form-label">Edad recomendada</label>
                            <input type="number" name="edadrecomendada" id="edadrecomendada" class="form-control" min=0 placeholder="Edad recomendada" value="<?= $libro->edadrecomendada ?>" required>
                        </div>
                    </div>

                    <!-- Portada -->
                    <div class="card mt-4">

                        <div class="card ">
                            <!-- No se encuentra la imagen... -->
                            <img src="<?= BOOK_IMAGE_FOLDER . '/' . ($libro->portada ?? DEFAULT_BOOK_IMAGE) ?> " alt="Portada del libro" class="card-img-top" width="100px" id="preview-image">
                            <!-- No se encuentra la imagen... -->
                            <div class="card-body">
                                <p class="card-text">Portada de <?= "$libro->titulo, de $libro->autor" ?> </p>
                            </div>
                        </div>


                        <div class="p-2">
                            <label for="file-with-preview" class="form-label">Portada</label>
                            <input type="file" name="portada" id="file-with-preview" class="form-control" accept="image/*">

                            <input type="checkbox" name="eliminarportada" id="eliminarportada">
                            <label for="eliminarportada">Eliminar portada</label>
                        </div>
                    </div>
                </div>
                <!-- <h2>Creación de Libros</h2> -->
                <input type="submit" value="Editar Libro" class="button" name="actualizar" value="Actualizar">

            </form>

        </div>
        <!-- Mostramos los temas -->
        <section>
            <h3>Temas tratados</h3>
            <!-- Si hay temas, mostrarlos -->
            <?php
            if (!empty($temas)) {

                // Mostrar los temas
                foreach ($temas as $tema) {
                    echo "<li> $tema->tema</li>";
                }
            } else {
                // Si no hay temas, mostrar un mensaje
                echo "<p class='alert alert-danger'>No hay temas</p>";
            }

            ?>

            <form action="/Libro/addtema" method='POST'>
                <input type="hidden" name='idlibro' value="<?= $libro->id ?>">

                <div class="d-flex align-items-center gap-2">
                    <select name="idtema" id="">
                        <?php
                        foreach ($listaTemas as $nuevoTema) {
                            echo "<option value='$nuevoTema->id'>$nuevoTema->tema</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" value="Añadir tema" class="btn btn-outline-secondary" name="add">
                </div>

            </form>

        </section>

        <!-- Mostramos los ejemplares-->
        <section>
            <h3>Ejemplares</h3>

            <!-- Si hay ejemplares, mostrarlos -->
            <?php
            if (!empty($ejemplares)) {

                // Mostrar los ejemplares
                foreach ($ejemplares as $ejemplar) {

                    echo "<li class='d-flex align-items-center list-group-item list-group-item-action list-group-item-secondary justify-content-between p-2 my-1'>$ejemplar->anyo - $ejemplar->estado - $ejemplar->caracteristicas - $ejemplar->precio €";

                    // Si el ejemplar no tiene prestamos, mostrar el botón de borrar

                    if (!$ejemplar->hasMany('Prestamo')) {
                        echo "<a class='btn btn-outline-danger' href='/Ejemplar/destroy/$ejemplar->id'>Borrar ejemplar</a>";
                    }
                    echo "</li>";
                }
            } else {
                // Si no hay ejemplares, mostrar un mensaje
                echo "<p class='alert alert-danger'>No hay ejemplares</p>";
            }

            ?>

            <!-- Boton para crear nuevo ejemplar -->
            <div class="d-flex my-4">
                <a class="btn btn-outline-success" href="/ejemplar/create/<?= $libro->id ?>">Nuevo Ejemplar</a>
            </div>

        </section>

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