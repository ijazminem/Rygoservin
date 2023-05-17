<?php
	/**
	 * General
	*/
	require_once('../../system/settings/settings.php');
	require_once('../../system/database/conexion.php');

	/**
	 * User Login
	*/
	require_once('../../system/models/usuarios_model.php');
	require_once('../../system/controllers/usuarios_controller.php');

	/**
	 * Sesión
	*/
	require_once('../../system/controllers/sesion_usuario_controller.php');

	/**
	 * Verify Sesion
	*/
	require_once('../../system/sessions/admin_session.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/main.css">
	<script src="<?php echo PATH; ?>/assets/js/jquery-3.6.4.min.js"></script>
	<script src="<?php echo PATH; ?>/assets/js/sweetalert2.js"></script>
	<script src="<?php echo PATH; ?>/assets/js/functions.js"></script>