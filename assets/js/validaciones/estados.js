jQuery(document).ready(function(){
	/**
	 * ----------------------------------------------------
	 * insert
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
	let v_descripcion = false;
	let v_habilitado = true;
	let v_id_cartera = true;

	/**
	 * validación de datos
	*/
	/**
	 * descripcion
	*/
	jQuery('#descripcion').keyup(function(){
		let info = comprobar_validaciones('#descripcion', null, false, 8);

		if(info == 'success'){
			v_descripcion = true;
		}else{
			v_descripcion = false;
		}

		input_control('#descripcion', info);
	});

	/**
	 * habilitado
	*/
	jQuery('#habilitado').change(function(){
		let info = comprobar_validaciones('#habilitado');

		if(info == 'success'){
			v_habilitado = true;
		}else{
			v_habilitado = false;
			input_control('#habilitado', info);
		}
	});

	/**
	 * id_cartera
	*/
	jQuery('#id_cartera').keyup(function(){
		let info = comprobar_validaciones('#id_cartera');

		if(info == 'success'){
			v_id_cartera = true;
		}else{
			v_id_cartera = false;
		}

		input_control('#id_cartera', info);
	});

	/**
	 * boton
	*/
	jQuery('#btn_agregar_estado').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!v_descripcion){
			input_control('#descripcion', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripción válida.<br>';
		}

		if(!v_habilitado){
			input_control('#habilitado', 'error');
			message += '<b>Habilitado:</b> Debe seleccionar una opción válida.<br>';
		}

		if(!v_id_cartera){
			input_control('#id_cartera', 'error');
			message += '<b>Id Cartera:</b> Debe agregar un Id de Cartera válido.<br>';
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
			button_control('#btn_agregar_estado', 'desactivar', 'Agregando Estado...');

			/**
			 * Recuperación de datos
			*/
			let descripcion = jQuery('#descripcion').val();
			let habilitado  = jQuery('#habilitado').val();
			let id_cartera  = jQuery('#id_cartera').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/estados_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
					descripcion: descripcion,
					habilitado: habilitado,
					id_cartera: id_cartera
				},
				success: function(data){
					try{
						if(data['success']){
							// limpiar campos
							jQuery('#descripcion').val('');
							
							// Establecer borde por defecto
							input_control('#descripcion', 'empty');
							input_control('#habilitado', 'empty');
							input_control('#id_cartera', 'empty');

							// resetear variables
							v_descripcion = false;

							Swal.fire({
								icon: 'success',
								title: 'Estado Creado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Crear Estado',
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

					button_control('#btn_agregar_estado', 'activar', 'Agregar Estado');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_estado', 'activar', 'Agregar Estado');
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
	let vu_id_estado = true;
	let vu_descripcion = true;
	let vu_habilitado = true;
	let vu_id_cartera = true;

	/**
	 * id_estado
	*/
	jQuery('#id_estado_u').keyup(function(){
		let info = comprobar_validaciones('#id_estado_u');

		if(info == 'success'){
			vu_id_estado = true;
		}else{
			vu_id_estado = false;
		}
	});

	/**
	 * descripcion
	*/
	jQuery('#descripcion_u').keyup(function(){
		let info = comprobar_validaciones('#descripcion_u', null, false, 8);

		if(info == 'success'){
			vu_descripcion = true;
		}else{
			vu_descripcion = false;
		}

		input_control('#descripcion_u', info);
	});

	/**
	 * habilitado
	*/
	jQuery('#habilitado_u').keyup(function(){
		let info = comprobar_validaciones('#habilitado_u');

		if(info == 'success'){
			vu_habilitado = true;
		}else{
			vu_habilitado = false;
			input_control('#habilitado_u', info);
		}
	});

	/**
	 * id_cartera
	*/
	jQuery('#id_cartera_u').keyup(function(){
		let info = comprobar_validaciones('#id_cartera_u');

		if(info == 'success'){
			vu_id_cartera = true;
		}else{
			vu_id_cartera = false;
		}

		input_control('#id_cartera_u', info);
	});

	/**
	 * boton
	*/
	jQuery('#btn_actualizar_estado').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_id_estado){
			message += '<b>Id Estado:</b> El Id del estado no es válido, recarga esta página para volver a cargarlo.<br>';
		}

		if(!vu_descripcion){
			input_control('#descripcion_u', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripción válida.<br>';
		}

		if(!vu_habilitado){
			input_control('#habilitado_u', 'error');
			message += '<b>Habilitado:</b> Debe seleccionar una opción válida.<br>';
		}

		if(!vu_id_cartera){
			input_control('#id_cartera_u', 'error');
			message += '<b>Id Cartera:</b> Debe agregar un Id de Cartera válido.<br>';
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
			button_control('#btn_actualizar_estado', 'desactivar', 'Actualizando Estado...');

			/**
			 * Recuperación de datos
			*/
			let id_estado   = jQuery('#id_estado_u').val();
			let descripcion = jQuery('#descripcion_u').val();
			let habilitado  = jQuery('#habilitado_u').val();
			let id_cartera  = jQuery('#id_cartera_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/estados_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_estado: id_estado,
					descripcion: descripcion,
					habilitado: habilitado,
					id_cartera: id_cartera
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#id_estado_u', 'empty');
							input_control('#descripcion_u', 'empty');
							input_control('#habilitado_u', 'empty');
							input_control('#id_cartera_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Estado Actualizado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Estado',
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

					button_control('#btn_actualizar_estado', 'activar', 'Actualizar Estado');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_estado', 'activar', 'Actualizar Estado');
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
	jQuery('.btn_eliminar_estado').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar a éste estado?',
			text: 'Si elimina éste estado, también se eliminarán todos los datos relacionados a él.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let id_estado = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/estados_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						id_estado: id_estado
					},
					success: function(data){
						try{
							if(data['success']){
								Swal.fire({
									icon: 'success',
									title: 'Estado Eliminado',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});

								let id = '#id_estado_' + id_estado;

								jQuery(id).remove();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Error Al Eliminar Estado',
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