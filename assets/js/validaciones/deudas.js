jQuery(document).ready(function(){
	/**
	 * expresiones regulares
	*/
	let regexDui = /^[0-9]{9}$/;

	/**
	 * ----------------------------------------------------
	 * insert
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
	let v_dui = true;

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

	/**
	 * boton
	*/
	jQuery('#btn_agregar_deuda').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

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
			button_control('#btn_agregar_deuda', 'desactivar', 'Agregando Deuda...');

			/**
			 * Recuperación de datos
			*/
			let dui = jQuery('#dui').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/deudas_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
					dui: dui
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#dui', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Deuda Creada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Crear Deuda',
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

					button_control('#btn_agregar_deuda', 'activar', 'Agregar Deuda');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_deuda', 'activar', 'Agregar Deuda');
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
	let vu_id_deuda = true;
	let vu_dui = true;

	/**
	 * id_deuda
	*/
	jQuery('#id_deuda_u').keyup(function(){
		let info = comprobar_validaciones('#id_deuda_u');

		if(info == 'success'){
			vu_id_deuda = true;
		}else{
			vu_id_deuda = false;
		}
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
		}

		input_control('#dui_u', info);
	});

	/**
	 * boton
	*/
	jQuery('#btn_actualizar_deuda').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_id_deuda){
			message += '<b>Id Deuda:</b> El Id de la deuda no es válido, recarga esta página para volver a cargarlo.<br>';
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
			button_control('#btn_actualizar_deuda', 'desactivar', 'Actualizando Deuda...');

			/**
			 * Recuperación de datos
			*/
			let id_deuda = jQuery('#id_deuda_u').val();
			let dui      = jQuery('#dui_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/deudas_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_deuda: id_deuda,
					dui: dui,
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#id_deuda_u', 'empty');
							input_control('#dui_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Deuda Actualizada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Deuda',
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

					button_control('#btn_actualizar_deuda', 'activar', 'Actualizar Deuda');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_deuda', 'activar', 'Actualizar Deuda');
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
	jQuery('.btn_eliminar_deuda').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar a ésta deuda?',
			text: 'Si elimina ésta deuda, también se eliminarán todos los datos relacionados a ella.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let id_deuda = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/deudas_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						id_deuda: id_deuda
					},
					success: function(data){
						try{
							if(data['success']){
								Swal.fire({
									icon: 'success',
									title: 'Deuda Eliminada',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});

								let id = '#id_deuda_' + id_deuda;

								jQuery(id).remove();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Error Al Eliminar Deuda',
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