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

	/**
	 * Ajax para los datos del usuario
	*/

	/**
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'insert' 
		&& isset($_POST['nombre_completo']) 
		&& isset($_POST['correo']) 
		&& isset($_POST['contrasena']) 
		&& isset($_POST['habilitado']) 
		&& isset($_POST['id_tipo_usuario'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar el Usuario, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Verificar si el correo del nuevo usuario existe en la base de datos
		*/
		$Usuarios_Controller = new Usuarios_Controller();

		$Usuarios_Email = $Usuarios_Controller->select_by_correo(strip_tags($_POST['correo']));

		if($Usuarios_Email == null){
			/**
			 * Crear Modelo
			*/
			$Usuarios = new Usuarios_Model();

			/**
			 * Insertar datos al modelo y limpiarlo de etiquetas html con la funcion strip_tags
			*/
			$Usuarios->set_nombre_completo(strip_tags($_POST['nombre_completo']));
			$Usuarios->set_correo(strip_tags($_POST['correo']));
			$Usuarios->set_contrasena(md5(strip_tags($_POST['contrasena'])));
			$Usuarios->set_habilitado(strip_tags($_POST['habilitado']));
			$Usuarios->set_fecha_registro($FechaActual);
			$Usuarios->set_id_tipo_usuario(strip_tags($_POST['id_tipo_usuario']));

			/**
			 * Insertar Usuario y validar si se registro o no
			*/
			if($Usuarios_Controller->insert($Usuarios)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Usuario agregado con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'Éste correo ya esta registrado en el sistema.';
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
		&& isset($_POST['id_usuario'])
		&& isset($_POST['nombre_completo'])
		&& isset($_POST['correo'])
		&& isset($_POST['contrasena'])
		&& isset($_POST['habilitado'])
		&& isset($_POST['id_tipo_usuario'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar el Usuario, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Usuarios_Controller = new Usuarios_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Usuario = $Usuarios_Controller->select_by_id(strip_tags($_POST['id_usuario']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Usuario != null){
			/**
			 * Actualizar los valores
			*/
			$Usuario->set_nombre_completo(strip_tags($_POST['nombre_completo']));
			$Usuario->set_correo(strip_tags($_POST['correo']));

			if(!empty($_POST['contrasena'])){
				$Usuario->set_contrasena(md5(strip_tags($_POST['contrasena'])));
			}

			$Usuario->set_habilitado(strip_tags($_POST['habilitado']));
			$Usuario->set_id_tipo_usuario(strip_tags($_POST['id_tipo_usuario']));

			/**
			 * Actualizar en la base de datos y validar si se actualizo o no
			*/
			if($Usuarios_Controller->update($Usuario)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Usuario actualizado con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Usuario no coincide con ningún registro.';
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
		&& isset($_POST['id_usuario'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar el Usuario, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Usuarios_Controller = new Usuarios_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Usuario = $Usuarios_Controller->select_by_id(strip_tags($_POST['id_usuario']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Usuario != null){
			if($Usuarios_Controller->delete($Usuario)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Usuario eliminado con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Usuario no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
?>