<?php
//iniciamos o retomamos la sesion
session_start();

//incluimos el fichero con las funciones
include("../modelo/servicios.php");

//creamos la funcion para filtrar los datos
function comprobarFormulario($dato){
	$dato = trim($dato);
	$dato = stripslashes($dato);
	$dato = htmlspecialchars($dato);
	return $dato;
}

//definimos las variables y les damos un valor vacio.
$nombreS = "";
$descripcionS = "";
$precio5 = "";
$precio10 = "";
$precio15 = "";

//filtramos los datos.
if($_POST["nombreS"]!="" && $_POST["descripcionS"]!="" && $_POST["precio5"]!="" && $_POST["precio10"]!="" && $_POST["precio15"]!="") {
	$nombreS = comprobarFormulario($_POST["nombreS"]);
	$descripcionS = comprobarFormulario($_POST["descripcionS"]);
	$precio5 = comprobarFormulario($_POST["precio5"]);
	$precio10 = comprobarFormulario($_POST["precio10"]);
	$precio15 = comprobarFormulario($_POST["precio15"]);
}

//comprobamos que los campos tengan información.
if ($nombreS!="" && $descripcionS!="" && $precio5!="" && $precio10!="" && $precio15!="") {

	//si no existe el nombre del servicio.
	if(!existeServicio($nombreS)){

	//indicamos que lo guarde
	guardarServicio($nombreS,$descripcionS,$precio5,$precio10,$precio15);
	$_SESSION['error']='Servicio añadido correctamente.';
	$_SESSION['color']='green';

	//redireccionamos la salida.
	header("Location: ./cargarServicios.php");
	die();
	}

	//si el nombre del servicio ya existe
	else{
		$_SESSION['error']='No pueden existir dos Servicios con el mismo nombre.';
		$_SESSION['color']='red';

		//redireccionamos la salida.
		header("Location: ./cargarServicios.php");
		die();
	}
}

//si falta algún campo por rellenar.
else{
$_SESSION['error']='Rellene todos los campos.';
$_SESSION['color']='red';

//redireccionamos.
header("Location: ../vista/bienvenido.php");
die();
}

?>