<?php
	
	echo <<<barranavsesioninic
		<nav id="barraNavPrinc">
			<input type="checkbox" name="mnHamb" id="mnHamb"/><label for="mnHamb" title="Menú" id="iconoMnHamb"><span class="icon-menu"></span></label>
			<ul id="mnPrinc">
				<li><a href="index.php" title="Inicio"><span class="icon-home" ></span><span>Inicio</span></a></li>
				<li><a href="perfil.php" title="Mi Perfil"><span class="icon-user-circle" ></span><span>Mi Perfil</span></a></li>
				<li><a href="formulario_busqueda.php" title="Búsqueda avanzada"><span class="icon-search"></span><span>Buscar</span></a></li>
				<li><a href="eliminar_sesion.php" title="Cerrar Sesión"><span class="icon-logout"></span><span>Cerrar Sesión</span></a></li>
			</ul>	
		</nav>
barranavsesioninic;

?>