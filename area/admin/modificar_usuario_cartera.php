<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
    require_once('../../system/controllers/usuario_cartera_controller.php');
    require_once('../../system/models/usuario_cartera_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Usuario Cartera</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/usuario_cartera.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_usuario_cartera'])){
		$Usuario_Cartera_Controller = new Usuario_Cartera_Controller();
		$Usuario_Cartera_Model = $Usuario_Cartera_Controller->select_by_id(strip_tags($_GET['id_usuario_cartera']));

		if($Usuario_Cartera_Model != null){
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Actualizar Cartera de Usuario</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a class="active">Actualizar Cartera Usuario</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Cartera de Usuario</h2>

			<div class="f_item">
				<label>ID: <span>*</span></label>

				<input type="number" id="id_usuario_cartera_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Usuario_Cartera_Model->get_id_usuario_cartera(); ?>">
			</div>
			
			<div class="f_item">
				<label>ID de usuario: <span>*</span></label>

				<input type="number" id="id_usuario_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Usuario_Cartera_Model->get_id_usuario(); ?>">
			</div>

	
			<div class="f_item">
				<label>ID cartera: <span>*</span></label>

				<select id="id_cartera_u" class="f_select">
					<?php
						$Carteras_Controller = new Carteras_Controller();
						$arrayCarteras = $Carteras_Controller->select_all();

						if($arrayCarteras != null && is_array($arrayCarteras)){
							for($i = 0; $i < sizeof($arrayCarteras); $i++){
								if($Carteras_Model->get_id_cartera() == $arrayCarteras[$i]['id_cartera']){
									echo '<option value="' . $arrayCarteras[$i]['id_cartera'] . '" selected>' . $arrayCarteras[$i]['nombre_cartera'] . '</option>';
								}else{
									echo '<option value="' . $arrayCarteras[$i]['id_cartera'] . '">' . $arrayCarteras[$i]['nombre_cartera'] . '</option>';
								}
							}
						}
					?>
				</select>
			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_usuario_cartera" class="f_input_btn" value="Actualizar Cartera">
			</div>			
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste id: ' . $_GET['id_usuario_cartera'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>