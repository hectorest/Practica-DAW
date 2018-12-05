<?php
session_start();
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");

if(!isset($_SESSION["usuarioLog"])){
	require_once("barraNavSesionNoIniciada.php");
	mostrarErrorDarBaja();
}
else{
	require_once("barraNavSesionIniciada.php");
	if(!empty($_GET["er"]) && $_GET["er"] == 310){

	}
	else{
		mostrarDarBaja();
	}
}

function mostrarErrorDarBaja(){
	echo<<<modalDarBaja
		<button type="button" onclick="cerrarMensajeModal(4);">X</button>
			<div class="modal">
				<div class="contenido">
					<span>
						<img src="./img/error.png" alt="error-detalle-foto">
						<h2>Error</h2>
					</span>
					<p>No puedes dar de baja una cuenta sin haber iniciado sesión previamente con dicha cuenta</p>
					<button type="button" onclick="cerrarMensajeModal(4);">Aceptar</button>
				</div>
			</div>
modalDarBaja;
}

function mostrarErrorServer(){
	echo<<<modalErrorServer
		<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>Para poder realizar cualquier cambio en los datos almacenados en Pictures & Images debes enviar los datos desde la dirección del propio sitio web</p>
					<button type="button" onclick="cerrarMensajeModal(0);">Cerrar</button>
				</div>
			</div>
modalErrorServer;
}

function mostrarDarBaja(){

	$sentencia0 = 'SELECT * FROM usuarios where IdUsuario='.$_SESSION["usuarioLog"];
		 if(!($resultado0= $GLOBALS["mysqli"]->query($sentencia0))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia0</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 }

	if(mysqli_num_rows($resultado0)){

		$idUsuSesion=$_SESSION["usuarioLog"];

		$totalfotos=0;
		 
		 // Ejecuta una sentencia SQL 
		 $sentencia = 'SELECT a.Titulo, count(f.album) fotosAlbum FROM fotos f right join albumes a on (f.Album = a.IdAlbum) join usuarios on (a.Usuario = usuarios.IdUsuario) where a.Usuario='.$idUsuSesion.' GROUP BY a.Titulo';
		 if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 }

		echo <<<darBajaArriba

			<section>

			<h3>¡Atención, los siguientes datos van a ser eliminados del sitio web!</h3>

			<div class="contTabla">
				<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">
					<tr>
						
						<th>Álbum</td>
						<th>Nº de fotos del álbum</td>

					</tr>
darBajaArriba;

		if(mysqli_num_rows($resultado) >= 1){
			while($fila = $resultado->fetch_assoc()){

				echo<<<tablaFilas
					<tr>
						
						<td>{$fila["Titulo"]}</td>
						<td>{$fila["fotosAlbum"]}</td>

					</tr>
tablaFilas;
					$totalfotos=$totalfotos + $fila["fotosAlbum"];

			}
		}
		else{
			echo<<<tablaFilas
					<tr>
						
						<td>No dispones de ningún álbum</td>
						<td>0</td>

					</tr>
tablaFilas;
					$totalfotos=$totalfotos;
		}

		echo <<<darBajaDebajo
				</table>

				<p>El total de fotos que se eliminará es de: $totalfotos</p>

			</div>

		</section>
		
		<form action="darse_de_baja.php" method="post" class="formulario" id="formDarBaja">
			<fieldset>
				<p>Para dar de baja la cuenta deberá confirmar dicha acción insertando los siguientes datos:</p>
				
				<input hidden type="text" name="usu" id="usu" value="$idUsuSesion"/>

				<p>
					<label for="passw"> Contraseña: </label>
					<input type="password" minlength="6" maxlength="15" required name="pass" id="passw"/>
				</p>
				
				<p>
					<button type="submit">Borrar Cuenta</button>
				</p>
			</fieldset>
		</form>
darBajaDebajo;

	}
	else{
			echo<<<modalControlRegistro

			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>¡El usuario que desea borrar no existe!</p>
					<button type="button" onclick="cerrarMensajeModal(0);">Cerrar</button>
				</div>
			</div>

modalControlRegistro;
	}
}

?>

<?php
	require_once("footer.php");
?>