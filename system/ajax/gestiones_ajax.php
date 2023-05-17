<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/gestiones_model.php');
	require_once('../controllers/gestiones_controller.php');

	/**
	 * User Login
	*/
	require_once('../models/usuarios_model.php');
	require_once('../controllers/usuarios_controller.php');

	/**
	 * Sesión
	*/
	require_once('../controllers/sesion_usuario_controller.php');

	/**
	 * Verify Sesion
	*/
	require_once('../sessions/session_ajax.php');

	/**
	 * Ajax para los datos del usuario
	*/

	/**
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'insert' 
		&& isset($_POST['descripcion']) 
		&& isset($_POST['id_sub_estado']) 
		&& isset($_POST['dui'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar la Gestión, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear Modelo
		*/
		$Gestiones = new Gestiones_Model();

		/**
		 * Insertar datos al modelo y limpiarlo de etiquetas html con la funcion strip_tags
		*/
		$Gestiones->set_descripcion(strip_tags($_POST['descripcion']));
		$Gestiones->set_fecha_registro($FechaActual);
		$Gestiones->set_id_usuario($CurrentUser->get_id_usuario());
		$Gestiones->set_id_sub_estado(strip_tags($_POST['id_sub_estado']));
		$Gestiones->set_dui(strip_tags($_POST['dui']));

		/**
		 * Crear Controlador
		*/
		$Gestiones_Controller = new Gestiones_Controller();

		/**
		 * Insertar gestion y validar si se registro o no
		*/
		if($Gestiones_Controller->insert($Gestiones)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Gestión agregada con exito.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}

	/**
	 * Update
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'update'
		&& isset($_POST['id_gestion'])
		&& isset($_POST['descripcion'])
		&& isset($_POST['id_sub_estado'])
		&& isset($_POST['dui'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar la Gestión, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Gestiones_Controller = new Gestiones_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Gestion = $Gestiones_Controller->select_by_id(strip_tags($_POST['id_gestion']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Gestion  != null){
			/**
			 * Actualizar los valores
			*/
			$Gestion->set_descripcion(strip_tags($_POST['descripcion']));
			$Gestion->set_id_sub_estado(strip_tags($_POST['id_sub_estado']));
			$Gestion->set_dui(strip_tags($_POST['dui']));

			/**
			 * Actualizar en la base de datos y validar si se actualizo o no
			*/
			if($Gestiones_Controller->update($Gestion)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Gestión actualizada con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Gestión no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}

	/**
	 * delete
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'delete'
		&& isset($_POST['id_gestion'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar la Gestión, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Gestiones_Controller = new Gestiones_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Gestion = $Gestiones_Controller->select_by_id(strip_tags($_POST['id_gestion']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Gestion != null){
			if($Gestiones_Controller->delete($Gestion)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Gestión eliminada con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Gestión no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
?>