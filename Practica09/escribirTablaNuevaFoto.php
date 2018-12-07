<?php

require_once("conexion_db.php");
	
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
		"nombre" => "Nombre",
		"fotosXpagina" => "Fotos por página",
		"descripcion" => "Descripción",
		"texto_alternativo" => "Texto alternativo",
		"fechaFoto" => "Fecha de la foto"
		);

		foreach ($clavesNombre as $key => $value) {
			if($clave==$key){
				$clave = $value;
			}
		}
	}

				echo<<<arribaTabla

					<section>

						<div class="contTabla">

						<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

						<caption>Datos de la foto añadida:</caption>

arribaTabla;

			require_once("extraerDatos.php");

			foreach ($sanearPost as $key => $value) {
				if($key!="passw2" && $key!="fPer" && $key!="passw0"){
					if($key == "Pais"){
						$value = extraerPais($value);
					}
					if($key == "album"){
						$value = extraerAlbum($value);
					}
					$clave = $key;
					cambiarClave($clave);
					if($value == ""){
						echo"<tr><td>$clave:</td><td><i>No hay datos</i></td></tr>";
					}
					else{
						echo"<tr><td>$clave:</td><td>$value</td></tr>";
					}
				}
			}

			echo<<<bajotabla

					</table>

				</div>

				<div class="enlPerf">
					<a href="index.php" title="Volver a inicio">Aceptar</a>
				</div>

			</section>

bajotabla;

?>