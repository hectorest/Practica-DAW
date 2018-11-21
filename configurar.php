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
	mostrarFormularioConfigurar();
}
function mostrarErrorSolAlbumSinIniciarSesion(){
	echo<<<modalSolAlbumSesionNoIniciada
		<button type="button" onclick="cerrarMensajeModal(4);">X</button>
		<div class="modal">
			<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-detalle-foto">
					<h2>Error</h2>
				</span>
				<p>Debes iniciar sesión para poder solicitar un álbum</p>
				<button type="button" onclick="cerrarMensajeModal(4);">Aceptar</button>
			</div>
			</div>
modalSolAlbumSesionNoIniciada;
}

function mostrarFormularioConfigurar(){

		 $sentencia = 'SELECT * FROM estilos';
		 if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 }

	echo<<<formularioConfigurarArriba
		<form action="respuesta_sol_album.php" method="post" class="formulario">
				
			<fieldset>

					<legend>
						Configura el estilo de la web
					</legend>
				<p>Selecciona uno de los siguientes estilos para que la web se muestre con dicho estilo cuando inicies sesión</p>
				<p>
					<label for="elegirEstilo">Estilo:</label>
					<span>
formularioConfigurarArriba;

			while($fila = $resultado->fetch_object()) { 
				echo "<input type='radio' name='$fila->Nombre' id='$fila->Nombre' value='$fila->Nombre'><span>$fila->Nombre</span>";
			} 

	echo<<<formularioConfigurarDebajo
					</span>
				</p>
				<p>
					<button type="submit">Enviar</button> <!--En realidad, el boton submit, una vez pulsado, redirigira, si todos los datos son correctos, a la pagina de respuesta de la solicitud de album-->
				</p>
			</fieldset>
		</form>
formularioConfigurarDebajo;
}

?>

<?php
	require_once("footer.php");
?>