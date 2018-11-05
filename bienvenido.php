<?php  
	
	require_once("head.php");

	$nomUsu = $_COOKIE["usuarioRec"];
	$ultimaVisita;

	

	if(isset($_COOKIE["ultimaVisita"])){
		$GLOBALS["ultimaVisita"] = $_COOKIE["ultimaVisita"];
	}


	if(!empty($_GET["existe"])){
		darBienvenida($nomUsu, $ultimaVisita, $_GET["existe"]);
	}

	function darBienvenida(&$usu, &$date, &$succes){
		
		if($succes == true){
			mostrarMensBienv($usu, $date);
			setcookie("ultimaVisita", date("c"), time() + 90 * 24 * 60 * 60);
			$_COOKIE["ultimaVisita"] = date("c");
		}
		else{
			mostrarMensErrorBienv();
			$_COOKIE["ultimaVisita"] = "";
			setcookie("visitaAnterior", "", time() + 90 * 24 * 60 * 60);
			$_COOKIE["visitaAnterior"] = "";
		}
	

	}

		function mostrarMensBienv(&$usu, &$date){
			echo <<<RecuerdoInicSes
				<div class="modal">
					<div class="contenido">
					<span>
						<h2>¡ Bienvenido $usu !</h2>
					</span>
						<p>No te has conectado desde: $date</p>
						<button type="button" onclick="cerrarMensajeModal(4);">Entrar</button>
						<button type="button" onclick="cerrarMensajeModal(3);">Salir</button>
					</div>
				</div>
RecuerdoInicSes;
		}

		function mostrarMensErrorBienv(){
			echo <<<errorCookie
			<button type="button" onclick="cerrarMensajeModal();">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<h2>El usuario almacenado no es válido o ha expirado</h2>
				</span>
					<button type="button" onclick="cerrarMensajeModal();">Aceptar</button>
				</div>
			</div>
errorCookie;
		}

?>