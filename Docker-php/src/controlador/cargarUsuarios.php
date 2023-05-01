<?php
//iniciamos o mantenemos la sesion activa
session_start();

//incluimos el fichero con las funciones
include("../modelo/usuarios.php");

//establecemos la variable
$_SESSION["usuarios"]=cargarUsuarios();

//redireccionamos 
header("Location: ../vista/bienvenido.php");
die();
?>