<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/tipos_usuarios_controller.php');
    require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/models/carteras_model.php');



	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Cartera</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/carteras.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_cartera'])){
		$Carteras_Controller = new Carteras_Controller();
		$Carteras_Model = $Carteras_Controller->select_by_id(strip_tags($_GET['id_cartera']));

		if($Carteras_Model != null){
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Actualizar Cartera</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a class="active">Actualizar Cartera</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Cartera</h2>

			<div class="f_item">
				<label>ID de cartera: <span>*</span></label>

				<input type="text" id="id_cartera_u" class="f_input_text readonly" readonly="readonly" value="<?php echo $Carteras_Model->get_id_cartera(); ?>">
			</div>

			<div class="f_item">
				<label>Nombre de Cartera: <span>*</span></label>

				<input type="text" id="nombre_cartera_u" class="f_input_text" value="<?php echo $Carteras_Model->get_nombre_cartera(); ?>">
			</div>

            <div class="f_item">
				<label>Descripción: <span>*</span></label>

				<textarea id="descripcion_u" class="f_textarea" rows="5"><?php echo $Carteras_Model->get_descripcion(); ?></textarea>
			</div>

            <div class="f_item">
				<label>Correo: <span>*</span></label>

				<input type="email" id="correo_contacto_u" class="f_input_email" value="<?php echo $Carteras_Model->get_correo_contacto(); ?>">
			</div>
			<div class="f_btn">
				<input type="button" id="btn_actualizar_cartera" class="f_input_btn" value="Actualizar Cartera">
			</div>			
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste id de cartera: ' . $_GET['id_cartera'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de la cartera.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>