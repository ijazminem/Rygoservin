<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/usuarios_controller.php');
	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/usuarios_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Asignar usuario a cartera</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/usuario_cartera.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_usuario'])){
		$Usuarios_Controller = new Usuarios_Controller();
		$Usuario = $Usuarios_Controller->select_by_id(strip_tags($_GET['id_usuario']));

		if($Usuario != null){
?>

	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Asignar Usuario a Cartera</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a class="active">Asignar Usuario a Cartera</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Asignar Usuario a Cartera</h2>

			<!-- Campos -->
		
			<div class="f_item">
				<label>ID del usuario:</label>

				<input type="number" id="id_usuario" class="f_input_number readonly" readonly="readonly" value="<?php echo $Usuario->get_id_usuario(); ?>">
			</div>

			<div class="f_item">
				<label>Cartera: <span>*</span></label>

				<select id="id_cartera" class="f_select">
					<?php
						$Carteras_Controller = new Carteras_Controller();
						$arrayCarteras = $Carteras_Controller->select_all();

						if($arrayCarteras != null && is_array($arrayCarteras)){
							for($i = 0; $i < sizeof($arrayCarteras); $i++){
								echo '<option value="' . $arrayCarteras[$i]['id_cartera'] . '">' . $arrayCarteras[$i]['nombre_cartera'] . '</option>';
							}
						}
					?>
				</select>
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="button" id="btn_agregar_usuario_cartera" class="f_input_btn" value="Agregar Usuario">
			</div>
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste id de usuario: ' . $_GET['id_usuario'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id del usuario.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>