jQuery(document).ready(function(){
	jQuery('#email').keyup(function(e){
		if(e.which == 13){
			login();
		}
	});

	jQuery('#pass').keyup(function(e){
		if(e.which == 13){
			login();
		}
	});

	jQuery('#login').click(function(){
		login();
	});
});

function login(){
	let email = jQuery('#email').val();
	let pass = jQuery('#pass').val();

	jQuery.ajax({
		url: URLactual + '/system/ajax/sesion_usuario_ajax.php',
		type: 'POST',
		dataType: 'json',
		data: {
			action: 'login',
			email: email,
			pass: pass
		},
		success: function(data){
			try{
				if(data['success']){
					window.location.href = window.location.href;
				}else{
					Swal.fire({
						icon: 'warning',
						title: 'Inicio de Sesión',
						html: data['message'],
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});
				}
			}catch(e){
				Swal.fire({
					icon: 'error',
					title: 'Error De Conexión',
					text: 'Revise su conexión a internet e inténtelo de nuevo.',
					confirmButtonText: 'Aceptar',
					confirmButtonColor: '#2BC521'
				});
			}
		},
		error: function(data){
			Swal.fire({
				icon: 'error',
				title: 'Error Del Servidor',
				text: data,
				confirmButtonText: 'Aceptar',
				confirmButtonColor: '#2BC521'
			});
		}
	});
}