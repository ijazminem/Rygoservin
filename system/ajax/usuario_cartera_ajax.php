<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/usuario_cartera_model.php');
	require_once('../controllers/usuario_cartera_controller.php');

	/**
	 * Ajax para los datos del usuario
	*/

	/**
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'insert' 
		&& isset($_POST['id_usuario']) 
		&& isset($_POST['id_cartera']) 
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar el Usuario a ésta Cartera, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear Modelo
		*/
		$Usuario_Cartera = new Usuario_Cartera_Model();

		/**
		 * Insertar datos al modelo y limpiarlo de etiquetas html con la funcion strip_tags
		*/
		$Usuario_Cartera->set_id_usuario(strip_tags($_POST['id_usuario']));
		$Usuario_Cartera->set_id_cartera(strip_tags($_POST['id_cartera']));

		/**
		 * Crear Controlador
		*/
		$Usuario_Cartera_Controller = new Usuario_Cartera_Controller();

		/**
		 * Insertar Cartera y validar si se registro o no
		*/
		if($Usuario_Cartera_Controller->insert($Usuario_Cartera)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Se agregó el Usuario a está Cartera con exito.';
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
		&& isset($_POST['id_usuario_cartera'])
		&& isset($_POST['id_usuario'])
		&& isset($_POST['id_cartera'])
		
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar el Usuario en ésta Cartera, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Usuario_Cartera_Controller = new Usuario_Cartera_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Usuario_Cartera = $Usuario_Cartera_Controller->select_by_id(strip_tags($_POST['id_usuario_cartera']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Usuario_Cartera != null){
			/**
			 * Actualizar los valores
			*/
			$Usuario_Cartera->set_id_usuario(strip_tags($_POST['id_usuario_cartera']));
			$Usuario_Cartera->set_id_cartera(strip_tags($_POST['id_cartera']));
			
			/**
			 * Actualizar en la base de datos y validar si se actualizo o no
			*/
			if($Usuario_Cartera_Controller->update($Usuario_Cartera)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Se actualizó el Usuario en ésta Cartera con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Usuario en ésta Cartera no coincide con ningún registro.';
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
		&& isset($_POST['id_usuario_cartera'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar el Usuario de ésta Cartera, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Usuario_Cartera_Controller = new Usuario_Cartera_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Usuario_Cartera = $Usuario_Cartera_Controller->select_by_id(strip_tags($_POST['id_usuario_cartera']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Usuario_Cartera != null){
			if($Usuario_Cartera_Controller->delete($Usuario_Cartera)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Se elimino el Usuario de ésta Cartera con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Usuario en ésta Cartera no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
?>