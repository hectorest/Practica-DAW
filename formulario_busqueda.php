<?php
session_start();
require_once("head.php");
require_once("header.php");
if(isset($_SESSION["usuarioLog"]) && $cookieFalsa == false){
	require_once("barraNavSesionIniciada.php");
}
else{
	require_once("barraNavSesionNoIniciada.php");
	if($cookieFalsa){
		mostrarMensErrorCookie();
	}
}
?>
		<form action="resultado_busqueda.php" method="get"  class="formulario" id="formBuscAvanz">

			<fieldset>

			<legend>
				Búsqueda avanzada
			</legend>

				<p>
					<label for="titulo">Título:</label>
					<input type="text" name="titulo" id="titulo"/>
				</p>
				<p>
					<label for="date1">Fecha entre:</label>
					<input type="date" name="date1" id="date1"/>
				</p>
				<p>
					<label for="date2">y</label>
					<input type="date" name="date2" id="date2"/>
				</p>
				<p>
					<label for="pais">País:</label>
					<select name="pais" id="pais">
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
					<label for="album">Álbum:</label>
					<input type="text" name="album" id="album"/>
				</p>
				<p>
					<label for="autor">Autor:</label>
					<input type="text" name="autor" id="autor"/>
				</p>
				<p>
					<button type="submit"><span class="icon-search">Buscar</span></button>
				</p>

			</fieldset>

		</form>

<?php
	require_once("footer.php");
?>