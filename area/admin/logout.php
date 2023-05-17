<?php
	/**
	 * Generales
	*/
	require_once('../../system/settings/settings.php');

	/**
	 * Controller
	*/
	require_once('../../system/controllers/sesion_usuario_controller.php');

	$Sesion_Usuario_Controller = new Sesion_Usuario_Controller();

	$Sesion_Usuario_Controller->close_session();

	header('Location: ' . PATH);
?>