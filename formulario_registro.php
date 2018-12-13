<?php
session_start();
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");
if(isset($_SESSION["usuarioLog"]) && $cookieFalsa == false){
	require_once("barraNavSesionIniciada.php");

		$sesionSaneada = $mysqli->real_escape_string($_SESSION["usuarioLog"]);

		 $sentencia = 'SELECT * FROM usuarios WHERE IdUsuario='.$sesionSaneada;
		 if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
		   echo '</p>'; 
		   exit; 
		 }

		 if(mysqli_num_rows($resultado)){

		 	$nomUsu;

			$fila = $resultado->fetch_object();
		 	$nomUsu = $fila->NomUsuario;

		 		echo<<<modalRegistroPorUrl

		<button type="button" onclick="cerrarMensajeModal(0);">X</button>
		<div class="modal">
			<div class="contenido">
				<span>
					<h2><span class="icon-attention-circled"></span>¡Atención!</h2>
				</span>
				<p>Ya has iniciado sesión como $nomUsu. Si quieres crear una nueva cuenta debes cerrar sesión primero.</p>
				<button type="button" onclick="cerrarMensajeModal(2);">Cerrar Sesión</button>
				<button type="button" onclick="cerrarMensajeModal(0);">Volver a Inicio</button>
			</div>
		</div>

modalRegistroPorUrl;
		 } 

		 $resultado->free();
		 $mysqli->close();

	}
	else{
		if($cookieFalsa){
			mostrarMensErrorCookie();
		}
		else{
			require_once("barraNavSesionNoIniciada.php");
?>

	<?php
		if(!empty($_GET["er"]) && $_GET["er"] == 300){
			
			echo<<<modalRegistro

			<button type="button" onclick="cerrarMensajeModal(1);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-registro">
					<h2>Error</h2>
				</span>
					<p>¡Las contraseñas no coinciden!</p>
					<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
				</div>
			</div>

modalRegistro;
		}
		else if(!empty($_GET["er"]) && $_GET["er"] == 301){
			
			echo<<<modalRegistro

			<button type="button" onclick="cerrarMensajeModal(1);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-registro">
					<h2>Error</h2>
				</span>
					<p>¡El nombre de usuario ya existe!</p>
					<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
				</div>
			</div>

modalRegistro;
		}
		else if(!empty($_GET["er"]) && $_GET["er"] == 310){
			
			echo<<<modalControlRegistro

			<button type="button" onclick="cerrarMensajeModal(1);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>Para poder realizar cualquier cambio en los datos almacenados en Pictures & Images debes enviar los datos desde la dirección del propio sitio web</p>
					<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
				</div>
			</div>

modalControlRegistro;
		}
		else if(!empty($_GET["er"]) && $_GET["er"] == 320){
			
			echo<<<modalControlRegistro

			<button type="button" onclick="cerrarMensajeModal(1);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>La fecha de nacimiento debe ser menor que la fecha actual</p>
					<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
				</div>
			</div>

modalControlRegistro;
		}
		echo<<<arribaFormulario
		<form action="controlRegistro.php" method="post" class="formulario" id="formReg" enctype="multipart/form-data">
			
			<fieldset>
					<legend>
						Regístrate
					</legend>
arribaFormulario;

			require_once("formulario_registroYmodificar.php");

		echo<<<debajoFormulario
				<p>
					<button type="submit">Enviar</button> <!--En realidad, el boton submit, una vez pulsado, redirigira, si todos los datos son correctos, a la pagina de respuesta de la solicitud de album-->
				</p>
				<a href="formulario_acceso.php"><span class="icon-user">¿Ya tienes una cuenta? Inicia sesión</span></a>
			</fieldset>
		</form>
debajoFormulario;
			}
		}

	?>

<?php
	require_once("footer.php");
?>