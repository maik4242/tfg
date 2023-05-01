<?php
//iniciamos o mantenemos la sesión iniciada.
session_start();

//establecemos las variables para la conexión a la BD
$hostname="localhost";
$user="root";
$pass="";

//establecemos la conexión con la BD
$conexion=mysqli_connect($hostname,$user,$pass,"");
if (mysqli_Connect_errno()) {
	echo("Fallo de conexion");
	exit();
}

//purgamos la base de datos
$consulta="DROP DATABASE centroDiscusion;";
$ejecutar_consulta=mysqli_query($conexion,$consulta);

//creamos la base de datos
$consulta="CREATE DATABASE centroDiscusion;";
$ejecutar_consulta=mysqli_query($conexion,$consulta);

//seleccionamos ("usamos") la base de datos
$consulta="USE centroDiscusion;";
$ejecutar_consulta=mysqli_query($conexion,$consulta);

//creamos la tabla usuarios
$consulta="CREATE TABLE IF NOT EXISTS usuarios(
	codigo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(50) NOT NULL,
	apellidos VARCHAR(50) NOT NULL,
	dni VARCHAR(9) NOT NULL UNIQUE,
	email VARCHAR(50) NOT NULL UNIQUE,
	pass VARCHAR(100) NOT NULL
	);";
$ejecutar_consulta=mysqli_query($conexion,$consulta);

//creamos el usuario administrador cifrando primero su contraseña.
$pass2="admin";
$pass2=password_hash($pass2, PASSWORD_BCRYPT);
$consulta="INSERT INTO usuarios(nombre,email,pass) VALUES('adminu','adminu@admin.admin','$pass2');";
$ejecutar_consulta=mysqli_query($conexion,$consulta);

//creamos la tabla servicios
$consulta="CREATE TABLE IF NOT EXISTS servicios(
	codigoS INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombreS VARCHAR(20) NOT NULL UNIQUE,
	descripcionS VARCHAR(200) NOT NULL,
	precio5 FLOAT(2) NOT NULL,
	precio10 FLOAT(2) NOT NULL,
	precio15 FLOAT(2) NOT NULL
	);";
$ejecutar_consulta=mysqli_query($conexion,$consulta);

//creamos la tabla de ventas
$consulta="CREATE TABLE IF NOT EXISTS ventas(
	codigoV INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	emailV VARCHAR(50) NOT NULL,
	codServicio INT NOT NULL,
	nomServicio VARCHAR(20) NOT NULL,
	precio FLOAT(2) NOT NULL,
	duracion FLOAT(2) NOT NULL,
	FOREIGN KEY (emailV) REFERENCES usuarios(email)	ON UPDATE CASCADE,
	FOREIGN KEY (codServicio) REFERENCES servicios(codigoS)	ON UPDATE CASCADE,
	FOREIGN KEY (nomServicio) REFERENCES servicios(nombreS)	ON UPDATE CASCADE
	);";
$ejecutar_consulta=mysqli_query($conexion,$consulta);

//cerramos la conexión
mysqli_close($conexion);

//mandamos un mensaje de que todo ha ido correctamente y redireccionamos la salida.
$_SESSION['error']='Base de datos creada correctamente.';
$_SESSION['color']='green';
header('Location: ./index.php');
die();
?>