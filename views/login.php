<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>LogIn - <?= APP_NAME ?></title>
	<!-- META -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="LogIn en <?= APP_NAME ?>">
	<meta name="author" content="Robert Sallent">

	<!-- FAVICON -->
	<link rel="shortcut icon" href="favicon.ico" type="image/png">

	<!-- CSS -->
	<?= (TEMPLATE)::getCss() ?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

	<?= (TEMPLATE)::getMenuBootstrap() ?>
	<?= (TEMPLATE)::getFlashes() ?>

	<main>
		<section class="d-flex flex-column justify-content-center align-items-center">
			<h2>Acceso a la aplicación</h2>
			<p>Introduce tus datos en el formulario para identificarte.</p>

			<form class="" method="POST" autocomplete="off" action="/Login/enter">
				<div class="mb-3">

					<label for="email">email</label>
					<input type="email" name="user" id="email" required placeholder="Introduce tu email">
				</div>

				<div class="mb-3">
					<label for="password">password</label>
					<input type="password" name="password" id="password" required placeholder="Introduce tu password">
				</div>

				<input type="submit" class="button" name="login" value="LogIn">

				<div class="derecha">
					<a href="/Forgotpassword">Olvidé mi clave</a>
				</div>

			</form>


		</section>

	</main>


	<?= Template::getAltFooter() ?>
</body>

</html>