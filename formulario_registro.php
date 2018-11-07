
<?php
	require_once("head.php");
	require_once("header.php");
	if(isset($_SESSION["usuarioLog"])){
		require_once("barraNavSesionIniciada.php");

		$identUsuariosReg = array(
				"1" => "pepee1",
				"2" => "manolo2",
				"3" => "sergio3",
				"4" => "juaan4",
				"5" => "luiis5");

			$nomUsu;
			foreach ($GLOBALS["identUsuariosReg"] as $key => $value) {
				if($key == $_SESSION["usuarioLog"]){
					$nomUsu = $value;
					break;
				}
			}
			echo<<<modalRegistroPorUrl

			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<!--<img src="./img/error.png" alt="error-login">-->
					<h2>¡Atención!</h2>
				</span>
					<p>Ya has iniciado sesión como $nomUsu. Si quieres crear una nueva cuenta debes cerrar sesión primero.</p>
					<button type="button" onclick="cerrarMensajeModal(2);">Cerrar Sesión</button>
					<button type="button" onclick="cerrarMensajeModal(0);">Volver a Inicio</button>
				</div>
			</div>

modalRegistroPorUrl;
	}
	else{
		require_once("barraNavSesionNoIniciada.php");
?>

	<?php
		if(!empty($_GET["er"])){
			$error = $_GET["er"];
			echo<<<modalRegistro

			<button type="button" onclick="cerrarMensajeModal(1);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-registro">
					<h2>Error $error</h2>
				</span>
					<p>¡Las contraseñas no coinciden!</p>
					<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
				</div>
			</div>

modalRegistro;
		}
	?>
	
		<form action="controlRegistro.php" method="post" class="formulario" id="formReg">
			
			<fieldset>

					<legend>
						Regístrate
					</legend>
				<p>
					<label for="usuario">Usuario*:</label>
					<input type="text" pattern="[A-Za-z0-9]{6,14}" minlength="6" maxlength="14" title="El nombre de usuario tendrá como mínimo 6 caracteres que pueden ser tanto letras mayúsculas como minúsculas y como números. El máximo número de caracteres permitido es 14. Los espacios en blanco no están permitidos" required name="usuario" id="usuario"/>
				</p>
				<p>
					<label for="passw1">Contraseña*:</label>
					<input type="password" pattern="[A-Za-z0-9¿?¡!-_@#$%&=]{8,16}" minlength="8" maxlength="16" required name="passw1" id="passw1" title="La contraseña tendrá un mínimo de 8 caracteres y un máximo de 16. Podrás escribir tanto letras mayúsculas como minúsculas además de números y los siguientes símbolos: ¿?¡!-_@#$%&=. Los espacios en blanco no están permitidos" />
				</p>
				<p>
					<label for="passw2">Repetir contraseña*:</label>
					<input type="password" pattern="[A-Za-z0-9¿?¡!-_@#$%&=]{8,16}" minlength="8" maxlength="16" required name="passw2" id="passw2" title="La contraseña debe de coincidir con la escrita en la casilla anterior" />
				</p>
				<p>
					<label for="email">Email*:</label>
					<input type="email" required name="email" id="email"/>
				</p>
				<p>
					<label for="sexo">Sexo*:</label>
					<select id="sexo" name="sexo" required>
						<option value="">Escoge</option>
						<option>Hombre</option>
						<option>Mujer</option>
						<option>Otro</option>
					</select>
				</p>
				<p>
					<label for="fnac">Fecha de nacimiento*:</label>
					<input type="date" required name="fNac" id="fnac"/>
				</p>
				<p>
					<label for="cres">Ciudad de residencia*:</label>
					<select required name="cRes" id="cres">
						<option value="">Escoge</option>
						<option>San Vicente</option>
						<option>Elche/Elx</option>
						<option>Elda</option>
						<option>Alicante</option>
						<option>Castellón</option>
						<option>Valencia</option>
						<option>Sevilla</option>
						<option>Murcia</option>
						<option>Madrid</option>
						<option>Pekín</option>
						<option>Tokio</option>
					</select>
				</p>
				<p>
					<label for="pres">País de residencia*:</label>
					<select required name="pRes" id="pres">
						<option value="">Escoge</option>
						<optgroup label="Europa">
							<option>Alemania</option>
							<option>España</option>
							<option>Francia</option>
							<option>Inglaterra</option>
							<option>Rusia</option>
							<option>Suiza</option>
						</optgroup>
						<optgroup label="Asia">
							<option>China</option>
							<option>Japón</option>
						</optgroup>
						<optgroup label="Norteamérica">
							<option>Estados Unidos</option>
							<option>Canadá</option>
						</optgroup>
						<optgroup label="Centroamérica">
							<option>México</option>
						</optgroup>
						<optgroup label="Sudamérica">
							<option>Argentina</option>
							<option>Brasil</option>
						</optgroup>
					</select>
				</p>
				<p>
					<label for="fper" id="labfper">Foto de perfil*:</label>
					<input type="file" accept="image/*" required name="fPer" id="fper"/>
				</p>
				<p>
					<button type="submit">Enviar</button> <!--En realidad, el boton submit, una vez pulsado, redirigira, si todos los datos son correctos, a la pagina de respuesta de la solicitud de album-->
				</p>
				<a href="formulario_acceso.php"><span class="icon-user">¿Ya tienes una cuenta? Inicia sesión</span></a>
			</fieldset>
		</form> 

	<?php 

		}

	?>

<?php
	require_once("footer.php");
?>