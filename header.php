<?php
echo <<<header
<body>
		<header id="piCabec">
			<a href="index.php" title="Ir a la página de inicio"><img src="./logotipo-e-icono/logotipo-pi-daw.png" alt="logotipo de pictures & images"/></a>
			<div>
				<h1>Pictures & Images</h1>
				<h2>Tu aplicación web para fotos</h2>
			</div>
		</header>

		<nav id="barraNavPrinc">
			<input type="checkbox" name="mnHamb" id="mnHamb"/><label for="mnHamb" title="Menú" id="iconoMnHamb"><span class="icon-menu"></span></label>
			<ul id="mnPrinc">
				<li><a href="index.php" title="Inicio"><span class="icon-home" ></span><span>Inicio</span></a></li>
				<li><a href="perfil.php" title="Mi Perfil"><span class="icon-user-circle" ></span><span>Mi Perfil</span></a></li>
				<li><a href="perfil2.php" title="Perfil sin iniciar sesión"><span class="icon-user-circle"></span><span>Perfil sin iniciar sesión</span></a></li>
				<li><a href="formulario_busqueda.php" title="Búsqueda avanzada"><span class="icon-search"></span><span>Buscar</span></a></li>
				<li><a href="formulario_acceso.php" title="Iniciar Sesión"><span class="icon-user"></span><span>Iniciar Sesión</span></a></li>
				<li><a href="formulario_registro.php" title="Regístrate"><span class="icon-user-plus"></span><span>Regístrate</span></a></li>
			</ul>	
		</nav>
header;
?>