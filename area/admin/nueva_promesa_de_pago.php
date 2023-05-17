<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');

	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Agregar Promesa de Pago</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/promesas_de_pago.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['dui'])){
		$Clientes_Controller = new Clientes_Controller();
		$Cliente = $Clientes_Controller->select_by_id(strip_tags($_GET['dui']));

		if($Cliente != null){
			// Recuperar datos
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());
?>

	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Agregar Promesa de Pago</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
			<a href="<?php echo PATH;?>/area/admin/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
			<a class="active">Agregar Promesa de Pago</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Promesa de Pago</h2>

			<!-- Campos -->
			<div class="f_item">
				<label>Saldo Total: <span>*</span></label>

				<input type="number" id="saldo_total" class="f_input_number">
			</div>

			<div class="f_item">
				<label>Descuento: <span>*</span></label>

				<input type="number" id="descuento" class="f_input_number">
			</div>

			<div class="f_item">
				<label>Total a Pagar: <span>*</span></label>

				<input type="number" id="total_pagar" class="f_input_number">
			</div>

			<div class="f_item">
				<label>Número de Cuotas: <span>*</span></label>

				<input type="number" id="numero_cuotas" class="f_input_number">
			</div>

			<div class="f_item">
				<label>Valor de las Cuotas: <span>*</span></label>

				<input type="number" id="valor_cuotas" class="f_input_number">
			</div>

			<div class="f_item">
				<label>Fecha de Pago: <span>*</span></label>

				<input type="date" id="fecha_pago" class="f_input_date" min="<?php echo $FechaHora[0]; ?>">
			</div>

			<div class="f_item">
				<label>DUI del Cliente: <span>*</span></label>

				<input type="number" id="dui" class="f_input_number readonly" readonly="readonly" value="<?php echo $Cliente->get_dui(); ?>">
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="button" id="btn_agregar_promesa_de_pago" class="f_input_btn" value="Crear Promesa">
			</div>
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste dui del cliente: ' . $_GET['dui'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el dui del cliente';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>