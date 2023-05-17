jQuery(document).ready(function(){
	/**
	 * ----------------------------------------------------
	 * insert
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
	let v_id_usuario = true;
	let v_id_cartera = true;

	/**
	 * validación de datos
	*/
	/**
	 * id_usuario
	*/
	jQuery('#id_usuario').keyup(function(){
		let info = comprobar_validaciones('#id_usuario');

		if(info == 'success'){
			v_id_usuario = true;
		}else{
			v_id_usuario = false;
		}

		input_control('#id_usuario', info);
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
	jQuery('#btn_agregar_usuario_cartera').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!v_id_usuario){
			input_control('#id_usuario', 'error');
			message += '<b>Id Usuario:</b> Debe agregar un Id de Usuario válido.<br>';
		}

		if(!v_id_cartera){
			input_control('#id_cartera', 'error');
			message += '<b>Id Cartera:</b> Debe seleccionar un Id de Cartera válido.<br>';
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
			button_control('#btn_agregar_usuario_cartera', 'desactivar', 'Agregando Cartera...');

			/**
			 * Recuperación de datos
			*/
			let id_usuario = jQuery('#id_usuario').val();
			let id_cartera = jQuery('#id_cartera').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/usuario_cartera_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
					id_usuario: id_usuario,
					id_cartera: id_cartera
				},
				success: function(data){
					try{
						if(data['success']){							
							// Establecer borde por defecto
							input_control('#id_usuario', 'empty');
							input_control('#id_cartera', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Cartera Asignada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Asignar Cartera',
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

					button_control('#btn_agregar_usuario_cartera', 'activar', 'Agregar Cartera');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_usuario_cartera', 'activar', 'Agregar Cartera');
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
	let vu_id_usuario_cartera = true;
	let vu_id_usuario = true;
	let vu_id_cartera = true;

	/**
	 * id_usuario_cartera
	*/
	jQuery('#id_usuario_cartera_u').keyup(function(){
		let info = comprobar_validaciones('#id_usuario_cartera_u');

		if(info == 'success'){
			vu_id_usuario_cartera = true;
		}else{
			vu_id_usuario_cartera = false;
		}
	});

	/**
	 * id_usuario
	*/
	jQuery('#id_usuario_u').keyup(function(){
		let info = comprobar_validaciones('#id_usuario_u');

		if(info == 'success'){
			vu_id_usuario = true;
		}else{
			vu_id_usuario = false;
		}

		input_control('#id_usuario_u', info);
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
	jQuery('#btn_actualizar_usuario_cartera').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_id_usuario_cartera){
			message += '<b>Id Usuario Cartera:</b> El Id Usuario Cartera no es válido, recarga esta página para volver a cargarlo.<br>';
		}

		if(!vu_id_usuario){
			input_control('#id_usuario_u', 'error');
			message += '<b>Id Usuario:</b> Debe agregar un Id de Usuario válido.<br>';
		}

		if(!vu_id_cartera){
			input_control('#id_cartera_u', 'error');
			message += '<b>Correo:</b> Debe agregar un Id de Cartera válido.<br>';
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
			button_control('#btn_actualizar_usuario_cartera', 'desactivar', 'Actualizando Cartera...');

			/**
			 * Recuperación de datos
			*/
			let id_usuario_cartera = jQuery('#id_usuario_cartera_u').val();
			let id_usuario         = jQuery('#id_usuario_u').val();
			let id_cartera         = jQuery('#id_cartera_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/usuarios_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_usuario_cartera: id_usuario_cartera,
					id_usuario: id_usuario,
					id_cartera: id_cartera,
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#id_usuario_cartera_u', 'empty');
							input_control('#id_usuario_u', 'empty');
							input_control('#id_cartera_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Cartera Actualizada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Cartera',
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

					button_control('#btn_actualizar_usuario_cartera', 'activar', 'Actualizar Cartera');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_usuario_cartera', 'activar', 'Actualizar Cartera');
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
	jQuery('.btn_eliminar_usuario_cartera').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar esta cartera?',
			text: 'Si elimina esta cartera, el empleado ya no podrá ver los detalles de esta cartera.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let id_usuario_cartera = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/usuario_cartera_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						id_usuario_cartera: id_usuario_cartera
					},
					success: function(data){
						try{
							if(data['success']){
								Swal.fire({
									icon: 'success',
									title: 'Cartera Eliminada',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});

								let id = '#id_usuario_cartera_' + id_usuario_cartera;

								jQuery(id).remove();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Error Al Eliminar Cartera',
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