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

//Función para comprobar si existe el usuario.
//se podria hacer con el email o con el dni (deben ser únicos).
function existeUsuario($email){

	//por defecto, el resultado es falso.
	$res=false;

	//establecemos conexion.
	$conexion=conexionDB();

	//creamos la consulta y la ejecutamos.
	$consulta="SELECT * FROM usuarios WHERE email='$email';";
	$ejecutar_consulta=mysqli_query($conexion, $consulta);
	$num=mysqli_num_rows($ejecutar_consulta);
	
	//si existe el resultado es verdadero.
	if($num>0){
		$res=true;
	}

	//cerramos la conexion.
	mysqli_close($conexion);

	//devolvemos el resultado (sea cual sea).
	return $res;
}

//Función para guardar usuarios.
function guardarUsuario($nombre,$apellidos,$dni,$email,$pass2){

	//ciframos la contraseña
	$pass2=password_hash($pass2, PASSWORD_BCRYPT);

	//conectamos con la BS.
	$conexion=conexionDB();

	//formamos y ejecutamos la consulta.
	$consulta="INSERT INTO usuarios (nombre,apellidos,dni,email,pass) VALUES ('$nombre','$apellidos','$dni','$email','$pass2');";
	$ejecutar_consulta=mysqli_query($conexion,$consulta);

	//cerramos la conexion.
	mysqli_close($conexion);
}

//Función para autenticarse.
function autenticar($user2,$pass2){

	//establecemos conexion.
	$conexion=conexionDB();

	//creamos y ejecutamos la consulta.
	$consulta="SELECT email, pass FROM usuarios WHERE email='$user2';";
	$ejecutar_consulta=mysqli_query($conexion,$consulta);

	//Creamos una variable con la salida y establecemos las variables de usuario y contraseña.
	$datos=mysqli_fetch_assoc($ejecutar_consulta);
	$usuario=$datos["email"];
	$contrasenia=$datos["pass"];

	//El resultado es falso de manera predeterminada.
	$res=false;

	//Si coinciden el usuario y contraseña, el resultado es verdadero.
	if($user2==$usuario && password_verify($pass2, $contrasenia)){
		$res=true;
	}

	//Devuelve el resultado.
	return $res;
}

//Función cargar usuarios.
function cargarUsuarios(){

	//establecemos conexión.
	$conexion=conexionDB();

	//creamos, ejecutamos la consulta y la salida la metemos en una variable.
	$consulta="SELECT * FROM usuarios;";
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

//Función borrar usuarios.
function borrarUsuario($codigo){

	//conectamos con la BD.
	$conexion=conexionDB();

	//creamos y ejecutamos la consulta.
	$consulta="DELETE FROM usuarios WHERE codigo='$codigo';";
	$ejecutar_consulta=mysqli_query($conexion, $consulta);

	//cerramos la conexión
	mysqli_close($conexion);
}

//Función actualizar usuarios.
function actualizarUsuario($codigo,$nombre,$apellidos,$dni,$email){

	//conectamos con la BD.
	$conexion=conexionDB();

	//creamos y ejecutamos la consulta.
	$consulta="UPDATE usuarios
				SET nombre='$nombre',
					apellidos='$apellidos',
					dni='$dni',
					email='$email'
				WHERE codigo='$codigo';";
	$ejecutar_consulta=mysqli_query($conexion,$consulta);

	//cerramos la conexión.
	mysqli_close($conexion);
}

?>