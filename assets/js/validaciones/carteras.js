jQuery(document).ready(function(){
	/**
	 * expresiones regulares
	*/
	let regexMail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

	/**
	 * ----------------------------------------------------
	 * insert
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
	let v_nombre_cartera = false;
	let v_descripcion = false;
	let v_correo_contacto = false;

	/**
	 * validación de datos
	*/
	/**
	 * nombre_cartera
	*/
	jQuery('#nombre_cartera').keyup(function(){
		let info = comprobar_validaciones('#nombre_cartera', null, false, 3);

		if(info == 'success'){
			v_nombre_cartera = true;
		}else{
			v_nombre_cartera = false;
		}

		input_control('#nombre_cartera', info);
	});

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
	 * correo_contacto
	*/
	jQuery('#correo_contacto').keyup(function(){
		let info = comprobar_validaciones('#correo_contacto', regexMail);

		if(info == 'success'){
			v_correo_contacto = true;
		}else{
			v_correo_contacto = false;
		}

		input_control('#correo_contacto', info);
	});

	/**
	 * boton
	*/
	jQuery('#btn_agregar_cartera').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!v_nombre_cartera){
			input_control('#nombre_cartera', 'error');
			message += '<b>Nombre Cartera:</b> Debe agregar un nombre de cartera válido.<br>';
		}

		if(!v_descripcion){
			input_control('#descripcion', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripción válida.<br>';
		}

		if(!v_correo_contacto){
			input_control('#correo_contacto', 'error');
			message += '<b>Correo de Contacto:</b> Debe agregar un correo de contacto válido.<br>';
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
			button_control('#btn_agregar_cartera', 'desactivar', 'Agregando Cartera...');

			/**
			 * Recuperación de datos
			*/
			let nombre_cartera  = jQuery('#nombre_cartera').val();
			let descripcion     = jQuery('#descripcion').val();
			let correo_contacto = jQuery('#correo_contacto').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/carteras_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
					nombre_cartera: nombre_cartera,
					descripcion: descripcion,
					correo_contacto: correo_contacto
				},
				success: function(data){
					try{
						if(data['success']){
							// limpiar campos
							jQuery('#nombre_cartera').val('');
							jQuery('#descripcion').val('');
							jQuery('#correo_contacto').val('');
							
							// Establecer borde por defecto
							input_control('#nombre_cartera', 'empty');
							input_control('#descripcion', 'empty');
							input_control('#correo_contacto', 'empty');

							// resetear variables
							v_nombre_cartera = false;
							v_descripcion = false;
							v_correo_contacto = false;

							Swal.fire({
								icon: 'success',
								title: 'Cartera Creada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Crear Cartera',
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

					button_control('#btn_agregar_cartera', 'activar', 'Agregar Cartera');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_cartera', 'activar', 'Agregar Cartera');
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
	let vu_id_cartera = true;
	let vu_nombre_cartera = true;
	let vu_descripcion = true;
	let vu_correo_contacto = true;

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
	});

	/**
	 * nombre_cartera
	*/
	jQuery('#nombre_cartera_u').keyup(function(){
		let info = comprobar_validaciones('#nombre_cartera_u', null, false, 3);

		if(info == 'success'){
			vu_nombre_cartera = true;
		}else{
			vu_nombre_cartera = false;
		}

		input_control('#nombre_cartera_u', info);
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
	 * correo_contacto
	*/
	jQuery('#correo_contacto_u').keyup(function(){
		let info = comprobar_validaciones('#correo_contacto_u', regexMail);

		if(info == 'success'){
			vu_correo_contacto = true;
		}else{
			vu_correo_contacto = false;
		}

		input_control('#correo_contacto_u', info);
	});

	/**
	 * boton
	*/
	jQuery('#btn_actualizar_cartera').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_id_cartera){
			message += '<b>Id Cartera:</b> El Id de la cartera no es válido, recarga esta página para volver a cargarlo.<br>';
		}

		if(!vu_nombre_cartera){
			input_control('#nombre_cartera_u', 'error');
			message += '<b>Nombre Cartera:</b> Debe agregar un nombre de cartera válido.<br>';
		}

		if(!vu_descripcion){
			input_control('#descripcion_u', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripción válida.<br>';
		}

		if(!vu_correo_contacto){
			input_control('#correo_contacto_u', 'error');
			message += '<b>Correo de Contacto:</b> Debe agregar un correo de contacto válido.<br>';
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
			button_control('#btn_actualizar_cartera', 'desactivar', 'Actualizando Cartera...');

			/**
			 * Recuperación de datos
			*/
			let id_cartera      = jQuery('#id_cartera_u').val();
			let nombre_cartera  = jQuery('#nombre_cartera_u').val();
			let descripcion     = jQuery('#descripcion_u').val();
			let correo_contacto = jQuery('#correo_contacto_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/carteras_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_cartera: id_cartera,
					nombre_cartera: nombre_cartera,
					descripcion: descripcion,
					correo_contacto: correo_contacto
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#id_cartera_u', 'empty');
							input_control('#nombre_cartera_u', 'empty');
							input_control('#descripcion_u', 'empty');
							input_control('#correo_contacto_u', 'empty');

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

					button_control('#btn_actualizar_cartera', 'activar', 'Actualizar Cartera');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_cartera', 'activar', 'Actualizar Cartera');
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
	jQuery('.btn_eliminar_cartera').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar a ésta cartera?',
			text: 'Si elimina ésta cartera, también se eliminarán todos los datos relacionados a ella.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let id_cartera = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/carteras_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						id_cartera: id_cartera
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

								let id = '#id_cartera_' + id_cartera;

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