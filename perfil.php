
<?php
	require_once("controlLogin.php");
	require_once("head.php");
	require_once("header.php");
	if(isset($_SESSION["usuarioRec"])){
		require_once("barraNavSesionIniciada.php");
	}
	else{
		require_once("barraNavSesionNoIniciada.php");
	}
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
				<a href="" title="Modificar mis datos"><span class="icon-pencil"></span><span>Modificar mis datos</span></a>
				<a href="darse_de_baja.php" title="Borrar cuenta"><span class="icon-user-times"></span><span>Darme de baja</span></a>
				<a href="mis_albumes.php" title="Acceder a mis álbumes"><span class="icon-album"></span><span>Mis álbumes</span></a>
				<a href="crearAlbum.php" title="Crea un álbum"><span class="icon-new-album"></span><span>Crear álbum</span></a>
				<a href="solicitar_album.php" title="Solicita un álbum"><span class="icon-print"></span><span>Solicitar álbum</span></a>
				<a href=""  title="Cerrar Sesión"><span class="icon-logout"></span><span>Cerrar Sesión</span></a>
			</div>

		</section>
<?php
	require_once("footer.php");
?>