<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
	require_once('../../system/controllers/estados_controller.php');
	//require_once('../../system/controllers/sub_estados_controller.php');

	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Agregar Gestión</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/gestiones.js"></script>

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
		<h1>Agregar Gestión</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
			<a href="<?php echo PATH;?>/area/admin/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
			<a class="active">Agregar Gestión</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Gestión</h2>

			<!-- Campos -->
	
			<div class="f_item">
				<label>Descripción: <span>*</span></label>

				<textarea id="descripcion" class="f_textarea" rows="5"></textarea>
			</div>

			<div class="f_item">
				<label>Estado: <span>*</span></label>

				<select id="id_estado" class="f_select">
					<option value="">-- Seleccione un estado --</option>

					<?php
						$Estados_Controller = new Estados_Controller();
						$arrayEstados = $Estados_Controller->select_all_by_id_cartera_habilitado($Cartera->get_id_cartera(), 'Si');

						if(is_array($arrayEstados) && $arrayEstados != null){
							for($i = 0; $i < sizeof($arrayEstados); $i++){
								echo '<option value="' . $arrayEstados[$i]['id_estado'] . '">' . $arrayEstados[$i]['descripcion'] . '</option>';
							}
						}
					?>
				</select>
			</div>

			<div class="f_item">
				<label>Sub Estado: <span>*</span></label>

				<select id="id_sub_estado" class="f_select">
					<option value="">-- Seleccione un sub estado --</option>
				</select>
			</div>

			<div class="f_item">
				<label>DUI del cliente:</label>

				<input type="number" id="dui" class="f_input_number readonly" readonly="readonly" value="<?php echo $Cliente->get_dui(); ?>">
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="button" id="btn_agregar_gestion" class="f_input_btn" value="Crear Gestión">
			</div>
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para este dui: ' . $_GET['dui'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el dui del cliente.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>