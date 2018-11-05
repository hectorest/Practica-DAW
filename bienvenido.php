<?php  
	
	require_once("head.php");

	//Sin acabar, no se como enviarle la fecha anterior guardada ya que no puedo usar $GLOBALS para recuperarla
	$ultimaVisita = "Ahora";
	$nomUsu = $_COOKIE["usuarioRec"];
	$dateUlt = $GLOBALS["ultimaVisita"];

	if(!empty($_GET["existe"])){
		darBienvenida($nomUsu, $dateUlt, $_GET["existe"]);
	}

	function darBienvenida(&$usu, &$date, &$succes){
		
		if($succes == true){
			mostrarMensBienv($usu, $date);
			$_COOKIE["ultimaVisita"] = date("c");
		}
		else{
			mostrarMensErrorBienv();
			$_COOKIE["ultimaVisita"] = "";
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