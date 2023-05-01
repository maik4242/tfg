<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="(min-width: 681px)" href="../css/estilo_bienvenidoGlobal.css">
	<link rel="stylesheet" type="text/css" media="(max-width: 680px)" href="../css/estilo_bienvenidoSmall.css">
	<link rel="icon" href="../images/logoCentroDiscusion.png">
	<title>Bienvenido</title>
</head>
<body>
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
	<main>
	<article class="verticalJustificado">
		<p>
			<h1>Hola, <?php echo("Don Mendo con php"); ?> </h1>
		</p>
		<p>
			Elija el servicio deseado pinchando en su nombre: 
		</p>
		<p>
		<table class="tablaservicios" border="2">
			<th class="oc">C&oacute;digo</th>
			<th>Nombre &#47; Tipo</th>
			<th class="oc">Breve descripci&oacute;n</th>
			<tr>
				<td class="oc">DEFCON1</td>
				<td><a href="./tarifa.php">Charla cordial</a></td>
				<td class="oc">Conversaci&oacute;n tranquila, apacible y coloquial.</td>
			</tr>
			<tr>
				<td class="oc">DEFCON2</td>
				<td><a href="./tarifa.php">Discusi&oacute;n pac&iacute;fica</a></td>
				<td class="oc">Lo que vendr&iacute;a siendo un debate formal</td>
			</tr>
			<tr>
				<td class="oc">DEFCON3</td>
				<td><a href="./tarifa.php">Discusi&oacute;n acalorada</a></td>
				<td class="oc">Tono m&aacute;s endurecido</td>
			</tr>
			<tr>
				<td class="oc">DEFCON4</td>
				<td><a href="./tarifa.php">Discusi&oacute;n subida de tono</a></td>
				<td class="oc">Pueden aparecer alg&uacute;n que otro insulto</td>
			</tr>
			<tr>
				<td class="oc">DEFCON5</td>
				<td><a href="./tarifa.php">A por todas</a></td>
				<td class="oc">Esto ya es algo m&aacute;s pr&oacute;ximo a la berrea</td>
			</tr>
			</tr>
		</table>
		</p>
		<p class="verticalCentrado">
			<img class="atras" src="../images/flechaAtras.png"/>
			<a id="atras" href="bienvenido.php">Atr&aacute;s</a>
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