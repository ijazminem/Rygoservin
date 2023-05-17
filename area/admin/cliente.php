<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
	require_once('../../system/controllers/deudas_controller.php');
	require_once('../../system/controllers/estados_controller.php');
	require_once('../../system/controllers/gestiones_controller.php');
	require_once('../../system/controllers/proceso_judicial_controller.php');
	require_once('../../system/controllers/promesas_de_pago_controller.php');
	require_once('../../system/controllers/sub_estados_controller.php');

	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');
	require_once('../../system/models/estados_model.php');
	require_once('../../system/models/gestiones_model.php');
	require_once('../../system/models/proceso_judicial_model.php');
	require_once('../../system/models/promesas_de_pago_model.php');
	require_once('../../system/models/sub_estados_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Datos del Cliente</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/clientes.js"></script>
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/deudas.js"></script>
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/gestiones.js"></script>
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/proceso_judicial.js"></script>
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/promesas_de_pago.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');

	/**
	 * validar si existe el registro a modificar
	*/
	if(isset($_GET['dui'])){
		$Clientes_Controller = new Clientes_Controller();
		$Cliente = $Clientes_Controller->select_by_id($_GET['dui']);

		if($Cliente != null){
			// Recuperar datos
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());
?>

	<section id="Title_Page">
		<h1>Datos del Cliente</h1>
	</section>
	
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
			<a class="active"><?php echo $Cliente->get_nombre_completo(); ?></a>
		</div>
	</section>

	<section class="Content_Info">
		<div class="ci_content">
			<h2>Datos del Cliente</h2>

			<div class="cic_items">
				<!-- Campos -->
				<div class="cic_item">
					<p><b>DUI:</b> <?php echo $Cliente->get_dui(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>ID Cliente:</b> <?php echo $Cliente->get_id_cliente(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Nombre Completo:</b> <?php echo $Cliente->get_nombre_completo(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Teléfono:</b> <?php echo $Cliente->get_telefono(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Estado:</b> <?php echo $Cliente->get_estado(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Fecha Registro:</b> <?php echo $Cliente->get_fecha_registro(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>ID Cartera:</b> <?php echo $Cliente->get_id_cartera(); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="Content_Table">
		<!-- Table -->
		<div class="ct_table">
			<div class="ct_header">
				<div>
					<h2>Lista de Deudas</h2>
				</div>

				<div>
					<a href="<?php echo PATH; ?>/area/admin/nueva_deuda/<?php echo $Cliente->get_dui(); ?>">Agregar Deuda</a>
				</div>
			</div>

			<table id="Tabla_Deudas" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Creado Por</th>
						<th>Fecha de Registro</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Deudas_Controller = new Deudas_Controller();
						$arrayDeudas = $Deudas_Controller->select_all_by_dui($Cliente->get_dui());

						if(is_array($arrayDeudas) && $arrayDeudas != null){
							for($i = 0; $i < sizeof($arrayDeudas); $i++){
								echo '<tr id="id_deuda_' . $arrayDeudas[$i]['id_deuda'] . '">';
								echo '<td>' . $arrayDeudas[$i]['id_deuda'] . '</td>';

								$Usuario = $Usuarios_Controller->select_by_id($arrayDeudas[$i]['id_usuario']);

								if($Usuario != null){
									echo '<td>' . $Usuario->get_nombre_completo() . '</td>';
								}else{
									echo '<td></td>';
								}
								
								echo '<td>' . $arrayDeudas[$i]['fecha_registro'] . '</td>';
								echo '<td class="content_opt">';
								echo '<a href="' . PATH . '/area/admin/modificar_deuda/' . $arrayDeudas[$i]['id_deuda'] . '" class="to_btn to_btn_edit to_btn_rl" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>';
								echo '<a href="' . PATH . '/area/admin/deuda/' . $arrayDeudas[$i]['id_deuda'] . '" class="to_btn to_btn_see" title="Ver"><i class="fa-solid fa-circle-info"></i></a>';
								echo '<a class="to_btn to_btn_delete btn_eliminar_deuda to_btn_rr" data-id="' . $arrayDeudas[$i]['id_deuda'] . '" title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>';
								echo '</td>';
								echo '</tr>';
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</section>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			/**
			 * DataTables
			*/
			jQuery('#Tabla_Deudas').DataTable({
				language: {
					processing:     "Procesando...",
					search:         "Buscar :",
					lengthMenu:     "Mostrar _MENU_ elementos",
					info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
					infoEmpty:      "Mostrando 0 a 0 de 0 elementos",
					infoFiltered:   "(Filtrado de _MAX_ total de elementos)",
					infoPostFix:    "",
					loadingRecords: "Cargando...",
					zeroRecords:    "Sin resultados encontrados",
					emptyTable:     "No hay datos disponibles en la tabla",
					paginate: {
						first:      "Primero",
						previous:   "<i class=\"fa-solid fa-angle-left\"></i>",
						next:       "<i class=\"fa-solid fa-angle-right\"></i>",
						last:       "Último"
					},
					aria: {
						sortAscending:  ": habilitar para ordenar la columna en orden ascendente",
						sortDescending: ": habilitar para ordenar la columna en orden descendente"
					}
			    }
			});
		});
	</script>

	<section class="Content_Table">
		<!-- Table -->
		<div class="ct_table">
			<div class="ct_header">
				<div>
					<h2>Lista de Gestiones</h2>
				</div>

				<div>
					<a href="<?php echo PATH; ?>/area/admin/nueva_gestion/<?php echo $Cliente->get_dui(); ?>">Agregar Gestión</a>
				</div>
			</div>

			<table id="Tabla_Gestiones" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Descripción</th>
						<th>Estado</th>
						<th>Creado Por</th>
						<th>Fecha de Registro</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Gestiones_Controller = new Gestiones_Controller();
						$arrayGestion = $Gestiones_Controller->select_all_by_dui($Cliente->get_dui());

						$Sub_Estados_Controller = new Sub_Estados_Controller();
						$Estados_Controller = new Estados_Controller();

						if(is_array($arrayGestion) && $arrayGestion != null){
							for($i = 0; $i < sizeof($arrayGestion); $i++){
								echo '<tr id="id_gestion_' . $arrayGestion[$i]['id_gestion'] . '">';
								echo '<td>' . $arrayGestion[$i]['id_gestion'] . '</td>';
								echo '<td>' . $arrayGestion[$i]['descripcion'] . '</td>';

								$Sub_Estado = $Sub_Estados_Controller->select_by_id($arrayGestion[$i]['id_sub_estado']);
								$Estado = $Estados_Controller->select_by_id($Sub_Estado->get_id_estado());

								echo '<td>' . $Estado->get_descripcion() . ' <i class="fa-solid fa-arrow-right-long" style="margin: 0 15px; font-size: 12px;"></i> ' . $Sub_Estado->get_descripcion() . ' </td>';

								$Usuario = $Usuarios_Controller->select_by_id($arrayGestion[$i]['id_usuario']);

								if($Usuario != null){
									echo '<td>' . $Usuario->get_nombre_completo() . '</td>';
								}else{
									echo '<td></td>';
								}

								echo '<td>' . $arrayGestion[$i]['fecha_registro'] . '</td>';

								echo '<td class="content_opt">';
								echo '<a href="' . PATH . '/area/admin/modificar_gestion/' . $arrayGestion[$i]['id_gestion'] . '" class="to_btn to_btn_edit to_btn_rl" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>';
								echo '<a class="to_btn to_btn_delete btn_eliminar_gestion to_btn_rr" data-id="' . $arrayGestion[$i]['id_gestion'] . '" title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>';
								echo '</td>';
								echo '</tr>';
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</section>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			/**
			 * DataTables
			*/
			jQuery('#Tabla_Gestiones').DataTable({
				language: {
					processing:     "Procesando...",
					search:         "Buscar :",
					lengthMenu:     "Mostrar _MENU_ elementos",
					info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
					infoEmpty:      "Mostrando 0 a 0 de 0 elementos",
					infoFiltered:   "(Filtrado de _MAX_ total de elementos)",
					infoPostFix:    "",
					loadingRecords: "Cargando...",
					zeroRecords:    "Sin resultados encontrados",
					emptyTable:     "No hay datos disponibles en la tabla",
					paginate: {
						first:      "Primero",
						previous:   "<i class=\"fa-solid fa-angle-left\"></i>",
						next:       "<i class=\"fa-solid fa-angle-right\"></i>",
						last:       "Último"
					},
					aria: {
						sortAscending:  ": habilitar para ordenar la columna en orden ascendente",
						sortDescending: ": habilitar para ordenar la columna en orden descendente"
					}
			    }
			});
		});


	</script>
	<section class="Content_Table">
		<!-- Table -->
		<div class="ct_table">
			<div class="ct_header">
				<div>
					<h2>Lista de promesas de pago</h2>
				</div>

				<div>
					<a href="<?php echo PATH; ?>/area/admin/nueva_promesa_de_pago/<?php echo $Cliente->get_dui(); ?>">Agregar promesa de pago</a>
				</div>
			</div>

			<table id="Tabla_Promesas" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Saldo total</th>
						<th>Descuento</th>
						<th>Total a pagar</th>
						<th>Número de cuotas</th>
						<th>Valor de cuotas</th>
						<th>Fecha de pago</th>
						<th>Creado Por</th>
						<th>Fecha de emisión</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Promesas_De_Pago_Controller = new Promesas_De_Pago_Controller();
						$arrayPromesa = $Promesas_De_Pago_Controller->select_all_by_dui($Cliente->get_dui());

						if(is_array($arrayPromesa) && $arrayPromesa != null){
							for($i = 0; $i < sizeof($arrayPromesa); $i++){
								echo '<tr id="id_promesa_' . $arrayPromesa[$i]['id_promesa'] . '">';
								echo '<td>' . $arrayPromesa[$i]['id_promesa'] . '</td>';
								echo '<td>$' . $arrayPromesa[$i]['saldo_total'] . '</td>';
								echo '<td>' . $arrayPromesa[$i]['descuento'] . '%</td>';
								echo '<td>$' . $arrayPromesa[$i]['total_pagar'] . '</td>';
								echo '<td>' . $arrayPromesa[$i]['numero_cuotas'] . '</td>';
								echo '<td>$' . $arrayPromesa[$i]['valor_cuotas'] . '</td>';
								echo '<td>' . $arrayPromesa[$i]['fecha_pago'] . '</td>';

								$Usuario = $Usuarios_Controller->select_by_id($arrayPromesa[$i]['id_usuario']);

								if($Usuario != null){
									echo '<td>' . $Usuario->get_nombre_completo() . '</td>';
								}else{
									echo '<td></td>';
								}

								echo '<td>' . $arrayPromesa[$i]['fecha_emision'] . '</td>';
								echo '<td class="content_opt">';
								echo '<a href="' . PATH . '/area/admin/modificar_promesa_de_pago/' . $arrayPromesa[$i]['id_promesa'] . '" class="to_btn to_btn_edit to_btn_rl" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>';
								echo '<a href="' . PATH . '/area/admin/promesa_de_pago/' . $arrayPromesa[$i]['id_promesa'] . '" class="to_btn to_btn_see" title="Ver"><i class="fa-solid fa-circle-info"></i></a>';
								echo '<a class="to_btn to_btn_delete btn_eliminar_promesa_de_pago to_btn_rr" data-id="' . $arrayPromesa[$i]['id_promesa'] . '" title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>';
								echo '</td>';
								echo '</tr>';
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</section>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			/**
			 * DataTables
			*/
			jQuery('#Tabla_Promesas').DataTable({
				language: {
					processing:     "Procesando...",
					search:         "Buscar :",
					lengthMenu:     "Mostrar _MENU_ elementos",
					info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
					infoEmpty:      "Mostrando 0 a 0 de 0 elementos",
					infoFiltered:   "(Filtrado de _MAX_ total de elementos)",
					infoPostFix:    "",
					loadingRecords: "Cargando...",
					zeroRecords:    "Sin resultados encontrados",
					emptyTable:     "No hay datos disponibles en la tabla",
					paginate: {
						first:      "Primero",
						previous:   "<i class=\"fa-solid fa-angle-left\"></i>",
						next:       "<i class=\"fa-solid fa-angle-right\"></i>",
						last:       "Último"
					},
					aria: {
						sortAscending:  ": habilitar para ordenar la columna en orden ascendente",
						sortDescending: ": habilitar para ordenar la columna en orden descendente"
					}
			    }
			});
		});
	</script>

	<section class="Content_Table">
		<!-- Table -->
		<div class="ct_table">
			<div class="ct_header">
				<div>
					<h2>Lista de procesos judiciales</h2>
				</div>

				<div>
					<a href="<?php echo PATH; ?>/area/admin/nuevo_proceso_judicial/<?php echo $Cliente->get_dui(); ?>">Agregar proceso judicial</a>
				</div>
			</div>

			<table id="Tabla_Procesos" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Descripción</th>
						<th>Creado Por</th>
						<th>Fecha de Registro</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Proceso_Judicial_Controller = new Proceso_Judicial_Controller();
						$arrayProceso = $Proceso_Judicial_Controller->select_all_by_dui($Cliente->get_dui());

						if(is_array($arrayProceso) && $arrayProceso != null){
							for($i = 0; $i < sizeof($arrayProceso); $i++){
								echo '<tr id="id_proceso_' . $arrayProceso[$i]['id_proceso'] . '">';
								echo '<td>' . $arrayProceso[$i]['id_proceso'] . '</td>';
								echo '<td>' . $arrayProceso[$i]['descripcion'] . '</td>';

								$Usuario = $Usuarios_Controller->select_by_id($arrayProceso[$i]['id_usuario']);

								if($Usuario != null){
									echo '<td>' . $Usuario->get_nombre_completo() . '</td>';
								}else{
									echo '<td></td>';
								}

								echo '<td>' . $arrayProceso[$i]['fecha_registro'] . '</td>';
								echo '<td class="content_opt">';
								echo '<a href="' . PATH . '/area/admin/modificar_proceso_judicial/' . $arrayProceso[$i]['id_proceso'] . '" class="to_btn to_btn_edit to_btn_rl" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>';
								echo '<a href="' . PATH . '/area/admin/proceso_judicial/' . $arrayProceso[$i]['id_proceso'] . '" class="to_btn to_btn_see" title="Ver"><i class="fa-solid fa-circle-info"></i></a>';
								echo '<a class="to_btn to_btn_delete btn_eliminar_proceso to_btn_rr" data-id="' . $arrayProceso[$i]['id_proceso'] . '" title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>';
								echo '</td>';
								echo '</tr>';
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</section>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			/**
			 * DataTables
			*/
			jQuery('#Tabla_Procesos').DataTable({
				language: {
					processing:     "Procesando...",
					search:         "Buscar :",
					lengthMenu:     "Mostrar _MENU_ elementos",
					info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
					infoEmpty:      "Mostrando 0 a 0 de 0 elementos",
					infoFiltered:   "(Filtrado de _MAX_ total de elementos)",
					infoPostFix:    "",
					loadingRecords: "Cargando...",
					zeroRecords:    "Sin resultados encontrados",
					emptyTable:     "No hay datos disponibles en la tabla",
					paginate: {
						first:      "Primero",
						previous:   "<i class=\"fa-solid fa-angle-left\"></i>",
						next:       "<i class=\"fa-solid fa-angle-right\"></i>",
						last:       "Último"
					},
					aria: {
						sortAscending:  ": habilitar para ordenar la columna en orden ascendente",
						sortDescending: ": habilitar para ordenar la columna en orden descendente"
					}
			    }
			});
		});
	</script>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste dui de cliente: ' . $_GET['dui'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el dui del cliente';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>