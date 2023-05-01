<?php
//Iniciamos o mantenemos la sesion activa.
session_start();

//Incluimos el fichero con las funciones.
include("../modelo/ventas.php");

//Establecemos la variable.
$_SESSION["ventas"]=cargarVentas();

//Redireccionamos la salida.
header("Location: ../vista/bienvenido.php");
die();
?>