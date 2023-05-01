<?php
//Iniciamos o mantenemos la sesion activa.
session_start();

//Incluimos el fichero con las funciones.
include("../modelo/ventas.php");

//establecemos la valirable del email
$email=$_SESSION['usuario']['email'];

//Establecemos la variable con los datos del usuario
$_SESSION["ventasUsuario"]=cargarVentasUsuario($email);

//Redireccionamos la salida.
header("Location: ../vista/bienvenido.php");
die();
?>