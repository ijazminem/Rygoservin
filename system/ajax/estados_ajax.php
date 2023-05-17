<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/estados_model.php');
	require_once('../controllers/estados_controller.php');

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
		&& isset($_POST['habilitado']) 
		&& isset($_POST['id_cartera'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se ha podido agregar el Estado, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear Modelo
		*/
		$Estados = new Estados_Model();

		/**
		 * Insertar datos al modelo y limpiarlo de etiquetas html con la funcion strip_tags
		*/
		$Estados->set_descripcion(strip_tags($_POST['descripcion']));
		$Estados->set_habilitado(strip_tags($_POST['habilitado']));
		$Estados->set_id_cartera(strip_tags($_POST['id_cartera']));

		/**
		 * Crear Controlador
		*/
		$Estados_Controller = new Estados_Controller();

		/**
		 * Insertar estados y validar si se registro o no
		*/
		if($Estados_Controller->insert($Estados)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Estado agregado con exito.';
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
		&& isset($_POST['id_estado'])
		&& isset($_POST['descripcion'])
		&& isset($_POST['habilitado'])
		&& isset($_POST['id_cartera'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se ha podido actualizar el Estado, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Estados_Controller = new Estados_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Estado = $Estados_Controller->select_by_id(strip_tags($_POST['id_estado']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Estado != null){
			/**
			 * Actualizar los valores
			*/
			$Estado->set_descripcion(strip_tags($_POST['descripcion']));
			$Estado->set_habilitado(strip_tags($_POST['habilitado']));
			$Estado->set_id_cartera(strip_tags($_POST['id_cartera']));
			
			/**
			 * Actualizar en la base de datos y validar si se actualizo o no
			*/
			if($Estados_Controller->update($Estado)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Estado actualizado con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Estado no coincide con ningún registro.';
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
		&& isset($_POST['id_estado'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar el Estado, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Estados_Controller = new Estados_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Estado = $Estados_Controller->select_by_id(strip_tags($_POST['id_estado']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Estado != null){
			if($Estados_Controller->delete($Estado)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Estado eliminado con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Estado no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
?>