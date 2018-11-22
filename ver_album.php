<?php
session_start();
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");
if(isset($_SESSION["usuarioLog"]) && $cookieFalsa == false){
	require_once("barraNavSesionIniciada.php");
	mostrarAlbum($_GET["IdAlbum"]);
}
else{
	require_once("barraNavSesionNoIniciada.php");
	if($cookieFalsa){
		mostrarMensErrorCookie();
	}
}
?>
<?php

function mostrarAlbum(&$IdAlbum){

	$idAlbum=$_GET["IdAlbum"];

	$sentencia1 = 'SELECT f.Titulo, a.Titulo AS AlbumTit, Fichero, f.Descripcion, f.Fecha, Alternativo, NomPais, NomUsuario FROM fotos f JOIN albumes a ON (f.Album = a.IdAlbum) JOIN usuarios ON (a.Usuario = usuarios.IdUsuario) JOIN paises ON (f.Pais = paises.IdPais) where Album='.$idAlbum;
		 if(!($resultado1 = $GLOBALS["mysqli"]->query($sentencia1))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 }

	$sentencia2 = 'SELECT * FROM albumes where IdAlbum='.$idAlbum;
		 if(!($resultado2 = $GLOBALS["mysqli"]->query($sentencia2))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 }

	$sentencia3 = 'SELECT DISTINCT NomPais, Pais FROM fotos, paises where Album='.$idAlbum.' and Pais=IdPais';
		 if(!($resultado3 = $GLOBALS["mysqli"]->query($sentencia3))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 }

	$sentencia4 = 'SELECT max(Fecha) fechaMax, min(Fecha) fechaMin FROM fotos where Album='.$idAlbum;
		 if(!($resultado4 = $GLOBALS["mysqli"]->query($sentencia4))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 } 
if(mysqli_num_rows($resultado1)) {
	if(mysqli_num_rows($resultado2)) {
		$fila2 = $resultado2->fetch_object();
		$tituloAlbum=$fila2->Titulo;
		$descAlbum=$fila2->Descripcion;
	}

	if(mysqli_num_rows($resultado4)) {
		$fila4 = $resultado4->fetch_object();
		$minFecha=$fila4->fechaMin;
		$maxFecha=$fila4->fechaMax;
	}

	echo <<<parte1
		<section>
			<h3>$tituloAlbum</h3>

			<p>$descAlbum</p>

			<div id="paisesAlbum" class="mostrarDatos">
			<p>Este álbum recoje fotos de los siguientes países:</p>
parte1;
			if(mysqli_num_rows($resultado3)){
				while($fila3 = $resultado3->fetch_assoc()) {

					$pais=$fila3["NomPais"];
					echo"<p>$pais</p>";

				}
			}

	echo<<<parte2
			</div>
			<p>Las fotos de este álbum han sido tomadas entre las fechas:</p>
			<p>$minFecha y $maxFecha</p>
			<div>
parte2;
		if(mysqli_num_rows($resultado1)){
				while($fila1 = $resultado1->fetch_object()) {

					echo<<<foto
					<article class="detFoto">
						<h3>$fila1->Titulo</h3>
						<figure>
							<img src="$fila1->Fichero" alt="$fila1->Alternativo"/>
						</figure>
						<div>
							<h4>Descripción:</h4>
							<p class="p-left">$fila1->Descripcion</p>
							<p><time datetime="$fila1->Fecha">$fila1->Fecha</time></p>
							<p>$fila1->NomPais</p>					
						</div>
					</article>
foto;
				}

		}
	}else{

		mostrarMensModalErrorPagAlbumNoExistente();

	}
	echo<<<parte3
			</div>
	</section>
parte3;

}

	function mostrarMensModalErrorPagAlbumNoExistente(){
		echo<<<modalDetalle
				<button type="button" onclick="cerrarMensajeModal(7);">X</button>
				<div class="modal">
					<div class="contenido">
						<span>
							<img src="./img/error.png" alt="error-detalle-foto">
							<h2>Error</h2>
						</span>
						<p>Estes álbum no existe o no contiene fotos</p>
						<button type="button" onclick="cerrarMensajeModal(7);">Cerrar</button>
					</div>
				</div>
modalDetalle;
	}

?>
<?php
	require_once("footer.php");
?>