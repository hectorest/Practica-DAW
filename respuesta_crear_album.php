<?php
	require_once("head.php");
	require_once("header.php");
?>

<?php
		if(!empty($_POST["titulo"]) || !empty($_POST["desc"])){
					
			/*$arrayCrearAlb = "Información Álbum -> ";

			if (!empty($_POST["titulo"])) {
						$arrayCrearAlb = $arrayCrearAlb . "Título: ". $_POST["titulo"] . "; ";
			}
			if (!empty($_POST["desc"])) {
						$arrayCrearAlb = $arrayCrearAlb . "Descripción: " . $_POST["desc"] . "; ";
			}

			$arrayCrearAlb = rtrim($arrayCrearAlb);
			$arrayCrearAlb[strlen($arrayCrearAlb) - 1] = ".";

			if(!empty($arrayCrearAlb)){ echo "<p>$arrayCrearAlb</p>"; }	*/

			mostrarTablaCrearAlbum($_POST["titulo"], $_POST["desc"]);
				

		}

function mostrarTablaCrearAlbum(&$titulo, &$desc){
echo <<<tablaCrearAlbum
		<section>


				<h3>Álbum creado</h3>
				<p>Has creado el álbum correctamente.</p>
			
			<div class="contTabla">

				<table class="tabla">

					<caption>Información del álbum:</caption>

					<tr>
						
						<td>Título:</td>
						<td>$titulo</td>

					</tr>

					<tr>
						
						<td>Descripcion:</td>
						<td class="p-left">$desc</td>

					</tr>

				</table>
			</div>

			<div class="enlPerf" id="inicioResSolAlbum">
				<a href="index.php" title="Volver a inicio">Aceptar</a>
			</div>
		</section>
tablaCrearAlbum;
}

?>

<?php
	require_once("footer.php");
?>