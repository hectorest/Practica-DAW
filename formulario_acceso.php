
<?php

	session_start();
	require_once("head.php");
	require_once("header.php");
	if(isset($_COOKIE["idUsuario"])){
		if(!isset($_SESSION["usuarioLog"])){
			require_once("controlCookie.php");
		}
	}
	if(isset($_SESSION["usuarioLog"])){
		require_once("barraNavSesionIniciada.php");
	}
	else{
		require_once("barraNavSesionNoIniciada.php");
	}
?>

	<?php
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

		if(isset($_SESSION["usuarioLog"])){

			$identUsuariosReg = array(
				"1" => "pepee1",
				"2" => "manolo2",
				"3" => "sergio3",
				"4" => "juaan4",
				"5" => "luiis5");

			$nomUsu;
			foreach ($GLOBALS["identUsuariosReg"] as $key => $value) {
				if($key == $_SESSION["usuarioLog"]){
					$nomUsu = $value;
					break;
				}
			}

			echo "<p>Ya has iniciado sesión previamente. Tu nombre es: $nomUsu</p>";
		}
		else {
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
			<p>
				<input type="checkbox" name="recordarme" id="recordarme"/>
				<label for="recordarme">Recordarme</label>
			</p>
			<p>
				<button type="submit">Entrar</button> <!--En realidad, el boton submit, una vez pulsado, redirigira, si todos los datos son correctos, a la pagina de respuesta de la solicitud de album-->
			</p>
			<a href="formulario_registro.php"><span class="icon-user-plus">¿Aún no tienes una cuenta? Regístrate</span></a>

		</fieldset> 

		</form>

	<?php  
		}
	?>
<?php
	require_once("footer.php");
?>