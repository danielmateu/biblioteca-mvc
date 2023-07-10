<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Creación Socio</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="/js/Preview.js"></script>

</head>

<body>
    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Crea un socio nuevo") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="d-flex gap-4 align-items-start">

        <!-- Formulario para creación de libro -->

        <form class="form col-6" method="POST" action="/Socio/store" enctype="multipart/form-data">
            <!-- DNI -->
            <!-- <input type="number" name="id" hidden> -->
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" placeholder="Introduce el DNI" required>
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Introduce el nombre" required>
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" placeholder="Introduce la apellidos" class="form-control" required>
            </div>
            <!-- Población -->
            <div class="mb-3">
                <label for="poblacion" class="form-label">Población</label>
                <input type="text" name="poblacion" id="poblacion" class="form-control" placeholder="Introduce la población" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" placeholder="Introduce el email" class="form-control" required>
            </div>

            <!-- Foto -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto de perfil</label>
                <input type="file" name="foto" id="file-with-preview" class="form-control" accept="image/*">
            </div>
            <!-- Botón de envío -->
            <input type="submit" value="Crear Socio" class="button" name="Guardar">
        </form>

        <!-- Previsualización -->
        <div class="card p-4">
            <h4 class="mb-4">Imagen de previsualización</h4>
            <img id="preview-image" src="<?= SOCIO_IMAGE_FOLDER . '/' . DEFAULT_SOCIO_IMAGE  ?>" alt="Imagen de previsualización" class="card-img-top ">
        </div>
    </main>

    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/socio">Volver</a>
        <!-- <a class="btn btn-secondary" href="/socio/edit/<?= $socio->id ?>">Editar</a>
            <a class="btn btn-danger" href="/socio/delete/<?= $socio->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>