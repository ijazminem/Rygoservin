jQuery(document).ready(function(){
	/**
	 * expresiones regulares
	*/
	let regexNumber = /^[0-9 ]{1,}$/;
	let regexDui = /^[0-9]{9}$/;

	/**
	 * ----------------------------------------------------
	 * insert
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
	let v_saldo_total = false;
	let v_descuento = false;
	let v_total_pagar = false;
	let v_numero_cuotas = false;
	let v_valor_cuotas = false;
	let v_fecha_pago = false;
	let v_dui = true;

	/**
	 * validación de datos
	*/
	/**
	 * saldo_total
	*/
	jQuery('#saldo_total').keyup(function(){
		let info = comprobar_validaciones('#saldo_total', regexNumber);

		if(info == 'success'){
			v_saldo_total = true;
		}else{
			v_saldo_total = false;
		}

		input_control('#saldo_total', info);
	});

	/**
	 * descuento
	*/
	jQuery('#descuento').keyup(function(){
		let info = comprobar_validaciones('#descuento', regexNumber);

		if(info == 'success'){
			v_descuento = true;
		}else{
			v_descuento = false;
		}

		input_control('#descuento', info);
	});

	/**
	 * total_pagar
	*/
	jQuery('#total_pagar').keyup(function(){
		let info = comprobar_validaciones('#total_pagar', regexNumber);

		if(info == 'success'){
			v_total_pagar = true;
		}else{
			v_total_pagar = false;
		}

		input_control('#total_pagar', info);
	});

	/**
	 * numero_cuotas
	*/
	jQuery('#numero_cuotas').keyup(function(){
		let info = comprobar_validaciones('#numero_cuotas', regexNumber);

		if(info == 'success'){
			v_numero_cuotas = true;
		}else{
			v_numero_cuotas = false;
		}

		input_control('#numero_cuotas', info);
	});

	/**
	 * valor_cuotas
	*/
	jQuery('#valor_cuotas').keyup(function(){
		let info = comprobar_validaciones('#valor_cuotas', regexNumber);

		if(info == 'success'){
			v_valor_cuotas = true;
		}else{
			v_valor_cuotas = false;
		}

		input_control('#valor_cuotas', info);
	});

	/**
	 * fecha_pago
	*/
	jQuery('#fecha_pago').change(function(){
		let info = comprobar_validaciones('#fecha_pago');

		if(info == 'success'){
			v_fecha_pago = true;
		}else{
			v_fecha_pago = false;
		}

		input_control('#fecha_pago', info);
	});

	/**
	 * dui
	*/
	jQuery('#dui').keyup(function(){
		let info = comprobar_validaciones('#dui', regexDui);

		if(info == 'success'){
			v_dui = true;
		}else{
			v_dui = false;
			input_control('#dui', info);
		}
	});

	/**
	 * boton
	*/
	jQuery('#btn_agregar_promesa_de_pago').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!v_saldo_total){
			input_control('#saldo_total', 'error');
			message += '<b>Saldo Total:</b> Debe agregar un saldo total válido.<br>';
		}

		if(!v_descuento){
			input_control('#descuento', 'error');
			message += '<b>Descuento:</b> Debe agregar un descuento válido.<br>';
		}

		if(!v_total_pagar){
			input_control('#total_pagar', 'error');
			message += '<b>Total a Pagar:</b> Debe agregar un total válido.<br>';
		}

		if(!v_numero_cuotas){
			input_control('#numero_cuotas', 'error');
			message += '<b>Número de Cuotas:</b> Debe agregar un número de cuotas válido.<br>';
		}

		if(!v_valor_cuotas){
			input_control('#valor_cuotas', 'error');
			message += '<b>Valor de las Cuotas:</b> Debe agregar un valor de cuotas válido.<br>';
		}

		if(!v_fecha_pago){
			input_control('#fecha_pago', 'error');
			message += '<b>Fecha de Pago:</b> Debe agregar una fecha de pago válida.<br>';
		}

		if(!v_dui){
			input_control('#dui', 'error');
			message += '<b>DUI:</b> Debe agregar un número de DUI válido.<br>';
		}

		/**
		 * Si hay errores mostrarlos, sino realizar la petición ajax
		*/
		if(message != ''){
			Swal.fire({
				icon: 'warning',
				title: 'Validaciones',
				html: message,
				confirmButtonText: 'Aceptar',
				confirmButtonColor: '#2BC521'
			});
		}else{
			/**
			 * Deshabilitar botón
			*/
			button_control('#btn_agregar_promesa_de_pago', 'desactivar', 'Agregando Promesa...');

			/**
			 * Recuperación de datos
			*/
			let saldo_total   = jQuery('#saldo_total').val();
			let descuento     = jQuery('#descuento').val();
			let total_pagar   = jQuery('#total_pagar').val();
			let numero_cuotas = jQuery('#numero_cuotas').val();
			let valor_cuotas  = jQuery('#valor_cuotas').val();
			let fecha_pago    = jQuery('#fecha_pago').val();
			let dui           = jQuery('#dui').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/promesas_de_pago_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
					saldo_total: saldo_total,
					descuento: descuento,
					total_pagar: total_pagar,
					numero_cuotas: numero_cuotas,
					valor_cuotas: valor_cuotas,
					fecha_pago: fecha_pago,
					dui: dui
				},
				success: function(data){
					try{
						if(data['success']){
							// limpiar campos
							jQuery('#saldo_total').val('');
							jQuery('#descuento').val('');
							jQuery('#total_pagar').val('');
							jQuery('#numero_cuotas').val('');
							jQuery('#valor_cuotas').val('');
							jQuery('#fecha_pago').val('');
							
							// Establecer borde por defecto
							input_control('#saldo_total', 'empty');
							input_control('#descuento', 'empty');
							input_control('#total_pagar', 'empty');
							input_control('#numero_cuotas', 'empty');
							input_control('#valor_cuotas', 'empty');
							input_control('#fecha_pago', 'empty');
							input_control('#dui', 'empty');

							// resetear variables
							v_saldo_total = false;
							v_descuento = false;
							v_total_pagar = false;
							v_numero_cuotas = false;
							v_valor_cuotas = false;
							v_fecha_pago = false;

							Swal.fire({
								icon: 'success',
								title: 'Promesa de Pago Creada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Crear Promesa de Pago',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}
					}catch(e){
						Swal.fire({
							icon: 'error',
							title: 'Error Del Servidor',
							text: e,
							confirmButtonText: 'Aceptar',
							confirmButtonColor: '#2BC521'
						});
					}

					button_control('#btn_agregar_promesa_de_pago', 'activar', 'Agregar Promesa');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_promesa_de_pago', 'activar', 'Agregar Promesa');
				}
			});
		}
	});

	/**
	 * ----------------------------------------------------
	 * update
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
	let vu_id_promesa = true;
	let vu_saldo_total = true;
	let vu_descuento = true;
	let vu_total_pagar = true;
	let vu_numero_cuotas = true;
	let vu_valor_cuotas = true;
	let vu_fecha_pago = true;
	let vu_dui = true;

	/**
	 * id_promesa
	*/
	jQuery('#id_promesa_u').keyup(function(){
		let info = comprobar_validaciones('#id_promesa_u');

		if(info == 'success'){
			vu_id_promesa = true;
		}else{
			vu_id_promesa = false;
		}
	});

	/**
	 * saldo_total
	*/
	jQuery('#saldo_total_u').keyup(function(){
		let info = comprobar_validaciones('#saldo_total_u', regexNumber);

		if(info == 'success'){
			vu_saldo_total = true;
		}else{
			vu_saldo_total = false;
		}

		input_control('#saldo_total_u', info);
	});

	/**
	 * descuento
	*/
	jQuery('#descuento_u').keyup(function(){
		let info = comprobar_validaciones('#descuento_u', regexNumber);

		if(info == 'success'){
			vu_descuento = true;
		}else{
			vu_descuento = false;
		}

		input_control('#descuento_u', info);
	});

	/**
	 * total_pagar
	*/
	jQuery('#total_pagar_u').keyup(function(){
		let info = comprobar_validaciones('#total_pagar_u', regexNumber);

		if(info == 'success'){
			vu_total_pagar = true;
		}else{
			vu_total_pagar = false;
		}

		input_control('#total_pagar_u', info);
	});

	/**
	 * numero_cuotas
	*/
	jQuery('#numero_cuotas_u').keyup(function(){
		let info = comprobar_validaciones('#numero_cuotas_u', regexNumber);

		if(info == 'success'){
			vu_numero_cuotas = true;
		}else{
			vu_numero_cuotas = false;
		}

		input_control('#numero_cuotas_u', info);
	});

	/**
	 * valor_cuotas
	*/
	jQuery('#valor_cuotas_u').keyup(function(){
		let info = comprobar_validaciones('#valor_cuotas_u', regexNumber);

		if(info == 'success'){
			vu_valor_cuotas = true;
		}else{
			vu_valor_cuotas = false;
		}

		input_control('#valor_cuotas_u', info);
	});

	/**
	 * fecha_pago
	*/
	jQuery('#fecha_pago_u').keyup(function(){
		let info = comprobar_validaciones('#fecha_pago_u');

		if(info == 'success'){
			vu_fecha_pago = true;
		}else{
			vu_fecha_pago = false;
		}

		input_control('#fecha_pago_u', info);
	});

	/**
	 * dui
	*/
	jQuery('#dui_u').keyup(function(){
		let info = comprobar_validaciones('#dui_u', regexDui);

		if(info == 'success'){
			vu_dui = true;
		}else{
			vu_dui = false;
			input_control('#dui_u', info);
		}
	});

	/**
	 * boton
	*/
	jQuery('#btn_actualizar_promesa_de_pago').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_id_promesa){
			message += '<b>Id Promesa:</b> El Id de la promesa no es válida, recarga esta página para volver a cargarlo.<br>';
		}

		if(!vu_saldo_total){
			input_control('#saldo_total_u', 'error');
			message += '<b>Saldo Total:</b> Debe agregar un saldo total válido.<br>';
		}

		if(!vu_descuento){
			input_control('#descuento_u', 'error');
			message += '<b>Descuento:</b> Debe agregar un descuento válido.<br>';
		}

		if(!vu_total_pagar){
			input_control('#total_pagar_u', 'error');
			message += '<b>Total a Pagar:</b> Debe agregar un total a pagar válido.<br>';
		}

		if(!vu_numero_cuotas){
			input_control('#numero_cuotas_u', 'error');
			message += '<b>Número de Cuotas:</b> Debe agregar un número de cuotas válido.<br>';
		}

		if(!vu_valor_cuotas){
			input_control('#valor_cuotas_u', 'error');
			message += '<b>Valor de las Cuotas:</b> Debe agregar un valor de cuotas válido.<br>';
		}

		if(!vu_fecha_pago){
			input_control('#fecha_pago_u', 'error');
			message += '<b>Fecha de Pago:</b> Debe agregar una fecha de pago válida.<br>';
		}

		if(!vu_dui){
			input_control('#dui_u', 'error');
			message += '<b>DUI:</b> Debe agregar un número de DUI válido.<br>';
		}

		/**
		 * Si hay errores mostrarlos, sino realizar el ajax
		*/
		if(message != ''){
			Swal.fire({
				icon: 'warning',
				title: 'Validaciones',
				html: message,
				confirmButtonText: 'Aceptar',
				confirmButtonColor: '#2BC521'
			});
		}else{
			/**
			 * Deshabilitar botón
			*/
			button_control('#btn_actualizar_promesa_de_pago', 'desactivar', 'Actualizando Promesa...');

			/**
			 * Recuperación de datos
			*/
			let id_promesa    = jQuery('#id_promesa_u').val();
			let saldo_total   = jQuery('#saldo_total_u').val();
			let descuento     = jQuery('#descuento_u').val();
			let total_pagar   = jQuery('#total_pagar_u').val();
			let numero_cuotas = jQuery('#numero_cuotas_u').val();
			let valor_cuotas  = jQuery('#valor_cuotas_u').val();
			let fecha_pago    = jQuery('#fecha_pago_u').val();
			let dui           = jQuery('#dui_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/promesas_de_pago_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_promesa: id_promesa,
					saldo_total: saldo_total,
					descuento: descuento,
					total_pagar: total_pagar,
					numero_cuotas: numero_cuotas,
					valor_cuotas: valor_cuotas,
					fecha_pago: fecha_pago,
					dui: dui
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#id_promesa_u', 'empty');
							input_control('#saldo_total_u', 'empty');
							input_control('#descuento_u', 'empty');
							input_control('#total_pagar_u', 'empty');
							input_control('#numero_cuotas_u', 'empty');
							input_control('#valor_cuotas_u', 'empty');
							input_control('#fecha_pago_u', 'empty');
							input_control('#dui_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Promesa Actualizada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar La Promesa',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}
					}catch(e){
						Swal.fire({
							icon: 'error',
							title: 'Error Del Servidor',
							text: e,
							confirmButtonText: 'Aceptar',
							confirmButtonColor: '#2BC521'
						});
					}

					button_control('#btn_actualizar_promesa_de_pago', 'activar', 'Actualizar Promesa');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_promesa_de_pago', 'activar', 'Actualizar Promesa');
				}
			});
		}
	});

	/**
	 * ----------------------------------------------------
	 * delete
	 * ----------------------------------------------------
	*/
	/**
	 * botón
	*/
	jQuery('.btn_eliminar_promesa_de_pago').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar a esta promesa de pago?',
			text: 'Si elimina esta promesa de pago, también se eliminarán todos los datos relacionados a esta promesa.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let id_promesa = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/promesas_de_pago_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						id_promesa: id_promesa
					},
					success: function(data){
						try{
							if(data['success']){
								Swal.fire({
									icon: 'success',
									title: 'Promesa Eliminada',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});

								let id = '#id_promesa_' + id_promesa;

								jQuery(id).remove();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Error Al Eliminar Promesa',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});
							}
						}catch(e){
							Swal.fire({
								icon: 'error',
								title: 'Error Del Servidor',
								text: e,
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}
					},
					error: function(data){
						Swal.fire({
							icon: 'error',
							title: 'Error De Conexión',
							text: 'Revise su conexión a internet e inténtelo de nuevo.',
							confirmButtonText: 'Aceptar',
							confirmButtonColor: '#2BC521'
						});
					}
				});
			}
		});
	});
});