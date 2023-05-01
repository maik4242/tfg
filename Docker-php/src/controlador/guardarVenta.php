<?php
//iniciamos o retomamos la sesion
session_start();

//incluimos el fichero con las funciones
include("../modelo/ventas.php");

//establecemos la variable de caducidad de la tarjeta
$caducidad=$_POST['caducidad'];

//cogemos la hora del sistema
$hora= new DateTime();
$hora=$hora->format("Y-m");

//Filtramos en si la tarjeta está caducada.
if($caducidad < $hora){
	$_SESSION['error']="La tarjeta de crédico está caducada.";
	$_SESSION['color']='red';
	header('Location: ../vista/resumen.php');
	die();
}

//Si la tarjetano está caducada.
else{
//establecemos las variables
$emailV=$_SESSION['usuario']['email'];
$codServicio=$_SESSION['codigoServicio']['codigoS'];
$nomServicio=$_SESSION['codigoServicio']['nombreS'];

//establecemos la variable del precio y de la duración en una variable de sesión.
if(isset($_SESSION['precio5']['dinero'])){
	$precio=$_SESSION['precio5']['dinero'];
}
else{
	if(isset($_SESSION['precio10']['dinero'])){
		$precio=$_SESSION['precio10']['dinero'];
	}
	else{
		$precio=$_SESSION['precio15']['dinero'];
	}
}

if(isset($_SESSION['precio5']['tiempo'])){
	$duracion=$_SESSION['precio5']['tiempo'];
}
else{
	if(isset($_SESSION['precio10']['tiempo'])){
		$duracion=$_SESSION['precio10']['tiempo'];
	}
	else{
		$duracion=$_SESSION['precio15']['tiempo'];
	}
}

//guardamos la venta
guardarVenta($emailV,$codServicio,$nomServicio,$precio,$duracion);

//imprimimos un mensaje
$_SESSION['error']='Reserva realizada con éxito.';
$_SESSION['color']='green';

//redireccionamos la salida en funcion del usuario.
if($_SESSION["usuario"]["email"]=="adminu@admin.admin"){
	header("Location: ./cargarVentas.php");
	die();
}
else{
	header("Location: ./cargarVentasUsuario.php");
	die();
}
}

?>