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
if($sanearPost["Clave"] != $sanearPost["passw2"]){
	$host = $_SERVER['HTTP_HOST']; 
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
	$extra = 'formulario_registro.php';
	header("Location: http://$host$uri/$extra?er=300");
	exit;
}
if(!empty($sanearPost["FNacimiento"])){
	$fechaActual = date('Y-m-d');
	if($fechaActual <= $sanearPost["FNacimiento"]){
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
		$extra = 'formulario_registro.php';
		header("Location: http://$host$uri/$extra?er=320");
		exit;
	}
}
	require_once("comprobacionServer.php");
	$urlPag = "formulario_registro.php";
	comprobarServer($urlPag);

	

	//insertar datos base de datos
	require_once("validarRegistro.php");

	//if($serverCorrecto){

		if($datosCorrectos){

			//primero comprobamos si existe ya el nombre de usuario
			$sentencia = 'SELECT * FROM usuarios WHERE NomUsuario =' . "'" . $sanearPost["NomUsuario"] . "'";
			if(!($resultado = $mysqli->query($sentencia))) { 
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
				echo '</p>'; 
				exit; 
			}
			if(mysqli_num_rows($resultado)){
				$host = $_SERVER['HTTP_HOST']; 
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
				$extra = 'formulario_registro.php';
				header("Location: http://$host$uri/$extra?er=301");
			}
			else{

				require_once("rellenarInsertarDatosRegistro.php");
				if(!empty($sanearPost["Foto"])){
					$insertarDatos = $insertarDatos . ',' . "'" . $sanearPost["Foto"] . "'" . ',';
				}
				else{
					$insertarDatos = $insertarDatos . ",'',";
				}
				$insertarDatos = $insertarDatos . "SYSDATE(),1";

				$sentencia = 'INSERT INTO usuarios (IdUsuario, NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, FRegistro, Estilo) VALUES (' . $insertarDatos . ')';
				if(!($resultado = $mysqli->query($sentencia))) { 
					echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
					echo '</p>'; 
					exit; 
				}
				if($mysqli->affected_rows >= 1){
					
					//pasamos a mostrar la tabla con los datos del usuario registrado

					require_once("head.php");
					require_once("header.php");
					require_once("barraNavSesionNoIniciada.php");

					require_once("escribirTablaRegNuevoUsuario.php");

				}
			}
		}
		else{
			require_once("head.php");
			require_once("header.php");
			require_once("barraNavSesionNoIniciada.php");
			echo<<<modalControlRegistro

				<button type="button" onclick="cerrarMensajeModal(0);">X</button>
				<div class="modal">
					<div class="contenido">
					<span>
						<img src="./img/error.png" alt="error-control-registro">
						<h2>Error</h2>
					</span>
						<p>Los datos enviados se han corrompido. Anulado el registro del nuevo usuario</p>
						<button type="button" onclick="cerrarMensajeModal(0);">Cerrar</button>
					</div>
				</div>

modalControlRegistro;

		}
}
else{
	require_once("head.php");
	require_once("header.php");
	require_once("barraNavSesionNoIniciada.php");
	echo<<<modalControlRegistro

		<button type="button" onclick="cerrarMensajeModal(0);">X</button>
		<div class="modal">
			<div class="contenido">
			<span>
				<img src="./img/error.png" alt="error-control-registro">
				<h2>Error</h2>
			</span>
				<p>No has enviado los datos para registrarte</p>
				<button type="button" onclick="cerrarMensajeModal(0);">Cerrar</button>
			</div>
		</div>

modalControlRegistro;
}

?>



<?php
	require_once("footer.php");
?>