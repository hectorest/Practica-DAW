<?php
session_start();
require_once("conexion_db.php");
if(!isset($_SESSION["usuarioLog"])){
	require_once("barraNavSesionNoIniciada.php");
}
?>
<?php
function mostrarMensErrorDatosCorruptos(){

		echo<<<modalControlRegistro

			<button type="button" onclick="cerrarMensajeModal(10);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>Los datos enviados se han corrompido. Anulado el registro del nuevo usuario</p>
					<button type="button" onclick="cerrarMensajeModal(10);">Cerrar</button>
				</div>
			</div>

modalControlRegistro;

}
if(!isset($_SESSION["usuarioLog"])){
	require_once("head.php");
	require_once("header.php");
	echo<<<modalcrear_album

			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>No has enviado los datos para crear un álbum</p>
					<button type="button" onclick="cerrarMensajeModal(6);">Crear álbum</button>
				</div>
			</div>

modalcrear_album;
	exit;
}
else{
	require_once("comprobacionServer.php");
	$urlPag = "crear_album.php";
	comprobarServer($urlPag);
}
$hayPost = false;
foreach ($_POST as $value){
	if(isset($value)){
		$hayPost=true;
	}
}
if($serverCorrecto == true && $hayPost == true){
	$sanearPost = $_POST;
	foreach ($sanearPost as $key => $value) {
		if(!empty($value)){
			$GLOBALS["mysqli"]->real_escape_string($value);
		}
	}
	if(!empty($sanearPost["titulo"]) && filter_has_var(INPUT_POST, 'titulo')){
		$sentencia = 'SELECT * FROM albumes WHERE Titulo = ' . "'" . $sanearPost["titulo"] . "'" . ' AND Usuario = ' . $_SESSION["usuarioLog"];
		if(!($resultado = $mysqli->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
			echo '</p>'; 
			exit; 
		}
		if(mysqli_num_rows($resultado)){
			$resultado->free();
			$host = $_SERVER['HTTP_HOST']; 
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
			$extra = 'crear_album.php';
			header("Location: http://$host$uri/$extra?er=301");
		}
		else{
			$resultado->free();
			$insertarDatos = "''";
			foreach ($sanearPost as $key => $value) {
				if(!empty($value)){
					if(is_numeric($value)){
						$insertarDatos = $insertarDatos . ',' . $value;
					}
					else{
						$insertarDatos = $insertarDatos . ',' . "'". $value . "'";
					}
				}
				else{
					$insertarDatos = $insertarDatos . ",''";
				}
			}
			$insertarDatos = $insertarDatos . ',' . "'" . $_SESSION["usuarioLog"] . "'";
			$sentencia = 'INSERT INTO albumes (IdAlbum, Titulo, Descripcion, Usuario) VALUES (' . $insertarDatos . ')';
			if(!($resultado = $mysqli->query($sentencia))) { 
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
				echo '</p>';
				exit;
			}
			if($mysqli->affected_rows >= 1){
				$idNuevoAlbum = $mysqli->insert_id;
				require_once("head.php");
				require_once("header.php");
				require_once("barraNavSesionIniciada.php");
				require_once("rellenarTablaNuevoAlbum.php");
			}
		}
	}
	else{
		require_once("head.php");
		require_once("header.php");
		mostrarMensErrorDatosCorruptos();
	}
	$GLOBALS["mysqli"]->close();
}
else{
	$GLOBALS["mysqli"]->close();
	require_once("head.php");
	require_once("header.php");
	require_once("barraNavSesionIniciada.php");
	echo<<<modalcrear_album

			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>No has enviado los datos para crear un álbum</p>
					<button type="button" onclick="cerrarMensajeModal(6);">Crear álbum</button>
				</div>
			</div>

modalcrear_album;
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