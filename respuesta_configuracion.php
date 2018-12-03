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

	function mostrarMensEstiloCorrompido(){

		echo<<<modalControlRegistro

			<button type="button" onclick="cerrarMensajeModal(2);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>Los datos enviados se han corrompido. Anulado el cambio en la configuración de la web</p>
					<button type="button" onclick="cerrarMensajeModal(2);">Cerrar</button>
				</div>
			</div>

modalControlRegistro;

	}

	function mostrarMensErrorCargaDeEstilos(){

		echo<<<modalControlRegistro

			<button type="button" onclick="cerrarMensajeModal(2);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>Se ha producido un error a la hora de cargar los estilos disponibles</p>
					<button type="button" onclick="cerrarMensajeModal(2);">Cerrar</button>
				</div>
			</div>

modalControlRegistro;

	}

	function mostrarMensErrorAccesoRemoto(){

		echo<<<modalControlRegistro

			<button type="button" onclick="cerrarMensajeModal(2);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>Para poder realizar cualquier cambio en los datos almacenados en Pictures & Images debes enviar los datos desde la dirección del propio sitio web</p>
					<button type="button" onclick="cerrarMensajeModal(2);">Cerrar</button>
				</div>
			</div>

modalControlRegistro;

	}

	if(!isset($_SESSION["usuarioLog"])){
		mostrarErrorRespConf();
		exit;
	}
	else{
		if(!isset($_SERVER["HTTP_REFERER"])){
			$serverCorrecto = false;
			mostrarMensErrorAccesoRemoto();
			exit;
		}
		else{
			$url = parse_url($_SERVER["HTTP_REFERER"]);
			if($url["host"] != $_SERVER["SERVER_NAME"]){
				$serverCorrecto = false;
				mostrarMensErrorAccesoRemoto();
				exit;
			}
			else{
				$serverCorrecto = true;
			}
		}
	}
	

	if($haySesion && $serverCorrecto){
		if(!empty($_POST)){
			$postSaneado = $_POST;
			foreach ($postSaneado as $key => $value) {
			  	if(!empty($value)){
			  		$mysqli->real_escape_string($value);
			  	}
			}

			$sentencia = 'SELECT count(IdEstilo) as TotalEstilos FROM estilos';
			if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
				echo '</p>'; 
				exit; 
			}

			if(mysqli_num_rows($resultado)){

				$rangoEstilos = $resultado->fetch_object();
				$rangoEstilos = (int) $rangoEstilos->TotalEstilos;

				$int_options = array("options" => array("min_range" => 1, "max_range" => $rangoEstilos));

				if(!empty($postSaneado["estiloWeb"]) && filter_var($postSaneado["estiloWeb"], FILTER_VALIDATE_INT, $int_options)){

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
							mostrarMensEstiloCambiado($nomEstilo);
						}
						else if($mysqli->affected_rows == 0){
							require_once("head.php");
							mostrarMensEstiloSinModificar($nomEstilo);
						}
					}
					else{
						mostrarErrorEstiloNoExistente();
					}

				}
				else{
					require_once("head.php");
					mostrarMensEstiloCorrompido();
				}
			}
			else{
				require_once("head.php");
				mostrarMensErrorCargaDeEstilos();
			}
		}
		else{
			require_once("head.php");
			mostrarErrorEstiloNoExistente();
		}
	}
	else{
		require_once("head.php");
		mostrarErrorRespConf();
	}





?>