jQuery(document).ready(function(){    
    /**
     * Variables generales para validación de datos
    */
    let v_nombre = false;
    let v_descripcion = false;
    let v_archivo = false;
    let v_id_proceso = true;

    /**
     * Validación de datos
    */
    jQuery('#nombre').keyup(function(){
        let info = comprobar_validaciones('#nombre', null, false, 8);

        if(info == 'success'){
            v_nombre = true;
        }else{
            v_nombre = false;
        }

        input_control('#nombre', info);
    });


    jQuery('#descripcion').keyup(function(){
        let info = comprobar_validaciones("#descripcion", null, false, 8);

        if(info == 'success'){
            v_descripcion = true;
        }else{
            v_descripcion = false;
        }

        input_control('#descripcion', info);
    });

    /**
     * archivo
    */
    jQuery('#archivo').change(function(){
        let info = comprobar_validaciones('#archivo');

        if(info == 'success'){
            v_archivo = true;
        }else{
            v_archivo = false;
        }

        input_control('#archivo', info);
    });

    /**
     * id_proceso
    */
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
     * Botón agregar archivo
    */
    jQuery('#btn_agregar_archivo').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!v_nombre){
			input_control('#nombre', 'error');
			message += '<b>Nombre:</b> Debe agregar un nombre válido.<br>';
		}

		if(!v_descripcion){
			input_control('#descripcion', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripción válida.<br>';
		}

        if(!v_archivo){
            input_control('#archivo', 'error');
            message += '<b>Archivo:</b> Debe agregar una archivo válido.<br>';
        }

		if(!v_id_proceso){
			input_control('#id_proceso', 'error');
			message += '<b>Id de proceso:</b> Debe seleccionar un id de archivo válido.<br>';
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
            button_control('#btn_agregar_archivo', 'desactivar', 'Agregando Archivo...');

            /**
             * Recuperación de datos
            */
            let formData = jQuery('#Form_Archivos')[0];
            let data = new FormData(formData);

            /**
             * Ajax
            */            
            jQuery.ajax({
                url: URLactual + '/system/ajax/archivos_ajax.php',
                type: 'POST',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: data,
                success: function(data){
                    try{
                        if(data['success']){
                            // Limpiar campos
                            jQuery('#nombre').val('');
                            jQuery('#descripcion').val('');
                            jQuery('#archivo').val('');

                            // Establecer borde por defecto
                            input_control('#nombre', 'empty');
                            input_control('#descripcion', 'empty');
                            input_control('#archivo', 'empty');
                            input_control('#id_proceso', 'empty');
                            
                            v_nombre = false;
							v_descripcion = false;
                            v_archivo = false;

							Swal.fire({
								icon: 'success',
								title: 'Archivo Creado',
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

                    button_control('#btn_agregar_archivo', 'activar', 'Agregar Archivo');

                    console.log(data);
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

					button_control('#btn_agregar_archivo', 'activar', 'Agregar Archivo');
				}
			});
		}
	});
    
    /**
     * update
    */
    let vu_id_archivo = true;
    let vu_nombre = true;
    let vu_descripcion = true;
    let vu_id_proceso = true;
    
    jQuery('#id_archivo_u').change(function(){
        let info = comprobar_validaciones('#id_archivo_u');

        if(info == 'success'){
            vu_id_archivo = true;    
        }else{
            vu_id_archivo = false;
        }
    });

    jQuery('#nombre_u').keyup(function(){
        let info = comprobar_validaciones('#nombre_u', null, false, 8);
        
        if(info == 'success'){
            vu_nombre = true;    
        }else{
            vu_nombre = false;
        }

        input_control('#nombre_u', info);
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
    jQuery('#btn_actualizar_archivo').click(function(){
        let message = '';

        if(!vu_id_archivo){
            message += '<b>Id Archivo:</b> El Id del archivo no es válido, recarga esta página para volver a cargarlo.<br>';
        }
        
		if(!vu_nombre){
			input_control('#nombre_u', 'error');
			message += '<b>Nombre:</b> Debe agregar un nombre válido.<br>';
		}
        
		if(!vu_descripcion){
			input_control('#descripcion_u', 'error');
			message += '<b>Descripción:</b> Debe agregar una descripcion válida.<br>';
		}

		if(!vu_id_proceso){
			input_control('#id_proceso_u', 'error');
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
            button_control('#btn_actualizar_archivo', 'desactivar', 'Actualizando archivo...');

            let id_archivo = jQuery('#id_archivo_u').val();
            let nombre = jQuery('#nombre_u').val();
            let descripcion = jQuery('#descripcion_u').val();
            let id_proceso = jQuery('#id_proceso_u').val();

            // Ajax
            jQuery.ajax({
				url: URLactual + '/system/ajax/archivos_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_archivo: id_archivo,
					nombre: nombre,
                    descripcion: descripcion,
                    id_proceso: id_proceso	
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
                            input_control('#id_archivo_u', 'empty');
                            input_control('#nombre_u', 'empty');
                            input_control('#descripcion_u', 'empty');
                            input_control('#id_proceso_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Archivo Actualizado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Archivo',
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

					button_control('#btn_actualizar_archivo', 'activar', 'Actualizar Archivo');
				},
                error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_archivo', 'activar', 'Actualizar Archivo');
				}
			});
        }
    });

    /**
     * delete
    */
    jQuery('.btn_eliminar_archivo').click(function(){
        Swal.fire({
            icon: 'warning',
            title: '¿Está seguro que quiere eliminar a éste archivo?',
            text: 'Si elimina éste archivo, también se eliminarán todos los datos relacionados a él.',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#cf433f',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#ccc',
        }).then((result) => {
            if(result.isConfirmed){
                // Ajax Delete
                let id_archivo = jQuery(this).data('id');

                jQuery.ajax({
                    url: URLactual + '/system/ajax/archivos_ajax.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'delete',
                        id_archivo: id_archivo
                    },
                    success: function(data){
                        try{
                            if(data['success']){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Archivo Eliminado',
                                    text: data['message'],
                                    confirmButtonText: 'Aceptar',
                                    confirmButtonColor: '#2BC521'
                                });

                                let id = '#id_archivo_' + id_archivo;

                                jQuery(id).remove();
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error Al Eliminar Archivo',
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