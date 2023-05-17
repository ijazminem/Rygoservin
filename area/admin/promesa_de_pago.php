<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
	require_once('../../system/controllers/deudas_controller.php');
	require_once('../../system/controllers/gestiones_controller.php');
	require_once('../../system/controllers/proceso_judicial_controller.php');
	require_once('../../system/controllers/promesas_de_pago_controller.php');

	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');
	require_once('../../system/models/gestiones_model.php');
	require_once('../../system/models/proceso_judicial_model.php');
    require_once('../../system/models/deudas_model.php');
	require_once('../../system/models/promesas_de_pago_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Datos del Cliente</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/clientes.js"></script>
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/deudas.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');

	/**
	 * validar si existe el registro a mostrar
	*/
	if(isset($_GET['id_promesa'])){
		$Promesas_De_Pago_Controller = new Promesas_De_Pago_Controller();
		$Promesa = $Promesas_De_Pago_Controller->select_by_id($_GET['id_promesa']);

		if($Promesa != null){
			// Recuperar datos
            $Clientes_Controller = new Clientes_Controller();
            $Cliente = $Clientes_Controller->select_by_id($Promesa->get_dui());

			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());          
?>

	<section id="Title_Page">
		<h1>Datos de la deuda</h1>
	</section>
	
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
            <a href="<?php echo PATH; ?>/area/admin/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
            <a class="active">Promesa de pago</a>
			
		</div>
	</section>

	<section class="Content_Info">
		<div class="ci_content">
			<h2>Datos de la promesa de pago</h2>

			<div class="cic_items">
				<!-- Campos -->
				<div class="cic_item">
					<p><b>ID:</b> <?php echo $Promesa->get_id_promesa(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Saldo total:</b> $<?php echo $Promesa->get_saldo_total(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Descuento:</b> <?php echo $Promesa->get_descuento(); ?>%</p>
				</div>
				
				<div class="cic_item">
					<p><b>Total a pagar:</b> $<?php echo $Promesa->get_total_pagar(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Número de cuotas:</b> <?php echo $Promesa->get_numero_cuotas(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Valor de cuotas:</b> $<?php echo $Promesa->get_valor_cuotas(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Fecha de pago:</b> <?php echo $Promesa->get_fecha_pago(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Fecha de emisión:</b> <?php echo $Promesa->get_fecha_emision(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>DUI del cliente:</b> <?php echo $Promesa->get_dui(); ?></p>
				</div>

				</div>
			</div>
		</div>
	</section>

    
<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste id de promesa: ' . $_GET['id_promesa'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de la promesa.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>