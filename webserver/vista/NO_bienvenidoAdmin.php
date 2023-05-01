<?php
session_start();
if($_SESSION["usuario"]["nombre"]!="adminu@admin.admin"){
	$_SESSION["error"]="Acceso denegado.";
	$_SESSION["color"]="red";
	header("Location: ./bienvenido.php");
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
	<title>Bienvenido</title>
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
			Bienvenido, admnistrador.
			</h1>
		</p>
		<p>
			Recordemos que son varios los servicios y ofertas que le ofrecemos: 
		<ol type="1" start="1">
			<li>Charla cordial. Se trata de una conversiaci&oacute;n, una charla tranquila y apacible con un sabroso caf&eacute; o t&eacute; afrutado.</li>
			<li>Discusi&oacute;n pac&iacute;fica. Se exponen los puntos de vista y se trata tranquilamente y con educaci&oacute;n.</li>
			<li>Discusi&oacute;n acalorada. Ya empiza a tomar otro matiz m&aacute;s oscuro. El tono se endurece y no se deja terminar al interlocutor, al &quot;contrario&quot;.</li>
			<li>Discusi&oacute;n subida de tono. Se emplean insultos verbales e incluso gestuales, poco importa el tema en s&iacute; mismo.</li>
			<li>A por todas. Aqu&iacute; se dispara sin ton ni son. Muy probable que se vaya af&oacute;nico a su hogar.</li>
		</ol>
		</p>

<!-- Tabla para mostrar los servicios -->
		<table class="tablaservicios" border="2">
			<th rowspan="2" class="oc">C&oacute;digo</th>
			<th rowspan="2">Nombre &#47; Tipo</th>
			<th rowspan="2" class="oc">Breve descripci&oacute;n</th>
			<th colspan="3">Precios (&euro;)</th>
			<th rowspan="2">Acci&oacute;n</th>
			<tr>
				<td class="negrita">5 min.</td>
				<td class="negrita">10 min.</td>
				<td class="negrita">15 min.</td>
			</tr>
			<tr>
				<td class="oc">DEFCON1</td>
				<td>Charla cordial</td>
				<td class="oc">Conversaci&oacute;n tranquila, apacible y coloquial.</td>
				<td>5&euro;</td>
				<td>7&euro;</td>
				<td>9&euro;</td>
				<td class="admin"><a href=""><img class="editar" src="../images/editar.png"/></a><a href=""><img class="borrar" src="../images/borrar.png"/></a></td>
			</tr>
			<tr>
				<td class="oc">DEFCON2</td>
				<td>Discusi&oacute;n pac&iacute;fica</td>
				<td class="oc">Lo que vendr&iacute;a siendo un debate formal</td>
				<td>7&euro;</td>
				<td>9&euro;</td>
				<td>11&euro;</td>
				<td class="admin"><a href=""><img class="editar" src="../images/editar.png"/></a><a href=""><img class="borrar" src="../images/borrar.png"/></a></td>
			</tr>
			<tr>
				<td class="oc">DEFCON3</td>
				<td>Discusi&oacute;n acalorada</td>
				<td class="oc">Tono m&aacute;s endurecido</td>
				<td>9&euro;</td>
				<td>11&euro;</td>
				<td>13&euro;</td>
				<td class="admin"><a href=""><img class="editar" src="../images/editar.png"/></a><a href=""><img class="borrar" src="../images/borrar.png"/></a></td>
			</tr>
			<tr>
				<td class="oc">DEFCON4</td>
				<td>Discusi&oacute;n subida de tono</td>
				<td class="oc">Pueden aparecer alg&uacute;n que otro insulto</td>
				<td>11&euro;</td>
				<td>13&euro;</td>
				<td>15&euro;</td>
				<td class="admin"><a href=""><img class="editar" src="../images/editar.png"/></a><a href=""><img class="borrar" src="../images/borrar.png"/></a></td>
			</tr>
			<tr>
				<td class="oc">DEFCON5</td>
				<td>A por todas</td>
				<td class="oc">Esto ya es algo m&aacute;s pr&oacute;ximo a la berrea</td>
				<td>13&euro;</td>
				<td>15&euro;</td>
				<td>17&euro;</td>
				<td class="admin"><a href=""><img class="editar" src="../images/editar.png"/></a><a href=""><img class="borrar" src="../images/borrar.png"/></a></td>
			</tr>
			</tr>
		</table>
<!-- Boton para el administrador -->
		<div class="engranaje">
		<a href="" target="_self"><img class="engranajefoto" src="../images/engranaje.png"/></a>
		</div>
<!-- Enlace para empezar la reserva -->
		<p class="verticalCentrado">
			<img class="calendario" src="../images/calendario.png"/>
			<a id="reserva" href="./tarifa.php">Haga su reserva aqu&iacute;</a>
		</p>
<!-- Enlace para cerar sesion -->
		<p class="verticalCentrado">
			<a id="cerrar" href="../controlador/cerrarSesion.php">Cerrar sesi&oacute;n</a>
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