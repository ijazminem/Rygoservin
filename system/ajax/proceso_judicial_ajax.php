<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/proceso_judicial_model.php');
	require_once('../controllers/proceso_judicial_controller.php');

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
        && isset($_POST['dui'])
	){		
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar el Proceso Judicial, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		$Proceso_Judicial_Model = new Proceso_Judicial_Model();

        $Proceso_Judicial_Model->set_descripcion(strip_tags($_POST['descripcion']));
        $Proceso_Judicial_Model->set_fecha_registro($FechaActual);
        $Proceso_Judicial_Model->set_id_usuario($CurrentUser->get_id_usuario());
        $Proceso_Judicial_Model->set_dui(strip_tags($_POST['dui']));
		
		$Proceso_Judicial_Controller = new Proceso_Judicial_Controller();

		if($Proceso_Judicial_Controller->insert($Proceso_Judicial_Model)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Proceso Judicial agregado con éxito.';
		}

		exit(json_encode($arrayRequest));
	}

	/**
	 * update
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'update'
		&& isset($_POST['id_proceso'])
        && isset($_POST['descripcion'])
        && isset($_POST['dui'])
	){		
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar el Proceso Judicial, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);
		
		$Proceso_Judicial_Controller = new Proceso_Judicial_Controller();

		$Proceso_Judicial_Model = $Proceso_Judicial_Controller->select_by_id(strip_tags($_POST['id_proceso']));
		
		if($Proceso_Judicial_Model != null){
			$Proceso_Judicial_Model->set_descripcion(strip_tags($_POST['descripcion']));
            $Proceso_Judicial_Model->set_dui(strip_tags($_POST['dui']));

			if($Proceso_Judicial_Controller->update($Proceso_Judicial_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Proceso Judicial actualizada con éxito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Proceso Judicial no coincide con ningún registro.';
		}
		
		exit(json_encode($arrayRequest));
	}

	/**
	 * delete
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'delete'
		&& isset($_POST['id_proceso'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar el Proceso Judicial, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);
		
		$Proceso_Judicial_Controller = new Proceso_Judicial_Controller();

		$Proceso_Judicial_Model = $Proceso_Judicial_Controller->select_by_id(strip_tags($_POST['id_proceso']));
		
		if($Proceso_Judicial_Model != null){
			if($Proceso_Judicial_Controller->delete($Proceso_Judicial_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Proceso Judicial eliminado con éxito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Proceso Juducial no coincide con ningún registro.';
		}

		exit(json_encode($arrayRequest));
	}
?>