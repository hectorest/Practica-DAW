<?php  
$idUsu = $_COOKIE["idUsuario"];
$ultimaVisita;
$usuarios = array(
	"1" => ["pepee1", "11111111", "normal"],
	"2" => ["manolo2","22222222","accesible"],
	"3" => ["sergio3", "33333333","normal"],
	"4" => ["juaan4", "44444444", "accesible"],
	"5" => ["luiis5", "55555555", "normal"]);
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

	function darBienvenida(&$idUsu, &$date, &$succes){
		
		if($succes == true){

			$nomUsu;
			foreach ($GLOBALS["usuarios"] as $key => $value) {
				if($key == $idUsu){
					$nomUsu = $value[0];
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