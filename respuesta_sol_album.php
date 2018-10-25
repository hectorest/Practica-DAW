<?php
	require_once("head.php");
	require_once("header.php");
?>
		
	<?php

		if(!empty($_POST["nombre"]) && !empty($_POST["titulo"]) && !empty($_POST["email"]) && !empty($_POST["calle"])){
			if(!empty($_POST["num"]) && !empty($_POST["cp"]) && !empty($_POST["pais"]) && !empty($_POST["local"])){
				if(!empty($_POST["prov"]) && !empty($_POST["album"])){
					
					/*Valores ficticios de las paginas y las fotos totales del album elegido por el usuario*/
					$numPag = 15;
					$totalFotosAlbum = 30;

					$precioAlbum = calcularPrecioAlbum($numPag, $totalFotosAlbum, $_POST["numCopias"], $_POST["resolucion"], $_POST["colorobn"]);

					mostrarTablaResSolAlbum($precioAlbum, $_POST["nombre"], $_POST["titulo"], $_POST["textAdic"], $_POST["email"], $_POST["calle"], $_POST["num"], $_POST["cp"],
						$_POST["pais"], $_POST["local"], $_POST["prov"], $_POST["telefono"], $_POST["colorPortada"], $_POST["numCopias"], $_POST["resolucion"], $_POST["album"], $_POST["frecep"],
						$_POST["colorobn"]);
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

function mostrarTablaResSolAlbum(&$precio, &$nombre, &$titulo, &$textAdic, &$email, &$calle, &$num, &$cp, &$pais, &$local, &$prov,
								 &$telefono, &$colorPortada, &$numCopias, &$resolucion, &$album, &$frecep, &$colorobn){

echo <<<tablaRespSolAlbum
		<section>


				<h3>Solicitud de álbum realizada</h3>
				<p>Has realizado el pedido del álbum correctamente. Recibirás tu álbum en la fecha indicada. El precio total del álbum es de: <br><span>$precio €</span></p>
			
			<div class="contTabla">

				<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

					<caption>Datos del álbum:</caption>

					<tr>
						
						<td>Nombre:</td>
						<td>$nombre</td>

					</tr>

					<tr>
						
						<td>Título:</td>
						<td>$titulo</td>

					</tr>

					<tr>
						
						<td>Texto adicional:</td>
						<td class="p-left">$textAdic</td>

					</tr>

					<tr>
						
						<td>Email:</td>
						<td>$email</td>

					</tr>

					<tr>
						
						<td>Dirección:</td>
						<td><span>Calle: $calle.</span><span> Número: $num.</span><span> CP: $cp.</span><span> País: $pais.</span><span> Localidad: $local.</span><span> Provincia: $prov</span></td>

					</tr>

					<tr>
						
						<td>Teléfono:</td>
						<td>$telefono</td>

					</tr>

					<tr>
						
						<td>Color de la portada:</td>
						<td>$colorPortada</td>

					</tr>

					<tr>
						
						<td>Número de Copias:</td>
						<td>$numCopias</td>

					</tr>

					<tr>
						
						<td>Resol. Impresión:</td>
						<td>$resolucion DPI</td>

					</tr>

					<tr>
						
						<td>Álbum de PI:</td>
						<td>$album</td>

					</tr>

					<tr>
						
						<td>Fecha Recepción:</td>
						<td>$frecep</td>

					</tr>

					<tr>
						
						<td>Impresión:</td>
						<td>$colorobn</td>

					</tr>

				</table>
			</div>

			<div class="enlPerf" id="inicioResSolAlbum">
				<a href="index.php" title="Volver a inicio">Aceptar</a>
			</div>
		</section>
tablaRespSolAlbum;
}

?>

<?php
	require_once("footer.php");
?>