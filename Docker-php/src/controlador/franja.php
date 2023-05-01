<?php
//iniciamos o retomamos la sesion
session_start();

//establecemos la variable de sesión para la hora.
if(isset($_POST['hora'])){
	$_SESSION['hora']=$_POST['hora'];
}

//redireccionamos.
header('Location: ../vista/resumen.php');
die();

?>