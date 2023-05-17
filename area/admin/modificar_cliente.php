<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
    require_once('../../system/controllers/clientes_controller.php');
    require_once('../../system/models/clientes_model.php');
    require_once('../../system/models/carteras_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Cliente</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/clientes.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['dui'])){
		$Clientes_Controller = new Clientes_Controller();
		$Clientes_Model = $Clientes_Controller->select_by_id(strip_tags($_GET['dui']));

		if($Clientes_Model != null){
			// Recuperar datos de la cartera para mostrarlos
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Clientes_Model->get_id_cartera());
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Actualizar Cliente</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
			<a class="active">Actualizar Cliente</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Cliente</h2>

			<div class="f_item">
				<label>DUI: <span>*</span></label>

				<input type="number" id="dui_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Clientes_Model->get_dui(); ?>">
			</div>

            <div class="f_item">
				<label>ID de cliente: <span>*</span></label>

				<input type="number" id="id_cliente_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Clientes_Model->get_id_cliente(); ?>">
			</div>

			<div class="f_item">
				<label>Nombre Completo: <span>*</span></label>

				<input type="text" id="nombre_completo_u" class="f_input_text" value="<?php echo $Clientes_Model->get_nombre_completo(); ?>">
			</div>

			<div class="f_item">
				<label>Teléfono: <span>*</span></label>

				<input type="number" id="telefono_u" class="f_input_number" value="<?php echo $Clientes_Model->get_telefono(); ?>">
			</div>

			<div class="f_item">
				<label>Estado: <span>*</span></label>

				<select id="estado_u" class="f_select">
					<option value="Si" <?php echo $Clientes_Model->get_estado() == 'Si' ? 'selected' : ''; ?>>Localizado</option>
					<option value="No" <?php echo $Clientes_Model->get_estado() == 'No' ? 'selected' : ''; ?>>Ilocalizado</option>
				</select>
			</div>

			<div class="f_item">
				<label>ID de cartera: <span>*</span></label>
                
                <input type="number" id="id_cartera_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Clientes_Model->get_id_cartera(); ?>">
			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_cliente" class="f_input_btn" value="Actualizar Cliente">
			</div>			
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste dui: ' . $_GET['dui'];

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