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

	<title>Agregar Cliente</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/clientes.js"></script>

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
		<h1>Agregar Cliente</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
			<a class="active">Agregar Cliente</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Cliente</h2>

			<!-- Campos -->
			<div class="f_item">
				<label>DUI: <span>*</span></label>

				<input type="number" id="dui" class="f_input_number">
			</div>

			<div class="f_item">
				<label>ID cliente: <span>*</span></label>

				<input type="number" id="id_cliente" class="f_input_number">
			</div>

			<div class="f_item">
				<label>Nombre Completo: <span>*</span></label>

				<input type="text" id="nombre_completo" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Teléfono: <span>*</span></label>

				<input type="number" id="telefono" class="f_input_number">
			</div>

			<div class="f_item">
				<label>Estado: <span>*</span></label>

				<select id="estado" class="f_select">
					<option value="Localizado">Localizado</option>
					<option value="Ilocalizado">Ilocalizado</option>
				</select>
			</div>

			<div class="f_item">
				<label>ID de cartera:</label>

				<input type="number" id="id_cartera" class="f_input_number readonly" readonly="readonly" value="<?php echo $Cartera->get_id_cartera(); ?>">
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="button" id="btn_agregar_cliente" class="f_input_btn" value="Crear Cliente">
			</div>
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para ésta cartera de cliente: ' . $_GET['id_cartera'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de cartera';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>