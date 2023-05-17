<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
	require_once('../../system/controllers/estados_controller.php');
    require_once('../../system/controllers/gestiones_controller.php');
    require_once('../../system/controllers/sub_estados_controller.php');

    require_once('../../system/models/carteras_model.php');
    require_once('../../system/models/clientes_model.php');
    require_once('../../system/models/estados_model.php');
    require_once('../../system/models/gestiones_model.php');
    require_once('../../system/models/sub_estados_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Gestión</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/gestiones.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_gestion'])){
		$Gestiones_Controller = new Gestiones_Controller();
		$Gestiones_Model = $Gestiones_Controller->select_by_id(strip_tags($_GET['id_gestion']));

		if($Gestiones_Model != null){
			$Clientes_Controller = new Clientes_Controller();
			$Cliente = $Clientes_Controller->select_by_id($Gestiones_Model->get_dui());

			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());

			$Sub_Estados_Controller = new Sub_Estados_Controller();
			$Sub_Estado = $Sub_Estados_Controller->select_by_id($Gestiones_Model->get_id_sub_estado());
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Actualizar Gestión</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
			<a href="<?php echo PATH;?>/area/admin/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
			<a class="active">Actualizar Gestión</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Gestión</h2>

			<div class="f_item">
				<label>ID de gestión: <span>*</span></label>

				<input type="number" id="id_gestion_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Gestiones_Model->get_id_gestion(); ?>">
			</div>

            <div class="f_item">
				<label>Descripción: <span>*</span></label>

				<textarea id="descripcion_u" class="f_textarea" rows="5"><?php echo $Gestiones_Model->get_descripcion(); ?></textarea>
			</div>
	
			<div class="f_item">
				<label>Estado: <span>*</span></label>

				<select id="id_estado_u" class="f_select">
					<option value="">-- Seleccione un estado --</option>

					<?php
						$Estados_Controller = new Estados_Controller();
						$arrayEstados = $Estados_Controller->select_all_by_id_cartera_habilitado($Cartera->get_id_cartera(), 'Si');

						if(is_array($arrayEstados) && $arrayEstados != null){
							for($i = 0; $i < sizeof($arrayEstados); $i++){
								if($Sub_Estado->get_id_estado() == $arrayEstados[$i]['id_estado']){
									echo '<option value="' . $arrayEstados[$i]['id_estado'] . '" selected>' . $arrayEstados[$i]['descripcion'] . '</option>';
								}else{
									echo '<option value="' . $arrayEstados[$i]['id_estado'] . '">' . $arrayEstados[$i]['descripcion'] . '</option>';
								}
							}
						}
					?>
				</select>
			</div>
			
            <div class="f_item">
				<label>Sub Estado: <span>*</span></label>

				<select id="id_sub_estado_u" class="f_select">
					<option value="">-- Selecione un sub estado --</option>

					<?php
						$arraySubEstados = $Sub_Estados_Controller->select_all_by_id_estado($Sub_Estado->get_id_estado());

						if(is_array($arraySubEstados) && $arraySubEstados != null){
							for($i = 0; $i < sizeof($arraySubEstados); $i++){
								if($Sub_Estado->get_id_sub_estado() == $arraySubEstados[$i]['id_sub_estado']){
									echo '<option value="' . $arraySubEstados[$i]['id_sub_estado'] . '" selected>' . $arraySubEstados[$i]['descripcion'] . '</option>';
								}else{
									echo '<option value="' . $arraySubEstados[$i]['id_sub_estado'] . '">' . $arraySubEstados[$i]['descripcion'] . '</option>';
								}
							}
						}
					?>
				</select>
			</div>

            		
			<div class="f_item">
				<label>DUI de cliente: <span>*</span></label>

				<input type="number" id="dui_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Gestiones_Model->get_dui(); ?>">
			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_gestion" class="f_input_btn" value="Actualizar Gestión">
			</div>			
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste id: ' . $_GET['id_gestion'];

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