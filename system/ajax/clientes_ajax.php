<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/clientes_model.php');
	require_once('../controllers/clientes_controller.php');

	/**
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'insert'
        && isset($_POST['dui'])
        && isset($_POST['id_cliente'])
		&& isset($_POST['nombre_completo'])
        && isset($_POST['telefono'])
		&& isset($_POST['estado'])
		&& isset($_POST['id_cartera'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar el Cliente, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		$Clientes_Controller = new Clientes_Controller();

		$Cliente = $Clientes_Controller->select_by_id(strip_tags($_POST['dui']));

		if($Cliente != null){
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'Ya existe un cliente con el mismo número de DUI.';
		}else{
			$Clientes_Model = new Clientes_Model();

	        $Clientes_Model->set_dui(strip_tags($_POST['dui']));
	        $Clientes_Model->set_id_cliente(strip_tags($_POST['id_cliente']));
			$Clientes_Model->set_nombre_completo(strip_tags($_POST['nombre_completo']));
			$Clientes_Model->set_telefono(strip_tags($_POST['telefono']));
			$Clientes_Model->set_estado(strip_tags($_POST['estado']));
			$Clientes_Model->set_fecha_registro($FechaActual);
			$Clientes_Model->set_id_cartera(strip_tags($_POST['id_cartera']));
			
			if($Clientes_Controller->insert($Clientes_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Cliente agregado con éxito.';
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
		&& isset($_POST['dui'])
        && isset($_POST['id_cliente'])
		&& isset($_POST['nombre_completo'])
        && isset($_POST['telefono'])
		&& isset($_POST['estado'])
		&& isset($_POST['id_cartera'])
	){
		
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar el Cliente, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);
		
		$Clientes_Controller = new Clientes_Controller();

		$Clientes_Model = $Clientes_Controller->select_by_id(strip_tags($_POST['dui']));
		
		if($Clientes_Model != null){
			$Clientes_Model->set_dui(strip_tags($_POST['dui']));
        	$Clientes_Model->set_id_cliente(strip_tags($_POST['id_cliente']));
			$Clientes_Model->set_nombre_completo(strip_tags($_POST['nombre_completo']));
			$Clientes_Model->set_telefono(strip_tags($_POST['telefono']));
			$Clientes_Model->set_estado(strip_tags($_POST['estado']));
			$Clientes_Model->set_id_cartera(strip_tags($_POST['id_cartera']));
            
			if($Clientes_Controller->update($Clientes_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Cliente actualizado con éxito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Cliente no coincide con ningún registro.';
		}

		exit(json_encode($arrayRequest));
	}

	/**
	 * delete
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'delete'
		&& isset($_POST['dui'])
	){
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar el Cliente, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);
		
		$Clientes_Controller = new Clientes_Controller();

		$Clientes_Model = $Clientes_Controller->select_by_id(strip_tags($_POST['dui']));
		
		if($Clientes_Model != null){
			if($Clientes_Controller->delete($Clientes_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Cliente eliminado con éxito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Cliente no coincide con ningún registro.';
		}

		exit(json_encode($arrayRequest));
	}
?>