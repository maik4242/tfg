<?php
//iniciamos o retomamos la sesion
session_start();

//incluimos el fichero con las funciones
include("../modelo/usuarios.php");

//creamos la funcion para filtrar los datos
function comprobarFormulario($dato){
	$dato = trim($dato);
	$dato = stripslashes($dato);
	$dato = htmlspecialchars($dato);
	return $dato;
}

//definimos las variables y les damos un valor vacio
$nombre = "";
$apellidos = "";
$dni = "";
$email = "";
$pass = "";
$pass2 = "";

//filtramos los datos
if($_POST["nombre"]!="" && $_POST["apellidos"]!="" && $_POST["dni"] && $_POST["email"]!="" && $_POST["pass"]!="" && $_POST["pass2"]!="") {
	$nombre = comprobarFormulario($_POST["nombre"]);
	$apellidos = comprobarFormulario($_POST["apellidos"]);
	$dni = comprobarFormulario($_POST["dni"]);
	$email = comprobarFormulario($_POST["email"]);
	$pass = comprobarFormulario($_POST["pass"]);
	$pass2 = comprobarFormulario($_POST["pass2"]);
}

//para subir los ficheros del formulario
//definimos la ruya de subida
$dir_subida='../subidos/';


//separamos el nombre del fichero en partes
$cad=explode(".", $_FILES['fichero_usuario']['name']);
$extension=$cad[count($cad) - 1];

//definimos el nombre del fichero
$fichero_subido=$dir_subida.$_POST["dni"].".".$extension;

//subimos el fichero
if($extension=="pdf"){
	move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido);

	//comprobamos que los campos contengan información
	if($nombre!="" && $apellidos!="" && $dni!="" && $email!="" && $pass!="" && $pass2!=""){
		//si los campos de contraseña del formulario coinciden
		if ($pass==$pass2) {
			//si no existe el email del usuario
			if (!existeUsuario($email)) {
				//se guarda el usuario en la BD
				guardarUsuario($nombre,$apellidos,$dni,$email,$pass);
				$_SESSION['error']="Usuario creado correctamente. Introducta sus credenciales para iniciar sesión.";
				$_SESSION['color']="green";
				header("Location: ../vista/centroDeDiscusion.php");
				die();
			}
			//si ya existe el email en la BD
			else{
				$_SESSION['error']="No se puede crar un usuario existente";
				$_SESSION['color']="red";
				header("Location: ../vista/formulario.php");
				die();
			}
		}
		//si las contraseñas no coinciden
		else{
			$_SESSION['error']="Las contraseñas no coinciden";
			$_SESSION['color']="red";
			header("Location: ../vista/formulario.php");
			die();
		}
	}
	//si se deja un campo en blanco
	else{
		$_SESSION['error']="No me sea vago y rellene todos los campos";
		$_SESSION['color']="red";
		header("Location: ../vista/formulario.php");
		die();
	}


	//para que las contraseñas.
	if(isset($_POST["pass"]) && isset($_POST["pass2"])){

		//que los campos estén rellenos.
		if($_POST["pass"]=="" || $_POST["pass2"]==""){
			header('Location: ../vista/formulario.php?error=Rellena los campos');
		}
		else{

			//si las contraseñas no coinciden.
			if($_POST["pass"]!=$_POST["pass2"]){
				header('Location: ../vista/formulario.php?error=Las contraseñas son diferentes');
			}
			else{
				header('Location: ../vista/formulario.php?error=TODO CORRECTO');
			}
		}
	}
}

//si el fichero no fuese en formato pdf
else{
	$_SESSION['error']="El formato del archivo debe ser pdf";
	$_SESSION['color']="red";
	header("Location: ../vista/formulario.php");
	die();
}

?>