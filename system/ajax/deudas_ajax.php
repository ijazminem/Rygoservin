<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/deudas_model.php');
	require_once('../controllers/deudas_controller.php');

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
		&& isset($_POST['dui'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar la Deuda, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear Modelo
		*/
		$Deudas = new Deudas_Model();

		/**
		 * Insertar datos al modelo y limpiarlo de etiquetas html con la funcion strip_tags
		*/
		$Deudas->set_dui(strip_tags($_POST['dui']));
		$Deudas->set_fecha_registro($FechaActual);
		$Deudas->set_id_usuario($CurrentUser->get_id_usuario());

		/**
		 * Crear Controlador
		*/
		$Deudas_Controller = new Deudas_Controller();

		/**
		 * Insertar deuda y validar si se registro o no
		*/
		if($Deudas_Controller->insert($Deudas)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Deuda agregada con exito.';
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
		&& isset($_POST['id_deuda'])
		&& isset($_POST['dui'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar la Deuda, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Deudas_Controller = new Deudas_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Deuda = $Deudas_Controller->select_by_id(strip_tags($_POST['id_deuda']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Deuda != null){
			/**
			 * Actualizar los valores
			*/
			$Deuda->set_dui(strip_tags($_POST['dui']));			

			/**
			 * Actualizar en la base de datos y validar si se actualizo o no
			*/
			if($Deudas_Controller->update($Deuda)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Deuda actualizada con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Deuda no coincide con ningún registro.';
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
		&& isset($_POST['id_deuda'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar la Deuda, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Deudas_Controller = new Deudas_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Deuda = $Deudas_Controller->select_by_id(strip_tags($_POST['id_deuda']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Deuda != null){
			if($Deudas_Controller->delete($Deuda)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Deuda eliminada con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Deuda no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
?>