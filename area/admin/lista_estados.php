<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/estados_controller.php');

	require_once('../../system/models/carteras_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Lista de Estados</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/estados.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_cartera'])){
		$Carteras_Controller = new Carteras_Controller();
		$Cartera = $Carteras_Controller->select_by_id(strip_tags($_GET['id_cartera']));

		if($Cartera != null){
?>

	<section id="Title_Page">
		<h1>Lista de Estados</h1>
	</section>
	
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a class="active">Lista de Estados</a>
		</div>
	</section>

	<section class="Content_Table">
		<!-- Table -->
		<div class="ct_table">
			<div class="ct_header">
				<div>
					<h2>Lista de Estados</h2>
				</div>

				<div>
					<a href="<?php echo PATH; ?>/area/admin/nuevo_estado/<?php echo $Cartera->get_id_cartera(); ?>">Agregar Estado</a>
				</div>
			</div>

			<table id="Tabla_Estados" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Descripción</th>
						<th>Habilitado</th>
						<th>ID de cartera</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Estados_Controller = new Estados_Controller();
						$arrayEstados = $Estados_Controller->select_all_by_id_cartera($Cartera->get_id_cartera());

						if(is_array($arrayEstados) && $arrayEstados != null){
							for($i = 0; $i < sizeof($arrayEstados); $i++){
								echo '<tr id="id_estado_' . $arrayEstados[$i]['id_estado'] . '">';
								echo '<td>' . $arrayEstados[$i]['id_estado'] . '</td>';
								echo '<td>' . $arrayEstados[$i]['descripcion'] . '</td>';
								echo '<td>' . $arrayEstados[$i]['habilitado'] . '</td>';
								echo '<td>' . $arrayEstados[$i]['id_cartera'] . '</td>';
								echo '<td class="content_opt">';
								echo '<a href="' . PATH . '/area/admin/modificar_estado/' . $arrayEstados[$i]['id_estado'] . '" class="to_btn to_btn_edit to_btn_rl" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>';
								echo '<a href="' . PATH . '/area/admin/estado/' . $arrayEstados[$i]['id_estado'] . '" class="to_btn to_btn_see" title="Ver"><i class="fa-solid fa-circle-info"></i></a>';
								echo '<a class="to_btn to_btn_delete btn_eliminar_estado to_btn_rr" data-id="' . $arrayEstados[$i]['id_estado'] . '" title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>';
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
			jQuery('#Tabla_Estados').DataTable({
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
			$error404 = 'No se encontró ningún resultado para este id de cartera: ' . $_GET['id_cartera'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de la cartera.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>