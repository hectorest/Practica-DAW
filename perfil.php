<?php
session_start();
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");

if(!isset($_SESSION["usuarioLog"])){
	require_once("barraNavSesionNoIniciada.php");
	mostrarErrorPerfilSinIniciarSesion();
}
else{
	require_once("barraNavSesionIniciada.php");
	mostrarPerfilUsuario();
}

function mostrarErrorPerfilSinIniciarSesion(){
	echo<<<modalPerfil
		<button type="button" onclick="cerrarMensajeModal(4);">X</button>
			<div class="modal">
				<div class="contenido">
					<span>
						<img src="./img/error.png" alt="error-detalle-foto">
						<h2>Error</h2>
					</span>
					<p>No puedes acceder a tu perfil sin haber iniciado sesión previamente</p>
					<button type="button" onclick="cerrarMensajeModal(4);">Aceptar</button>
				</div>
			</div>
modalPerfil;
}
	function mostrarPerfilUsuario(){

		$idUsuSesion=$_SESSION["usuarioLog"];
		 
		 // Ejecuta una sentencia SQL 
		 $sentencia = 'SELECT * FROM usuarios u, paises p where p.IdPais=u.Pais and u.IdUsuario='.$idUsuSesion;
		 if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 } 

		$fila = $resultado->fetch_object();

		$sexo;
		if($fila->Sexo == 1){
			$sexo = "Hombre";
		}
		else if($fila->Sexo == 2){
			$sexo = "Mujer";
		}
		else{
			$sexo = "Otro";
		}

		if($fila->Foto == ''){
			$fila->Foto = "./img/foto_perfil.png";
		}

		if($fila->Ciudad == ''){
			$fila->Ciudad = "No hay datos";
		}

		if($fila->NomPais == 'Ninguno'){
			$fila->NomPais = "No hay datos";
		}

		echo <<<perfilUsuario

			<section>

			<p id='bienvenidaUsuarioPerfil'>¡Hola $fila->NomUsuario!</p>

			<h3>Mis Datos:</h3>

			<img src="$fila->Foto" alt="foto_perfil">

			<div class="contTabla">
				<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">
					
					<tr>
						
						<td>Nombre:</td>
						<td>$fila->NomUsuario</td>

					</tr>

					<tr>
						
						<td>Email:</td>
						<td>$fila->Email</td>

					</tr>

					<tr>

						<td>Sexo:</td>
						<td>$sexo</td>

					</tr>

					<tr>
						
						<td>Fecha nacimiento:</td>
						<td><time datetime="1998-09-15">$fila->FNacimiento</time></td>

					</tr>

					<tr>

						<td>Ciudad de Residencia:</td>
						<td>$fila->Ciudad</td>

					</tr>

					<tr>

						<td>País de Residencia:</td>
						<td>$fila->NomPais</td>

					</tr>
				</table>
			</div>
			<div class="enlPerf">
				<a href="formulario_modificar.php" title="Modificar mis datos"><span class="icon-pencil"></span><span>Modificar mis datos</span></a>
				<a href="dar_baja.php" title="Borrar cuenta"><span class="icon-user-times"></span><span>Darme de baja</span></a>
				<a href="mis_albumes.php" title="Acceder a mis álbumes"><span class="icon-album"></span><span>Mis álbumes</span></a>
				<a href="anyadir_foto_album.php" title="Añadir foto a un álbum"><span class="icon-file-image"></span><span>Añadir foto a álbum</span></a>
				<a href="crear_album.php" title="Crea un álbum"><span class="icon-new-album"></span><span>Crear álbum</span></a>
				<a href="solicitar_album.php" title="Solicita un álbum"><span class="icon-print"></span><span>Solicitar álbum</span></a>
				<a href="configurar.php" title="Configurar el estilo de la web"><span class="icon-conf"></span><span>Configurar</span></a>
				<a href="eliminar_sesion.php"  title="Cerrar Sesión"><span class="icon-logout"></span><span>Cerrar Sesión</span></a>
			</div>

		</section>

perfilUsuario;

		$resultado->free();
		$GLOBALS["mysqli"]->close();
	}

			
?>

		

<?php
	require_once("footer.php");
?>