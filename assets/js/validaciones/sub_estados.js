jQuery(document).ready(function(){
    /**
     * Variables generales para validación de datos
    */
    let v_descripcion = false;
    let v_habilitado = true;
    let v_id_estado = true;

    /**
     * Validación de datos
    */
    jQuery('#descripcion').keyup(function(){
        let info = comprobar_validaciones("#descripcion", null, false, 8)

        if(info == 'success'){
            v_descripcion = true;
        }else{
            v_descripcion = false;
        }

        input_control('#descripcion', info);
    });

    jQuery('#habilitado').change(function(){
		let info = comprobar_validaciones('#habilitado');

		if(info == 'success'){
			v_habilitado = true;
		}else{
			v_habilitado = false;
            input_control('#habilitado', info);
		}
	});

    jQuery('#id_estado').change(function(){
		let info = comprobar_validaciones('#id_estado');

		if(info == 'success'){
			v_id_estado = true;
		}else{
			v_id_estado = false;
            input_control('#id_estado', info);
		}
	});

    /**
     * Botón agregar sub estado
    */
    jQuery('#btn_agregar_subestado').click(function(){
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

        if(!v_id_estado){
			input_control('#id_estado', 'error');
			message += '<b>Id de estado:</b> Debe seleccionar un id de estado válido.<br>';
		}
        
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
            button_control('#btn_agregar_subestado', 'desactivar', 'Agregando Sub-estado...');

            /**
             * Recuperación de datos
            */
            let descripcion = jQuery('#descripcion').val();
            let habilitado = jQuery('#habilitado').val();
            let id_estado = jQuery('#id_estado').val();

            /**
             * Ajax
            */
            jQuery.ajax({
                url: URLactual + '/system/ajax/sub_estados_ajax.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'insert',
                    descripcion: descripcion,
                    habilitado: habilitado,
                    id_estado: id_estado
                },
                success: function(data){
                    try{
                        if(data['success']){
                            // Limpiar campos
                            jQuery('#descripcion').val('');

                            // Establecer borde por defecto
                            input_control('#descripcion', 'empty');
                            input_control('#habilitado', 'empty');
                            input_control('#id_estado', 'empty');
                            
							v_descripcion = false;

							Swal.fire({
								icon: 'success',
								title: 'Sub-estado Creado',
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
	            
	                button_control('#btn_agregar_subestado', 'activar', 'Agregar Sub-estado');
				},
                error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_subestado', 'activar', 'Agregar Sub-estado');
				}
			});
		}
	});

	/**
	 * update
	*/
    let vu_id_sub_estado = true;
    let vu_descripcion = true;
    let vu_habilitado = true;
    let vu_id_estado = true;

    jQuery('#id_sub_estado_u').keyup(function(){
        let info = comprobar_validaciones('#id_sub_estado_u');

        if(info == 'success'){
            vu_id_sub_estado = true;
        }else{
            vu_id_sub_estado = false;
        }
    });
    
    jQuery('#descripcion_u').keyup(function(){
        let info = comprobar_validaciones('#descripcion_u', null, false, 8);

        if(info == 'success'){
            vu_descripcion = true;
        }else{
            vu_descripcion = false;
        }

        input_control('#descripcion_u', info);
    });

    
    jQuery('#habilitado_u').change(function(){
        let info = comprobar_validaciones('#habilitado_u');
        
        if(info == 'success'){
            vu_habilitado = true;
        }else{
            vu_habilitado = false;
            input_control('#habilitado_u', info);
        }
    });
      
    jQuery('#id_estado_u').change(function(){
        let info = comprobar_validaciones('#id_estado_u');

        if(info == 'success'){
            vu_id_estado = true;
        }else{
            vu_id_estado = false;
            input_control('#id_estado_u', info);
        }
    });

    /**
     * botón actualizar
    */
    jQuery('#btn_actualizar_subestado').click(function(){
        let message = '';

        if(!vu_id_sub_estado){
            message += '<b>Id sub-estado:</b> El Id del sub-estado no es válido, recarga esta página para volver a cargarlo.<br>';
        }

		if(!vu_descripcion){
			input_control('#descripcion_u', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripcion válida.<br>';
		}
        
		if(!vu_habilitado){
			input_control('#habilitado_u', 'error');
			message += '<b>Habilitado:</b> Debe seleccionar una opción válida.<br>';
		}

         
		if(!vu_id_estado){
			input_control('#id_estado_u', 'error');
			message += '<b>Id de estado:</b> Debe seleccionar un id de estado válido.<br>';
		}

        if(message != ''){
			Swal.fire({
				icon: 'warning',
				title: 'Validaciones',
				html: message,
				confirmButtonText: 'Aceptar',
				confirmButtonColor: '#2BC521'
			});
		}else{
            button_control('#btn_actualizar_subestado', 'desactivar', 'Actualizando sub-estado...');

            let id_sub_estado = jQuery('#id_sub_estado_u').val();
            let descripcion = jQuery('#descripcion_u').val();
            let habilitado = jQuery('#habilitado_u').val();
            let id_estado = jQuery('#id_estado_u').val();

            // Ajax
            jQuery.ajax({
				url: URLactual + '/system/ajax/sub_estados_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_sub_estado: id_sub_estado,
                    descripcion: descripcion,
                    habilitado: habilitado,
                    id_estado: id_estado
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#id_sub_estado_u', 'empty');
							input_control('#descripcion_u', 'empty');
							input_control('#habilitado_u', 'empty');
							input_control('#id_estado_u', 'empty');
							
							Swal.fire({
								icon: 'success',
								title: 'Sub-Estado Actualizado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Sub-Estado',
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

					button_control('#btn_actualizar_subestado', 'activar', 'Actualizar Sub-Estado');
				},
                error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_subestado', 'activar', 'Actualizar Sub-Estado');
				}
			});
        }
    });

    /**
     * delete
    */
	jQuery('.btn_eliminar_sub_estado').click(function(){
	    Swal.fire({
	        icon: 'warning',
	        title: '¿Está seguro que quiere eliminar a este Sub-Estado?',
	        text: 'Si elimina este sub-estado, también se eliminarán todos los datos relacionados a el.',
	        showCancelButton: true,
	        confirmButtonText: 'Eliminar',
	        confirmButtonColor: '#cf433f',
	        cancelButtonText: 'Cancelar',
	        cancelButtonColor: '#ccc',
	    }).then((result) => {
	        if(result.isConfirmed){
	            // Ajax Delete
	            let id_sub_estado = jQuery(this).data('id');

	            jQuery.ajax({
	                url: URLactual + '/system/ajax/sub_estados_ajax.php',
	                type: 'POST',
	                dataType: 'json',
	                data: {
	                    action: 'delete',
	                    id_sub_estado: id_sub_estado
	                },
	                success: function(data){
	                    try{
	                        if(data['success']){
	                            Swal.fire({
	                                icon: 'success',
	                                title: 'Sub-Estado Eliminado',
	                                text: data['message'],
	                                confirmButtonText: 'Aceptar',
	                                confirmButtonColor: '#2BC521'
	                            });

	                            let id = '#id_sub_estado_' + id_sub_estado;

                                jQuery(id).remove();
	                        }else{
	                            Swal.fire({
	                                icon: 'error',
	                                title: 'Error Al Eliminar Sub-Estado',
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
