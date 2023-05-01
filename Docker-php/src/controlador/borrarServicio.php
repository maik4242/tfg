<?php
//Iniciamos o mantenemos la sesión.
session_start();

//Incluimos el fichero con las funciones.
include("../modelo/servicios.php");

//establecemos la variable del código del servicio a eliminar.
$codigo=$_GET["codigo"];

//borramos el servicio.
borrarServicio($codigo);

//mandamos un mensaje
$_SESSION['error']="Servicio eliminado correctamente.";
$_SESSION['color']="green";

//redireccionamos la salida.
header("Location: ./cargarServicios.php");
die();
?>