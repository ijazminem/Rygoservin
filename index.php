<?php
	/**
	 * Default
	*/
	require_once('system/settings/settings.php');
	require_once('system/database/conexion.php');

	/**
	 * Session
	*/
	require_once('system/sessions/session.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rivas y Gonzalez</title>
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/main.css">
	<script src="<?php echo PATH; ?>/assets/js/jquery-3.6.4.min.js"></script>
	<script src="<?php echo PATH; ?>/assets/js/sweetalert2.js"></script>
	<script src="<?php echo PATH; ?>/assets/js/functions.js"></script>
	<script src="<?php echo PATH; ?>/assets/js/validaciones/login.js"></script>
</head>
<body>
	<br><br><br><br><br><br>
	<section id="Form">
		<form>
			<h1>RYGOSERVIN</h1>

			<div class="item">
				<input type="email" id="email" name="email" placeholder="Correo electrónico">
			</div>
			
			<div class="item">
				<input type="password" id="pass" name="pass" placeholder="Contraseña">
				<div class="see_pass">
					<i class="fa-regular fa-eye"></i>
					<i class="fa-regular fa-eye-slash fa-eye-dn"></i>
				</div>
			</div>

			<div class="item">
				<input type="button" id="login" name="login" value="Iniciar Sesión">
			</div>
		</form>
	</section>
</body>
</html>