	<section id="Error_404">
		<div class="content_error404">
			<h1>Error 404</h1>

			<p>
				<?php
					if(isset($error404)){
						echo $error404;
					}else{
						echo 'La página que buscas no está disponible.';
					}
				?>
			</p>
		</div>
	</section>