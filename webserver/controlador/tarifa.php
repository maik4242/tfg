<?php
//iniciamos o retomamos la sesion
session_start();

//incluimos el fichero con las funciones
include("../modelo/servicios.php");

//establecemos las variables para los precios y la duración de cada uno
if(isset($_POST['precio5'])){
	$_SESSION['precio5']['dinero']=$_POST['precio5'];
	$_SESSION['precio5']['tiempo']=5;
}
else{
	if(isset($_POST['precio10'])){
		$_SESSION['precio10']['dinero']=$_POST['precio10'];
		$_SESSION['precio10']['tiempo']=10;
	}
	else{
		$_SESSION['precio15']['dinero']=$_POST['precio15'];
		$_SESSION['precio15']['tiempo']=15;

	}
}

//establecemos la variable
$_SESSION["codigoServicio"]=codigoServicio($_POST['codigoS']);

//redireccionamos la salida
header('Location: ../vista/franja.php');
die();

?>