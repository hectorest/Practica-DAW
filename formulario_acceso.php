<?php
session_start();
$cookieFalsaFormAcceso = false;
if(isset($_COOKIE["idUsuario"])){
	require_once("controlCookie.php");
	if(!isset($_SESSION["usuarioLog"])){
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "controlLogin.php";
		header("Location: http://$host$uri/$extra");
	}
}
require_once("head.php");
require_once("header.php");
if(isset($_SESSION["usuarioLog"]) && $cookieFalsaFormAcceso == false){
	require_once("barraNavSesionIniciada.php");
}
else{
	require_once("barraNavSesionNoIniciada.php");
}

		if(isset($_GET["er"])){
			
			echo<<<modalAcceso

			<button type="button" onclick="cerrarMensajeModal(1);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-login">
					<h2>Error</h2>
				</span>
					<p>¡El usuario o la contraseña no existen!</p>
					<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
				</div>
			</div>

modalAcceso;
		}

		if(isset($_SESSION["usuarioLog"]) && $cookieFalsaFormAcceso == false){
			$usuarios = array(
				"1" => ["pepee1", "11111111", "normal"],
				"2" => ["manolo2","22222222","accesible"],
				"3" => ["sergio3", "33333333","normal"],
				"4" => ["juaan4", "44444444", "accesible"],
				"5" => ["luiis5", "55555555", "normal"]);

			$nomUsu;
			foreach ($GLOBALS["usuarios"] as $key => $value) {
				if($key == $_SESSION["usuarioLog"]){
					$nomUsu = $value[0];
					break;
				}
			}

			echo<<<modalAccesoPorUrl

			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<h2><span class="icon-attention-circled"></span>¡Atención!</h2>
				</span>
					<p>Ya has iniciado sesión previamente. Tu nombre es: $nomUsu</p>
					<button type="button" onclick="cerrarMensajeModal(2);">Cerrar Sesión</button>
					<button type="button" onclick="cerrarMensajeModal(0);">Cerrar</button>
				</div>
			</div>

modalAccesoPorUrl;
		}
		else {
			if($cookieFalsaFormAcceso){
				mostrarMensErrorCookie();
			}
			else{
	?>
		<form action="controlLogin.php" method="post" class="formulario" id="formAcc">

		<fieldset>

			<legend>
				Iniciar Sesión
			</legend>

			<p>
				<label for="usuario">Usuario:</label>
				<input type="text" minlength="6" maxlength="14" required name="login" id="usuario"/>
			</p>
			<p>
				<label for="passw">Contraseña:</label>
				<input type="password" minlength="8" maxlength="16" required name="pass" id="passw"/>
			</p>
			<p id="pCasillaRecordarme">
				<input type="checkbox" name="recordarme" id="recordarme"/>
				<label for="recordarme">Recordarme en este equipo</label>
			</p>
			<p>
				<button type="submit">Entrar</button> <!--En realidad, el boton submit, una vez pulsado, redirigira, si todos los datos son correctos, a la pagina de respuesta de la solicitud de album-->
			</p>
			<a href="formulario_registro.php"><span class="icon-user-plus">¿Aún no tienes una cuenta? Regístrate</span></a>

		</fieldset> 

		</form>

	<?php  

			}
		}
		
	?>
<?php
	require_once("footer.php");
?>