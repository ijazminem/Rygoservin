<?php
	/**
	 * User Login
	*/
	require_once('system/models/usuarios_model.php');
	require_once('system/controllers/usuarios_controller.php');

	/**
	 * Sesión
	*/
	require_once('system/controllers/sesion_usuario_controller.php');

	$Sesion_Usuario_Controller = new Sesion_Usuario_Controller();

	/**
	 * Verificar si existe una sesión activa
	*/
	if(isset($_SESSION['rygo_session'])){
		/**
		 * Si existe crear controlador para setear mi current user
		*/
		$Usuarios_Controller = new Usuarios_Controller();
		$CurrentUser = $Usuarios_Controller->select_by_id($_SESSION['rygo_session']);

		if($CurrentUser != null){
			// Verifica si es administrador
			if($CurrentUser->get_id_tipo_usuario() == 1){
				header('Location: ' . PATH . '/area/admin/');
			}else if($CurrentUser->get_id_tipo_usuario() == 2){// verifica si es empleado
				header('Location: ' . PATH . '/area/empleado/');
			}
		}
	}
?>