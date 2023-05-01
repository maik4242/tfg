<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<!-- Para que tenga varias hojas de estilo en funcion del tamaño del dispositivo -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="(min-width: 681px)" href="../css/estilo_formularioGlobal.css">
	<link rel="stylesheet" type="text/css" media="(max-width: 680px)" href="../css/estilo_formularioSmall.css">

<!-- Para poner el icono de la pestania del navegador -->
	<link rel="icon" href="../images/logoCentroDiscusion.png">
	<title>Formulario</title>
</head>
<body>
<!-- Tanto para el menu (nav) como la cabecera (header) y el pie (footer), se utiliza php ya que es comun a todas las paginas. -->
	<nav>
		<?php
			include("../include/nav.php");
		?>
	</nav>

	<header>
		<?php
			include("../include/cabecera.php");
		?>
	</header>
<!-- Se utiliza main para separar el nav, header y footer de los articulos -->
	<main>
		<article class="verticalCentrado">
		<p>
			<h1>Formulario de alta</h1>
		</p>
		<p style="color:<?php if(isset($_SESSION["color"])){
					echo ($_SESSION["color"]);
				}?>;">
			<?php
			if(isset($_SESSION["error"])){
				echo ($_SESSION["error"]);
				unset($_SESSION["error"]);	
			}
			?>
		</p>

		<form class="verticalCentrado" enctype="multipart/form-data" action="../controlador/loginFormulario.php" method="POST">
			<table>
			<tr>	
				<td><label for="nombre">Nombre:</label></td>
				<td><input type="text" name="nombre" size="20" maxlength="40" required autofocus value="<?php if(isset($_POST["nombre"])){echo($_POST["nombre"]);} ?>"/></td>
			</tr>
			<tr>
				<td><label for="apellidos">Apellidos:</label></td>
				<td><input type="text" name="apellidos" size="20" maxlength="60" required value="<?php if(isset($_POST["apellidos"])){echo($_POST["apellidos"]);} ?>"/></td>
			</tr>
			<tr>
				<td><label for="dni">DNI (con letra y sin espacios):</label></td>
				<td><input type="text" name="dni" size="12" maxlength="9" pattern="[0-9]{8}[A-z]{1}" required value="<?php if(isset($_POST["dni"])){echo($_POST["dni"]);} ?>"/></td>
			</tr>
			<tr>
				<td><label for="email">Correo electr&oacute;nico:</label></td>
				<td><input type="email" name="email" size="20" maxlength="60" required value="<?php if(isset($_POST["email"])){echo($_POST["email"]);} ?>"/></td>
			</tr>
			<tr>
				<td><label for="pass">Contrase&ntilde;a:</label></td>
				<td><input type="password" name="pass" size="20" maxlength="60" required value="<?php if(isset($_POST["pass"])){echo($_POST["pass"]);} ?>"/></td>
			</tr>
			<tr>
				<td><label for="pass2">Confirmar Contrase&ntilde;a:</label></td>
				<td><input type="password" name="pass2" size="20" maxlength="60" required value="<?php if(isset($_POST["pass2"])){echo($_POST["pass2"]);} ?>"/></td>
			</tr>
			</table>
			<p>
				Suba una fotocopia del DNI en fomato pdf: 
			</p>
			<p>
				<input type="file" name="fichero_usuario"/>
			</p>

<!-- A los checkbox y a los botones se les asigna un clase para darles un estilo propio -->
			<p class="casilla">
				<input type="checkbox" name="terminos" required>
				<label for="terminos">Acepto los T&eacute;rminos y Condiciones de Uso</label>
			</p>
			<p class="casilla">	
				<input type="checkbox" name="privacidad" required>
				<label for="privacidad">Acepto la Pol&iacute;tica de Privacidad</label>
			</p>
			<p class="boton">
				<input type="submit" value="Aceptar y enviar"/>
			</p>
			<p class="boton">
				<input type="reset" value="Limpiar formulario"/>
			</p>	
		</form>
		</article>
	</main>

	<footer>
		<?php
			include("../include/pie.php");
		?>
	</footer>
</body>
</html>