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

	$sentencia1 = 'SELECT * FROM fotos where Album='.$idAlbum;
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


	$fila2 = $resultado2->fetch_object();
	$tituloAlbum=$fila2->Titulo;
	$descAlbum=$fila2->Descripcion;

	$fila4 = $resultado4->fetch_object();
	$minFecha=$fila4->fechaMin;
	$maxFecha=$fila4->fechaMax;


	echo <<<parte1
		<section>
			<h3>$tituloAlbum</h3>

			<p>$descAlbum</p>

			<div id="filtrosAplicados" class="mostrarDatos">
parte1;

				while($fila3 = $resultado3->fetch_assoc()) {

					$pais=$fila3["NomPais"];
					echo"<p>$pais</p>";

				}

	echo<<<parte2
			</div>
			<p>$minFecha - $maxFecha</p>
			<div>
parte2;

				while($fila1 = $resultado1->fetch_assoc()) {

					echo<<<foto
				<article>
					<h4><a href="detalle_foto.php?id={$fila1['IdFoto']}" title="Ver detalles de la foto">{$fila1['Titulo']}</a></h4>
					<figure>
						<a href="detalle_foto.php?id={$fila1['IdFoto']}" title="Ver detalles de la foto"><img src="{$fila1['Fichero']}" alt="{$fila1['Alternativo']}"/></a>
					</figure>
				</article>
foto;

				}
	echo<<<parte3
			</div>		
		<div class="paginacion">
			<div>
				<span class="icon-to-start" title="Primeras 5 imágenes"></span>
				<span class="icon-left-open" title="Anteriores 5 imágenes"></span>
				<p>Página <output>1</output> / 5</p>
				<span class="icon-right-open" title="Siguientes 5 imágenes"></span>
				<span class="icon-to-end" title="Últimas 5 imágenes"></span>
			</div>
		</div>
	</section>
parte3;

}	
?>
<?php
	require_once("footer.php");
?>