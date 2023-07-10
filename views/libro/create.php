<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Creación Libro</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
    <!-- Script para previsualización -->
    <script src="/js/Preview.js"></script>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Crea un libro nuevo") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="d-flex justify-content-between align-items-center gap-4">

        <!-- Formulario para creación de libro -->
        <form class="form col-6" method="POST" action="/Libro/store" enctype="multipart/form-data">
            <!-- <h2>Creación de Libros</h2> -->
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Introduce el ISBN" required>
            </div>
            <!-- Titulo -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Introduce el nombre" required>
            </div>
            <!-- Editorial -->
            <div class="mb-3">
                <label for="editorial" class="form-label">Editorial</label>
                <input type="text" name="editorial" id="editorial" placeholder="Introduce la editorial" class="form-control" required>
            </div>
            <!-- Autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" name="autor" id="autor" class="form-control" placeholder="Introduce el autor" required>
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
                <input type="number" name="ediciones" id="ediciones" class="form-control" required placeholder="número de edición">
            </div>

            <!-- Edad recomendada -->
            <div class="mb-3">
                <label for="edad_recomendada" class="form-label">Edad recomendada</label>
                <input type="number" name="edadrecomendada" id="edadrecomendada" class="form-control" min=0 required placeholder="Edad recomendada">
            </div>

            <!-- Tema Principal -->
            <div class="mb-3">
                <label for="tema_principal" class="form-label">Tema principal</label>
                <select name="idtema" id="">
                    <?php foreach ($listaTemas as $nuevoTema) : ?>
                        <option value="<?= $nuevoTema->id ?>"><?= $nuevoTema->tema ?></option>
                    <?php endforeach; ?>
                </select>

                <p>Puedes añadir más temas desde la opción de edición</p>
            </div>

            <!-- Imagen -->
            <div class="mb-3">
                <label for="portada" class="form-label">Portada</label>
                <input type="file" name="portada" id="file-with-preview" class="form-control" placeholder="Elige la portada" accept="image/*">
            </div>


            <input type="submit" value="Crear Libro" class="button" name="Guardar">
        </form>

        <!-- Prvisualización -->
        <div class="card p-4">
            <h4>Imagen de previsualización</h4>
            <img id="preview-image" src="<?= BOOK_IMAGE_FOLDER . '/' . DEFAULT_BOOK_IMAGE ?>" alt="Imagen de previsualización" class="card-img-top">
        </div>


    </main>
    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/libro">Volver</a>
        <!-- <a class="btn btn-secondary" href="/libro/edit/<?= $libro->id ?>">Editar</a>
        <a class="btn btn-danger" href="/libro/delete/<?= $libro->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>



</body>

</html>