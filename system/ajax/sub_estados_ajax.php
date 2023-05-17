<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/sub_estados_model.php');
	require_once('../controllers/sub_estados_controller.php');

	/**
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'insert'
        && isset($_POST['descripcion'])
        && isset($_POST['habilitado'])
        && isset($_POST['id_estado'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar el Sub Estado , inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);
		
		$Sub_Estados_Model = new Sub_Estados_Model();

        $Sub_Estados_Model->set_descripcion(strip_tags($_POST['descripcion']));
        $Sub_Estados_Model->set_habilitado(strip_tags($_POST['habilitado']));
        $Sub_Estados_Model->set_id_estado(strip_tags($_POST['id_estado']));
		
		$Sub_Estados_Controller = new Sub_Estados_Controller();
		
		if($Sub_Estados_Controller->insert($Sub_Estados_Model)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Sub Estado agregado con éxito.';
		}

		exit(json_encode($arrayRequest));
	}

	/**
	 * update
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'update'
		&& isset($_POST['id_sub_estado'])
        && isset($_POST['descripcion'])
        && isset($_POST['habilitado'])
        && isset($_POST['id_estado'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar el Sub Estado, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);
		
		$Sub_Estados_Controller = new Sub_Estados_Controller();

		$Sub_Estados_Model = $Sub_Estados_Controller->select_by_id(strip_tags($_POST['id_sub_estado']));
		
		if($Sub_Estados_Model != null){
			$Sub_Estados_Model->set_descripcion(strip_tags($_POST['descripcion']));
            $Sub_Estados_Model->set_habilitado(strip_tags($_POST['habilitado']));
            $Sub_Estados_Model->set_id_estado(strip_tags($_POST['id_estado']));
            
			if($Sub_Estados_Controller->update($Sub_Estados_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Sub Estado actualizado con éxito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Sub Estado no coincide con ningún registro.';
		}

		exit(json_encode($arrayRequest));
	}

	/**
	 * delete
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'delete'
		&& isset($_POST['id_sub_estado'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar el Sub Estado, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);
		
		$Sub_Estados_Controller = new Sub_Estados_Controller();

		$Sub_Estados_Model = $Sub_Estados_Controller->select_by_id(strip_tags($_POST['id_sub_estado']));

		if($Sub_Estados_Model != null){
			if($Sub_Estados_Controller->delete($Sub_Estados_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Sub Estado eliminado con éxito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Sub Estado no coincide con ningún registro.';
		}

		exit(json_encode($arrayRequest));
	}

	/**
	 * select_all_by_id_estado
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'select_all_by_id_estado' 
		&& isset($_POST['id_estado'])
	){
		$generalHTML = '<option value="">-- Seleccione un sub estado --</option>';

		$Sub_Estados_Controller = new Sub_Estados_Controller();

		$arraySubEstados = $Sub_Estados_Controller->select_all_by_id_estado(strip_tags($_POST['id_estado']));

		if(is_array($arraySubEstados) && $arraySubEstados != null){
			for($i = 0; $i < sizeof($arraySubEstados); $i++){
				$generalHTML .= '<option value="' . $arraySubEstados[$i]['id_sub_estado'] . '">' . $arraySubEstados[$i]['descripcion'] . '</option>';
			}
		}

		exit($generalHTML);
	}
?>