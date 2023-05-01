<?php
//Iniciamos o mantenemos la sesión.
session_start();

//Incluimos el fichero con las funciones.
include("../modelo/usuarios.php");

//Establecemos la variable y usamos la función de borrado.
$codigo=$_GET["codigo"];

//Impedimos que se elimine el usuario administrador.
if ($codigo=1){
	$_SESSION['error']="No se puede eliminar al usuario administrador";
	$_SESSION['color']="red";
}	

else{
	borrarUsuario($codigo);
	$_SESSION['error']="Usuario eliminado correctamente.";
	$_SESSION['color']="green";
}

//Redirigimos la salida.
header("Location: ./cargarUsuarios.php");
die();
?>