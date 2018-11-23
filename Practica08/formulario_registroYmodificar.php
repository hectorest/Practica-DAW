<?php
require_once("conexion_db.php");

if(isset($_SESSION["usuarioLog"])){

			$sesionSaneada = $mysqli->real_escape_string($_SESSION["usuarioLog"]);

		 $sentencia = 'SELECT * FROM usuarios WHERE IdUsuario='.$sesionSaneada;
		 if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 }
		 if(mysqli_num_rows($resultado)){
			 $fila=$resultado->fetch_object();

echo<<<formularioModificarParte0
	<p>
		<label for="usuario">Usuario:</label>
		<input type="text" value="$fila->NomUsuario" pattern="[A-Za-z0-9]{6,14}" minlength="6" maxlength="14" title="El nombre de usuario tendrá como mínimo 6 caracteres que pueden ser tanto letras mayúsculas como minúsculas y como números. El máximo número de caracteres permitido es 14. Los espacios en blanco no están permitidos"  name="usuario" id="usuario"/>
	</p>
	<p>
		<label for="passw1">Contraseña:</label>
		<input type="password" value="$fila->Clave" pattern="[A-Za-z0-9¿?¡!-_@#$%&=]{8,16}" minlength="8" maxlength="16" name="passw1" id="passw1" title="La contraseña tendrá un mínimo de 8 caracteres y un máximo de 16. Podrás escribir tanto letras mayúsculas como minúsculas además de números y los siguientes símbolos: ¿?¡!-_@#$%&=. Los espacios en blanco no están permitidos" />
	</p>
	<p>
		<label for="passw2">Repetir contraseña:</label>
		<input type="password" value="$fila->Clave" pattern="[A-Za-z0-9¿?¡!-_@#$%&=]{8,16}" minlength="8" maxlength="16" name="passw2" id="passw2" title="La contraseña debe de coincidir con la escrita en la casilla anterior" />
	</p>
	<p>
		<label for="email">Email:</label>
		<input type="email" value="$fila->Email" name="email" id="email"/>
	</p>
	<p>
		<label for="sexo">Sexo:</label>
		<select id="sexo" name="Sexo">
			<option value="">Escoge</option>
formularioModificarParte0;

		switch ($fila->Sexo) {
			case '1':
				echo<<<Sexo
			<option value="1" selected>Hombre</option>
			<option value="2">Mujer</option>
			<option value="3">Otro</option>
Sexo;
				break;
			case '2':
				echo<<<Sexo
			<option value="1">Hombre</option>
			<option value="2" selected>Mujer</option>
			<option value="3">Otro</option>
Sexo;
				break;
			case '3':
				echo<<<Sexo
			<option value="1">Hombre</option>
			<option value="2">Mujer</option>
			<option value="3" selected>Otro</option>
Sexo;
				break;
			
			default:
				echo<<<Sexo
			<option value="1">Hombre</option>
			<option value="2">Mujer</option>
			<option value="3">Otro</option>
Sexo;
				break;
		}

echo<<<formularioModificarParte1
		</select>
	</p>
	<p>
		<label for="fnac">Fecha de nacimiento:</label>
		<input type="date" value="$fila->FNacimiento" name="fNac" id="fnac"/>
	</p>
	<p>
		<label for="cres">Ciudad de residencia:</label>
		<input type="text" value="$fila->Ciudad" maxlength="200" name="cRes" id="cres" title="Introduce la ciudad de residencia" />
	</p>
	<p>
	<label for="pres">País de residencia:</label>
			<select name="pRes" id="pres">
			<option value="">Escoge</option>
formularioModificarParte1;
	
	function extraerContinentes(){
		$sentencia0 = 'SELECT DISTINCT Continente FROM paises order by (Continente) ASC';
		if(!($resultado0 = $GLOBALS["mysqli"]->query($sentencia0))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia0</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		while($fila0= $resultado0->fetch_assoc()){
			echo "<optgroup label='{$fila0['Continente']}'>";
			extraerPaisesContinente($fila0['Continente']);
			echo "</optgroup>";
		}
		$resultado0->free();
	}

	function extraerPaisesContinente(&$continente){
		$sentencia1 = 'SELECT IdPais, NomPais FROM paises p WHERE p.Continente='. "'" . $continente . "'" . 'ORDER BY (NomPais) ASC';
		if(!($resultado1 = $GLOBALS["mysqli"]->query($sentencia1))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia1</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		while($fila1 = $resultado1->fetch_assoc()){
			$IdPais = $fila1["IdPais"];
			$IdPaisFila = $GLOBALS["fila"]->Pais;
			if($IdPais==$IdPaisFila){
				echo "<option value=$IdPaisFila selected>{$fila1['NomPais']}</option>";
			}else{
				echo "<option value=$IdPais>{$fila1['NomPais']}</option>";
			}
		}
		$resultado1->free();
	}

	extraerContinentes();

echo<<<formularioModificarParte2
		</select>
	</p>
	<p>
		<label for="fper" id="labfper">Foto de perfil:</label>
		<input type="file" accept="image/*" name="fPer" id="fper"/>
	</p>
formularioModificarParte2;
		}
	}
	else{
?>
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
		<select id="sexo" name="Sexo" required>
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
		<input type="text" maxlength="200" required name="cRes" id="cres" title="Introduce la ciudad de residencia" />
	</p>
	<p>
		<label for="pres">País de residencia*:</label>
		<select required name="pRes" id="pres">
			<option value="">Escoge</option>
			<?php
				require_once("obtenerPaises.php");
				$GLOBALS["mysqli"]->close();
			?>
		</select>
	</p>
	<p>
		<label for="fper" id="labfper">Foto de perfil:</label>
		<input type="file" accept="image/*" name="fPer" id="fper"/>
	</p>
<?php
	}
?>