<title>Pictures & Images - Crear Álbum</title>

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