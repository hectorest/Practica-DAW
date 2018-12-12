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
			"Pais" => "País",
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
			"nombre" => "Nombre"
		);

		foreach ($clavesNombre as $key => $value) {
			if($clave==$key){
				$clave = $value;
			}
		}
	}

	if(isset($_SESSION["usuarioLog"])){
		$sesionSaneada = $mysqli->real_escape_string($_SESSION["usuarioLog"]);
		$titulo = "<h3>Modificación realizada</h3>";
	}

	$sentencia = 'SELECT * FROM usuarios JOIN paises ON (usuarios.Pais = paises.IdPais) WHERE NomUsuario =' . "'" . $sanearPost["NomUsuario"] . "'";
		if(!($resultado = $mysqli->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($resultado) >= 1){

			$respuesta = $resultado->fetch_object();
			$pais = $respuesta->NomPais;
			if($pais == 'Ninguno'){
				$pais = 'No hay datos';
			}
			if(!empty($titulo)){

				echo<<<arribaTabla

					<section>
						
						$titulo

						<div class="contTabla">

						<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

						<caption>Datos de registro:</caption>

arribaTabla;

			}
			else{

				echo<<<arribaTabla

					<section>

						<div class="contTabla">

						<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

						<caption>Datos de registro:</caption>

arribaTabla;

			}

			foreach ($sanearPost as $key => $value) {
				if($key!="passw2" && $key!="passw0"){
					$clave = $key;
					cambiarClave($clave);
					if($value == ""){
						echo"<tr><td>$clave:</td><td><i>No hay datos</i></td></tr>";
					}
					else{
						if($key == "Sexo"){
							if($value == 1){
								$value = "Hombre";
							}
							else if($value == 2){
								$value = "Mujer";
							}
							else{
								$value = "Otro";
							}
						}
						if($key == "Pais"){
							$value = $pais;
						}
						echo"<tr><td>$clave:</td><td>$value</td></tr>";
					}
				}
			}

			if(!empty($_FILES["Foto"])){
				echo"<tr><td>Foto Perfil:</td><td>{$_FILES['Foto']['name']}</td></tr>";
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

		$resultado->free();

?>