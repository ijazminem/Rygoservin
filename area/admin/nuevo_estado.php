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

	<title>Agregar Estado</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/estados.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_cartera'])){
		$Carteras_Controller = new Carteras_Controller();
		$Cartera = $Carteras_Controller->select_by_id(strip_tags($_GET['id_cartera']));

		if($Cartera != null){
?>

	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Agregar Estado</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_estados/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Estados</a>
			<a class="active">Agregar Estado</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Estado</h2>

			<!-- Campos -->
	
			<div class="f_item">
				<label>Descripción: <span>*</span></label>

				<textarea id="descripcion" class="f_textarea" rows="3"></textarea>
			</div>

			
			<div class="f_item">
				<label>Habilitado: <span>*</span></label>

				<select id="habilitado" class="f_select">
					<option value="Si">Habilitado</option>
					<option value="No">Deshabilitado</option>
				</select>
			</div>

			<div class="f_item">
				<label>ID de cartera:</label>

				<input type="number" id="id_cartera" class="f_input_number readonly" readonly="readonly" value="<?php echo $Cartera->get_id_cartera(); ?>">
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="button" id="btn_agregar_estado" class="f_input_btn" value="Crear Estado">
			</div>
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para este id de cartera: ' . $_GET['id_cartera'];

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