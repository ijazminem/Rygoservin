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

	<title>Panel Principal</title>

<?php
	require_once('header2.php');

	/**
	 * validar si existe el registro a modificar
	*/
	if(isset($_GET['id_cartera'])){
		$Carteras_Controller = new Carteras_Controller();
		$Cartera = $Carteras_Controller->select_by_id($_GET['id_cartera']);

		if($Cartera != null){
?>

	<section id="Title_Page">
		<h1>Datos de la Cartera</h1>
	</section>

	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a class="active"><?php echo $Cartera->get_nombre_cartera(); ?></a>
		</div>
	</section>
	
	<section id="Panel_Control">
		<div class="pc_opciones">
			<!-- items -->
			<div class="pco_item">
				<i class="fa-solid fa-users"></i>

				<h2>Deudores</h2>

				<div class="pcoi_btn">
					<a href="<?php echo PATH; ?>/area/admin/nuevo_cliente/<?php echo $Cartera->get_id_cartera(); ?>">Agregar Deudor</a>
				</div>

				<div class="pcoi_btn">
					<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Deudores</a>
				</div>

				<div class="pcoi_btn">
					<a href="#">Agregar por CSV</a>
				</div>
			</div>

			<div class="pco_item">
				<i class="fa-regular fa-rectangle-list"></i>

				<h2>Estados</h2>

				<div class="pcoi_btn">
					<a href="<?php echo PATH; ?>/area/admin/nuevo_estado/<?php echo $Cartera->get_id_cartera(); ?>">Agregar Estado</a>
				</div>

				<div class="pcoi_btn">
					<a href="<?php echo PATH; ?>/area/admin/lista_estados/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Estados</a>
				</div>
			</div>
			<!-- items -->
		</div>
	</section>

<?php
	}else{
			$error404 = 'No se encontró ningún resultado para éste id de cartera: ' . $_GET['id_cartera'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de la cartera';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>