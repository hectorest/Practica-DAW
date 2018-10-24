<?php

	$usuario = $_POST["usuario"];
	$passw = $_POST["passw"];

	$usuariosReg = array(
		"pepe1" => "11111111",
		"manolo2" => "22222222",
		"sergio3" => "33333333",
		"juan4" => "44444444",
		"luis5" => "55555555");

print_r($usuariosReg);

foreach ($usuariosReg as $key => $value) {
	if($key == "$usuario" && $value =="$passw"){
		echo "Existe";
	}
	else{
		echo "No existe";
	}
}



?>