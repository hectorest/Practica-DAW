<?php
	require_once("head.php");
	require_once("header.php");
?>

	<?php
		if(!empty($_GET["titulo"]) || !empty($_GET["desc"])){
					
			/*$arrayCrearAlb = "Información Álbum -> ";

			if (!empty($_GET["titulo"])) {
						$arrayCrearAlb = $arrayCrearAlb . "Título: ". $_GET["titulo"] . "; ";
			}
			if (!empty($_GET["desc"])) {
						$arrayCrearAlb = $arrayCrearAlb . "Descripción: " . $_GET["desc"] . "; ";
			}

			$arrayCrearAlb = rtrim($arrayCrearAlb);
			$arrayCrearAlb[strlen($arrayCrearAlb) - 1] = ".";

			if(!empty($arrayCrearAlb)){ echo "<p>$arrayCrearAlb</p>"; }	*/

			echo<<<datosCrearAlbum

				<section>
					<h3>Información del álbum</h3> 

					<div class="mostrarDatos">
				
datosCrearAlbum;

						if (!empty($_GET["titulo"])) {

							$titulo = $_GET["titulo"];

							echo "<p>Titulo: $titulo</p>";
						}
						if (!empty($_GET["desc"])) {

							$desc = $_GET["desc"];

							echo "<p>Descripción: $desc</p>";
						}

					echo "</div> </section>";

		}else{

			echo <<<formularioCrearAlbum

			<form action="crearAlbum.php" method="get" class="formulario" id="formCrearAmb">

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
	?>
<?php
	require_once("footer.php");
?>