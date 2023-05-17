<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
    require_once('../../system/models/carteras_model.php');


	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Agregar Cartera</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/carteras.js"></script>

<?php
	require_once('header2.php');
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Agregar Cartera</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a class="active">Agregar Cartera</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Cartera</h2>

			<div class="f_item">
				<label>Nombre de Cartera: <span>*</span></label>

				<input type="text" id="nombre_cartera" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Descripción: <span>*</span></label>

				<textarea id="descripcion" class="f_textarea" rows="5"></textarea>
			</div>

			<div class="f_item">
				<label>Correo de contacto: <span>*</span></label>

				<input type="email" id="correo_contacto" class="f_input_email">
			</div>


			<div class="f_btn">
				<input type="button" id="btn_agregar_cartera" class="f_input_btn" value="Crear Cartera">
			</div>
		</form>
	</section>

<?php
	/**
	 * footer
	*/
	require_once('footer.php');
?>