<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/promesas_de_pago_model.php');
	require_once('../controllers/promesas_de_pago_controller.php');

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
	 * Ajax para los datos del usuario
	*/

	/**
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'insert' 
		&& isset($_POST['saldo_total']) 
		&& isset($_POST['descuento']) 
		&& isset($_POST['total_pagar']) 
		&& isset($_POST['numero_cuotas']) 
		&& isset($_POST['valor_cuotas'])
		&& isset($_POST['fecha_pago'])
		&& isset($_POST['dui'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar la Promesa de Pago, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear Modelo
		*/
		$Promesas_De_Pago_Model = new Promesas_De_Pago_Model();

		/**
		 * Insertar datos al modelo y limpiarlo de etiquetas html con la funcion strip_tags
		*/
		$Promesas_De_Pago_Model->set_saldo_total(strip_tags($_POST['saldo_total']));
		$Promesas_De_Pago_Model->set_descuento(strip_tags($_POST['descuento']));
		$Promesas_De_Pago_Model->set_total_pagar(strip_tags($_POST['total_pagar']));
		$Promesas_De_Pago_Model->set_numero_cuotas(strip_tags($_POST['numero_cuotas']));
		$Promesas_De_Pago_Model->set_valor_cuotas(strip_tags($_POST['valor_cuotas']));
		$Promesas_De_Pago_Model->set_fecha_pago(strip_tags($_POST['fecha_pago']));
		$Promesas_De_Pago_Model->set_fecha_emision($FechaActual);
		$Promesas_De_Pago_Model->set_id_usuario($CurrentUser->get_id_usuario());
		$Promesas_De_Pago_Model->set_dui(strip_tags($_POST['dui']));

		/**
		 * Crear Controlador
		*/
		$Promesas_De_Pago_Controller = new Promesas_De_Pago_Controller();

		/**
		 * Insertar Usuario y validar si se registro o no
		*/
		if($Promesas_De_Pago_Controller->insert($Promesas_De_Pago_Model)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Promesa de Pago agregada con exito.';
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
		&& isset($_POST['id_promesa'])
		&& isset($_POST['saldo_total']) 
		&& isset($_POST['descuento']) 
		&& isset($_POST['total_pagar']) 
		&& isset($_POST['numero_cuotas']) 
		&& isset($_POST['valor_cuotas'])
		&& isset($_POST['fecha_pago'])
		&& isset($_POST['dui'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar la Promesa de Pago, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Promesas_De_Pago_Controller = new Promesas_De_Pago_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Promesas_De_Pago_Model = $Promesas_De_Pago_Controller->select_by_id(strip_tags($_POST['id_promesa']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Promesas_De_Pago_Model != null){
			/**
			 * Actualizar los valores
			*/
			$Promesas_De_Pago_Model->set_saldo_total(strip_tags($_POST['saldo_total']));
			$Promesas_De_Pago_Model->set_descuento(strip_tags($_POST['descuento']));
			$Promesas_De_Pago_Model->set_total_pagar(strip_tags($_POST['total_pagar']));
			$Promesas_De_Pago_Model->set_numero_cuotas(strip_tags($_POST['numero_cuotas']));
			$Promesas_De_Pago_Model->set_valor_cuotas(strip_tags($_POST['valor_cuotas']));
			$Promesas_De_Pago_Model->set_fecha_pago(strip_tags($_POST['fecha_pago']));
			$Promesas_De_Pago_Model->set_dui(strip_tags($_POST['dui']));

			/**
			 * Actualizar en la base de datos y validar si se actualizo o no
			*/
			if($Promesas_De_Pago_Controller->update($Promesas_De_Pago_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Promesa de Pago actualizada con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Promesa de Pago no coincide con ningún registro.';
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
		&& isset($_POST['id_promesa'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar la Promesa de Pago, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Promesas_De_Pago_Controller = new Promesas_De_Pago_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Promesas_De_Pago_Model = $Promesas_De_Pago_Controller->select_by_id(strip_tags($_POST['id_promesa']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Promesas_De_Pago_Model != null){
			if($Promesas_De_Pago_Controller->delete($Promesas_De_Pago_Model)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Promesa de Pago eliminada con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Promesa de Pago no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
?>