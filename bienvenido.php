<?php  
	
	require_once("head.php");

	$idUsu = $_COOKIE["idUsuario"];
	$ultimaVisita;

	$identUsuariosReg = array(
		"1" => "pepee1",
		"2" => "manolo2",
		"3" => "sergio3",
		"4" => "juaan4",
		"5" => "luiis5");

	if(isset($_COOKIE["ultimaVisita"])){
		$GLOBALS["ultimaVisita"] = $_COOKIE["ultimaVisita"];
	}

	

	if(!empty($_GET["existe"])){
		darBienvenida($idUsu, $ultimaVisita, $_GET["existe"]);
	}

	function darBienvenida(&$idUsu, &$date, &$succes){
		echo "$date";
		if($succes == true){

			$nomUsu;
			foreach ($GLOBALS["identUsuariosReg"] as $key => $value) {
				if($key == $idUsu){
					$nomUsu = $value;
					break;
				}
			}

			mostrarMensBienv($nomUsu, $date);
			setcookie("ultimaVisita", date("c"), time() + 90 * 24 * 60 * 60);
			$_COOKIE["ultimaVisita"] = date("c");
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
			<button type="button" onclick="cerrarMensajeModal(3);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<h2>El usuario almacenado no es válido o ha expirado</h2>
				</span>
					<button type="button" onclick="cerrarMensajeModal(3);">Aceptar</button>
				</div>
			</div>
errorCookie;
		}

?>