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
		$ultimaVisita = $_COOKIE["ultimaVisita"];
		$ultimaVisita = strtotime($ultimaVisita);
		$ultimaVisitaDia = date('d-m-Y',$ultimaVisita);
		$ultimaVisitaHora = date('H:i',$ultimaVisita);
		$ultimaVisita = (string) $ultimaVisitaDia . " a las " . (string) $ultimaVisitaHora;
	}

	

	if(!empty($_GET["existe"])){
		darBienvenida($idUsu, $ultimaVisita, $_GET["existe"]);
	}

	function darBienvenida(&$idUsu, &$date, &$succes){
		
		if($succes == true){

			$nomUsu;
			foreach ($GLOBALS["identUsuariosReg"] as $key => $value) {
				if($key == $idUsu){
					$nomUsu = $value;
					break;
				}
			}

			setcookie("ultimaVisita", date("c"), time() + 90 * 24 * 60 * 60);
			$_COOKIE["ultimaVisita"] = date("c");
			mostrarMensBienv($nomUsu, $date);

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
					<h2>El usuario almacenado no es válido o ha expirado</h2>
				</span>
					<button type="button" onclick="cerrarMensajeModal(2);">Aceptar</button>
				</div>
			</div>
errorCookie;
		}

?>