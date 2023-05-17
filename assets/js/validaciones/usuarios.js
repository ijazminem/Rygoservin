jQuery(document).ready(function(){
	/**
	 * expresiones regulares
	*/
	let regexMail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	let regexName = /^[a-zA-ZáéíóúÁÉÍÓÚÜüñÑ ]{7,}$/;
	let regexPass = /^[A-Za-záéíóúÁÉÍÓÚñÑüÜ0-9|!"#$%&/()=?¡\]\[{}'¿´+*\-_;,.:°@~^` ]{8,}$/;

	/**
	 * ----------------------------------------------------
	 * insert
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
	let v_nombre_completo = false;
	let v_correo = false;
	let v_contrasena = false;
	let v_habilitado = true;
	let v_id_tipo_usuario = true;

	/**
	 * validación de datos
	*/
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
	 * correo
	*/
	jQuery('#correo').keyup(function(){
		let info = comprobar_validaciones('#correo', regexMail);

		if(info == 'success'){
			v_correo = true;
		}else{
			v_correo = false;
		}

		input_control('#correo', info);
	});

	/**
	 * contrasena
	*/
	jQuery('#contrasena').keyup(function(){
		let info = comprobar_validaciones('#contrasena', regexPass);

		if(info == 'success'){
			v_contrasena = true;
		}else{
			v_contrasena = false;
		}

		input_control('#contrasena', info);
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
	 * id_tipo_usuario
	*/
	jQuery('#id_tipo_usuario').change(function(){
		let info = comprobar_validaciones('#id_tipo_usuario');

		if(info == 'success'){
			v_id_tipo_usuario = true;
		}else{
			v_id_tipo_usuario = false;
			input_control('#id_tipo_usuario', info);
		}
	});

	/**
	 * boton
	*/
	jQuery('#btn_agregar_usuario').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!v_nombre_completo){
			input_control('#nombre_completo', 'error');
			message += '<b>Nombre Completo:</b> Debe agregar un nombre válido.<br>';
		}

		if(!v_correo){
			input_control('#correo', 'error');
			message += '<b>Correo:</b> Debe agregar un correo válido.<br>';
		}

		if(!v_contrasena){
			input_control('#contrasena', 'error');
			message += '<b>Contraseña:</b> Debe agregar una contraseña con al menos 8 caracteres.<br>';
		}

		if(!v_habilitado){
			input_control('#habilitado', 'error');
			message += '<b>Habilitado:</b> Debe establecer si el usuario estará habilitado o no.<br>';
		}

		if(!v_id_tipo_usuario){
			input_control('#id_tipo_usuario', 'error');
			message += '<b>Tipo de Usuario:</b> Debe seleccionar un tipo de usuario válido.<br>';
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
			button_control('#btn_agregar_usuario', 'desactivar', 'Agregando Usuario...');

			/**
			 * Recuperación de datos
			*/
			let nombre_completo = jQuery('#nombre_completo').val();
			let correo          = jQuery('#correo').val();
			let contrasena      = jQuery('#contrasena').val();
			let habilitado      = jQuery('#habilitado').val();
			let id_tipo_usuario = jQuery('#id_tipo_usuario').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/usuarios_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
					nombre_completo: nombre_completo,
					correo: correo,
					contrasena: contrasena,
					habilitado: habilitado,
					id_tipo_usuario: id_tipo_usuario
				},
				success: function(data){
					try{
						if(data['success']){
							// limpiar campos
							jQuery('#nombre_completo').val('');
							jQuery('#correo').val('');
							jQuery('#contrasena').val('');
							
							// Establecer borde por defecto
							input_control('#nombre_completo', 'empty');
							input_control('#correo', 'empty');
							input_control('#contrasena', 'empty');
							input_control('#habilitado', 'empty');
							input_control('#id_tipo_usuario', 'empty');

							// resetear variables
							v_nombre_completo = false;
							v_correo = false;
							v_contrasena = false;

							Swal.fire({
								icon: 'success',
								title: 'Usuario Creado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Crear Usuario',
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

					button_control('#btn_agregar_usuario', 'activar', 'Agregar Usuario');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_usuario', 'activar', 'Agregar Usuario');
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
	let vu_id_usuario = true;
	let vu_nombre_completo = true;
	let vu_correo = true;
	let vu_contrasena = true;
	let vu_habilitado = true;
	let vu_id_tipo_usuario = true;

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
	 * correo
	*/
	jQuery('#correo_u').keyup(function(){
		let info = comprobar_validaciones('#correo_u', regexMail);

		if(info == 'success'){
			vu_correo = true;
		}else{
			vu_correo = false;
		}

		input_control('#correo_u', info);
	});

	/**
	 * contrasena
	*/
	jQuery('#contrasena_u').keyup(function(){
		let info = comprobar_validaciones('#contrasena_u', regexPass, true);

		if(info == 'success'){
			vu_contrasena = true;
		}else if(info == 'empty'){
			vu_contrasena = true;
		}else{
			vu_contrasena = false;
		}

		input_control('#contrasena_u', info);
	});

	/**
	 * habilitado
	*/
	jQuery('#habilitado_u').change(function(){
		let info = comprobar_validaciones('#habilitado_u');

		if(info == 'success'){
			vu_habilitado = true;
		}else{
			vu_habilitado = false;
			input_control('#habilitado_u', info);
		}
	});

	/**
	 * id_tipo_usuario
	*/
	jQuery('#id_tipo_usuario_u').change(function(){
		let info = comprobar_validaciones('#id_tipo_usuario_u');

		if(info == 'success'){
			vu_id_tipo_usuario = true;
		}else{
			vu_id_tipo_usuario = false;
			input_control('#id_tipo_usuario_u', info);
		}
	});

	/**
	 * boton
	*/
	jQuery('#btn_actualizar_usuario').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_id_usuario){
			message += '<b>Id Usuario:</b> El Id del usuario no es válido, recarga esta página para volver a cargarlo.<br>';
		}

		if(!vu_nombre_completo){
			input_control('#nombre_completo_u', 'error');
			message += '<b>Nombre Completo:</b> Debe agregar un nombre válido.<br>';
		}

		if(!vu_correo){
			input_control('#correo_u', 'error');
			message += '<b>Correo:</b> Debe agregar un correo válido.<br>';
		}

		if(!vu_contrasena){
			input_control('#contrasena_u', 'error');
			message += '<b>Correo:</b> Debe agregar una contraseña con al menos 8 caracteres.<br>';
		}

		if(!vu_habilitado){
			input_control('#habilitado_u', 'error');
			message += '<b>Habilitado:</b> Debe establecer si el usuario estará habilitado o no.<br>';
		}

		if(!vu_id_tipo_usuario){
			input_control('#id_tipo_usuario_u', 'error');
			message += '<b>Tipo de Usuario:</b> Debe seleccionar un tipo de usuario válido.<br>';
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
			button_control('#btn_actualizar_usuario', 'desactivar', 'Actualizando Usuario...');

			/**
			 * Recuperación de datos
			*/
			let id_usuario      = jQuery('#id_usuario_u').val();
			let nombre_completo = jQuery('#nombre_completo_u').val();
			let correo          = jQuery('#correo_u').val();
			let contrasena      = jQuery('#contrasena_u').val();
			let habilitado      = jQuery('#habilitado_u').val();
			let id_tipo_usuario = jQuery('#id_tipo_usuario_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/usuarios_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_usuario: id_usuario,
					nombre_completo: nombre_completo,
					correo: correo,
					contrasena: contrasena,
					habilitado: habilitado,
					id_tipo_usuario: id_tipo_usuario
				},
				success: function(data){
					try{
						if(data['success']){
							// limpiar campos
							jQuery('#contrasena_u').val('');

							// Establecer borde por defecto
							input_control('#id_usuario_u', 'empty');
							input_control('#nombre_completo_u', 'empty');
							input_control('#correo_u', 'empty');
							input_control('#contrasena_u', 'empty');
							input_control('#habilitado_u', 'empty');
							input_control('#id_tipo_usuario_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Usuario Actualizado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Usuario',
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

					button_control('#btn_actualizar_usuario', 'activar', 'Actualizar Usuario');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_usuario', 'activar', 'Actualizar Usuario');
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
	jQuery('.btn_eliminar_usuario').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar a éste usuario?',
			text: 'Si elimina éste usuario, también se eliminarán todos los datos relacionados a él.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let id_usuario = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/usuarios_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						id_usuario: id_usuario
					},
					success: function(data){
						try{
							if(data['success']){
								Swal.fire({
									icon: 'success',
									title: 'Usuario Eliminado',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});

								let id = '#id_usuario_' + id_usuario;

								jQuery(id).remove();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Error Al Eliminar Usuario',
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