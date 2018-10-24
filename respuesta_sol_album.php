<?php
	require_once("head.php");
	require_once("header.php");
?>
		
	<?php

		if(!empty($_POST["nombre"]) && !empty($_POST["titulo"]) && !empty($_POST["email"]) && !empty($_POST["calle"])){
			if(!empty($_POST["num"]) && !empty($_POST["cp"]) && !empty($_POST["pais"]) && !empty($_POST["local"])){
				if(!empty($_POST["prov"]) && !empty($_POST["album"])){
					calcularPrecioAlbum();
				}
			}

		}

		function calcularPrecioAlbum(){
			
		}

		
echo <<<tablaRespSolAlbum
		<section>


				<h3>Solicitud de álbum realizada</h3>
				<p>Has realizado el pedido del álbum correctamente. Recibirás tu álbum en la fecha indicada. El precio total del álbum es de: <br><span>30.25€</span></p>
			
			<div class="contTabla">

				<table class="tabla">

					<caption>Datos del álbum:</caption>

					<tr>
						
						<td>Nombre:</td>
						<td>Pepe Garcia Perez</td>

					</tr>

					<tr>
						
						<td>Título:</td>
						<td>Álbum ejemplo</td>

					</tr>

					<tr>
						
						<td>Texto adicional:</td>
						<td class="p-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>

					</tr>

					<tr>
						
						<td>Email:</td>
						<td>pepegp@gmail.com</td>

					</tr>

					<tr>
						
						<td>Dirección:</td>
						<td><span>Calle </span><span>Número </span><span>Piso </span><span>Puerta </span><span>CP </span><span>Localidad </span><span>Provincia</span></td>

					</tr>

					<tr>
						
						<td>Teléfono:</td>
						<td>135489741</td>

					</tr>

					<tr>
						
						<td>Color de la portada:</td>
						<td>Negro</td>

					</tr>

					<tr>
						
						<td>Número de Copias:</td>
						<td>1</td>

					</tr>

					<tr>
						
						<td>Resol. Impresión:</td>
						<td>150 DPI</td>

					</tr>

					<tr>
						
						<td>Álbum de PI:</td>
						<td>Álbum 1</td>

					</tr>

					<tr>
						
						<td>Fecha Recepción:</td>
						<td>10/10/2018</td>

					</tr>

					<tr>
						
						<td>Impresión:</td>
						<td>Blanco y negro</td>

					</tr>

				</table>
			</div>

			<div class="enlPerf" id="inicioResSolAlbum">
				<a href="index.php" title="Volver a inicio">Aceptar</a>
			</div>
		</section>
tablaRespSolAlbum;
?>

<?php
	require_once("footer.php");
?>