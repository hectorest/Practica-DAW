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

function mostrarModalAccesoPorUrl(&$nomUsu){
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

			$usuarioSesion = $_SESSION["usuarioLog"];
			$usuarioSesion = $GLOBALS["mysqli"]->real_escape_string($usuarioSesion);
			$usuarioSesion = (int) $usuarioSesion;

		 	// Ejecuta una sentencia SQL 
			$sentencia = 'SELECT * FROM usuarios WHERE IdUsuario = '. $usuarioSesion; 
			if(!($usuario = $mysqli->query($sentencia))) { 
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
				echo '</p>'; 
				exit; 
			}

			$nomUsu;

			if(mysqli_num_rows($usuario)){
				$fila = $usuario->fetch_object();
				$nomUsu = $fila->NomUsuario;
				mostrarModalAccesoPorUrl($nomUsu);
			}
			else{
				mostrarMensErrorCookie();
			}
			$usuario->free();
			$mysqli->close();
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
				<input type="text" minlength="3" maxlength="15" required name="login" id="usuario"/>
			</p>
			<p>
				<label for="passw">Contraseña:</label>
				<input type="password" minlength="6" maxlength="15" required name="pass" id="passw"/>
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

				$mysqli->close();
			}
		}
		
	?>
<?php
	require_once("footer.php");
?>