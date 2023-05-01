<?php
//Función para establecer conexión con la base de datos.
function conexionDB(){
	$hostname="db:3306";
	$user="root";
	$db="centrodiscusion";
	$pass="password";

	//establecemos la conexion.
	$conexion=mysqli_connect($hostname,$user,$pass,$db);
	if (mysqli_connect_errno()) {
		echo("Fallo de conexión");
		exit();
	}
	return $conexion;

	//seleccionamos ("usamos") la base de datos.
	$consulta="USE centroDiscusion;";
	$ejecutar_consulta=mysqli_query($conexion,$consulta);
}

//Función para guardar ventas.
function guardarVenta($emailV,$codServicio,$nomServicio,$precio,$duracion){

	//conectamos con la BS.
	$conexion=conexionDB();

	//formamos y ejecutamos la consulta.
	$consulta="INSERT INTO ventas (emailV,codServicio,nomServicio,precio,duracion) VALUES ('$emailV','$codServicio','$nomServicio','$precio','$duracion');";
	$ejecutar_consulta=mysqli_query($conexion,$consulta);

	//cerramos la conexion.
	mysqli_close($conexion);
}

//Función para cargar las ventas.
function cargarVentas(){
	
	//establecemos conexión.
	$conexion=conexionDB();

	//creamos, ejecutamos la consulta y la salida la metemos en una variable.
	$consulta="SELECT * FROM ventas;";
	$ejecutar_consulta=mysqli_query($conexion,$consulta);
	$num=mysqli_num_rows($ejecutar_consulta);

	for($i=0; $i<$num; $i++){
		$datos[$i]=mysqli_fetch_assoc($ejecutar_consulta);
	}
	$datos["num"]=$num;

	//cerramos la conexión y devuelve la variable.
	mysqli_close($conexion);
	return $datos;
}

//Función para cargar las ventas de un usuario
function cargarVentasUsuario($email){
	
	//establecemos conexión.
	$conexion=conexionDB();

	//creamos, ejecutamos la consulta y la salida la metemos en una variable.
	$consulta="SELECT * FROM ventas WHERE emailV='$email';";
	$ejecutar_consulta=mysqli_query($conexion,$consulta);
	$num=mysqli_num_rows($ejecutar_consulta);

	for($i=0; $i<$num; $i++){
		$datos[$i]=mysqli_fetch_assoc($ejecutar_consulta);
	}
	$datos["num"]=$num;

	//cerramos la conexión y devuelve la variable.
	mysqli_close($conexion);
	return $datos;
}

?>