<?php
//iniciamos o retomamos la sesion
session_start();

//incluimos el fichero con las funciones
include("../modelo/usuarios.php");

//creamos la funcion para filtrar los datos
function comprobarFormulario($dato){
	$dato = trim($dato);
	$dato = stripslashes($dato);
	$dato = htmlspecialchars($dato);
	return $dato;
}

//definimos las variables y les damos un valor vacio
$nombre = "";
$apellidos = "";
$dni = "";
$email = "";

//filtramos los datos
if($_POST["nombre"]!="" && $_POST["apellidos"]!="" && $_POST["dni"]!="" && $_POST["email"]!="") {
	$nombre = comprobarFormulario($_POST["nombre"]);
	$apellidos = comprobarFormulario($_POST["apellidos"]);
	$dni = comprobarFormulario($_POST["dni"]);
	$email = comprobarFormulario($_POST["email"]);
}

//definimos la variable de codigo
$codigo = $_POST['codigo'];

//comprobamos que los campos tengan información
if ($nombre!="" && $apellidos!="" && $dni!="" && $email!="") {

	// //si el usuario no existe (no tiene un email ya existente)
	// if(!existeUsuario($email)){

		//indicamos que lo acualice
		actualizarUsuario($codigo,$nombre,$apellidos,$dni,$email);
		$_SESSION['error']='Usuario actualizado correctamente.';
		$_SESSION['color']='green';

		//redireccionamos la salida.
		header("Location: ./cargarUsuarios.php");
		die();
	}

// 	//si el usuario ya existe (ya hay un email existente)
// 	else{
// 		$_SESSION['error']='El usuario ya existe (email).';
// 		$_SESSION['color']='red';

// 		//redireccionamos la salida.
// 		header("Location: ./cargarUsuarios.php");
// 		die();
// 	}
// }

//si falta algún campo por rellenar
else{
$_SESSION['error']='Rellene todos los campos.';
$_SESSION['color']='red';

//redireccionamos la salida
header("Location: ../vista/bienvenido.php");
die();
}

?>