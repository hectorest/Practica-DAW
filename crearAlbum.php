<?php
	require_once("head.php");
	require_once("header.php");
?>

<?php
		if(!empty($_POST["titulo"]) || !empty($_GET["desc"])){
					
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
				

		}else{

			echo <<<formularioCrearAlbum

			<form action="crearAlbum.php" method="post" class="formulario" id="formCrearAmb">

				<fieldset>

					<legend>
						Crear Álbum
					</legend>

					<p>
						<label for="titulo">Titulo:</label>
						<input type="text" required name="titulo" id="titulo"/>
					</p>
					<p>
						<label for="desc">Descripción:</label>
						<textarea name="desc" id="desc" placeholder="Descripción del álbum o dedicatoria" rows="10" cols="50" maxlength="4000" title="Tope de caracteres o letras: 4000"></textarea>
					</p>
					<p>
						<button type="submit">Crear</button>
					</p>

				</fieldset> 

			</form>
		
formularioCrearAlbum;

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