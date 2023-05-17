<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/archivos_controller.php');
	require_once('../../system/controllers/bitacoras_controller.php');
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
	require_once('../../system/controllers/deudas_controller.php');
	require_once('../../system/controllers/gestiones_controller.php');
	require_once('../../system/controllers/proceso_judicial_controller.php');

	require_once('../../system/models/archivos_model.php');
	require_once('../../system/models/bitacoras_model.php');
	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');
	require_once('../../system/models/gestiones_model.php');
	require_once('../../system/models/proceso_judicial_model.php');
    require_once('../../system/models/deudas_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Datos del Proceso Judicial</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/clientes.js"></script>
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/archivos.js"></script>
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/bitacoras.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');

	/**
	 * validar si existe el registro a modificar
	*/
	if(isset($_GET['id_proceso'])){
		$Proceso_Judicial_Controller = new Proceso_Judicial_Controller();
		$Proceso = $Proceso_Judicial_Controller->select_by_id($_GET['id_proceso']);

		if($Proceso != null){
			// Recuperar datos
            $Clientes_Controller = new Clientes_Controller();
            $Cliente = $Clientes_Controller->select_by_id($Proceso->get_dui());
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());
            
?>

	<section id="Title_Page">
		<h1>Datos del proceso judicial</h1>
	</section>
	
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
            <a href="<?php echo PATH; ?>/area/admin/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
            <a class="active">Proceso Judicial</a>
			
		</div>
	</section>

	<section class="Content_Info">
		<div class="ci_content">
			<h2>DATOS DEL PROCESO JUDICIAL</h2>

			<div class="cic_items">
				<!-- Campos -->
				<div class="cic_item">
					<p><b>ID:</b> <?php echo $Proceso->get_id_proceso(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Descripción</b> <?php echo $Proceso->get_descripcion(); ?></p>
				</div>

                <div class="cic_item">
					<p><b>DUI del cliente:</b> <?php echo $Proceso->get_dui(); ?></p>
				</div>

				</div>
			</div>
		</div>
	</section>

    <section class="Content_Table">
		<!-- Table -->
		<div class="ct_table">
			<div class="ct_header">
				<div>
					<h2>Lista de Archivos</h2>
				</div>

				<div>
					<a href="<?php echo PATH; ?>/area/admin/nuevo_archivo/<?php echo $Proceso->get_id_proceso(); ?>">Agregar Archivo</a>
				</div>
			</div>

			<table id="Tabla_Archivos" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
                        <th>Nombre</th>
						<th>Descripción</th>
						<th>Creado Por</th>
						<th>Fecha de registro</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Archivos_Controller = new Archivos_Controller();
						$arrayArchivo = $Archivos_Controller->select_all_by_id_proceso($Proceso->get_id_proceso());

						if(is_array($arrayArchivo) && $arrayArchivo != null){
							for($i = 0; $i < sizeof($arrayArchivo); $i++){
								echo '<tr id="id_archivo_' . $arrayArchivo[$i]['id_archivo'] . '">';
								echo '<td>' . $arrayArchivo[$i]['id_archivo'] . '</td>';
                                echo '<td>' . $arrayArchivo[$i]['nombre'] . '</td>';
								echo '<td>' . $arrayArchivo[$i]['descripcion'] . '</td>';

								$Usuario = $Usuarios_Controller->select_by_id($arrayArchivo[$i]['id_usuario']);

								if($Usuario != null){
									echo '<td>' . $Usuario->get_nombre_completo() . '</td>';
								}else{
									echo '<td></td>';
								}

								echo '<td>' . $arrayArchivo[$i]['fecha_registro'] . '</td>';
								echo '<td class="content_opt">';
								echo '<a href="' . PATH . '/area/admin/modificar_archivo/' . $arrayArchivo[$i]['id_archivo'] . '" class="to_btn to_btn_edit to_btn_rl" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>';
								echo '<a href="' . PATH . '/assets/files/' . $arrayArchivo[$i]['archivo'] . '" class="to_btn to_btn_see" title="Ver" target="_blank"><i class="fa-regular fa-eye"></i></a>';
								echo '<a class="to_btn to_btn_delete btn_eliminar_archivo to_btn_rr" data-id="' . $arrayArchivo[$i]['id_archivo'] . '" title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>';
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
			jQuery('#Tabla_Archivos').DataTable({
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
					<h2>Lista de bitácoras</h2>
				</div>

				<div>
					<a href="<?php echo PATH; ?>/area/admin/nueva_bitacora/<?php echo $Proceso->get_id_proceso(); ?>">Agregar Bitácora</a>
				</div>
			</div>

			<table id="Tabla_Bitacoras" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Descripción</th>
						<th>Creado Por</th>
						<th>Fecha de registro</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Bitacoras_Controller = new Bitacoras_Controller();
						$arrayBitacora = $Bitacoras_Controller->select_all_by_id_proceso($Proceso->get_id_proceso());

						if(is_array($arrayBitacora) && $arrayBitacora != null){
							for($i = 0; $i < sizeof($arrayBitacora); $i++){
								echo '<tr id="id_bitacora_' . $arrayBitacora[$i]['id_bitacora'] . '">';
								echo '<td>' . $arrayBitacora[$i]['id_bitacora'] . '</td>';
								echo '<td>' . $arrayBitacora[$i]['descripcion'] . '</td>';
								
								$Usuario = $Usuarios_Controller->select_by_id($arrayBitacora[$i]['id_usuario']);

								if($Usuario != null){
									echo '<td>' . $Usuario->get_nombre_completo() . '</td>';
								}else{
									echo '<td></td>';
								}

								echo '<td>' . $arrayBitacora[$i]['fecha_registro'] . '</td>';
								echo '<td class="content_opt">';
								echo '<a href="' . PATH . '/area/admin/modificar_bitacora/' . $arrayBitacora[$i]['id_proceso'] . '" class="to_btn to_btn_edit to_btn_rl" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>';
								echo '<a class="to_btn to_btn_delete btn_eliminar_bitacora to_btn_rr" data-id="' . $arrayBitacora[$i]['id_bitacora'] . '" title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>';
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
			jQuery('#Tabla_Bitacoras').DataTable({
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
			$error404 = 'No se encontró ningún resultado para éste id de gestión: ' . $_GET['id_gestion'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de la deuda.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>