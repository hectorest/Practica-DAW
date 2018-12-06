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
	require_once("comprobacionServer.php");
	$urlPag = "formulario_registro.php";
	comprobarServer($urlPag);
	
	//insertar datos base de datos
	require_once("validarSolicitud.php");
	$datosCorrectos=true;

if($serverCorrecto){

	if($datosCorrectos){

		$sentencia = 'SELECT count(IdFoto) numFotos FROM fotos WHERE Album =' . "'" . $sanearPost["album"] . "'";
		if(!($resultado = $mysqli->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($resultado)){
			$fila = $resultado->fetch_object();
		}

			$totalFotosAlbum = $fila->numFotos;
			$numPag = 0;
			if($totalFotosAlbum%$sanearPost["fotosXpagina"]==0){
				$numPag = $totalFotosAlbum/$sanearPost["fotosXpagina"];
			}else{
				$numPag = ceil($totalFotosAlbum/$sanearPost["fotosXpagina"]);
			}

			$coste = calcularPrecioAlbum($numPag, $totalFotosAlbum, $sanearPost["num_copias"], $sanearPost["resolucion"], $sanearPost["colorobn"]);

		require_once("rellenarInsertarDatosRegistro.php");
			$insertarDatos = $insertarDatos . ", SYSDATE(), $coste";
			$sentencia = 'INSERT INTO solicitudes (IdSolicitud, Nombre, Titulo, Descripcion, Email, d_Calle, d_Numero, d_CP, d_Pais, d_Localidad, d_Provincia, Color, Copias, Resolucion, Album, Fecha, IColor, FRegistro, Coste) VALUES (' . $insertarDatos . ')';
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
				require_once("respuesta_sol_album.php");

			}
	}
	else{

				require_once("head.php");
				require_once("header.php");
				require_once("barraNavSesionIniciada.php");

		echo<<<modalControlAnyadirAAlbum

			<button type="button" onclick="cerrarMensajeModal(12);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>Esta solicitud no es correcta</p>
					<button type="button" onclick="cerrarMensajeModal(12);">Cerrar</button>
				</div>
			</div>

modalControlAnyadirAAlbum;

		}
	}
	else{
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
		$extra = 'solicitar_album.php';
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
				<p>No has enviado los datos de solicitud</p>
				<button type="button" onclick="cerrarMensajeModal(11);">Cerrar</button>
			</div>
		</div>

modalAnyadirFotoAAlbum;
}

function calcularPrecioAlbum($numpag, $totalFotosAlbum, $numCopias, $resolucion, $colorobn){
					
	$precioTotalPags = 0.0;
					
	if($numpag < 5){
		$precioTotalPags += $numpag * 0.10;
	}
	else if($numpag >= 5 && $numpag <= 10){
		$precioTotalPags += $numpag * 0.08;
	}
	else{
		$precioTotalPags += $numpag * 0.07;
	}

	$precioTotalFotos = 0.0;

	if($colorobn == "color"){
		$precioTotalFotos += $totalFotosAlbum * 0.05;
	}

	if($resolucion > 300){
		$precioTotalFotos += $totalFotosAlbum * 0.02;
	}

	$precioTotal = ($precioTotalPags + $precioTotalFotos) * $numCopias;

	return $precioTotal;
					
}
	
?>

<?php
	require_once("footer.php");
?>