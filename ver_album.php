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
function extraerPais(&$IdP){

	$sentencia = 'SELECT NomPais FROM paises WHERE IdPais =' . $IdP;
	
	if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		echo '</p>'; 
		exit; 
	}

	$fila = $resultado->fetch_object();

	return $fila->NomPais;

}

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

	$sentencia3 = 'SELECT DISTINCT Pais FROM fotos where Album='.$idAlbum;
		 if(!($resultado3 = $GLOBALS["mysqli"]->query($sentencia3))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 }

	$sentencia4 = 'SELECT max(Fecha) FROM fotos where Album='.$idAlbum;
		 if(!($resultado4 = $GLOBALS["mysqli"]->query($sentencia4))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 } 

	$sentencia5 = 'SELECT min(Fecha) FROM fotos where Album='.$idAlbum;
		 if(!($resultado5 = $GLOBALS["mysqli"]->query($sentencia5))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 }

	$fila2 = $resultado2->fetch_object();
	$tituloAlbum=$fila2->Titulo;
	$descAlbum=$fila2->Descripcion;

	$fila4 = $resultado4->fetch_object();
	$fila5 = $resultado5->fetch_object();
	$maxFecha=$fila4->Fecha;
	$minFecha=$fila5->Fecha;


	echo <<<parte1
		<section>
			<h3>$tituloAlbum:</h3>

			<p>$descAlbum</p>

			<div id="filtrosAplicados" class="mostrarDatos">
parte1;
			$fila3 = $resultado3->fetch_object();
				while($fila3 = $resultado3->fetch_object()) {

					echo"<p>$fila3->Pais</p>";

				}

	echo<<<parte2
			"</div>"
			<p>$minFecha - $maxFecha</p>
			<div class="imagenes">
parte2;
			$fila1 = $resultado1->fetch_object();
				while($fila1 = $resultado1->fetch_object()) {

					echo<<<foto
				<article>
					<h4><a href="detalle_foto.php?id=$fila1->IdFoto" title="Ver detalles de la foto">$fila1->Titulo</a></h4>
					<figure>
						<a href="detalle_foto.php?id=$fila1->IdFoto" title="Ver detalles de la foto"><img src="$fila1->Fichero" alt="fila1->Titulo"/></a>
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