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

	<title>Agregar Usuario</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/usuarios.js"></script>

<?php
	require_once('header2.php');
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Agregar Usuario</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_usuarios">Lista de Usuarios</a>
			<a class="active">Agregar Usuario</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Usuario</h2>

			<div class="f_item">
				<label>Nombre Completo: <span>*</span></label>

				<input type="text" id="nombre_completo" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Correo: <span>*</span></label>

				<input type="email" id="correo" class="f_input_email">
			</div>

			<div class="f_item">
				<label>Contraseña: <span>*</span></label>

				<input type="password" id="contrasena" class="f_input_password">

				<div class="see_pass">
					<i class="fa-regular fa-eye"></i>
					<i class="fa-regular fa-eye-slash fa-eye-dn"></i>
				</div>
			</div>

			<div class="f_item">
				<label>Habilitado: <span>*</span></label>

				<select id="habilitado" class="f_select">
					<option value="Si">Habilitado</option>
					<option value="No">Deshabilitado</option>
				</select>
			</div>

			<div class="f_item">
				<label>Tipo de Usuario: <span>*</span></label>

				<select id="id_tipo_usuario" class="f_select">
					<?php
						$Tipos_Usuarios_Controller = new Tipos_Usuarios_Controller();
						$arrayTiposUsuarios = $Tipos_Usuarios_Controller->select_all();

						if($arrayTiposUsuarios != null && is_array($arrayTiposUsuarios)){
							for($i = 0; $i < sizeof($arrayTiposUsuarios); $i++){
								echo '<option value="' . $arrayTiposUsuarios[$i]['id_tipo_usuario'] . '">' . $arrayTiposUsuarios[$i]['nombre_tipo_usuario'] . '</option>';
							}
						}
					?>
				</select>
			</div>

			<div class="f_btn">
				<input type="button" id="btn_agregar_usuario" class="f_input_btn" value="Crear Usuario">
			</div>
		</form>
	</section>

<?php
	/**
	 * footer
	*/
	require_once('footer.php');
?>