<title>Pictures & Images - Control Registro</title>

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

		if($_POST["passw1"] != $_POST["passw2"]){
			$host = $_SERVER['HTTP_HOST']; 
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
			$extra = 'formulario_registro.php';
			header("Location: http://$host$uri/$extra?er=300");
		}else{

			echo<<<arribaTabla

			<section>
				<div class="contTabla">

				<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

				<caption>Datos de registro:</caption>

arribaTabla;

			foreach ($_POST as $key => $value) {
				if($key!="passw2" && $key!="fPer"){
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


		}

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