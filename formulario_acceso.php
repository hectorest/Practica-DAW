<<<<<<< HEAD
<?php
	require_once("head.php");
	require_once("header.php");
?>

	<?php
		if(isset($_GET["er"])){
			echo "<p>Usuario o contraseña incorrectos</p>";
		}
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
				<button type="submit">Entrar</button> <!--En realidad, el boton submit, una vez pulsado, redirigira, si todos los datos son correctos, a la pagina de respuesta de la solicitud de album-->
			</p>
			<a href="formulario_registro.php"><span class="icon-user-plus">¿Aún no tienes una cuenta? Regístrate</span></a>

		</fieldset> 

		</form>

<?php
	require_once("footer.php");
=======
<?php
	require_once("head.php");
	require_once("header.php");
?>

	<?php
		if(isset($_GET["er"])){
			echo "<p>Usuario o contraseña incorrectos</p>";
		}
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
				<button type="submit">Entrar</button> <!--En realidad, el boton submit, una vez pulsado, redirigira, si todos los datos son correctos, a la pagina de respuesta de la solicitud de album-->
			</p>
			<a href="formulario_registro.php"><span class="icon-user-plus">¿Aún no tienes una cuenta? Regístrate</span></a>

		</fieldset> 

		</form>

<?php
	require_once("footer.php");
>>>>>>> parent of 00508ac... modales en Registro y Login
?>