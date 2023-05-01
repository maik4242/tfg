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

//Función para cargar los servicios.
function cargarServicios(){

	//realizamos la conexión a la BD.
	$conexion=conexionDB();

	//creamos, ejecutamos la consulta y creamos una variable con la salida de datos.
	$consulta="SELECT * FROM servicios;";
	$ejecutar_consulta=mysqli_query($conexion,$consulta);
	$num=mysqli_num_rows($ejecutar_consulta);
	for($i=0; $i<$num; $i++){
		$datos[$i]=mysqli_fetch_assoc($ejecutar_consulta);
	}
	$datos["num"]=$num;

	//cerramos la conexión y devolvemos los datos.
	mysqli_close($conexion);
	return $datos;
}

//Función añadir servicios
function guardarServicio($nombreS,$descripcionS,$precio5,$precio10,$precio15){

	//realizamos la conexión con la BD.
	$conexion=conexionDB();

	//creamos y ejecutamos la consulta.
	$consulta="INSERT INTO servicios(nombreS,descripcionS,precio5,precio10,precio15) 
				VALUES ('$nombreS','$descripcionS','$precio5','$precio10','$precio15')";
	$ejecutar_consulta=mysqli_query($conexion,$consulta);

	//cerramos la conexión con la BS.
	mysqli_close($conexion);
}

//Función para borrar los servicios.
function borrarServicio($codigo){

	//conectamos con la BD.
	$conexion=conexionDB();

	//creamos y ejecutamos la consulta.
	$consulta="DELETE FROM servicios WHERE codigoS='$codigo';";
	$ejecutar_consulta=mysqli_query($conexion, $consulta);

	//cerramos la conexión.
	mysqli_close($conexion);
}

//Función para editar (actualizar) los servicios.
function actualizarServicio($codigoS,$nombreS,$descripcionS,$precio5,$precio10,$precio15){

	//conectamos con la BD.
	$conexion=conexionDB();

	//creamos y ejecutamos la consulta.
	$consulta="UPDATE servicios 
		SET nombreS='$nombreS',
			descripcionS='$descripcionS',
			precio5='$precio5',
			precio10='$precio10',
			precio15='$precio15'
		WHERE codigoS='$codigoS';";
	$ejecutar_consulta=mysqli_query($conexion, $consulta);

	//cerramos la conexión.
	mysqli_close($conexion);
}

//Función para obtener el nombre del servicio.
function codigoServicio($codigoS){

	//conectamos con la BD.
	$conexion=conexionDB();

	//creamos y ejecutamos la consulta.
	$consulta="SELECT * FROM servicios WHERE codigoS='$codigoS';";
	$ejecutar_consulta=mysqli_query($conexion, $consulta);

	//lo unimos a una variable.
	$codigoServicio=mysqli_fetch_assoc($ejecutar_consulta);

	//que nos devuelva esa variable.
	return $codigoServicio;

	//cerramos la conexión.
	mysqli_close($conexion);
}

//Función para comprobar si existe el servicio.
function existeServicio($nombreS){

	//por defecto el resultado es falso.
	$res=false;

	//establecemos conexion.
	$conexion=conexionDB();

	//creamos la consulta y la ejecutamos.
	$consulta="SELECT * FROM servicios WHERE nombreS='$nombreS';";
	$ejecutar_consulta=mysqli_query($conexion,$consulta);
	$num=mysqli_num_rows($ejecutar_consulta);

	//si esiste el resultado es verdadero.
	if($num>0){
		$res=true;
	}

	//cerramos la conexion.
	mysqli_close($conexion);

	//devolvemos el resultado (sea cual sea).
	return $res;
}

?>