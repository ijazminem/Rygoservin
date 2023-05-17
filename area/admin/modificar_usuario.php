<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/tipos_usuarios_controller.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Usuario</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/usuarios.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_usuario'])){
		$Usuarios_Controller = new Usuarios_Controller();
		$Usuario_Model = $Usuarios_Controller->select_by_id(strip_tags($_GET['id_usuario']));

		if($Usuario_Model != null){
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Actualizar Usuario</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_usuarios">Lista de Usuarios</a>
			<a class="active">Actualizar Usuario</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Usuario</h2>

			<div class="f_item">
				<label>Id Usuario: <span>*</span></label>

				<input type="text" id="id_usuario_u" class="f_input_text readonly" readonly="readonly" value="<?php echo $Usuario_Model->get_id_usuario(); ?>">
			</div>

			<div class="f_item">
				<label>Nombre Completo: <span>*</span></label>

				<input type="text" id="nombre_completo_u" class="f_input_text" value="<?php echo $Usuario_Model->get_nombre_completo(); ?>">
			</div>

			<div class="f_item">
				<label>Correo: <span>*</span></label>

				<input type="email" id="correo_u" class="f_input_email" value="<?php echo $Usuario_Model->get_correo(); ?>">
			</div>

			<div class="f_item">
				<label>Contraseña: </label>

				<input type="password" id="contrasena_u" class="f_input_password">

				<div class="see_pass">
					<i class="fa-regular fa-eye"></i>
					<i class="fa-regular fa-eye-slash fa-eye-dn"></i>
				</div>
			</div>

			<div class="f_item">
				<label>Habilitado: <span>*</span></label>

				<select id="habilitado_u" class="f_select">
					<option value="Si" <?php echo $Usuario_Model->get_habilitado() == 'Si' ? 'selected' : ''; ?>>Habilitado</option>
					<option value="No" <?php echo $Usuario_Model->get_habilitado() == 'No' ? 'selected' : ''; ?>>Deshabilitado</option>
				</select>
			</div>

			<div class="f_item">
				<label>Tipo de Usuario: <span>*</span></label>

				<select id="id_tipo_usuario_u" class="f_select">
					<?php
						$Tipos_Usuarios_Controller = new Tipos_Usuarios_Controller();
						$arrayTiposUsuarios = $Tipos_Usuarios_Controller->select_all();

						if($arrayTiposUsuarios != null && is_array($arrayTiposUsuarios)){
							for($i = 0; $i < sizeof($arrayTiposUsuarios); $i++){
								if($Usuario_Model->get_id_tipo_usuario() == $arrayTiposUsuarios[$i]['id_tipo_usuario']){
									echo '<option value="' . $arrayTiposUsuarios[$i]['id_tipo_usuario'] . '" selected>' . $arrayTiposUsuarios[$i]['nombre_tipo_usuario'] . '</option>';
								}else{
									echo '<option value="' . $arrayTiposUsuarios[$i]['id_tipo_usuario'] . '">' . $arrayTiposUsuarios[$i]['nombre_tipo_usuario'] . '</option>';
								}
							}
						}
					?>
				</select>
			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_usuario" class="f_input_btn" value="Actualizar Usuario">
			</div>			
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste id de usuario: ' . $_GET['id_usuario'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id del usuario';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>