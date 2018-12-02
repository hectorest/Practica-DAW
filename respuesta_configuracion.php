<?php
session_start();
$cookieFalsa = false;
require_once("controlCookie.php");
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
	require_once("header.php");
	require_once("barraNavSesionNoIniciada.php");
	$haySesion = false;
	if($cookieFalsa){
		mostrarMensErrorCookie();
	}
}

require_once("conexion_db.php");

	function mostrarErrorRespConf(){
		echo<<<modalSolAlbumSesionNoIniciada
			<button type="button" onclick="cerrarMensajeModal(9);">X</button>
			<div class="modal">
				<div class="contenido">
					<span>
						<img src="./img/error.png" alt="error-detalle-foto">
						<h2>Error</h2>
					</span>
					<p>Debes seleccionar una opción de estilo para poder cambiar la configuración del sitio web</p>
					<button type="button" onclick="cerrarMensajeModal(9);">Aceptar</button>
				</div>
			</div>
modalSolAlbumSesionNoIniciada;

	}

	function mostrarErrorEstiloNoExistente(){
		echo<<<modalSolAlbumSesionNoIniciada
			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
					<span>
						<img src="./img/error.png" alt="error-detalle-foto">
						<h2>Error</h2>
					</span>
					<p>El estilo seleccionado no existe</p>
					<button type="button" onclick="cerrarMensajeModal(0);">Aceptar</button>
				</div>
			</div>
modalSolAlbumSesionNoIniciada;

	}

	function mostrarMensEstiloCambiado(&$est){
		echo<<<modalSolAlbumSesionNoIniciada
			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
					<span>
						<h2>¡Estilo cambiado con éxito!</h2>
					</span>
					<p>A partir de ahora la web se visualizará con el estilo $est cuando inicies sesión</p>
					<button type="button" onclick="cerrarMensajeModal(0);">Aceptar</button>
				</div>
			</div>
modalSolAlbumSesionNoIniciada;

	}

	function mostrarMensEstiloSinModificar(&$est){
		echo<<<modalSolAlbumSesionNoIniciada
			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
					<span>
						<h2>¡Estilo ya seleccionado!</h2>
					</span>
					<p>El estilo $est ya está seleccionado como estilo por defecto del sitio web</p>
					<button type="button" onclick="cerrarMensajeModal(0);">Aceptar</button>
				</div>
			</div>
modalSolAlbumSesionNoIniciada;

	}

	if($haySesion){
		if(!empty($_POST)){
			$postSaneado = $_POST;
			foreach ($postSaneado as $key => $value) {
			  	if(!empty($value)){
			  		$mysqli->real_escape_string($value);
			  	}
			}
			if(is_numeric($postSaneado["estiloWeb"])){

				$sentencia = 'SELECT * FROM estilos WHERE IdEstilo = ' . $postSaneado["estiloWeb"];
				if(!($estilo = $GLOBALS["mysqli"]->query($sentencia))) { 
					echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
					echo '</p>'; 
					exit; 
				}

				$nomEstilo = $estilo->fetch_object();
				$nomEstilo = $nomEstilo->Nombre;

				if(mysqli_num_rows($estilo) >= 1){
					$sentencia = 'UPDATE usuarios SET Estilo = '. "'" . $postSaneado["estiloWeb"] . "'" . ' WHERE IdUsuario = ' . $_SESSION["usuarioLog"];
					if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
					  echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
					  echo '</p>'; 
					  exit; 
					}
					if($mysqli->affected_rows > 0){
						require_once("head.php");
						require_once("header.php");
						require_once("barraNavSesionIniciada.php");
						mostrarMensEstiloCambiado($nomEstilo);
					}
					else if($mysqli->affected_rows == 0){
						require_once("head.php");
						require_once("header.php");
						require_once("barraNavSesionIniciada.php");
						mostrarMensEstiloSinModificar($nomEstilo);
					}
				}
				else{
					mostrarErrorEstiloNoExistente();
				}

			}
		}
		else{
			require_once("head.php");
			require_once("header.php");
			require_once("barraNavSesionNoIniciada.php");
			mostrarErrorEstiloNoExistente();
		}
	}
	else{
		require_once("head.php");
		require_once("header.php");
		require_once("barraNavSesionNoIniciada.php");
		mostrarErrorRespConf();
	}





?>