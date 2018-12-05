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
if(!isset($_SERVER["HTTP_REFERER"])){
		$serverCorrecto = false;
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
		$extra = 'anyadir_foto_album.php';
		header("Location: http://$host$uri/$extra?er=310");
		exit;
	}
	else{
		$url = parse_url($_SERVER["HTTP_REFERER"]);
		if($url["host"] != $_SERVER["SERVER_NAME"]){
			$serverCorrecto = false;
			$host = $_SERVER['HTTP_HOST']; 
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
			$extra = 'anyadir_foto_album.php';
			header("Location: http://$host$uri/$extra?er=310");
			exit;
		}
		else{
			$serverCorrecto = true;
		}
	}
	

	//insertar datos base de datos
	require_once("validarFoto.php");

	if($serverCorrecto){

		if($datosCorrectos){

			require_once("rellenarInsertarDatosRegistro.php");
				$insertarDatos = $insertarDatos . "SYSDATE()";
				$sentencia = 'INSERT INTO fotos (IdFoto, Titulo, Descripcion, Fecha, Pais, Fichero, Alternativo, Album, FRegistro) VALUES (' . $insertarDatos . ')';
				if(!($resultado = $mysqli->query($sentencia))) { 
					echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
					echo '</p>'; 
					exit; 
				}
				if($mysqli->affected_rows >= 1){
					
					//pasamos a mostrar la tabla con los datos de la foto insertada

					require_once("head.php");
					require_once("header.php");
					require_once("barraNavSesionNoIniciada.php");

					require_once("escribirTablaNuevaFoto.php");

				}
		}
		else{

					require_once("head.php");
					require_once("header.php");
					require_once("barraNavSesionIniciada.php");

			echo<<<modalControlAnyadirAAlbum

				<button type="button" onclick="cerrarMensajeModal(11);">X</button>
				<div class="modal">
					<div class="contenido">
					<span>
						<img src="./img/error.png" alt="error-control-registro">
						<h2>Error</h2>
					</span>
						<p>Ya existe una foto con el título "$tituloExistente". Inserte otro título</p>
						<button type="button" onclick="cerrarMensajeModal(11);">Cerrar</button>
					</div>
				</div>

modalControlAnyadirAAlbum;

		}
	}
	else{
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
		$extra = 'formulario_registro.php';
		header("Location: http://$host$uri/$extra?er=310");
	}
}
else{
	echo<<<modalAnyadirFotoAAlbum

		<button type="button" onclick="cerrarMensajeModal(11);">X</button>
		<div class="modal">
			<div class="contenido">
			<span>
				<img src="./img/error.png" alt="error-control-registro">
				<h2>Error</h2>
			</span>
				<p>No has enviado los datos para añadir una foto</p>
				<button type="button" onclick="cerrarMensajeModal(11);">Cerrar</button>
			</div>
		</div>

modalAnyadirFotoAAlbum;
}

?>



<?php
	require_once("footer.php");
?>