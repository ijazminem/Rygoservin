<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Lista de Usuarios</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/usuarios.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');
?>

	<section id="Title_Page">
		<h1>Lista de Usuarios</h1>
	</section>
	
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a class="active">Lista de Usuarios</a>
		</div>
	</section>

	<section class="Content_Table">
		<!-- Table -->
		<div class="ct_table">
			<div class="ct_header">
				<div>
					<h2>Lista de Usuarios</h2>
				</div>

				<div>
					<a href="<?php echo PATH; ?>/area/admin/nuevo_usuario">Agregar Usuario</a>
				</div>
			</div>

			<table id="Tabla_Usuarios" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Correo</th>
						<th>Tipo</th>
						<th>Habilitado</th>
						<th>Fecha Registro</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Usuarios_Controller = new Usuarios_Controller();
						$arrayUsuarios = $Usuarios_Controller->select_all_join();

						if(is_array($arrayUsuarios) && $arrayUsuarios != null){
							for($i = 0; $i < sizeof($arrayUsuarios); $i++){
								echo '<tr id="id_usuario_' . $arrayUsuarios[$i]['id_usuario'] . '">';
								echo '<td>' . $arrayUsuarios[$i]['id_usuario'] . '</td>';
								echo '<td>' . $arrayUsuarios[$i]['nombre_completo'] . '</td>';
								echo '<td>' . $arrayUsuarios[$i]['correo'] . '</td>';
								echo '<td>' . $arrayUsuarios[$i]['nombre_tipo_usuario'] . '</td>';
								echo '<td>' . $arrayUsuarios[$i]['habilitado'] . '</td>';
								echo '<td>' . $arrayUsuarios[$i]['fecha_registro'] . '</td>';
								echo '<td class="content_opt">';

								if($CurrentUser->get_id_usuario() != $arrayUsuarios[$i]['id_usuario']){
									echo '<a href="' . PATH . '/area/admin/modificar_usuario/' . $arrayUsuarios[$i]['id_usuario'] . '" class="to_btn to_btn_edit to_btn_rl" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>';
									echo '<a href="' . PATH . '/area/admin/usuario/' . $arrayUsuarios[$i]['id_usuario'] . '" class="to_btn to_btn_see" title="Ver"><i class="fa-solid fa-circle-info"></i></a>';
									echo '<a class="to_btn to_btn_delete btn_eliminar_usuario to_btn_rr" data-id="' . $arrayUsuarios[$i]['id_usuario'] . '" title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>';
								}
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
			jQuery('#Tabla_Usuarios').DataTable({
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
	/**
	 * footer
	*/
	require_once('footer.php');
?>