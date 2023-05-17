<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
	require_once('../../system/controllers/proceso_judicial_controller.php');

	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');
	require_once('../../system/models/proceso_judicial_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Agregar Archivo</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/bitacoras.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_proceso'])){
		$Proceso_Judicial_Controller = new Proceso_Judicial_Controller();
		$Proceso = $Proceso_Judicial_Controller->select_by_id(strip_tags($_GET['id_proceso']));

		if($Proceso != null){
			// Recuperar datos
            $Clientes_Controller = new Clientes_Controller();
            $Cliente = $Clientes_Controller->select_by_id($Proceso->get_dui());
            
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());
?>

	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Agregar Proceso Judicial</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
            <a href="<?php echo PATH; ?>/area/admin/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
            <a href="<?php echo PATH; ?>/area/admin/proceso_judicial/<?php echo $Proceso->get_id_proceso(); ?>">Proceso Judicial</a>
			<a class="active">Agregar Bitácora</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Bitácora</h2>

			<!-- Campos -->
		
			<div class="f_item">
				<label>Descripción: <span>*</span></label>

				<textarea id="descripcion" class="f_textarea" rows="5"></textarea>
			</div>

			<div class="f_item">
				<label>ID del proceso judicial:</label>

				<input type="number" id="id_proceso" class="f_input_number readonly" readonly="readonly" value="<?php echo $Proceso->get_id_proceso(); ?>">
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="button" id="btn_agregar_bitacora" class="f_input_btn" value="Agregar Bitacora">
			</div>
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste id de proceso judicial: ' . $_GET['id_proceso'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id del proceso judicial.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>