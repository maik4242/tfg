<?php
//iniciamos o retomamos la sesión
session_start();

//incluimos el fichero de las funciones
include("../modelo/usuarios.php");

//creamos la funcion para filtrar los datos
function comprobarFormulario($dato){
	$dato = trim($dato);
	$dato = stripslashes($dato);
	$dato = htmlspecialchars($dato);
	return $dato;
}

//definimos las variables y les damos un valor vacio
$email = "";
$pass = "";

//filtramos los datos
if($_POST["user"]!="" && $_POST["pass"]!="") {
	$email = comprobarFormulario($_POST["user"]);
	$pass = comprobarFormulario($_POST["pass"]);
}

	//comprobamos si todos los campos están rellenos
	if($_POST["user"]!="" && $_POST["pass"]!=""){

		//autenticamos al usuario
		if(autenticar($_POST["user"],$_POST["pass"])){
			$_SESSION['usuario']['email']=$_POST["user"];
			header("Location: ./cargarServicios.php");
			die();
		}

		//si las credenciales no son correctas
		else{
			$_SESSION["error"]="Usuario y/o contraseña incorrectos";
			$_SESSION["color"]="red";
			header("Location: ../index.php");
			die();
		}
}

//si falta algún campo por rellenar
else{
	$_SESSION['error']="Debe rellenar todos los campos.";
	$_SESSION['color']="red";
	header("Location: ../index.php");
	die();
}
?>