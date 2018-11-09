<?php
session_start();
function mostrarErrorCrearAlbumSinIniciarSesion(){
		echo<<<modalCrearAlbumSesionNoIniciada

			<button type="button" onclick="cerrarMensajeModal(4);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-detalle-foto">
					<h2>Error</h2>
				</span>
					<p>Debes iniciar sesión para poder crear un álbum</p>
					<button type="button" onclick="cerrarMensajeModal(4);">Aceptar</button>
				</div>
			</div>

modalCrearAlbumSesionNoIniciada;
}
require_once("head.php");
require_once("header.php");
if(!isset($_SESSION["usuarioLog"])){
	require_once("barraNavSesionNoIniciada.php");
	mostrarErrorCrearAlbumSinIniciarSesion();
}
else{
	require_once("barraNavSesionIniciada.php");
?>

			<form action="respuesta_crear_album.php" method="post" class="formulario" id="formCrearAmb">

				<fieldset>

					<legend>
						Crear Álbum
					</legend>

					<p>
						<label for="titulo">Titulo:</label>
						<input type="text" required name="titulo" id="titulo"/>
					</p>
					<p>
						<label for="desc">Descripción:</label>
						<textarea name="desc" id="desc" placeholder="Descripción del álbum o dedicatoria" rows="10" cols="50" maxlength="4000" title="Tope de caracteres o letras: 4000"></textarea>
					</p>
					<p>
						<button type="submit">Crear</button>
					</p>

				</fieldset> 

			</form>

	<?php 

		}

	?>

<?php
	require_once("footer.php");
?>