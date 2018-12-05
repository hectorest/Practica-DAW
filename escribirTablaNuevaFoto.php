<?php

require_once("conexion_db.php");
	
	function cambiarClave(&$clave){
		$clavesNombre = array(
			"album" => "Álbum",
			"autor" => "Autor",
			"Fecha" => "Fecha",
			"titulo" => "Título",
			"desc" => "Descripción",
			"palClave" => "Palabra clave",
			"Clave" => "Contraseña",
			"Sexo" => "Sexo",
			"FNacimiento" => "Fecha de nacimiento",
			"Ciudad" => "Ciudad de residencia",
			"local" => "Localidad",
			"Pais" => "País de residencia",
			"NomUsuario" => "Usuario",
			"Email" => "Email",
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
			"descripcion" => "Descripción",
			"fechaFoto" => "Fecha",
			"texto_alternativo" => "Color o Blanco y negro",
			"pais" => "País"
		);

		foreach ($clavesNombre as $key => $value) {
			if($clave==$key){
				$clave = $value;
			}
		}
	}

	if(isset($_SESSION["usuarioLog"])){
		$sesionSaneada = $mysqli->real_escape_string($_SESSION["usuarioLog"]);
	}
	$sentencia = 'SELECT * FROM fotos JOIN paises ON (fotos.Pais = paises.IdPais) WHERE fotos.Titulo =' . "'" . $sanearPost["titulo"] . "'";
		if(!($resultado = $mysqli->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($resultado) >= 1){

			$sentencia1 = 'SELECT * FROM fotos JOIN albumes ON (fotos.Album = albumes.IdAlbum) WHERE fotos.Titulo =' . "'" . $sanearPost["titulo"] . "'";
				if(!($resultado1 = $mysqli->query($sentencia1))) { 
					echo "<p>Error al ejecutar la sentencia <b>$sentencia1</b>: " . $mysqli->error; 
					echo '</p>'; 
					exit; 
				}

				if(mysqli_num_rows($resultado1) >= 1){

					$respuesta = $resultado->fetch_object();
					$pais = $respuesta->NomPais;
					if($pais == 'Ninguno'){
						$pais = 'No hay datos';
					}

					$respuesta1 = $resultado1->fetch_object();
					$album = $respuesta1->Titulo;
					if($album == 'Ninguno'){
						$album = 'No hay datos';
					}


				echo<<<arribaTabla

					<section>

						<div class="contTabla">

						<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

						<caption>Datos de la foto añadida:</caption>

arribaTabla;

			foreach ($sanearPost as $key => $value) {
				if($key!="passw2" && $key!="fPer" && $key!="passw0"){
					$clave = $key;
					cambiarClave($clave);
					if($value == ""){
						echo"<tr><td>$clave:</td><td><i>No hay datos</i></td></tr>";
					}
					else{
						if($key == "pais"){
							$value = $pais;
						}
						if($key == "album"){
							$value = $album;
						}
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
			}

		}

		$resultado->free();

?>