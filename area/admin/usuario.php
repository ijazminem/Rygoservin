<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/models/tipos_usuarios_model.php');

	require_once('../../system/controllers/tipos_usuarios_controller.php');
	require_once('../../system/controllers/usuario_cartera_controller.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Datos del Usuario</title>
	<!-- validaciones -->
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');

	/**
	 * validar si existe el registro a modificar
	*/
	if(isset($_GET['id_usuario'])){
		$Usuarios_Controller = new Usuarios_Controller();
		$Usuario = $Usuarios_Controller->select_by_id($_GET['id_usuario']);

		if($Usuario != null){
?>

	<section id="Title_Page">
		<h1>Datos del Usuario</h1>
	</section>
	
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_usuarios">Lista de Usuarios</a>
			<a class="active"><?php echo $Usuario->get_nombre_completo(); ?></a>
		</div>
	</section>

	<section class="Content_Info">
		<div class="ci_content">
			<h2>Datos del Usuario</h2>

			<div class="cic_items">
				<div class="cic_item">
					<p><b>Id Usuario:</b> <?php echo $Usuario->get_id_usuario(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Nombre Completo:</b> <?php echo $Usuario->get_nombre_completo(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Correo:</b> <?php echo $Usuario->get_correo(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Habilitado:</b> <?php echo $Usuario->get_habilitado(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Fecha Registro:</b> <?php echo $Usuario->get_fecha_registro(); ?></p>
				</div>

				<?php
					$Tipos_Usuarios_Controller = new Tipos_Usuarios_Controller();
					$Tipo_Usuario = $Tipos_Usuarios_Controller->select_by_id($Usuario->get_id_tipo_usuario());

					if($Tipo_Usuario != null){
				?>

				<div class="cic_item">
					<p><b>Tipo de Usuario:</b> <?php echo $Tipo_Usuario->get_nombre_tipo_usuario(); ?></p>
				</div>

				<?php
					}
				?>
			</div>
		</div>
	</section>

	<section class="Content_Table">
		<!-- Table -->
		<div class="ct_table">
			<div class="ct_header">
				<div>
					<h2>Carteras Asignadas</h2>
				</div>

				<div>
					<a href="<?php echo PATH; ?>/area/admin/nuevo_usuario_cartera/<?php echo $_GET['id_usuario']; ?>">Asignar Cartera</a>
				</div>
			</div>

			<table id="Tabla_Usuario_Cartera" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Cartera</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Usuario_Cartera_Controller = new Usuario_Cartera_Controller();
						$arrayUsuariosCarteras = $Usuario_Cartera_Controller->select_by_id_usuario_join_carteras($_GET['id_usuario']);

						if(is_array($arrayUsuariosCarteras) && $arrayUsuariosCarteras != null){
							for($i = 0; $i < sizeof($arrayUsuariosCarteras); $i++){
								echo '<tr id="id_usuario_cartera_' . $arrayUsuariosCarteras[$i]['id_usuario_cartera'] . '">';
								echo '<td>' . $arrayUsuariosCarteras[$i]['id_usuario_cartera'] . '</td>';
								echo '<td>' . $arrayUsuariosCarteras[$i]['nombre_cartera'] . '</td>';
								echo '<td class="content_opt">';
								echo '<a class="to_btn to_btn_delete btn_eliminar_usuario_cartera to_btn_r" data-id="' . $arrayUsuariosCarteras[$i]['id_usuario_cartera'] . '" title="Eliminar"><i class="fa-regular fa-trash-can"></i></a>';
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
			jQuery('#Tabla_Usuario_Cartera').DataTable({
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
			$error404 = 'No se encontró ningún resultado para éste id de usuario: ' . $_GET['id_usuario'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id del usuario';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>