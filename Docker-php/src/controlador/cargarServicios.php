<?php
//iniciamos o mantenemos la sesion activa
session_start();

//incluimos el fichero con las funciones
include("../modelo/servicios.php");

//establecemos la variable
$_SESSION["servicios"]=cargarServicios();

//redireccionamos 
header("Location: ../vista/bienvenido.php");
die();
?>