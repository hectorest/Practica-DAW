<?php
session_start();
require_once("head.php");
require_once("header.php");
if(isset($_SESSION["usuarioLog"]) && $cookieFalsa == false){
	require_once("barraNavSesionIniciada.php");
	if(isset($_GET["id"])){
		if(!is_numeric($_GET["id"])){
			echo<<<modalDetalle
				<button type="button" onclick="cerrarMensajeModal(0);">X</button>
				<div class="modal">
					<div class="contenido">
						<span>
							<img src="./img/error.png" alt="error-detalle-foto">
							<h2>Error</h2>
						</span>
						<p>Esta página de foto no existe</p>
						<button type="button" onclick="cerrarMensajeModal(0);">Cerrar</button>
					</div>
				</div>
modalDetalle;
		}
		else{
			$imagenAColocar = EsParOImpar($_GET["id"]);
			mostrarDetalleFoto($_GET["id"], $imagenAColocar);
		}
	}
}
	else{
		require_once("barraNavSesionNoIniciada.php");
		if($cookieFalsa){
			mostrarMensErrorCookie();
		}
		else{
			echo<<<modalDetalleSesionNoIniciada

				<button type="button" onclick="cerrarMensajeModal(4);">X</button>
				<div class="modal">
					<div class="contenido">
						<span>
						<img src="./img/error.png" alt="error-detalle-foto">
						<h2>Error</h2>
						</span>
						<p>Debes iniciar sesión para poder ver el detalle de la foto</p>
						<button type="button" onclick="cerrarMensajeModal(4);">Aceptar</button>
					</div>
				</div>

modalDetalleSesionNoIniciada;
		}
	}
?>
<?php

function EsParOImpar($id){
	if($id % 2 == 0){
		return '<img src="./imagen-muestra/paisaje.jpg" alt="Titulo foto Ejemplo &id"/>';
	}
	else{
		return '<img src="./imagen-muestra/imagen-muestra.jpg" alt="Titulo foto Ejemplo &id"/>';
	}
}

function mostrarDetalleFoto($idImg, $img){
echo <<<detalleFoto
	<article id="detFoto">
		<h3>Titulo foto Ejemplo $idImg</h3>
		<figure>
			$img
		</figure>
		<div>
			<h4>Descripción:</h4>
			<p class="p-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<p><time datetime="2018-09-15">Fecha de foto ejemplo $idImg, por ejemplo: 15 de septiembre de 2018</time></p>
			<p>Pais foto ejemplo $idImg</p>
			<a href="album.php" title="Álbum al que pertenece la foto">Álbum</a>
			<a href="usuario.php" title="Autor de la foto">Usuario</a>					
		</div>
	</article>
detalleFoto;
}

?>
<?php
	require_once("footer.php");
?>