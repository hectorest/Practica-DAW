<?php
	echo<<< formularioRegistroModificar
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
formularioRegistroModificar;
?>