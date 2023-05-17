<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
    require_once('../../system/controllers/estados_controller.php');

    require_once('../../system/models/carteras_model.php');
    require_once('../../system/models/estados_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Estado</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/estados.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_estado'])){
		$Estados_Controller = new Estados_Controller();
		$Estados_Model = $Estados_Controller->select_by_id(strip_tags($_GET['id_estado']));

		if($Estados_Model != null){
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Estados_Model->get_id_cartera());
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Actualizar Estado</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_estados/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Estados</a>
			<a class="active">Actualizar Estado</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Estado</h2>

			<div class="f_item">
				<label>ID de estado: <span>*</span></label>

				<input type="number" id="id_estado_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Estados_Model->get_id_estado(); ?>">
			</div>

            <div class="f_item">
				<label>Descripción: <span>*</span></label>

				<textarea id="descripcion_u" class="f_textarea" rows="5"><?php echo $Estados_Model->get_descripcion(); ?></textarea>
			</div>
	
			<div class="f_item">
				<label>Habilitado: <span>*</span></label>

				<select id="habilitado_u" class="f_select">
					<option value="Si" <?php echo $Estados_Model->get_habilitado() == 'Si' ? 'selected' : ''; ?>>Habilitado</option>
					<option value="No" <?php echo $Estados_Model->get_habilitado() == 'No' ? 'selected' : ''; ?>>Deshabilitado</option>
				</select>
			</div>
            

            		
			<div class="f_item">
				<label>ID de Cartera: <span>*</span></label>

				<input type="number" id="id_cartera_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Estados_Model->get_id_cartera(); ?>">
			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_estado" class="f_input_btn" value="Actualizar Estado">
			</div>			
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste id: ' . $_GET['id_estado'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>