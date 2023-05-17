<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/bitacoras_controller.php');
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
	require_once('../../system/controllers/proceso_judicial_controller.php');

    require_once('../../system/models/bitacoras_model.php');
    require_once('../../system/models/carteras_model.php');
    require_once('../../system/models/clientes_model.php');
    require_once('../../system/models/proceso_judicial_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Archivo</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/bitacoras.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_bitacora'])){
		$Bitacoras_Controller = new Bitacoras_Controller();
		$Bitacoras_Model = $Bitacoras_Controller->select_by_id(strip_tags($_GET['id_bitacora']));

		if($Bitacoras_Model != null){
			// Recuperar datos
			$Proceso_Judicial_Controller = new Proceso_Judicial_Controller();
			$Proceso = $Proceso_Judicial_Controller->select_by_id($Bitacoras_Model->get_id_proceso());

            $Clientes_Controller = new Clientes_Controller();
            $Cliente = $Clientes_Controller->select_by_id($Proceso->get_dui());
            
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Actualizar Bitácora</h1>
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
			<a class="active">Actualizar Bitácora</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Bitácora</h2>

            <div class="f_item">
				<label>ID de bitácora: <span>*</span></label>

				<input type="number" id="id_bitacora_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Bitacoras_Model->get_id_bitacora(); ?>">
			</div>

			<div class="f_item">
				<label>Descripción: <span>*</span></label>

				<textarea id="descripcion_u" class="f_textarea" rows="5"><?php echo $Bitacoras_Model->get_descripcion(); ?></textarea>
			</div>

			<div class="f_item">
				<label>ID de proceso: <span>*</span></label>
                
                <input type="number" id="id_proceso_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Bitacoras_Model->get_id_proceso(); ?>">

			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_bitacora" class="f_input_btn" value="Actualizar Bitácora">
			</div>			
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste id de bitácora: ' . $_GET['id_bitacora'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de la bitácora.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>