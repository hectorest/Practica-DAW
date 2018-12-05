<?php
session_start();
$cookieFalsa = false;
require_once("controlCookie.php");
require_once("conexion_db.php");
if(isset($_SESSION["usuarioLog"]) && $cookieFalsa == false){
	if(isset($_COOKIE["ultimaVisita"])){
		$ultimaVisita = $_COOKIE["ultimaVisita"];
		$ultimaVisita = strtotime($ultimaVisita);
		$ultimaVisitaDia = date('d-m-Y',$ultimaVisita);
		$ultimaVisitaHora = date('H:i',$ultimaVisita);
		$ultimaVisita = (string) $ultimaVisitaDia . " a las " . (string) $ultimaVisitaHora;
	}
	$haySesion = true;
}
else{
	require_once("head.php");
	require_once("header.php");
	require_once("barraNavSesionNoIniciada.php");
	$haySesion = false;
	if($cookieFalsa){
		mostrarMensErrorCookie();
	}
}

	require_once("conexion_db.php");

	function mostrarErrorActualizarDatos(){
		echo<<<modalSolAlbumSesionNoIniciada
			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
					<span>
						<img src="./img/error.png" alt="error-detalle-foto">
						<h2>Error</h2>
					</span>
					<p>Se ha producido un error al intentar actualizar tus datos</p>
					<button type="button" onclick="cerrarMensajeModal(0);">Aceptar</button>
				</div>
			</div>
modalSolAlbumSesionNoIniciada;

	}

	function mostrarErrorSinEnvioModificarDatos(){
		echo<<<modalControlRegistro

		<button type="button" onclick="cerrarMensajeModal(10);">X</button>
		<div class="modal">
			<div class="contenido">
			<span>
				<img src="./img/error.png" alt="error-control-registro">
				<h2>Error</h2>
			</span>
				<p>No has enviado los datos para modificar tus datos</p>
				<button type="button" onclick="cerrarMensajeModal(10);">Cerrar</button>
			</div>
		</div>

modalControlRegistro;

	}

	if(!isset($_SESSION["usuarioLog"])){
		require_once("head.php");
		require_once("header.php");
		require_once("barraNavSesionIniciada.php");
		mostrarErrorSinEnvioModificarDatos();
		exit;
	}
	else{
		if(!isset($_SERVER["HTTP_REFERER"])){
			$serverCorrecto = false;
			$host = $_SERVER['HTTP_HOST']; 
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
			$extra = 'formulario_modificar.php';
			header("Location: http://$host$uri/$extra?er=310");
			exit;
		}
		else{
			$url = parse_url($_SERVER["HTTP_REFERER"]);
			if($url["host"] != $_SERVER["SERVER_NAME"]){
				$serverCorrecto = false;
				$host = $_SERVER['HTTP_HOST']; 
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
				$extra = 'formulario_modificar.php';
				header("Location: http://$host$uri/$extra?er=310");
				exit;
			}
			else{
				$serverCorrecto = true;
			}
		}
	}
	

	if($haySesion && $serverCorrecto){
		if(!empty($_POST)){

			$sanearPost = $_POST;
			foreach ($sanearPost as $key => $value) {
			  	if(!empty($value)){
			  		$mysqli->real_escape_string($value);
			  	}
			}

			//primero comprobamos si existe ya el nombre de usuario
			$sentencia = 'SELECT * FROM usuarios WHERE NomUsuario =' . "'" . $sanearPost["NomUsuario"] . "'";
			if(!($resultado = $mysqli->query($sentencia))) { 
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
				echo '</p>'; 
				exit; 
			}

			if(mysqli_num_rows($resultado)){
				$fila = $resultado->fetch_object();
			}

			$sentencia1 = 'SELECT * FROM usuarios WHERE IdUsuario =' . "'" . $_SESSION["usuarioLog"] . "'";
			if(!($resultado1 = $mysqli->query($sentencia1))) { 
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
				echo '</p>'; 
				exit; 
			}

			if(mysqli_num_rows($resultado1)){
				$fila1 = $resultado1->fetch_object();
				$claveAct = $fila1->Clave;
			}

			if(mysqli_num_rows($resultado) && mysqli_num_rows($resultado1)){
				$usuPost = $fila->NomUsuario;
				$usuSession = $fila1->NomUsuario;
				if($usuPost != $usuSession){
					$host = $_SERVER['HTTP_HOST']; 
					$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
					$extra = 'formulario_modificar.php';
					header("Location: http://$host$uri/$extra?er=302");
				}
			}
			if($sanearPost["Clave"] != $sanearPost["passw2"]){
				$host = $_SERVER['HTTP_HOST']; 
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
				$extra = 'formulario_modificar.php';
				header("Location: http://$host$uri/$extra?er=300");
			}
			if($sanearPost["passw0"] != $claveAct){
				$host = $_SERVER['HTTP_HOST']; 
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
				$extra = 'formulario_modificar.php';
				header("Location: http://$host$uri/$extra?er=305");
			}

			//actualizar datos base de datos
			require_once("validarRegistro.php");

			if($datosCorrectos){

				$actualizarDatosUsuario = '';
				$cont = 0;
				foreach ($sanearPost as $key => $value) {
					if($key == "passw0" || $key == "passw2"){
						$actualizarDatosUsuario = $actualizarDatosUsuario;
					}
					else{
						if(!empty($value)){
							if($cont == 0){
								$actualizarDatosUsuario = $actualizarDatosUsuario  . $key . "=" . "'" . $value . "'";
								$cont += 1;
							}
							else{
								$actualizarDatosUsuario = $actualizarDatosUsuario . ',' . $key . "=" . "'" . $value . "'";
							}
						}
					}
				}

				if(empty($sanearPost["Pais"])){
					$actualizarDatosUsuario = $actualizarDatosUsuario  . ",Pais" . "=" . "'0'";
				}

				if(empty($sanearPost["Ciudad"])){
					$actualizarDatosUsuario = $actualizarDatosUsuario  . ",Ciudad" . "=" . "''";
				}

				$sentencia = 'UPDATE usuarios SET ' . $actualizarDatosUsuario . ' WHERE IdUsuario = ' . $_SESSION["usuarioLog"];
				if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
					echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
					echo '</p>'; 
					exit; 
				}
				require_once("head.php");
				require_once("header.php");
				require_once("barraNavSesionIniciada.php");
				if($mysqli->affected_rows >= 0){
					require_once("escribirTablaRegNuevoUsuario.php");
				}
				else{
					mostrarErrorActualizarDatos();
				}
			}
			else{

				require_once("head.php");
				require_once("header.php");
				require_once("barraNavSesionIniciada.php");

				echo<<<modalControlRegistro

			<button type="button" onclick="cerrarMensajeModal(3);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>Los datos enviados se han corrompido. Anulada la modificación de datos del usuario actual</p>
					<button type="button" onclick="cerrarMensajeModal(3);">Cerrar</button>
				</div>
			</div>

modalControlRegistro;

			}
		}
		else{
			mostrarErrorSinEnvioModificarDatos();
		}
	}
	else{
		mostrarErrorSinEnvioModificarDatos();
	}
	

?>