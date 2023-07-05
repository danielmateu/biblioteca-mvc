<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Creación Ejemplar</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <div class="d-flex justify-content-center my-4">

        <h2>Creando ejemplar para <?= $libro->titulo ?></h2>
    </div>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <!-- Formulario para creación de libro -->
        <form class="form col-6" method="POST" action="/Ejemplar/store">

            <input type="hidden" name="idlibro" value="<?= $libro->id ?>">

            <!-- Anyo -->

            <div class="mb-3">
                <label for="anyo" class="form-label">Año</label>
                <input type="text" class="form-control" id="anyo" name="anyo" min=0 placeholder="Año de edicion">
            </div>

            <!-- Edicion -->

            <div class="mb-3">
                <label for="edicion" class="form-label">Edicion</label>
                <input type="text" class="form-control" id="edicion" name="edicion" placeholder="Edicion">
            </div>

            <!-- Precio -->

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" min=0 step="0.01" placeholder="Introduce el precio">
            </div>

            <!-- Estado -->

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado del libro">
            </div>

            <!-- Caracteristicas -->

            <div class="mb-3">
                <label for="caracteristicas" class="form-label">Caracteristicas</label>
                <input type="text" class="form-control" id="caracteristicas" name="caracteristicas" placeholder="Caracteristicas del libro">
                <!-- <select name="" id="">
                    <option value="1">Tapa blanda</option>
                    <option value="2">Tapa dura</option>
                    <option value="3">Tapa blanda con solapas</option>
                    <option value="4">Tapa dura con sobrecubierta</option>
                </select> -->
            </div>



            <input type="submit" value="Crear Ejemplar" class="button" name="Guardar">
        </form>


        <div class="d-flex justify-content-center gap-2">
            <!-- Botones para volver, editar y borrar -->
            <a class="btn btn-primary" href="/libro">Volver</a>
            <!-- <a class="btn btn-secondary" href="/libro/edit/<?= $libro->id ?>">Editar</a>
            <a class="btn btn-danger" href="/libro/delete/<?= $libro->id ?>">Borrar</a> -->
        </div>



    </main>

    <?= Template::getAltFooter() ?>
</body>

</html>