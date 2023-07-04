<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Creación Libro</title>
    <link rel="stylesheet" href="/css/style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
</head>

<body>
    <?= Template::getLogin() ?>
    <?= Template::getHeader("Crea un libro nuevo") ?>
    <?= Template::getMenu() ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <!-- Formulario para creación de libro -->

        <form class="form" method="POST" action="/Libro/store">
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

            <!-- Portada -->
            <!-- <div class="mb-3">
                <label for="portada" class="form-label">Portada</label>
                <input type="file" name="portada" id="portada" class="form-control">
            </div> -->
            <input type="submit" value="Crear Libro" class="button" name="Guardar">
        </form>



    </main>

    <?= Template::getFooter() ?>
</body>

</html>