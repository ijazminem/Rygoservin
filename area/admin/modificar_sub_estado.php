<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/estados_controller.php');
    require_once('../../system/controllers/sub_estados_controller.php');

    require_once('../../system/models/carteras_model.php');
    require_once('../../system/models/estados_model.php');
    require_once('../../system/models/sub_estados_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Cliente</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/sub_estados.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_sub_estado'])){
		$Sub_Estados_Controller = new Sub_Estados_Controller();
		$Sub_Estados_Model = $Sub_Estados_Controller->select_by_id(strip_tags($_GET['id_sub_estado']));

		if($Sub_Estados_Model != null){
			$Estados_Controller = new Estados_Controller();
			$Estado = $Estados_Controller->select_by_id($Sub_Estados_Model->get_id_estado());

			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Estado->get_id_cartera());
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Actualizar Sub-Estado</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_estados/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Estados</a>
			<a href="<?php echo PATH; ?>/area/admin/estado/<?php echo $Estado->get_id_estado(); ?>">Estado #<?php echo $Estado->get_id_estado(); ?></a>
			<a class="active">Actualizar Sub-Estado</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Sub-Estado</h2>

			<div class="f_item">
				<label>ID de Sub-Estado: <span>*</span></label>

				<input type="number" id="id_sub_estado_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Sub_Estados_Model->get_id_sub_estado(); ?>">
			</div>

			<div class="f_item">
				<label>Descripción: <span>*</span></label>

				<textarea id="descripcion_u" class="f_textarea" rows="5"><?php echo $Sub_Estados_Model->get_descripcion(); ?></textarea>
			</div>

	

			<div class="f_item">
				<label>Habilitado: <span>*</span></label>

				<select id="habilitado_u" class="f_select">
					<option value="Si" <?php echo $Sub_Estados_Model->get_habilitado() == 'Si' ? 'selected' : ''; ?>>Si</option>
					<option value="No" <?php echo $Sub_Estados_Model->get_habilitado() == 'No' ? 'selected' : ''; ?>>No</option>
				</select>
			</div>

			<div class="f_item">
				<label>ID de estado: <span>*</span></label>
                
                <input type="number" id="id_estado_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Sub_Estados_Model->get_id_estado(); ?>">

			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_subestado" class="f_input_btn" value="Actualizar Sub-Estado">
			</div>			
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste sub-estado: ' . $_GET['id_sub_estado'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el dui del sub-estado.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>