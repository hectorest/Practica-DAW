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

		echo<<<arribaTabla

			<section>

				<h3>Álbum creado</h3>
				<p>Has creado el álbum correctamente.</p>
			
			<div class="contTabla">

				<table class="tabla">

					<caption>Información del álbum:</caption>

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

?>

<?php
	require_once("footer.php");
?>