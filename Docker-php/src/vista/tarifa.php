<?php
//Iniciamos o mantenemos la sesión.
session_start();

//Si no ha iniciado sesión, se le reenvía a la la página de inicio.
if(!isset($_SESSION["usuario"]["email"])){
	$_SESSION["error"]="Identifíquese.";
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
	<title>Bienvenido. Tarifa</title>
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
			//Establecemos el mensaje de bienvenida para el administrador 
			if ($_SESSION['usuario']['email']=='adminu@admin.admin'){
				echo("Usuario Administrador");
			}

			//Para el resto de usuarios imprime su nombre
			else{
				echo("Bienvenido, ".$_SESSION["usuario"]["email"]);
			}
			?> 
			</h1>
		</p>
		<!-- Reservamos un espacio para mensajes de error -->
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
		<p>
			Elija la tarifa deseada en funci&oacute;n del tiempo que desee disfrutar de su servicio: 
		</p>
		<p>
<!-- Tabla para mostrar los servicios con enlaces en los distintos precios -->
		<table class="tablaservicios" border="2">
			<th rowspan="2" class="oc">C&oacute;digo</th>
			<th rowspan="2">Nombre &#47; Tipo</th>
			<th rowspan="2" class="oc">Breve descripci&oacute;n</th>
			<th colspan="3">Precios (&euro;)</th>
			<tr>
				<td class="negrita">5 min.</td>
				<td class="negrita">10 min.</td>
				<td class="negrita">15 min.</td>
			</tr>
			<?php
			//Si no hay servicio disponible, se imprime el mensaje.
			if($_SESSION["servicios"]["num"]==0){
				echo("No hay servicio disponibles, lo sentimos.");
			}

			//Para la lista de servicios.
			else{

				//Utilizamos un bucle para imprimir todos los servicios.
				for($i=0; $i<$_SESSION['servicios']['num'];$i++){
					echo("<form action='../controlador/tarifa.php' method='POST'>");
					echo("<tr>");
						echo("<td class='oc'>");
							echo("<input type='hidden' name='codigoS' value='".$_SESSION["servicios"][$i]["codigoS"]."'/>");
						echo("</td>");
						echo("<td>");
							echo($_SESSION["servicios"][$i]["nombreS"]);
						echo("</td>");
						echo("<td class='oc'>");
							echo($_SESSION["servicios"][$i]["descripcionS"]);
						echo("</td>");
						echo("<td>");
							echo("<input type='submit' name='precio5' value='".$_SESSION["servicios"][$i]["precio5"]."'/>");
						echo("</td>");
						echo("<td>");
							echo("<input type='submit' name='precio10' value='".$_SESSION["servicios"][$i]["precio10"]."'/>");
						echo("</td>");
						echo("<td>");
							echo("<input type='submit' name='precio15' value='".$_SESSION["servicios"][$i]["precio15"]."'/>");
						echo("</td>");
					echo("</tr>");
					echo("</form>");
				}
			}

			?>
		</table>
		</p>
<!-- Enlace para ir a la pagina de atras -->
		<p class="verticalCentrado">
			<img class="atras" src="../images/flechaAtras.png"/>
			<a id="atras" href="./bienvenido.php">Atr&aacute;s</a>
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