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

	<title>Panel Principal</title>

<?php
	require_once('header2.php');
?>

	<section id="Title_Page">
		<h1>Panel de Control</h1>
	</section>
	
	<section id="Panel_Control">
		<div class="pc_opciones">
			<!-- items -->
			<div class="pco_item">
				<i class="fa-solid fa-boxes-stacked"></i>

				<h2>Carteras</h2>

				<div class="pcoi_btn">
					<a href="<?php echo PATH; ?>/area/admin/nueva_cartera">Agregar Cartera</a>
				</div>

				<div class="pcoi_btn">
					<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
				</div>

				<div class="pcoi_btn">
					<a href="#">Reportes</a>
				</div>
			</div>

			<div class="pco_item">
				<i class="fa-solid fa-users-gear"></i>

				<h2>Usuarios</h2>

				<div class="pcoi_btn">
					<a href="<?php echo PATH; ?>/area/admin/nuevo_usuario">Agregar Usuario</a>
				</div>

				<div class="pcoi_btn">
					<a href="<?php echo PATH; ?>/area/admin/lista_usuarios">Lista de Usuarios</a>
				</div>

				<div class="pcoi_btn">
					<a href="#">Progreso de Usuarios</a>
				</div>
			</div>

		
			<!-- items -->
		</div>
	</section>

<?php
	/**
	 * footer
	*/
	require_once('footer.php');
?>