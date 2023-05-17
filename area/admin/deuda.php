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

	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');
	require_once('../../system/models/gestiones_model.php');
	require_once('../../system/models/proceso_judicial_model.php');
    require_once('../../system/models/deudas_model.php');
    
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
	 * validar si existe el registro a modificar
	*/
	if(isset($_GET['id_deuda'])){
		$Deudas_Controller = new Deudas_Controller();
		$Deuda = $Deudas_Controller->select_by_id($_GET['id_deuda']);

		if($Deuda != null){
			// Recuperar datos
            $Clientes_Controller = new Clientes_Controller();
            $Cliente = $Clientes_Controller->select_by_id($Deuda->get_dui());
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
            <a class="active">Deuda</a>
			
		</div>
	</section>

	<section class="Content_Info">
		<div class="ci_content">
			<h2>Datos de la deuda</h2>

			<div class="cic_items">
				<!-- Campos -->
				<div class="cic_item">
					<p><b>ID:</b> <?php echo $Deuda->get_id_deuda(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>DUI del cliente:</b> <?php echo $Deuda->get_dui(); ?></p>
				</div>
			</div>
		</div>
	</section>

    
<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste id de deuda: ' . $_GET['id_deuda'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de la deuda.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>