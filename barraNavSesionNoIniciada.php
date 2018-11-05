<?php
	
	echo <<<barranavsesionNoinic
		<nav id="barraNavPrinc">
			<input type="checkbox" name="mnHamb" id="mnHamb"/><label for="mnHamb" title="Menú" id="iconoMnHamb"><span class="icon-menu"></span></label>
			<ul id="mnPrinc">
				<li><a href="index.php" title="Inicio"><span class="icon-home" ></span><span>Inicio</span></a></li>
				<li><a href="formulario_busqueda.php" title="Búsqueda avanzada"><span class="icon-search"></span><span>Buscar</span></a></li>
				<li><a href="formulario_acceso.php" title="Iniciar Sesión"><span class="icon-user"></span><span>Iniciar Sesión</span></a></li>
				<li><a href="formulario_registro.php" title="Regístrate"><span class="icon-user"></span><span>Regístrate</span></a></li>
			</ul>	
		</nav>
barranavsesionNoinic;

?>