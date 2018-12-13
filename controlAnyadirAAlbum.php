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
	$urlPag = "anyadir_foto_album.php";
	comprobarServer($urlPag);
	

	//insertar datos base de datos
	require_once("validarFoto.php");
	$topeTamImg = 2097152;
	if($serverCorrecto){

		if($datosCorrectos){

			require_once("rellenarInsertarDatosRegistro.php");
				if(!empty($_FILES["Foto"]) && is_uploaded_file($_FILES["Foto"]["tmp_name"])){
					if($_FILES["Foto"]["error"] > 0) {
						$host = $_SERVER['HTTP_HOST']; 
						$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
						$extra = 'anyadir_foto_album.php';
						header("Location: http://$host$uri/$extra?erFile={$_FILES['Foto']['error']}");
						exit;
					}
					else{ 

                       	$arrayNomArchivo = explode(".", $_FILES['Foto']['name']);

						$extensionArchivo = $arrayNomArchivo[sizeof($arrayNomArchivo) - 1];

						$fecha = getdate();

						$fechaSaneada = $fecha["mday"]. "-" .$fecha["mon"]. "-" .$fecha["year"]. "-" .$fecha["hours"]. "-" .$fecha["minutes"]. "-" .$fecha["seconds"]; 

						$nomFile = $_FILES["Foto"]["name"] . "-" . $fechaSaneada . "-" . $_SESSION["usuarioLog"] . "." . $extensionArchivo;

                        $directorio="ficheros/fotosSubidas/" . $nomFile; 

                        if($_FILES["Foto"]["size"] > $topeTamImg){
                       		$host = $_SERVER['HTTP_HOST']; 
							$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
							$extra = 'formulario_registro.php';
							header("Location: http://$host$uri/$extra?erFile=2");
							exit;
                        }
                        else{
                       		 move_uploaded_file($_FILES["Foto"]["tmp_name"], "ficheros/fotosSubidas/" . $nomFile);
                        }
                        
                        $foto="ficheros/fotosSubidas/".$nomFile;
						$insertarDatos = $insertarDatos . ',' . "'" . $foto . "'" . ',';
                       
                    }
                }
				else{
					$insertarDatos = $insertarDatos . ",'',";
				}
				$insertarDatos = $insertarDatos . " SYSDATE()";
				$sentencia = 'INSERT INTO fotos (IdFoto, Titulo, Descripcion, Fecha, Pais, Alternativo, Album, Fichero, FRegistro) VALUES (' . $insertarDatos . ')';
				if(!($resultado = $mysqli->query($sentencia))) { 
					echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
					echo '</p>'; 
					exit; 
				}
				if($mysqli->affected_rows >= 1){
					
					//pasamos a mostrar la tabla con los datos de la foto insertada

					require_once("head.php");
					require_once("header.php");
					require_once("barraNavSesionIniciada.php");

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
						<p>Los datos introducidos no son válidos. Recuerda que el título no sea el mismo de una foto tuya y que el album debe existir</p>
						<button type="button" onclick="cerrarMensajeModal(11);">Cerrar</button>
					</div>
				</div>

modalControlAnyadirAAlbum;

		}
	}
	else{
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
		$extra = 'anyadir_foto_album.php';
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