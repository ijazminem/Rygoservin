<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/tipos_usuarios_model.php');
	require_once('../controllers/tipos_usuarios_controller.php');

	/**
	 * Ajax para los datos del tipo de usuario
	*/

	/**
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'insert' 
		&& isset($_POST['nombre_tipo_usuario'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar el Tipo de Usuario, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear Modelo
		*/
		$Tipos_Usuarios_Model = new Tipos_Usuarios_Model();

		/**
		 * Insertar datos al modelo y limpiarlo de etiquetas html con la funcion strip_tags
		*/
		$Tipos_Usuarios_Model->set_nombre_tipo_usuario(strip_tags($_POST['nombre_tipo_usuario']));

		/**
		 * Crear Controlador
		*/
		$Tipos_Usuarios_Controller = new Tipos_Usuarios_Controller();

		/**
		 * Insertar Usuario y validar si se registro o no
		*/
		if($Tipos_Usuarios_Controller->insert($Tipos_Usuarios_Model)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Tipo de Usuario agregado con exito.';
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
		&& isset($_POST['id_tipo_usuario'])
		&& isset($_POST['nombre_tipo_usuario'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar el Tipo de Usuario, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Tipos_Usuarios_Controller = new Tipos_Usuarios_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Tipos_Usuarios_Model = $Tipos_Usuarios_Controller->select_by_id(strip_tags($_POST['id_tipo_usuario']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Tipos_Usuarios_Model != null){
			/**
			 * Actualizar los valores
			*/
			$Tipos_Usuarios_Model->set_nombre_tipo_usuario(strip_tags($_POST['nombre_tipo_usuario']));

			/**
			 * Actualizar en la base de datos y validar si se actualizo o no
			*/
			if($Tipos_Usuarios_Controller->update($Tipos_Usuarios_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Tipo de Usuario actualizado con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Tipo de Usuario no coincide con ningún registro.';
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
		&& isset($_POST['id_tipo_usuario'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar el Tipo de Usuario, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Tipos_Usuarios_Controller = new Tipos_Usuarios_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Tipos_Usuarios_Model = $Tipos_Usuarios_Controller->select_by_id(strip_tags($_POST['id_usuario']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Tipos_Usuarios_Model != null){
			if($Tipos_Usuarios_Controller->delete($Tipos_Usuarios_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Tipo de Usuario eliminado con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Tipo de Usuario no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
?>