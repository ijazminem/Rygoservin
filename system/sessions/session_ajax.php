<?php
	$Sesion_Usuario_Controller = new Sesion_Usuario_Controller();
	$CurrentUser = null;

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
			if($CurrentUser->get_id_tipo_usuario() == 1 || $CurrentUser->get_id_tipo_usuario() == 2){
				
			}else{
				header('Location: ' . PATH);
			}
		}
	}else{
		header('Location: ' . PATH);
	}
?>