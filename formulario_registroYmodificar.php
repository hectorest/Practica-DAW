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
			<option value="1">Hombre</option>
			<option value="2">Mujer</option>
			<option value="3">Otro</option>
		</select>
	</p>
	<p>
		<label for="fnac">Fecha de nacimiento*:</label>
		<input type="date" required name="fNac" id="fnac"/>
	</p>
	<p>
		<label for="cres">Ciudad de residencia*:</label>
		<input type="text" maxlength="200" required name="passw1" id="passw1" title="Introduce la ciudad de residencia" />
	</p>
	<p>
		<label for="pres">País de residencia*:</label>
		<select required name="pRes" id="pres">
			<option value="">Escoge</option>
			<?php
				require_once("conexion_db.php");
				require_once("obtenerPaises.php");
			?>
		</select>
	</p>
	<p>
		<label for="fper" id="labfper">Foto de perfil*:</label>
		<input type="file" accept="image/*" required name="fPer" id="fper"/>
	</p>
