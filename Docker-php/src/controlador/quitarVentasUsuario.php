<?php
//iniciamos o mantenemos la sesion activa
session_start();

//"eliminamos" la variable
unset($_SESSION["ventasUsuario"]);

//redireccionamos 
header("Location: ../vista/bienvenido.php");
die();
?>