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
	let v_descripcion = false;
	let v_id_estado = false;
	let v_id_sub_estado = false;
	let v_dui = true;

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
	 * id_estado
	*/
	jQuery('#id_estado').change(function(){
		let info = comprobar_validaciones('#id_estado');

		if(info == 'success'){
			v_id_estado = true;
			input_control('#id_estado', 'empty');

			let id_estado = jQuery('#id_estado').val();

			// ajax get sub estados
			jQuery.ajax({
				url: URLactual + '/system/ajax/sub_estados_ajax.php',
				type: 'POST',
				dataType: 'html',
				data: {
					action: 'select_all_by_id_estado',
					id_estado: id_estado
				},
				success: function(data){
					jQuery('#id_sub_estado').html(data);
				},
				error: function(data){
					let options = '<option value="" selected>-- Seleccione un sub estado --</option>';

					jQuery('#id_sub_estado').html(options);
				}
			});
		}else{
			v_id_estado = false;
			input_control('#id_estado', 'empty');

			// id_sub_estado
			let options = '<option value="" selected>-- Seleccione un sub estado --</option>';

			jQuery('#id_sub_estado').html(options);
		}

		v_id_sub_estado = false;
	});

	/**
	 * id_sub_estado
	*/
	jQuery('#id_sub_estado').change(function(){
		let info = comprobar_validaciones('#id_sub_estado');

		if(info == 'success'){
			v_id_sub_estado = true;
			input_control('#id_sub_estado', 'empty');
		}else{
			v_id_sub_estado = false;
			input_control('#id_sub_estado', info);
		}
	});

	/**
	 * dui
	*/
	jQuery('#dui').keyup(function(){
		let info = comprobar_validaciones('#dui'. regexDui);

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
	jQuery('#btn_agregar_gestion').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!v_descripcion){
			input_control('#descripcion', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripción válida.<br>';
		}

		if(!v_id_estado){
			input_control('#id_estado', 'error');
			message += '<b>Estado:</b> De seleccionar un Estado válido.<br>';
		}

		if(!v_id_sub_estado){
			input_control('#id_sub_estado', 'error');
			message += '<b>Sub Estado:</b> Debe seleccionar Sub Estado válido.<br>';
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
			button_control('#btn_agregar_gestion', 'desactivar', 'Agregando Gestión...');

			/**
			 * Recuperación de datos
			*/
			let descripcion   = jQuery('#descripcion').val();
			let id_sub_estado = jQuery('#id_sub_estado').val();
			let dui           = jQuery('#dui').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/gestiones_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
					descripcion: descripcion,
					id_sub_estado: id_sub_estado,
					dui: dui
				},
				success: function(data){
					try{
						if(data['success']){
							// limpiar campos
							jQuery('#descripcion').val('');
							
							// Establecer borde por defecto
							input_control('#descripcion', 'empty');
							input_control('#id_sub_estado', 'empty');
							input_control('#dui', 'empty');

							// resetear variables
							v_descripcion = false;

							Swal.fire({
								icon: 'success',
								title: 'Gestión Creada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Crear Gestión',
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

					button_control('#btn_agregar_gestion', 'activar', 'Agregar Gestión');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					console.log(data);

					button_control('#btn_agregar_gestion', 'activar', 'Agregar Gestión');
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
	let vu_id_gestion = true;
	let vu_descripcion = true;
	let vu_id_estado = true;
	let vu_id_sub_estado = true;
	let vu_dui = true;

	/**
	 * id_gestion
	*/
	jQuery('#id_gestion_u').keyup(function(){
		let info = comprobar_validaciones('#id_gestion_u');

		if(info == 'success'){
			vu_id_gestion = true;
		}else{
			vu_id_gestion = false;
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
	 * id_estado
	*/
	jQuery('#id_estado_u').change(function(){
		let info = comprobar_validaciones('#id_estado_u');

		if(info == 'success'){
			vu_id_estado = true;
			input_control('#id_estado_u', 'empty');

			let id_estado = jQuery('#id_estado_u').val();

			// ajax get sub estados
			jQuery.ajax({
				url: URLactual + '/system/ajax/sub_estados_ajax.php',
				type: 'POST',
				dataType: 'html',
				data: {
					action: 'select_all_by_id_estado',
					id_estado: id_estado
				},
				success: function(data){
					jQuery('#id_sub_estado_u').html(data);
				},
				error: function(data){
					let options = '<option value="" selected>-- Seleccione un sub estado --</option>';

					jQuery('#id_sub_estado_u').html(options);
				}
			});
		}else{
			vu_id_estado = false;
			input_control('#id_estado_u', 'empty');

			// id_sub_estado
			let options = '<option value="" selected>-- Seleccione un sub estado --</option>';

			jQuery('#id_sub_estado_u').html(options);
		}

		vu_id_sub_estado = false;
	});

	/**
	 * id_sub_estado
	*/
	jQuery('#id_sub_estado_u').change(function(){
		let info = comprobar_validaciones('#id_sub_estado_u');

		if(info == 'success'){
			vu_id_sub_estado = true;
			input_control('#id_sub_estado_u', 'empty');
		}else{
			vu_id_sub_estado = false;
			input_control('#id_sub_estado_u', info);
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
	jQuery('#btn_actualizar_gestion').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_id_gestion){
			message += '<b>Id Gestión:</b> El Id de la gestión no es válido, recarga esta página para volver a cargarlo.<br>';
		}

		if(!vu_descripcion){
			input_control('#descripcion_u', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripción válida.<br>';
		}

		if(!vu_id_estado){
			input_control('#id_estado_u', 'error');
			message += '<b>Estado:</b> Seleccionar un Estado válido.<br>';
		}

		if(!vu_id_sub_estado){
			input_control('#id_sub_estado_u', 'error');
			message += '<b>Sub Estado:</b> Debe seleccionar un Sub Estado válido.<br>';
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
			button_control('#btn_actualizar_gestion', 'desactivar', 'Actualizando Gestión...');

			/**
			 * Recuperación de datos
			*/
			let id_gestion    = jQuery('#id_gestion_u').val();
			let descripcion   = jQuery('#descripcion_u').val();
			let id_sub_estado = jQuery('#id_sub_estado_u').val();
			let dui           = jQuery('#dui_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/gestiones_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_gestion: id_gestion,
					descripcion: descripcion,
					id_sub_estado: id_sub_estado,
					dui: dui
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#id_gestion_u', 'empty');
							input_control('#descripcion_u', 'empty');
							input_control('#id_sub_estado_u', 'empty');
							input_control('#dui_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Gestión Actualizada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Gestión',
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

					button_control('#btn_actualizar_gestion', 'activar', 'Actualizar Gestión');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_gestion', 'activar', 'Actualizar Gestión');
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
	jQuery('.btn_eliminar_gestion').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar ésta gestión?',
			text: 'Si elimina ésta gestión, también se eliminarán todos los datos relacionados a esta gestión.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let id_gestion = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/gestiones_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						id_gestion: id_gestion
					},
					success: function(data){
						try{
							if(data['success']){
								Swal.fire({
									icon: 'success',
									title: 'Gestión Eliminada',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});

								let id = '#id_gestion_' + id_gestion;

								jQuery(id).remove();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Error Al Eliminar Gestión',
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