<?php

//creamos la conexión
$conexion = mysqli_connect(
	"db:3306",
	"root",
	"password",
	"centrodiscusion"
);

//comprobamos conexión
if (!$conexion){
	die("connection failed: " .mysqli_connect_error());
}	
echo "Conexion correcta";
?>
