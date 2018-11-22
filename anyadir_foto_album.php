<?php
function mostrarErrorAnyadirFotoSinIniciarSesion(){
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
function extraerAlbumes(){
	$sentencia = 'SELECT * FROM albumes';
	if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		echo '</p>'; 
		exit; 
	}

	while($fila = $resultado->fetch_assoc()){
		$IdAlbum = $fila["IdAlbum"];
		echo "<option value=$IdAlbum>{$fila['Titulo']}</option>";
	}
}
session_start();
require_once("head.php");
require_once("header.php");
if(!isset($_SESSION["usuarioLog"])){
	require_once("barraNavSesionNoIniciada.php");
	mostrarErrorAnyadirFotoSinIniciarSesion();
}
else{
	require_once("barraNavSesionIniciada.php");
?>


		<section>
			
			<h3>Añadir foto a álbum</h3>
			<p>En esta página podrás añadir una foto a uno de tus álbumes.</p>
			
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
					<label for="fechaFoto">Fecha de la foto*:</label>
					<input type="date" required name="fechaFoto" id="fechaFoto" title="Fecha de la foto"/>
				</p>
				<p>
					<label for="pais">País*:</label>
					<select required name="pais" id="pais">
						<option value="">Escoge</option>
						<?php  
							require_once("obtenerPaises.php");
						?>
					</select>
				</p>
				<p>
					<label for="fper" id="labfper">Foto*:</label>
					<input type="file" accept="image/*" required name="fPer" id="fper"/>
				</p>
				<p>
					<label for="texto_alternativo">Texto Alternativo*:</label>
					<input type="text" required name="texto_alternativo" id="texto_alternativo" minlength="10" placeholder="Texto alternativo" maxlength="200" title="Este es el texto que identifica a la imagen"/>
				</p>
				<p>

					<label for="album">Álbum de PI*:</label>

					<select required name="album" id="album" title="Escoge un álbum entre los que tienes creados en tu cuenta">
						
						<option value="">Escoge</option>
					<?php
						extraerAlbumes();
					?>
					</select>

				</p>
				<p>
					<button type="submit">Enviar</button> <!--En realidad, el boton submit, una vez pulsado, redirigira, si todos los datos son correctos, a la pagina de respuesta de la solicitud de album-->
				</p>
			</fieldset>
		</form>

	<?php 

		}

	?>

<?php
	require_once("footer.php");
?>