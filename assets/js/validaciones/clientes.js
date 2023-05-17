jQuery(document).ready(function(){
	/**
	 * expresiones regulares
	*/
	let regexDui = /^[0-9]{9}$/;
	let regexName = /^[a-zA-ZáéíóúÁÉÍÓÚÜüñÑ ]{7,}$/;
	let regexPhone = /^[0-9]{8,}$/;

	/**
	 * ----------------------------------------------------
	 * insert
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
    let v_dui = false;
    let v_id_cliente = false;
	let v_nombre_completo = false;
    let v_telefono = false;
    let v_estado = true;
    let v_id_cartera = true; 

	/**
	 * validación de datos
	*/

    /**
     * dui
     */
    jQuery('#dui').keyup(function(){
        let info = comprobar_validaciones('#dui', regexDui);

        if(info == 'success'){
            v_dui = true;
        }else{
            v_dui = false;
        }

        input_control('#dui', info);
    });
    
    jQuery('#id_cliente').keyup(function(){
        let info = comprobar_validaciones('#id_cliente')

        if(info == 'success'){
            v_id_cliente = true;
        }else{
            v_id_cliente = false;
        }

        input_control('#id_cliente', info);
    });

	/**
	 * nombre_completo
	*/
	jQuery('#nombre_completo').keyup(function(){
		let info = comprobar_validaciones('#nombre_completo', regexName);

		if(info == 'success'){
			v_nombre_completo = true;
		}else{
			v_nombre_completo = false;
		}

		input_control('#nombre_completo', info);
	});

	/**
	 * telefono
	*/
	jQuery('#telefono').keyup(function(){
		let info = comprobar_validaciones('#telefono', regexPhone);

		if(info == 'success'){
			v_telefono = true;
		}else{
			v_telefono = false;
		}

		input_control('#telefono', info);
	});

	/**
	 * estado
	*/
	jQuery('#estado').change(function(){
		let info = comprobar_validaciones('#estado');

		if(info == 'success'){
			v_estado = true;
		}else{
			v_estado = false;
        	input_control('#estado', info);    
		}	
	});	

	/**
	 * id_cartera
	*/
	jQuery('#id_cartera').change(function(){
		let info = comprobar_validaciones('#id_cartera');

		if(info == 'success'){
			v_id_cartera = true;
		}else{
			v_id_cartera = false;
			input_control('#id_cartera', info);
		}
	});

	/**
	 * boton
	*/
	jQuery('#btn_agregar_cliente').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

        if(!v_dui){
			input_control('#dui', 'error');
			message += '<b>DUI:</b> Debe agregar un número de DUI válido.<br>';
		}

        if(!v_id_cliente){
			input_control('#id_cliente', 'error');
			message += '<b>ID cliente:</b> Debe agregar un ID válido.<br>';
		}

		if(!v_nombre_completo){
			input_control('#nombre_completo', 'error');
			message += '<b>Nombre Completo:</b> Debe agregar un nombre válido.<br>';
		}

		if(!v_telefono){
			input_control('#telefono', 'error');
			message += '<b>Teléfono:</b> Debe agregar un número de teléfono válido.<br>';
		}

		if(!v_estado){
			input_control('#estado', 'error');
			message += '<b>Estado:</b> Debe establecer una opción válida.<br>';
		}

		if(!v_id_cartera){
			input_control('#id_cartera', 'error');
			message += '<b>Id de cartera:</b> Debe seleccionar un Id de cartera válido.<br>';
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
			button_control('#btn_agregar_cliente', 'desactivar', 'Agregando cliente...');

			/**
			 * Recuperación de datos
			*/
            let dui             = jQuery('#dui').val();
            let id_cliente      = jQuery('#id_cliente').val();
			let nombre_completo = jQuery('#nombre_completo').val();
			let telefono        = jQuery('#telefono').val();
			let estado          = jQuery('#estado').val();
			let id_cartera      = jQuery('#id_cartera').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/clientes_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
                    dui: dui,
                    id_cliente: id_cliente,
					nombre_completo: nombre_completo,
                    telefono: telefono,
                    estado: estado,
                    id_cartera: id_cartera
				},
				success: function(data){
					try{
						if(data['success']){
							// limpiar campos
                            jQuery('#dui').val('');
                            jQuery('#id_cliente').val('');
							jQuery('#nombre_completo').val('');
							jQuery('#telefono').val('');
							
							// Establecer borde por defecto
							input_control('#dui', 'empty');
							input_control('#id_cliente', 'empty');
							input_control('#nombre_completo', 'empty');
							input_control('#telefono', 'empty');
							input_control('#estado', 'empty');
							input_control('#id_cartera', 'empty');

							// resetear variables
                            v_dui = false;
                            v_id_cliente = false;
							v_nombre_completo = false;
							v_telefono = false;

							Swal.fire({
								icon: 'success',
								title: 'Cliente Creado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Crear Cliente',
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

					button_control('#btn_agregar_cliente', 'activar', 'Agregar Cliente');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_cliente', 'activar', 'Agregar Cliente');
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
	let vu_dui = true;
    let vu_id_cliente = true;
	let vu_nombre_completo = true;
	let vu_telefono = true;
	let vu_estado = true;
	let vu_id_cartera = true;

	/**
	 * dui
	*/
	jQuery('#dui_u').keyup(function(){
		let info = comprobar_validaciones('#dui_u', regexDui);

		if(info == 'success'){
			vu_dui = true;
		}else{
			vu_dui = false;
		}
	});

    /**
	 * id_cliente
	*/
	jQuery('#id_cliente_u').keyup(function(){
		let info = comprobar_validaciones('#id_cliente_u');

		if(info == 'success'){
			vu_id_cliente = true;
		}else{
			vu_id_cliente = false;
		}

		input_control('#id_cliente_u', info);
	});

	/**
	 * nombre_completo
	*/
	jQuery('#nombre_completo_u').keyup(function(){
		let info = comprobar_validaciones('#nombre_completo_u', regexName);

		if(info == 'success'){
			vu_nombre_completo = true;
		}else{
			vu_nombre_completo = false;
		}

		input_control('#nombre_completo_u', info);
	});

	/**
	 * telefono
	*/
	jQuery('#telefono_u').keyup(function(){
		let info = comprobar_validaciones('#telefono_u', regexPhone);

		if(info == 'success'){
			vu_telefono = true;
		}else{
			vu_telefono = false;
		}

		input_control('#telefono_u', info);
	});

	/**
	 * estado
	*/
	jQuery('#estado_u').change(function(){
		let info = comprobar_validaciones('#estado_u');

		if(info == 'success'){
			vu_estado = true;
		}else{
			vu_estado = false;
			input_control('#estado_u', info);
		}
	});

	/**
	 * id_cartera
	*/
	jQuery('#id_cartera_u').change(function(){
		let info = comprobar_validaciones('#id_cartera_u');

		if(info == 'success'){
			vu_id_cartera = true;
		}else{
			vu_id_cartera = false;
			input_control('#id_cartera_u', info);
		}
	});

	/**
	 * boton
	*/
	jQuery('#btn_actualizar_cliente').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_dui){
			message += '<b>DUI:</b> El dui del cliente no es válido, recarga esta página para volver a cargarlo.<br>';
		}
        if(!vu_id_cliente){
			message += '<b>ID:</b> El id del cliente no es válido, recarga esta página para volver a cargarlo.<br>';
		}

		if(!vu_nombre_completo){
			input_control('#nombre_completo_u', 'error');
			message += '<b>Nombre Completo:</b> Debe agregar un nombre válido.<br>';
		}

		if(!vu_telefono){
			input_control('#telefono', 'error');
			message += '<b>Teléfono:</b> Debe agregar un número de teléfono válido.<br>';
		}

		if(!vu_estado){
			input_control('#estado', 'error');
			message += '<b>Estado:</b> Debe establecer una opción válida.<br>';
		}

		if(!vu_id_cartera){
			input_control('#id_cartera', 'error');
			message += '<b>Id de cartera:</b> Debe seleccionar un Id de cartera válido.<br>';
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
			button_control('#btn_actualizar_cliente', 'desactivar', 'Actualizando Cliente...');

			/**
			 * Recuperación de datos
			*/
            let dui             = jQuery('#dui_u').val();
            let id_cliente      = jQuery('#id_cliente_u').val();
			let nombre_completo = jQuery('#nombre_completo_u').val();
			let telefono        = jQuery('#telefono_u').val();
			let estado          = jQuery('#estado_u').val();
			let id_cartera      = jQuery('#id_cartera_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/clientes_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
                    dui: dui,
                    id_cliente: id_cliente,
					nombre_completo: nombre_completo,
                    telefono: telefono,
                    estado: estado,
                    id_cartera: id_cartera
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#dui_u', 'empty');
							input_control('#id_cliente_u', 'empty');
							input_control('#nombre_completo_u', 'empty');
							input_control('#telefono_u', 'empty');
							input_control('#estado_u', 'empty');
							input_control('#id_cartera_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Cliente Actualizado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Cliente',
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

					button_control('#btn_actualizar_cliente', 'activar', 'Actualizar Cliente');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_cliente', 'activar', 'Actualizar Cliente');
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
	jQuery('.btn_eliminar_cliente').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar a éste cliente?',
			text: 'Si elimina éste cliente, también se eliminarán todos los datos relacionados a él.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let dui = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/clientes_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						dui: dui
					},
					success: function(data){
						try{
							if(data['success']){
								Swal.fire({
									icon: 'success',
									title: 'Cliente Eliminado',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});

								let id = '#dui_' + dui;

                                jQuery(id).remove();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Error Al Eliminar Cliente',
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