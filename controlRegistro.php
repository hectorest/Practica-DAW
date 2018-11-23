<?php
session_start();
require_once("conexion_db.php");
$hayPost = false;
foreach ($_POST as $value){
	if(isset($value)){
		$hayPost=true;
	}
}
if($hayPost==true){	
$sanearPost = $_POST;
foreach($sanearPost as $key => $value){
	$GLOBALS["mysqli"]->real_escape_string($value);
}
if($sanearPost["passw1"] != $sanearPost["passw2"]){
	$host = $_SERVER['HTTP_HOST']; 
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
	$extra = 'formulario_registro.php';
	header("Location: http://$host$uri/$extra?er=300");
}else{
require_once("head.php");
require_once("header.php");
	
	echo<<<arribaTabla

		<section>
			<div class="contTabla">

			<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

			<caption>Datos de registro:</caption>

arribaTabla;

			foreach ($sanearPost as $key => $value) {
				if($key!="passw2" && $key!="fPer"){
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
	else{
		echo<<<modalControlRegistro

			<button type="button" onclick="cerrarMensajeModal(2);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>No has enviado los datos para registrarte</p>
					<button type="button" onclick="cerrarMensajeModal(2);">Cerrar</button>
				</div>
			</div>

modalControlRegistro;
	}

function cambiarClave(&$clave){
	$clavesNombre = array(
		"album" => "Álbum",
		"autor" => "Autor",
		"Fecha" => "Fecha",
		"titulo" => "Título",
		"desc" => "Descripción",
		"palClave" => "Palabra clave",
		"passw1" => "Contraseña",
		"pass" => "Contraseña",
		"Sexo" => "Sexo",
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

	foreach ($clavesNombre as $key => $value) {
		if($clave==$key){
			$clave = $value;
		}
	}
}

?>



<?php
	require_once("footer.php");
?>