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
function mostrarErrorCrearAlbumConTituloRepetido(){
		echo<<<modalCrearAlbumSesionNoIniciada

			<button type="button" onclick="cerrarMensajeModal(1);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-detalle-foto">
					<h2>Error</h2>
				</span>
					<p>Ya tienes un álbum con ese título</p>
					<button type="button" onclick="cerrarMensajeModal(1);">Aceptar</button>
				</div>
			</div>

modalCrearAlbumSesionNoIniciada;
}
function mostrarMensErrorAccesoRemoto(){

		echo<<<modalControlModificar

			<button type="button" onclick="cerrarMensajeModal(10);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>Para poder realizar cualquier cambio en los datos almacenados en Pictures & Images debes enviar los datos desde la dirección del propio sitio web</p>
					<button type="button" onclick="cerrarMensajeModal(10);">Cerrar</button>
				</div>
			</div>

modalControlModificar;

}
require_once("head.php");
require_once("header.php");
if(!empty($_GET["er"]) && $_GET["er"] == 301){
	mostrarErrorCrearAlbumConTituloRepetido();
}
if(!empty($_GET["er"]) && $_GET["er"] == 310){
	mostrarMensErrorAccesoRemoto();
}
if(!isset($_SESSION["usuarioLog"])){
	require_once("barraNavSesionNoIniciada.php");
	mostrarErrorCrearAlbumSinIniciarSesion();
}
else{
	if($cookieFalsa == true){
		mostrarMensErrorCookie();
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
		}

	?>

<?php
	require_once("footer.php");
?>