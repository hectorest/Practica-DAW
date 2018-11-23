<?php
session_start();
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");
if(!isset($_SESSION["usuarioLog"])){
	require_once("barraNavSesionNoIniciada.php");
}
else{
	require_once("barraNavSesionIniciada.php");
}
?>

<?php

	$hayPost = false;
	
	foreach ($_POST as $value){
		if(isset($value)){
			$hayPost=true;
		}
	}

	if($hayPost==true){

		$postSaneado = $_POST;
		foreach ($postSaneado as $key => $value) {
			if(!empty($value)){
				$GLOBALS["mysqli"]->real_escape_string($value);
			}
		}

		echo<<<arribaTabla

			<section>

				<h3>Álbum creado</h3>
				<p>Has creado el álbum correctamente.</p>
			
			<div class="contTabla">

				<table class="tabla">

					<caption>Información del álbum:</caption>

arribaTabla;

			foreach ($postSaneado as $key => $value) {
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

			<div class="enlPerf" id="inicioResSolAlbum">
				<a href="index.php" title="Volver a inicio">Aceptar</a>
			</div>

		</section>
bajoTabla;

		$GLOBALS["mysqli"]->close();
	}
	else{

		$GLOBALS["mysqli"]->close();
		
		echo<<<modalcrear_album

			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>No has enviado los datos para crear un álbum</p>
					<button type="button" onclick="cerrarMensajeModal(6);">Crear álbum</button>
				</div>
			</div>

modalcrear_album;
	}

function cambiarClave(&$clave){
	$clav = array(
		"album" => "Álbum",
		"autor" => "Autor",
		"date1" => "Desde",
		"date2" => "Hasta",
		"titulo" => "Título",
		"desc" => "Descripción",
		"palClave" => "Palabra clave",
		"passw1" => "Contraseña",
		"pass" => "Contraseña",
		"sexo" => "Sexo",
		"fNac" => "Fecha de nacimiento",
		"cRes" => "Ciudad de residencia",
		"pais" => "País",
		"local" => "Localidad",
		"pRes" => "País de residencia",
		"usuario" => "Usuario",
		"email" => "Email",
		"texto_adicional" => "Texto adicional",
		"cp" => "Código Postal",
		"calle" => "Calle",
		"numero" => "Número",
		"local" => "Localidad",
		"prov" => "Provincia",
		"telefono" => "Teléfono",
		"color_portada" => "Color portada",
		"num_copias" => "Número de copias",
		"resolucion" => "Resolución",
		"frecep" => "Fecha de recepción",
		"colorobn" => "Color o Blanco y negro",
		"nombre" => "Nombre"
		);

	foreach ($clav as $key => $value) {
		if($clave==$key){
			$clave = $value;
		}
	}
}

?>

<?php
	require_once("footer.php");
?>