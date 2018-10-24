<?php
	require_once("head.php");
	require_once("header.php");
?>

		<article id="detFoto">
			<h3>Titulo foto Ejemplo 1</h3>
			<figure>
				<img src="./imagen-muestra/imagen-muestra.jpg" alt="Titulo foto Ejemplo 1"/>
			</figure>
			<div>
				<h4>Descripción:</h4>
				<p class="p-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p><time datetime="2018-09-15">Fecha de foto ejemplo 1, por ejemplo: 15 de septiembre de 2018</time></p>
				<p>Pais foto ejemplo 1</p>
				<a href="album.php" title="Álbum al que pertenece la foto">Álbum</a>
				<a href="usuario.php" title="Autor de la foto">Usuario</a>					
			</div>
		</article>
	 
<?php
	require_once("footer.php");
?>