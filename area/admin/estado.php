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

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Datos del Estado</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/estados.js"></script>
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/sub_estados.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');

	/**
	 * validar si existe el registro a modificar
	*/
	if(isset($_GET['id_estado'])){
		$Estados_Controller = new Estados_Controller();
		$Estado = $Estados_Controller->select_by_id($_GET['id_estado']);

		if($Estado != null){
			// Recuperar datos
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Estado->get_id_cartera());
            
?>

	<section id="Title_Page">
		<h1>Datos del estado</h1>
	</section>
	
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_estados/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Estados</a>
			<a class="active">Estado #<?php echo $Estado->get_id_estado(); ?></a>
		</div>
	</section>

	<section class="Content_Info">
		<div class="ci_content">
			<h2>Datos del estado</h2>

			<div class="cic_items">
				<!-- Campos -->
				<div class="cic_item">
					<p><b>ID:</b> <?php echo $Estado->get_id_estado(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Descripción:</b> <?php echo $Estado->get_descripcion(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Habilitado:</b> <?php echo $Estado->get_habilitado(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>ID Cartera:</b> <?php echo $Estado->get_id_cartera(); ?></p>
				</div>
			</div>
		</div>
	</section>

    <section class="Content_Table">
		<!-- Table -->
		<div class="ct_table">
			<div class="ct_header">
				<div>
					<h2>Lista de Sub Estados</h2>
				</div>

				<div>
					<a href="<?php echo PATH; ?>/area/admin/nuevo_sub_estado/<?php echo $Estado->get_id_estado(); ?>">Agregar Sub Estado</a>
				</div>
			</div>

			<table id="Tabla_Sub_Estados" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Descripción</th>
						<th>Habilitado</th>
						<th>ID de estado</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Sub_Estados_Controller = new Sub_Estados_Controller();
						$arraySubEstados = $Sub_Estados_Controller->select_all_by_id_estado($Estado->get_id_estado());

						if(is_array($arraySubEstados) && $arraySubEstados != null){
							for($i = 0; $i < sizeof($arraySubEstados); $i++){
								echo '<tr id="id_sub_estado_' . $arraySubEstados[$i]['id_sub_estado'] . '">';
								echo '<td>' . $arraySubEstados[$i]['id_sub_estado'] . '</td>';
								echo '<td>' . $arraySubEstados[$i]['descripcion'] . '</td>';
								echo '<td>' . $arraySubEstados[$i]['habilitado'] . '</td>';
								echo '<td>' . $arraySubEstados[$i]['id_estado'] . '</td>';
								echo '<td class="content_opt">';
								echo '<a href="' . PATH . '/area/admin/modificar_sub_estado/' . $arraySubEstados[$i]['id_sub_estado'] . '" class="to_btn to_btn_edit to_btn_rl" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>';
								echo '<a class="to_btn to_btn_delete btn_eliminar_sub_estado to_btn_rr" data-id="' . $arraySubEstados[$i]['id_sub_estado'] . '" title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>';
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
			jQuery('#Tabla_Sub_Estados').DataTable({
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
			$error404 = 'No se encontró ningún resultado para éste id de estado: ' . $_GET['id_estado'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id del estado.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>