<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Creación Usuario</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
    <!-- Script para previsualización -->
    <script src="/js/Preview.js"></script>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Crea un usuario nuevo") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="d-flex justify-content-between align-items-center gap-4">

        <!-- Formulario para creación de usuario -->
        <form class="form col-6" method="POST" name="user" action="/user/store" enctype="multipart/form-data">
            <!-- <h2>Creación de Usuario</h2> -->
            <!-- Nombre usuario -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="displayname" id="nombre" class="form-control" placeholder="Nombre del usuario" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email del usuario" required>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Teléfono del usuario" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña del usuario" required>
            </div>

            <!-- Repeat Passsword -->
            <div class="mb-3">
                <label for="repeat-password" class="form-label">Repite la contraseña</label>
                <input type="password" name="repeat-password" id="repeat-password" class="form-control" placeholder="Repite la contraseña del usuario" required>
            </div>

            <!-- Roles -->
            <div class="mb-3">
                <label for="roles" class="form-label">Roles</label>
                <select name="roles" id="roles" class="form-select" required>
                    <option value="ROLE_LIBRARIAN">Bibliotecario</option>
                    <option value="ROLE_ADMIN">Administrador</option>
                </select>
            </div>

            <!-- Imagen -->
            <div class="mb-3">
                <label for="portada" class="form-label">Imagen Usuario</label>
                <input type="file" name="portada" id="file-with-preview" class="form-control" placeholder="Elige la portada" accept="image/*">
            </div>


            <input type="submit" value="Crear usuario" class="button" name="guardar">
        </form>

        <!-- Prvisualización -->
        <div class="card p-4">
            <h4>Imagen de previsualización</h4>
            <img id="preview-image" src="<?= USER_IMAGE_FOLDER . '/' . DEFAULT_USER_IMAGE ?>" alt="Imagen de previsualización" class="card-img-top">
        </div>
    </main>

    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/user">Volver</a>
        <!-- <a class="btn btn-secondary" href="/usuario/edit/<?= $usuario->id ?>">Editar</a>
        <a class="btn btn-danger" href="/usuario/delete/<?= $usuario->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>



</body>

</html>