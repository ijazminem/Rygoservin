<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/usuarios_model.php');
	require_once('../controllers/usuarios_controller.php');
	require_once('../controllers/sesion_usuario_controller.php');

	/**
	 * login
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'login'
		&& isset($_POST['email'])
		&& isset($_POST['pass'])
	){
		/**
		 * Datos
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'Datos de inicio de sesión incorrectos.'
		);

		/**
		 * Modelo
		*/
		$Usuarios_Model = new Usuarios_Model();
		$Usuarios_Model->set_correo(strip_tags($_POST['email']));
		$Usuarios_Model->set_contrasena(strip_tags($_POST['pass']));

		/**
		 * Controlador
		*/
		$Usuarios_Controller = new Usuarios_Controller();

		$Usuarios_Model = $Usuarios_Controller->login($Usuarios_Model);

		if($Usuarios_Model == null){
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'Datos de inicio de sesión incorrectos.';
		}else if($Usuarios_Model->get_habilitado() == 'No'){
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'Este usuario aún no está habilitado en el sistema.';
		}else if($Usuarios_Model->get_id_tipo_usuario() > 0){
			/**
			 * Crear Modelo de Inicio de Sesión
			*/
			$CurrentUser = new Sesion_Usuario_Controller();

			$CurrentUser->set_current_user($Usuarios_Model->get_id_usuario());

			$arrayRequest['success'] = true;
			$arrayRequest['message'] = '';
		}

		exit(json_encode($arrayRequest));
	}
?>