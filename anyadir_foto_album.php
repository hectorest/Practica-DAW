<?php
function mostrarErrorAnyadirFotoSinIniciarSesion(){
	$GLOBALS["mysqli"]->close();
	echo<<<modalAnyadirFotoSesionNoIniciada
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
modalAnyadirFotoSesionNoIniciada;
}
session_start();
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");
if(!isset($_SESSION["usuarioLog"])){
	require_once("barraNavSesionNoIniciada.php");
	mostrarErrorAnyadirFotoSinIniciarSesion();
}
else{
	require_once("barraNavSesionIniciada.php");
	if(!empty($_GET["er"]) && $_GET["er"] == 310){
			echo<<<modalControlAnyadirFoto

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

modalControlAnyadirFoto;
	}
?>
		<section>
			
			<h3>Añadir foto a álbum</h3>
			<p>En esta página podrás añadir una foto a uno de tus álbumes. Los campos con * son obligatorios. Los campos con ** tienen una aclaración asociada a su funcionamiento.</p>
			<p>Recuerda que el titulo de la foto no se puede repetir con ninguno de los de las fotos que hayas subido hasta ahora y debes tener al menos un álbum para poder añadir fotos en la web.</p>
			
		</section>

		<form action="controlAnyadirAAlbum.php" method="post" class="formulario">
				
			<fieldset>

					<legend>
						Formulario de añadir foto
					</legend>
				<p>Rellena el siguiente formulario aportando todos los detalles de la foto.</p>
				
				<p>
					<label for="titulo">Título*:</label>
					<input type="text" required name="titulo" id="titulo" placeholder="Título" maxlength="200" title="El título del álbum no puede superar los 200 caracteres o letras"/>
				</p>
				<p>
					<label for="descripcion">Descripción:</label>
					<textarea id="descripcion" name="descripcion" placeholder="Descripción de la foto" rows="10" cols="50" maxlength="4000" title="Tope de caracteres o letras: 4000"></textarea>
				</p>
				<p>
					<label for="fechaFoto">Fecha de la foto**:</label>
					<input type="date" name="fechaFoto" id="fechaFoto" title="Fecha de la foto"/>
				</p>
				<p>
					<label for="Pais">País*:</label>
					<select required name="Pais" id="Pais">
						<option value="">Escoge</option>
						<?php  
							require_once("obtenerPaises.php");
						?>
					</select>
				</p>
				<p>
					<label for="Foto" id="labfper">Foto*:</label>
					<input type="file" accept="image/*" name="Foto" id="Foto" enctype="multipart/form-data"/>
				</p>
				<p>
					<label for="texto_alternativo">Texto Alternativo*:</label>
					<input type="text" required name="texto_alternativo" id="texto_alternativo" minlength="10" placeholder="Texto alternativo" maxlength="200" title="Este es el texto que identifica a la imagen (debe tener un mínimo de 10 carácteres)"/>
				</p>
				<p>

					<label for="album">Álbum de PI*:</label>

					<select required name="album" id="album" title="Escoge un álbum entre los que tienes creados en tu cuenta">
						
						<option value="">Escoge</option>

						<?php
							require_once("obtenerAlbumes.php");
							$GLOBALS["mysqli"]->close();
						?>

					</select>

				</p>
				<p>
					<button type="submit">Enviar</button> <!--En realidad, el boton submit, una vez pulsado, redirigira, si todos los datos son correctos, a la pagina de respuesta de la solicitud de album-->
				</p>
				<p>**Si no se especifica la fecha de la foto, el sistema guardará la fecha en que se añada la foto al álbum</p>
			</fieldset>
		</form>

	<?php 

		}

	?>

<?php
	require_once("footer.php");
?>