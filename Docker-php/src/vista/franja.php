<?php
session_start();
if(!isset($_SESSION["usuario"]["email"])){
	$_SESSION["error"]="Acceso denegado.";
	$_SESSION["color"]="red";
	header("Location: ../index.php");
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

<!-- Para que tenga varias hojas de estilo en funcion del tamaño del dispositivo -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="(min-width: 681px)" href="../css/estilo_bienvenidoGlobal.css">
	<link rel="stylesheet" type="text/css" media="(max-width: 680px)" href="../css/estilo_bienvenidoSmall.css">

<!-- Para poner el icono de la pestania del navegador -->
	<link rel="icon" href="../images/logoCentroDiscusion.png">
	<title>Bienvenido. Franja</title>
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
	<article class="verticalJustificado">
		<p>
			<h1>
			<?php 
			if ($_SESSION['usuario']['email']=='adminu@admin.admin'){
				echo("Usuario Administrador");
			}
			else{
				echo("Bienvenido, ".$_SESSION["usuario"]["email"]);
			}
			?> 
			</h1>
		</p>
		<p>
			Elija la franja horaria deseada para su servicio: 
		</p>
		<p>
<!-- Tabla para mostrar los servicios con enlaces en los distintos precios -->
		<form action="../controlador/franja.php" method="POST">
		<table class="tablaservicios" border="2">
			<th colspan="12">Franjas horarias</th>
			<tr>
				<td colspan="6" class="negrita">Mañana</td>
			</tr>
			<tr>
				<td><input type="submit" name="hora" value="10:30"/></td>
				<td><input type="submit" name="hora" value="11:00"/></td>
				<td><input type="submit" name="hora" value="11:30"/></td>
			</tr>
			<tr>
				<td><input type="submit" name="hora" value="12:00"/></td>
				<td><input type="submit" name="hora" value="12:30"/></td>
				<td><input type="submit" name="hora" value="13:00"/></td>
			</tr>
			<tr>
				<td colspan="6" class="negrita">Tarde</td>
			</tr>
			<tr>
				<td><input type="submit" name="hora" value="17:30"/></td>
				<td><input type="submit" name="hora" value="18:00"/></td>
				<td><input type="submit" name="hora" value="18:30"/></td>
			</tr>
			<tr>
				<td><input type="submit" name="hora" value="19:00"/></td>
				<td><input type="submit" name="hora" value="19:30"/></td>
				<td><input type="submit" name="hora" value="20:00"/></td>
			</tr>
		</table>
		</form>	
		</p>
		<p>
			No se olvide de acudir a su cita, ya que si no aparece:
			<ol type="1">
				<li>Cabe la posibilidad deque su interlocutor se enfade.</li>
				<li>Muy posiblemente, en su pr&oacute;ximo ecuentro le grite de primeras (y con raz&oacute;n) aunque haya contratado una charla cordial.</li>
				<li>Totalmente seguro que no recuperar&aacute; su dinero.</li>
			</ol>
		</p>
<!-- Enlace para ir a la pagina de atras -->
		<p class="verticalCentrado">
			<img class="atras" src="../images/flechaAtras.png"/>
			<a id="atras" href="./tarifa.php">Atr&aacute;s</a>
		</p>
	</article>
	</main>
	<footer>
		<?php
			include("../include/pie.php");
		?>
	</footer>
</body>
</html>
