<?php
session_start();
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");
if(isset($_SESSION["usuarioLog"]) && $cookieFalsa == false){
	require_once("barraNavSesionIniciada.php");
	if(isset($_GET["id"])){
		if(!is_numeric($_GET["id"])){
			mostrarMensModalErrorPagDetalleFotoNoExistente();
		}
		else{
			$idFoto = $GLOBALS["mysqli"]->real_escape_string($_GET["id"]);
			mostrarDetalleFoto($idFoto);
		}
	}
	else{
		mostrarMensModalErrorPagDetalleFotoNoExistente();
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

	function mostrarMensModalErrorPagDetalleFotoNoExistente(){
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


?>
<?php

function mostrarDetalleFoto(&$idImg){
	$sentencia = 'SELECT f.Titulo, a.Titulo AS AlbumTit, IdAlbum, Fichero, f.Descripcion, f.Fecha, Alternativo, NomPais, NomUsuario, a.Usuario AS Usuario FROM fotos f JOIN albumes a ON (f.Album = a.IdAlbum) JOIN usuarios ON (a.Usuario = usuarios.IdUsuario) JOIN paises ON (f.Pais = paises.IdPais) WHERE IdFoto = ' . $idImg;
	if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		echo '</p>'; 
		exit; 
	}

	if(mysqli_num_rows($resultado)){
		$fila = $resultado->fetch_object();
		echo <<<detalleFoto
		<article class="detFoto">
			<h3>$fila->Titulo</h3>
			<figure>
				<img src="$fila->Fichero" alt="$fila->Alternativo"/>
			</figure>
			<div>
				<h4>Descripción:</h4>
				<p class="p-left">$fila->Descripcion</p>
				<p><time datetime="$fila->Fecha">$fila->Fecha</time></p>
				<p>$fila->NomPais</p>
				<a href="resultado_busqueda.php?Album=$fila->IdAlbum" title="Álbum al que pertenece la foto">Álbum: $fila->AlbumTit</a>
				<a href="resultado_busqueda.php?Usuario=$fila->Usuario" title="Autor de la foto">Usuario: $fila->NomUsuario</a>					
			</div>
		</article>
detalleFoto;
	}
	else{
		mostrarMensModalErrorPagDetalleFotoNoExistente();
	}

	$resultado->free();
	$GLOBALS["mysqli"]->close();

}

?>
<?php
	require_once("footer.php");
?>