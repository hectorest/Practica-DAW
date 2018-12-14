
<?php
	require_once("head.php");
	require_once("header.php");
?>

		<section>
			<h3>Mis Datos:</h3>

			<img src="./img/foto_perfil.png" alt="foto_perfil">

			<div class="contTabla">	
				<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">
					
					<tr>
						
						<td>Nombre:</td>
						<td>Usuario Nuevo</td>

					</tr>

					<tr>
						
						<td>Email:</td>
						<td>usuarionuevo@gmail.com</td>

					</tr>

					<tr>

						<td>Sexo:</td>
						<td>Hombre</td>

					</tr>

					<tr>
						
						<td>Fecha nacimiento:</td>
						<td><time datetime="1998-09-15">15 de septiembre de 1998</time></td>

					</tr>

					<tr>

						<td>Ciudad de Residencia:</td>
						<td>San Vicente</td>

					</tr>

					<tr>

						<td>País de Residencia:</td>
						<td>España</td>

					</tr>
				</table>

			</div>

			<div class="enlPerf">
				<a href="formulario_acceso.php" title="Iniciar Sesión"><span class="icon-user"></span><span>Iniciar Sesión</span></a>
			</div>

		</section>
<?php
	require_once("footer.php");
?>