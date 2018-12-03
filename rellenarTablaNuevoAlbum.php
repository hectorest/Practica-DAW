<?php
	
	$host = $_SERVER['HTTP_HOST']; 
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
	$extra = 'anyadir_foto_album.php';
	$href = "http://$host$uri/$extra";

	echo<<<arribaTabla

			<section>

				<h3>Álbum creado</h3>
				<p>Has creado el álbum correctamente.</p>
			
			<div class="contTabla">

				<table class="tabla">

					<caption>Información del álbum:</caption>

arribaTabla;

			foreach ($sanearPost as $key => $value) {
				$clave = $key;
				cambiarClave($clave);
				if($value == ""){
					echo"<tr><td>$key:</td><td><i>No hay datos</i></td></tr>";
				}
				else{
					echo"<tr><td>$clave:</td><td>$value</td></tr>";
				}
			}

			echo<<<bajoTabla
				</table>
			</div>

			<div class="enlPerf" id="inicioRespCrearAlbum">
				<a href="index.php" title="Volver a inicio">Aceptar</a>
			</div>

			<p id="enlaceAnyadirFotoAlbum">¡Inserta la primera foto en tu nuevo álbum! <a href="$href" title="Añade una foto al álbum">Añadir Foto</a></p>

		</section>
bajoTabla;




?>