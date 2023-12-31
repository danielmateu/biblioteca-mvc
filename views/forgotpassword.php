<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>LogIn - <?= APP_NAME ?></title>

	<!-- META -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Nueva clave en <?= APP_NAME ?>">
	<meta name="author" content="Robert Sallent">

	<!-- FAVICON -->
	<link rel="shortcut icon" href="favicon.ico" type="image/png">

	<!-- CSS -->
	<?= (TEMPLATE)::getCss() ?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
	<?= (TEMPLATE)::getMenuBootstrap() ?>
	<?= (TEMPLATE)::getHeaderAlt('Nueva clave') ?>

	<?= (TEMPLATE)::getFlashes() ?>

	<main>
		<section class="flex-container">
			<div class="flex1"> </div>

			<form class="flex2" method="POST" autocomplete="off" id="loginForm" action="/Forgotpassword/send">

				<h2>Recuperación de password</h2>
				<p class="justificado">Introduce tus datos y se te enviará una
					nueva clave con la que podrás acceder a la aplicación.
					Recuerda que debes cambiarla lo antes posible.</p>

				<div style="margin: 10px;">
					<label for="email">email:</label>
					<input type="email" name="email" id="email" required>
					<br>
					<label for="phone">teléfono:</label>
					<input type="text" name="phone" id="phone" required>
				</div>

				<div class="centrado">
					<input type="submit" class="button" name="nueva" value="Nueva clave">
				</div>
			</form>

			<div class="flex1"> </div>
		</section>

	</main>

	<?= Template::getAltFooter() ?>
</body>

</html>