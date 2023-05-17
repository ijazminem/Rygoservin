<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/bitacoras_model.php');
	require_once('../controllers/bitacoras_controller.php');

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
        && isset($_POST['descripcion'])
        && isset($_POST['id_proceso'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar la Bitácora, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		$Bitacoras_Model = new Bitacoras_Model();

        $Bitacoras_Model->set_descripcion(strip_tags($_POST['descripcion']));
        $Bitacoras_Model->set_fecha_registro($FechaActual);
        $Bitacoras_Model->set_id_usuario($CurrentUser->get_id_usuario());
        $Bitacoras_Model->set_id_proceso(strip_tags($_POST['id_proceso']));

		$Bitacoras_Controller = new Bitacoras_Controller();
		
		if($Bitacoras_Controller->insert($Bitacoras_Model)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Bitácora agregada con éxito.';
		}

		exit(json_encode($arrayRequest));
	}

	/**
	 * update
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'update'
		&& isset($_POST['id_bitacora'])
        && isset($_POST['descripcion'])
        && isset($_POST['id_proceso'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar la Bitácora, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		$Bitacoras_Controller = new Bitacoras_Controller();

		$Bitacoras_Model = $Bitacoras_Controller->select_by_id(strip_tags($_POST['id_bitacora']));

		if($Bitacoras_Model != null){
			$Bitacoras_Model->set_descripcion(strip_tags($_POST['descripcion']));
            $Bitacoras_Model->set_id_proceso(strip_tags($_POST['id_proceso']));
            
			if($Bitacoras_Controller->update($Bitacoras_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Bitácora actualizada con éxito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Bitácora no coincide con ningún registro.';
		}
		
		exit(json_encode($arrayRequest));
	}

	/**
	 * delete
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'delete'
		&& isset($_POST['id_bitacora'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar la Bitácora, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);
		
		$Bitacoras_Controller = new Bitacoras_Controller();

		$Bitacoras_Model = $Bitacoras_Controller->select_by_id(strip_tags($_POST['id_bitacora']));
		
		if($Bitacoras_Model != null){
			if($Bitacoras_Controller->delete($Bitacoras_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Bitácora eliminado con éxito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Bitácora no coincide con ningún registro.';
		}

		exit(json_encode($arrayRequest));
	}
?>