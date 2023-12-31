<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
    <script src="/js/Preview.js"></script>
</head>

<body>

    <!-- Use de la funcion shorten para acortar la longitud del titulo -->
    <?= Template::getMenuBootstrap() ?>
    <?=
    Template::getHeaderAlt("Editando: $socio->nombre $socio->apellidos")
    ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <!-- Formulario para edicion de libro -->
        <div class="d-flex align-items-start justify-content-center gap-4">
            <form class="form col-6" method="POST" action="/Socio/update" enctype="multipart/form-data">

                <!-- Input oculto que contiene el ID del socio a actualizar -->
                <input type="hidden" name="id" value="<?= $socio->id ?>">

                <!-- DNI -->
                <div class="mb-3">
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" value="<?= $socio->dni ?>" required id="dni">
                </div>

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="<?= $socio->nombre ?>" required id="nombre">
                </div>

                <!-- Apellidos -->
                <div class="mb-3">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" value="<?= $socio->apellidos ?>" required id="apellidos">
                </div>

                <!-- email -->
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?= $socio->email ?>" required id="email">
                </div>

                <!-- Población -->
                <div class="mb-3">
                    <label for="poblacion">Población</label>
                    <input type="text" name="poblacion" value="<?= $socio->poblacion ?>" required id="poblacion">
                </div>

                <div class="mb-3">
                    <label for="file-with-preview" class="form-label">Foto de perfil</label>
                    <input type="file" name="foto" id="file-with-preview" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <input type="checkbox" name="eliminarperfil" id="eliminarperfil">
                    <label for="eliminarperfil">Eliminar foto de perfil</label>
                </div>

                <input type="submit" value="Editar Socio" class="button" name="actualizar" value="Actualizar">
            </form>

            <div class="card mt-2">
                <img src="<?= SOCIO_IMAGE_FOLDER . '/' . ($socio->foto ?? DEFAULT_SOCIO_IMAGE) ?> " alt="Portada del libro" class="card-img-top p-4" width="100px" id='preview-image'>

            </div>
        </div>

        <!-- Foto Perfil -->

    </main>

    <!-- Botón que nos redirija a la lista de libros -->
    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/socio">Volver</a>
        <!-- <a class="btn btn-secondary" href="/socio/edit/<?= $socio->id ?>">Editar</a> -->
        <a class="btn btn-danger" href="/socio/delete/<?= $socio->id ?>">Borrar Socio</a>
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>