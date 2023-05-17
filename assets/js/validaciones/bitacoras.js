jQuery(document).ready(function(){
    /**
     * Variables generales para validación de datos
    */
    let v_descripcion = false;
    let v_id_proceso = true;

    /**
     * Validación de datos
    */
    jQuery('#descripcion').keyup(function(){
        let info = comprobar_validaciones("#descripcion", null, false, 8);

        if(info == 'success'){
            v_descripcion = true;
        }else{
            v_descripcion= false;
        }

        input_control('#descripcion', info);
    });

    jQuery('#id_proceso').change(function(){
		let info = comprobar_validaciones('#id_proceso');

		if(info == 'success'){
			v_id_proceso = true;
		}else{
			v_id_proceso = false;

            input_control('#id_proceso', info);
		}
	});

    /**
     * Botón agregar bitácora
    */
    jQuery('#btn_agregar_bitacora').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';
		
		if(!v_descripcion){
			input_control('#descripcion', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripción válida.<br>';
		}

		if(!v_id_proceso){
			input_control('#id_proceso', 'error');
			message += '<b>Id de proceso:</b> Debe seleccionar un id de proceso válido.<br>';
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
            button_control('#btn_agregar_bitacora', 'desactivar', 'Agregando Bitácora...');

            /**
             * Recuperación de datos
            */
            let descripcion = jQuery('#descripcion').val();
            let id_proceso = jQuery('#id_proceso').val();

            /**
             * Ajax
            */
            jQuery.ajax({
                url: URLactual + '/system/ajax/bitacoras_ajax.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'insert',
                    descripcion: descripcion,
                    id_proceso: id_proceso
                },
                success: function(data){
                    try{
                        if(data['success']){
                            // Limpiar campos
                            jQuery('#descripcion').val('');

                            // Establecer borde por defecto
                            input_control('#descripcion', 'empty');
                            input_control('#id_proceso', 'empty');
                            
							v_descripcion = false;

							Swal.fire({
								icon: 'success',
								title: 'Bitácora Creada',
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
            
                	button_control('#btn_agregar_bitacora', 'activar', 'Agregar Bitácora');
				},
                error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_bitacora', 'activar', 'Agregar Bitácora');
				}
			});
		}
	});

	/**
	 * update
	*/
    let vu_id_bitacora = true;
    let vu_descripcion = true;
    let vu_id_proceso = true;

    jQuery('#id_bitacora_u').keyup(function(){
        let info = comprobar_validaciones('#id_bitacora_u');

        if(info == 'success'){
            vu_id_bitacora = true;
        }else{
            vu_id_bitacora = false;
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

    jQuery('#id_proceso_u').change(function(){
        let info = comprobar_validaciones('#id_proceso_u');

        if(info == 'success'){
            vu_id_proceso = true;
        }else{
            vu_id_proceso = false;
            input_control('#id_proceso_u', info);
        }
    });

    /**
     * botón actualizar
    */
    jQuery('#btn_actualizar_bitacora').click(function(){
        let message = '';

        if(!vu_id_bitacora){
            message += '<b>Id Bitácora:</b> El Id de la bitácora no es válido, recarga esta página para volver a cargarlo.<br>';
        }

		if(!vu_descripcion){
			input_control('#descripcion_u', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripcion válida.<br>';
		}

		if(!vu_id_proceso){
			input_control('#id_proceso_u', 'error');
			message += '<b>Id de proceso:</b> Debe seleccionar un id de bitácora válido.<br>';
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
            button_control('#btn_actualizar_bitacora', 'desactivar', 'Actualizando bitácora...');

            let id_bitacora = jQuery('#id_bitacora_u').val();
            let descripcion = jQuery('#descripcion_u').val();
            let id_proceso = jQuery('#id_proceso_u').val();

            // Ajax
            jQuery.ajax({
				url: URLactual + '/system/ajax/bitacoras_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_bitacora: id_bitacora,
                    descripcion: descripcion,
                    id_proceso: id_proceso
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#id_bitacora_u', 'empty');
							input_control('#descripcion_u', 'empty');
							input_control('#id_proceso_u', 'empty');
							
							Swal.fire({
								icon: 'success',
								title: 'Bitácora Actualizada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Bitácora',
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

					button_control('#btn_actualizar_bitacora', 'activar', 'Actualizar Bitácora');
				},
                error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_bitacora', 'activar', 'Actualizar Bitácora');
				}
			});
        }
    });

    /**
     * delete
    */
	jQuery('.btn_eliminar_bitacora').click(function(){
	    Swal.fire({
	        icon: 'warning',
	        title: '¿Está seguro que quiere eliminar a esta bitácora?',
	        text: 'Si elimina esta bitácora, también se eliminarán todos los datos relacionados a ella.',
	        showCancelButton: true,
	        confirmButtonText: 'Eliminar',
	        confirmButtonColor: '#cf433f',
	        cancelButtonText: 'Cancelar',
	        cancelButtonColor: '#ccc',
	    }).then((result) => {
        	if(result.isConfirmed){
	            // Ajax Delete
	            let id_bitacora = jQuery(this).data('id');

	            jQuery.ajax({
	                url: URLactual + '/system/ajax/bitacoras_ajax.php',
	                type: 'POST',
	                dataType: 'json',
	                data: {
	                    action: 'delete',
	                    id_bitacora: id_bitacora
	                },
	                success: function(data){
	                    try{
	                        if(data['success']){
	                            Swal.fire({
	                                icon: 'success',
	                                title: 'Bitácora Eliminada',
	                                text: data['message'],
	                                confirmButtonText: 'Aceptar',
	                                confirmButtonColor: '#2BC521'
	                            });

	                            let id = '#id_bitacora_' + id_bitacora;

                                jQuery(id).remove();
	                        }else{
	                            Swal.fire({
	                                icon: 'error',
	                                title: 'Error Al Eliminar Bitácora',
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