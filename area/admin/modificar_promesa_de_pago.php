<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
    require_once('../../system/controllers/promesas_de_pago_controller.php');

    require_once('../../system/models/carteras_model.php');
    require_once('../../system/models/clientes_model.php');
    require_once('../../system/models/promesas_de_pago_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Promesa de Pago</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/promesas_de_pago.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_promesa'])){
		$Promesas_De_Pago_Controller = new Promesas_De_Pago_Controller();
		$Promesas_De_Pago_Model = $Promesas_De_Pago_Controller->select_by_id(strip_tags($_GET['id_promesa']));

		if($Promesas_De_Pago_Model != null){
			$Clientes_Controller = new Clientes_Controller();
			$Cliente = $Clientes_Controller->select_by_id($Promesas_De_Pago_Model->get_dui());

			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());
?>
	
	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Actualizar Promesa de Pago</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
			<a href="<?php echo PATH;?>/area/admin/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
			<a class="active">Actualizar Promesa de Pago</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Promesa de Pago</h2>

			<div class="f_item">
				<label>ID de promesa de pago: <span>*</span></label>

				<input type="number" id="id_promesa_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Promesas_De_Pago_Model->get_id_promesa(); ?>">
			</div>

            <div class="f_item">
				<label>Saldo total: <span>*</span></label>

				<input type="number" id="saldo_total_u" class="f_input_number " value="<?php echo $Promesas_De_Pago_Model->get_saldo_total(); ?>">
			</div>

            <div class="f_item">
				<label>Descuento: <span>*</span></label>

				<input type="number" id="descuento_u" class="f_input_number " value="<?php echo $Promesas_De_Pago_Model->get_descuento(); ?>">
			</div>

            <div class="f_item">
				<label>Total a pagar: <span>*</span></label>

				<input type="number" id="total_pagar_u" class="f_input_number" value="<?php echo $Promesas_De_Pago_Model->get_saldo_total(); ?>">
			</div>

            <div class="f_item">
				<label>Número de cuotas: <span>*</span></label>

				<input type="number" id="numero_cuotas_u" class="f_input_number" value="<?php echo $Promesas_De_Pago_Model->get_numero_cuotas(); ?>">
			</div>

            
            <div class="f_item">
				<label>Valor de cuota: <span>*</span></label>

				<input type="number" id="valor_cuotas_u" class="f_input_number" value="<?php echo $Promesas_De_Pago_Model->get_valor_cuotas(); ?>">
			</div>

            
            <div class="f_item">
				<label>Fecha de pago: <span>*</span></label>

				<?php
					$FechaPago = explode(' ', $Promesas_De_Pago_Model->get_fecha_pago());
				?>
				<input type="date" id="fecha_pago_u" class="f_input_date" value="<?php echo $FechaPago[0]; ?>" min="<?php echo $FechaHora[0]; ?>">
			</div>

			<div class="f_item">
				<label>DUI de cliente: <span>*</span></label>
                
                <input type="number" id="dui_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Promesas_De_Pago_Model->get_dui(); ?>">

			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_promesa_de_pago" class="f_input_btn" value="Actualizar Promesa de Pago">
			</div>			
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para id de promesa de pago: ' . $_GET['id_promesa'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de la promesa de pago.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>