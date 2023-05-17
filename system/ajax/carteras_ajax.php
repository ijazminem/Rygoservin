<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/carteras_model.php');
	require_once('../controllers/carteras_controller.php');

	/**
	 * Ajax para los datos de las carteras
	*/

	/**
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'insert' 
		&& isset($_POST['nombre_cartera']) 
		&& isset($_POST['descripcion']) 
		&& isset($_POST['correo_contacto'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar la Cartera, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear Modelo
		*/
		$Carteras = new Carteras_Model();

		/**
		 * Insertar datos al modelo y limpiarlo de etiquetas html con la funcion strip_tags
		*/
		$Carteras->set_nombre_cartera(strip_tags($_POST['nombre_cartera']));
		$Carteras->set_descripcion(strip_tags($_POST['descripcion']));
		$Carteras->set_correo_contacto(strip_tags($_POST['correo_contacto']));

		/**
		 * Crear Controlador
		*/
		$Carteras_Controller = new Carteras_Controller();

		/**
		 * Insertar Cartera y validar si se registro o no
		*/
		if($Carteras_Controller->insert($Carteras)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Cartera agregada con exito.';
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
		&& isset($_POST['id_cartera'])
		&& isset($_POST['nombre_cartera'])
		&& isset($_POST['descripcion'])
		&& isset($_POST['correo_contacto'])	
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar la Cartera, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Carteras_Controller = new Carteras_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Cartera = $Carteras_Controller->select_by_id(strip_tags($_POST['id_cartera']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Cartera != null){
			/**
			 * Actualizar los valores
			*/
			$Cartera->set_nombre_cartera(strip_tags($_POST['nombre_cartera']));
			$Cartera->set_descripcion(strip_tags($_POST['descripcion']));
			$Cartera->set_correo_contacto(strip_tags($_POST['correo_contacto']));

			/**
			 * Actualizar en la base de datos y validar si se actualizo o no
			*/
			if($Carteras_Controller->update($Cartera)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Cartera actualizada con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Cartera no coincide con ningún registro.';
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
		&& isset($_POST['id_cartera'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar la Cartera, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Carteras_Controller = new Carteras_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Cartera = $Carteras_Controller->select_by_id(strip_tags($_POST['id_cartera']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Cartera != null){
			if($Carteras_Controller->delete($Cartera)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Cartera eliminada con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Cartera no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
?>