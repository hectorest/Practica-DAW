<?php
session_start();
function mostrarErrorMisAlbumesSinIniciarSesion(){
		echo<<<modalMisAlbumesSesionNoIniciada

			<button type="button" onclick="cerrarMensajeModal(4);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-detalle-foto">
					<h2>Error</h2>
				</span>
					<p>Debes iniciar sesión para ver tus álbumes</p>
					<button type="button" onclick="cerrarMensajeModal(4);">Aceptar</button>
				</div>
			</div>

modalMisAlbumesSesionNoIniciada;
}
function mostrarErrorNoHayAlbumes(){
		echo<<<modalMisAlbumesSesionNoIniciada

			<button type="button" onclick="cerrarMensajeModal(3);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-detalle-foto">
					<h2>Error</h2>
				</span>
					<p>No dispones de álbumes</p>
					<button type="button" onclick="cerrarMensajeModal(3);">Aceptar</button>
				</div>
			</div>

modalMisAlbumesSesionNoIniciada;
}
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");
if(!isset($_SESSION["usuarioLog"])){
	$GLOBALS["mysqli"]->close();
	require_once("barraNavSesionNoIniciada.php");
	mostrarErrorMisAlbumesSinIniciarSesion();
}
else{
	if($cookieFalsa == true){
		mostrarMensErrorCookie();
	}
	else{
		require_once("barraNavSesionIniciada.php");

				$idUsuSesion= $GLOBALS["mysqli"]->real_escape_string($_SESSION["usuarioLog"]);

				$sentencia = 'SELECT * FROM albumes WHERE Usuario='.$idUsuSesion;
				 if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
				   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
				   echo '</p>'; 
				   exit; 
				 }

			if(mysqli_num_rows($resultado)){
				echo<<<arribaTablaMisAlbumes
					<section>
					<h3>Mis Álbumes:</h3>

					<div class="contTabla">
						<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">
							<tr>
								
								<th>Título</th>
								<th>Descripción</th>
								<th></th>

							</tr>
arribaTablaMisAlbumes;
				while($fila = $resultado->fetch_object()) {

				   	echo "<tr>"; 
   					echo "<td>$fila->Titulo</td>"; 
   					echo "<td>$fila->Descripcion</td>";
   					echo "<td><a href='ver_album.php?IdAlbum=".$fila->IdAlbum."'>Ver Álbum</a></td>"; 
  					echo "</tr>";

				}

				echo<<<debajoTablaMisAlbumes
							</table>
						</div>
					</section>
debajoTablaMisAlbumes;

			}
			else{

				mostrarErrorNoHayAlbumes(); 

			}
			$resultado->free();
		}
		$GLOBALS["mysqli"]->close();
	}
?>

<?php
	require_once("footer.php");
?>