<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/archivos_model.php');
	require_once('../controllers/archivos_controller.php');

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
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'insert' 
		&& isset($_POST['nombre'])
        && isset($_POST['descripcion'])
        && isset($_POST['id_proceso']) 
        && isset($_FILES['archivo'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar el Archivo, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		if($_FILES['archivo']['error'] > 0){
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'No se pudo subir el archivo, inténtelo de nuevo. Si el ereror persiste contacte al desarrollador.';
		}else{
			// comprobar archivo
			$name = $_FILES['archivo']['name'];// example: archivo.txt
			$archivo = explode('.', $name);// example: array(0 => 'archivo', 1 => 'txt');
			$extension = $archivo[sizeof($archivo)-1];// example: $archivo[2-1] => $archivo[1]
			$real_name = '';
			$limit = sizeof($archivo)-2;// $limit = 2-2

			for($i = 0; $i <= $limit; $i++){
				$real_name .= $archivo[$i];
			}

			$j = 0;
			
			$test_name = $real_name;

			do{
				if(file_exists(PATH_IMG . '/' . $test_name.'.'.$extension)){
					$j++;
					$test_name = $real_name . $j;
				}else{
					$real_name = $test_name . '.' . $extension;
					break;
				}
			}while(true);

			// mover el archivo
			$nombreimg = PATH_IMG . '/' . $real_name;

			@move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreimg);

			$Archivos_Model = new Archivos_Model();

			$Archivos_Model->set_nombre(strip_tags($_POST['nombre']));
	        $Archivos_Model->set_descripcion(strip_tags($_POST['descripcion']));
	        $Archivos_Model->set_fecha_registro($FechaActual);
	        $Archivos_Model->set_archivo($real_name);
	        $Archivos_Model->set_id_usuario($CurrentUser->get_id_usuario());
	        $Archivos_Model->set_id_proceso(strip_tags($_POST['id_proceso']));
			
			$Archivos_Controller = new Archivos_Controller();

			if($Archivos_Controller->insert($Archivos_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Archivo agregado con exito.';
			}
		}

		exit(json_encode($arrayRequest));
	}

	/**
	 * update
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'update'
		&& isset($_POST['id_archivo'])
		&& isset($_POST['nombre'])
        && isset($_POST['descripcion'])
        && isset($_POST['id_proceso'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar el Archivo, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		$Archivos_Controller = new Archivos_Controller();

		$Archivos_Model = $Archivos_Controller->select_by_id(strip_tags($_POST['id_archivo']));
		
		if($Archivos_Model != null){
			$Archivos_Model->set_nombre(strip_tags($_POST['nombre']));
            $Archivos_Model->set_descripcion(strip_tags($_POST['descripcion']));
            $Archivos_Model->set_id_proceso(strip_tags($_POST['id_proceso']));

			if($Archivos_Controller->update($Archivos_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Archivo actualizado con éxito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Archivo no coincide con ningún registro.';
		}

		exit(json_encode($arrayRequest));
	}

	/**
	 * delete
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'delete'
		&& isset($_POST['id_archivo'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar el archivo, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);
		
		$Archivos_Controller = new Archivos_Controller();

		$Archivos_Model = $Archivos_Controller->select_by_id(strip_tags($_POST['id_archivo']));
		
		if($Archivos_Model != null){
			if($Archivos_Controller->delete($Archivos_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Archivo eliminado con éxito.';

				// eliminar documento
				if(file_exists(PATH_IMG . '/' . $Archivos_Model->get_archivo())){
					unlink(PATH_IMG . '/' . $Archivos_Model->get_archivo());
				}
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Archivo no coincide con ningún registro.';
		}

		exit(json_encode($arrayRequest));
	}
?>