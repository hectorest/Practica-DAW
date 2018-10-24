<?php
	require_once("head.php");
	require_once("header.php");
?>


		<form action="formulario_acceso.php" method="post" class="formulario" id="formAcc">

		<fieldset>

			<legend>
				Iniciar Sesión
			</legend>

			<p>
				<label for="usuario">Usuario:</label>
				<input type="text" minlength="6" maxlength="14" required name="usuario" id="usuario"/>
			</p>
			<p>
				<label for="passw">Contraseña:</label>
				<input type="password" minlength="8" maxlength="16" required name="passw" id="passw"/>
			</p>
			<p>
				<button type="submit">Entrar</button> <!--En realidad, el boton submit, una vez pulsado, redirigira, si todos los datos son correctos, a la pagina de respuesta de la solicitud de album-->
			</p>
			<a href="formulario_registro.php"><span class="icon-user-plus">¿Aún no tienes una cuenta? Regístrate</span></a>

		</fieldset> 

		</form>


<?php
	if(!empty($_POST["usuario"]) && !empty($_POST["passw"])){
	$usuario = $_POST["usuario"];
	$passw = $_POST["passw"];

	$usuariosReg = array(
		"pepe1" => "11111111",
		"manolo2" => "22222222",
		"sergio3" => "33333333",
		"juan4" => "44444444",
		"luis5" => "55555555");

	$existe = false;

foreach ($usuariosReg as $key => $value) {
	if($key == "$usuario" && $value =="$passw"){
		$GLOBALS["existe"] = true;
	}
}

if($existe == true){
	header("refresh: 0; index.php");
}
else{
	echo "<p>Usuario no existente</p>";
}
}
?>

<?php
	require_once("footer.php");
?>