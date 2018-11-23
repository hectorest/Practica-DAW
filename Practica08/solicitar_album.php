<?php
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
session_start();
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");
if(!isset($_SESSION["usuarioLog"])){
	require_once("barraNavSesionNoIniciada.php");
	mostrarErrorSolAlbumSinIniciarSesion();
}
else{
	require_once("barraNavSesionIniciada.php");
?>


		<section>
			
			<h3>Solicitar álbum</h3>
			<p>En esta página podrás realizar el pedido de la impresión de un álbum que hayas creado en tu cuenta. Las tarifas por páginas y resoluciones se especifican a continuación.</p>
			

			<div class="contTabla">
				<table class="tabla">
					
					<caption>Tarifas:</caption>
					
					<tr>
						
						<th>Concepto</th>
						<th>Tarifa</th>

					</tr>

					<tr>
						
						<td> < 5 páginas</td>
						<td>0.10 € por pág.</td>

					</tr>

					<tr>
							
						<td>entre 5 y 10 páginas</td>
						<td>0.08 € por pág.</td>

					</tr>

					<tr>

						<td>> 11 páginas</td>
						<td>0.07 € por pág.</td>

					</tr>

					<tr>
							
						<td>Blanco y negro</td>
						<td>0 €</td>

					</tr>

					<tr>

						<td>Color</td>
						<td>0.05 € por foto.</td>

					</tr>

					<tr>

						<td>Resolución > 300dpi</td>
						<td>0.02 € por foto</td>

					</tr>

				</table>
			</div>
		</section>

		<form action="respuesta_sol_album.php" method="post" class="formulario">
				
			<fieldset>

					<legend>
						Formulario de solicitud
					</legend>
				<p>Rellena el siguiente formulario aportando todos los detalles para confeccionar tu álbum. Los campos con (*) son obligatorios.</p>
				
				<p>
					<label for="nombre">Nombre*:</label>
					<input type="text" required name="nombre" id="nombre" placeholder="Tu nombre y apellidos" maxlength="200" title="Tu nombre junto con tus apellidos no podrán superar los 200 caracteres o letras"/>
				</p>
				<p>
					<label for="titulo">Título del álbum*:</label>
					<input type="text" required name="titulo" id="titulo" placeholder="Que describa al album" maxlength="200" title="El titulo no podrá superar los 200 caracteres o letras" />
				</p>
				<p>
					<label for="texto_adicional">Texto adicional:</label>
					<textarea id="texto_adicional" name="texto_adicional" placeholder="Descripción del álbum o dedicatoria" rows="10" cols="50" maxlength="4000" title="Tope de caracteres o letras: 4000"></textarea>
				</p>
				<p>
					<label for="email">Email*:</label>
					<input type="email" required name="email" id="email" maxlength="200" title="Tope de caracteres o letras para su correo electrónico o email: 200" />
				</p>
				<p id="solAlbumDirec">
					<label for="calle">Dirección*:</label>
					<input type="text" required name="calle" id="calle" placeholder="Calle">
					<input type="number" required name="numero" id="numero" placeholder="Número" min="0">
					<input type="number" required name="cp" id="CP" placeholder="CP" min="0">
				

					<label for="pais">País*:</label>
					<select required name="pais" id="pais">
						<option value="">Escoge</option>
						<?php  
							require_once("obtenerPaises.php");
						?>
					</select>
					<label for="local">Localidad*:</label>
					<input type="text" required name="local" id="local">
					<label for="prov">Provincia*:</label>
					<input type="text" required name="prov" id="prov">
				</p>
				<p>
					<label for="telefono">Teléfono:</label>
					<input type="tel" placeholder="000000000" name="telefono" id="telefono" pattern="[0-9]{9}" minlength="9" maxlength="9" />
				</p>

				<p>
					<label for="color_portada">Color de la portada:</label>
					<input type="color" name="color_portada" value="#000000" id="color_portada"/>
				</p>

				<p>
					<label for="num_copias">Número de copias:</label>
					<input type="number" name="num_copias" id="num_copias" value="1" min="1" />
				</p>

				<p>

					<label for="resolucion">Resolución de impresión:</label>
					<input type="range" name="resolucion" id="resolucion" min="150" max="900" step="150" value="150" onchange="document.getElementById('outresolucion').textContent=this.value"/>
					<span><output id="outresolucion">150 </output> <span>DPI</span></span> 

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
					<label for="frecep">Fecha aprox. recepción:</label>
					<input type="date" name="frecep" id="frecep" title="Fecha aproximada de recepción"/>
				</p>

				<p>
					<label for="color">¿Impresión a color?</label>
					<span>
						<input type="radio" name="colorobn" id="color" value="A Color"><span>Color</span>
						<input type="radio" name="colorobn" checked="checked" id="bn" value="En Blanco y Negro"><span>Blanco y negro</span>
					</span>
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