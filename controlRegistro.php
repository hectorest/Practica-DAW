<?php
	require_once("head.php");
	require_once("header.php");
?>

<?php

	if(!empty($_POST["usuario"]) && !empty($_POST["passw1"]) && !empty($_POST["passw2"])){
		if(!empty($_POST["email"]) && !empty($_POST["sexo"]) && !empty($_POST["fnac"])){
			if(!empty($_POST["cres"]) && !empty($_POST["pres"]) && !empty($_POST["fper"])){
				hacerRegistro($_POST["usuario"],$_POST["passw1"],$_POST["passw2"],$_POST["email"],$_POST["sexo"],$_POST["fnac"],$_POST["cres"],$_POST["pres"],$_POST["fper"]);
			}
		}
	}

	function hacerRegistro(&$usu, &$p1, &$p2, &$email, &$sexo, &$fnac, &$cres, &$pres, &$fper){
		if($p1 != $p2){
			header("Location: formulario_registro.php?er=300");
		}
		else{
			mostrarDatosUsuReg($usu, $p1, $email, $sexo, $fnac, $cres, $pres, $fper);
		}
	}

function mostrarDatosUsuReg(&$usu, &$p1, &$email, &$sexo, &$fnac, &$cres, &$pres, &$fper){
echo <<<datosRegistro

<section>

	<div class="contTabla">

		<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

			<caption>Datos de registro:</caption>

				<tr>
						
					<td>Usuario:</td>
					<td>$usu</td>

				</tr>

				<tr>
							
					<td>Contraseña:</td>
					<td>$p1</td>

				</tr>

				<tr>
							
					<td>Email:</td>
					<td>$email</td>

				</tr>

				<tr>
							
					<td>Sexo:</td>
					<td>$sexo</td>

				</tr>

				<tr>
							
					<td>Fecha de nacimiento:</td>
					<td>$fnac</td>

				</tr>

				<tr>
							
					<td>Ciudad de residencia:</td>
					<td>$cres</td>

				</tr>

				<tr>
							
					<td>País de residencia:</td>
					<td>$pres</td>

				</tr>

		</table>

	</div>

	<div class="enlPerf">
		<a href="index.php" title="Volver a inicio">Aceptar</a>
	</div>

</section>

datosRegistro;

}

?>

<?php
	require_once("footer.php");
?>