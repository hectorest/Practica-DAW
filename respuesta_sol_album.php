<?php
	require_once("head.php");
	require_once("header.php");
?>
		
	<?php

	$completo = True;
	
	foreach ($_POST as $value){
		if(!isset($value)){
			$completo=false;
		}
	}
		if($completo==true){			
					/*Valores ficticios de las paginas y las fotos totales del album elegido por el usuario*/
			$numPag = 15;
			$totalFotosAlbum = 30;

			$precio = calcularPrecioAlbum($numPag, $totalFotosAlbum, $_POST["n#umero_copias"], $_POST["resoluci#on"], $_POST["color_o_blanco_y_negro"]);

			/*mostrarTablaResSolAlbum($precioAlbum, $_POST["nombre"], $_POST["titulo"], $_POST["textAdic"], $_POST["email"], $_POST["calle"], $_POST["num"], $_POST["cp"],
								$_POST["pais"], $_POST["local"], $_POST["prov"], $_POST["telefono"], $_POST["colorPortada"], $_POST["numCopias"], $_POST["resolucion"], $_POST["album"], $_POST["frecep"],
								$_POST["colorobn"]);*/

		echo<<<arribaTabla

		<section>


				<h3>Solicitud de álbum realizada</h3>
				<p>Has realizado el pedido del álbum correctamente. Recibirás tu álbum en la fecha indicada. El precio total del álbum es de: <br><span>$precio €</span></p>
			
			<div class="contTabla">

				<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

					<caption>Datos del álbum:</caption>

arribaTabla;

			foreach ($_POST as $key => $value) {
				if($value == ""){
					echo"<tr><td>$clave:</td><td><i>No hay datos</i></td></tr>";
				}
				else{
					$clave = $key;
					cambiarAcentos($clave);
					$clave = ucfirst($clave);
					$clave = str_replace("_", " ", $clave);
					$clave = str_replace("ny", "ñ", $clave);
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

		}

function cambiarAcentos(&$clave){

	$pos = strpos($clave, "#");
	if($pos!=false){
		$vocal = substr($clave, $pos, 2);
		switch ($vocal) {
			case '#a':
				$clave = str_replace("#a", "á", $clave);
				break;
			case '#e':
				$clave = str_replace("#e", "é", $clave);
				break;
			case '#i':
				$clave = str_replace("#i", "í", $clave);
				break;
			case '#o':
				$clave = str_replace("#o", "ó", $clave);
				break;
			case '#u':
				$clave = str_replace("#u", "ú", $clave);
				break;			
			default:
				break;
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