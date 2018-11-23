<?php  
$idUsu = $_COOKIE["idUsuario"];
$ultimaVisita;
require_once("conexion_db.php");
if(isset($_COOKIE["ultimaVisita"])){
	$ultimaVisita = $_COOKIE["ultimaVisita"];
	$ultimaVisita = strtotime($ultimaVisita);
	$ultimaVisitaDia = date('d-m-Y',$ultimaVisita);
	$ultimaVisitaHora = date('H:i',$ultimaVisita);
	$ultimaVisita = (string) $ultimaVisitaDia . " a las " . (string) $ultimaVisitaHora;
}
if(!empty($_GET["existe"])){
	darBienvenida($idUsu, $ultimaVisita, $_GET["existe"]);
	require_once("head.php");
}
else{
	require_once("head.php");
	mostrarMensErrorBienvUrl();
}

	function darBienvenida(&$idUsu, &$date, &$succes){
		
		if($succes == true){

			$nomUsu;
		
			$idUsu = $GLOBALS["mysqli"]->real_escape_string($idUsu);

			$sentencia = 'SELECT * FROM usuarios WHERE IdUsuario=' . $idUsu; 
		 	if(!($usuario = $GLOBALS["mysqli"]->query($sentencia))) { 
		   		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
		   		echo '</p>'; 
		   		exit; 
		 	} 

		 	if(mysqli_num_rows($usuario)){
		 		$fila = $usuario->fetch_object();
		 		$nomUsu = $fila->NomUsuario;
		 		setcookie("ultimaVisita", date("c"), time() + 90 * 24 * 60 * 60);
				$_COOKIE["ultimaVisita"] = date("c");
				mostrarMensBienv($nomUsu, $date);
				$usuario->free();
		 	}
		 	else{
		 		mostrarMensErrorBienv();
		 	}

		}
		else{
			mostrarMensErrorBienv();
		}
	

	}

		function mostrarMensBienv(&$usu, &$date){
			echo <<<RecuerdoInicSes
				<div class="modal">
					<div class="contenido">
					<span>
						<h2>¡Bienvenido $usu!</h2>
					</span>
						<p>No te has conectado desde el día: $date</p>
						<button type="button" onclick="cerrarMensajeModal(3);">Entrar</button>
						<button type="button" onclick="cerrarMensajeModal(2);">Salir</button>
					</div>
				</div>
RecuerdoInicSes;
		}

		function mostrarMensErrorBienv(){
			echo <<<errorCookie
			<button type="button" onclick="cerrarMensajeModal(2);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-login">
					<h2>Error</h2>
				</span>
					<p>El usuario almacenado no es válido o ha expirado</p>
					<button type="button" onclick="cerrarMensajeModal(2);">Aceptar</button>
				</div>
			</div>
errorCookie;
		}

		function mostrarMensErrorBienvUrl(){
			echo<<<modalMensErrorBienvUrl

			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-login">
					<h2>Error</h2>
				</span>
					<p>No se ha iniciado sesión de ninguna forma en la página web</p>
					<button type="button" onclick="cerrarMensajeModal(0);">Cerrar</button>
				</div>
			</div>

modalMensErrorBienvUrl;
		}

?>