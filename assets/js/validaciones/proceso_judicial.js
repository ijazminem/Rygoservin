jQuery(document).ready(function(){
	/**
	 * expresiones regulares
	*/
	let regexDui = /^[0-9]{9}$/;

    /**
     * Variables generales para validación de datos
    */
    let v_descripcion = false;
    let v_dui = true;

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

    jQuery('#dui').change(function(){
		let info = comprobar_validaciones('#dui', regexDui);

		if(info == 'success'){
			v_dui = true;
		}else{
			v_dui = false;
			input_control('#dui', info);
		}
	});

    /**
     * Botón agregar proceso
    */
    jQuery('#btn_agregar_proceso').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!v_descripcion){
			input_control('#descripcion', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripción válida.<br>';
		}

		if(!v_dui){
			input_control('#dui', 'error');
			message += '<b>Id de proceso:</b> Debe seleccionar un DUI válido.<br>';
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
            button_control('#btn_agregar_proceso', 'desactivar', 'Agregando Proceso...');

            /**
             * Recuperación de datos
            */
            let descripcion = jQuery('#descripcion').val();
            let dui = jQuery('#dui').val();

            /**
             * Ajax
            */            
            jQuery.ajax({
                url: URLactual + '/system/ajax/proceso_judicial_ajax.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'insert',
                    descripcion: descripcion,
                    dui: dui
                },
                success: function(data){
                    try{
                        if(data['success']){
                            // Limpiar campos
                            jQuery('#descripcion').val('');

                            // Establecer borde por defecto
                            input_control('#descripcion', 'empty');
                            input_control('#dui', 'empty');
                            
							v_descripcion = false;

							Swal.fire({
								icon: 'success',
								title: 'Proceso Creado',
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
            
                	button_control('#btn_agregar_proceso', 'activar', 'Agregar Proceso');
				},                
                error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_proceso', 'activar', 'Agregar Proceso');
				}
			});
		}
	});

    /**
     * update
    */
    let vu_id_proceso = true;
    let vu_descripcion = true;
    let vu_dui = true;

    jQuery('#id_proceso_u').keyup(function(){
        let info = comprobar_validaciones('#id_proceso_u');
        
        if(info == 'success'){
            vu_id_proceso = true;
        }else{
            vu_id_proceso = false;
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

    jQuery('#dui_u').change(function(){
        let info = comprobar_validaciones('#dui_u', regexDui);

        if(info == 'success'){
            vu_dui = true;
        }else{
            vu_dui = false;
            input_control('#dui_u', info);
        }
    });

    /**
     * botón actualizar
    */
    jQuery('#btn_actualizar_proceso').click(function(){
        let message = '';

        if(!vu_id_proceso){
            message += '<b>Id Proceso:</b> El Id del proceso no es válido, recarga esta página para volver a cargarlo.<br>';
        }
        
		if(!vu_descripcion){
			input_control('#descripcion_u', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripcion válida.<br>';
		}

		if(!vu_dui){
			input_control('#dui_u', 'error');
			message += '<b>DUI:</b> Debe seleccionar un DUI válido.<br>';
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
            button_control('#btn_actualizar_proceso', 'desactivar', 'Actualizando proceso...');

            let id_proceso = jQuery('#id_proceso_u').val();
            let descripcion = jQuery('#descripcion_u').val();
            let dui = jQuery('#dui_u').val();

            // Ajax
            jQuery.ajax({
				url: URLactual + '/system/ajax/proceso_judicial_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_proceso: id_proceso,
                    descripcion: descripcion,
                    dui: dui
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#id_proceso_u', 'empty');
							input_control('#descripcion_u', 'empty');
							input_control('#dui_u', 'empty');
							
							Swal.fire({
								icon: 'success',
								title: 'Proceso Actualizado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Proceso',
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

					button_control('#btn_actualizar_proceso', 'activar', 'Actualizar Proceso');
				},
                error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_proceso', 'activar', 'Actualizar Proceso');
				}
			});
        }
    });

    /**
     * delete
    */
	jQuery('.btn_eliminar_proceso').click(function(){
    	Swal.fire({
	        icon: 'warning',
	        title: '¿Está seguro que quiere eliminar a este proceso judicial?',
	        text: 'Si elimina este proceso judicial, también se eliminarán todos los datos relacionados a el.',
	        showCancelButton: true,
	        confirmButtonText: 'Eliminar',
	        confirmButtonColor: '#cf433f',
	        cancelButtonText: 'Cancelar',
	        cancelButtonColor: '#ccc',
	    }).then((result) => {
	        if(result.isConfirmed){
	            // Ajax Delete
	            let id_proceso = jQuery(this).data('id');

	            jQuery.ajax({
	                url: URLactual + '/system/ajax/proceso_judicial_ajax.php',
	                type: 'POST',
	                dataType: 'json',
	                data: {
	                    action: 'delete',
	                    id_proceso: id_proceso
	                },
	                success: function(data){
	                    try{
	                        if(data['success']){
	                            Swal.fire({
	                                icon: 'success',
	                                title: 'Proceso Eliminado',
	                                text: data['message'],
	                                confirmButtonText: 'Aceptar',
	                                confirmButtonColor: '#2BC521'
	                            });

	                            let id = '#id_proceso_' + id_proceso;

                                jQuery(id).remove();
	                        }else{
	                            Swal.fire({
	                                icon: 'error',
	                                title: 'Error Al Eliminar Proceso',
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
