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

	$postSaneado = $_POST;
	foreach ($postSaneado as $key => $value) {
		if(!empty($value)){
			$GLOBALS["mysqli"]->real_escape_string($value);
		}
	}
		if($hayPost==true){	

			/*Valores ficticios de las paginas y las fotos totales del album elegido por el usuario*/

			$numPag = 15;
			$totalFotosAlbum = 30;

			$precio = calcularPrecioAlbum($numPag, $totalFotosAlbum, $_POST["num_copias"], $_POST["resolucion"], $_POST["colorobn"]);


		echo<<<arribaTabla

		<section>


			<h3>Solicitud de álbum realizada</h3>
			<p>Has realizado el pedido del álbum correctamente. Recibirás tu álbum en la fecha indicada. El precio total del álbum es de: <br><span>$precio €</span></p>
			
			<div class="contTabla">

				<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

					<caption>Datos del álbum:</caption>

arribaTabla;

			foreach ($postSaneado as $key => $value) {
				$clave = $key;
				cambiarClave($clave);
				if($value == ""){
					echo"<tr><td>$clave:</td><td><i>No hay datos</i></td></tr>";
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
			
			echo<<<modalRespSolAlbum

			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-respuesta-sol-album">
					<h2>Error</h2>
				</span>
					<p>No has solicitado ningún álbum</p>
					<button type="button" onclick="cerrarMensajeModal(5);">Solicitar álbum</button>
				</div>
			</div>

modalRespSolAlbum;
		}

function cambiarClave(&$clave){
	$clavesNombre = array(
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

	foreach ($clavesNombre as $key => $value) {
		if($clave==$key){
			$clave = $value;
		}
	}
}

function calcularPrecioAlbum($numpag, $totalFotosAlbum, $numCopias, $resolucion, $colorobn){
					
	$precioTotalPags = 0.0;
					
	if($numpag < 5){
		$precioTotalPags += $numPag * 0.10;
	}
	else if($numpag >= 5 && $numpag <= 10){
		$precioTotalPags += $numpag * 0.08;
	}
	else{
		$precioTotalPags += $numpag * 0.07;
	}

	$precioTotalFotos = 0.0;

	if($colorobn == "color"){
		$precioTotalFotos += $totalFotosAlbum * 0.05;
	}

	if($resolucion > 300){
		$precioTotalFotos += $totalFotosAlbum * 0.02;
	}

	$precioTotal = ($precioTotalPags + $precioTotalFotos) * $numCopias;

	return $precioTotal;
					
}

?>

<?php
	require_once("footer.php");
?>