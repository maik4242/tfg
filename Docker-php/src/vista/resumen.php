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
	<title>Bienvenido. Resumen</title>
</head>
<body>
<!-- Tanto para el menu (nav) como la cabecera (header) y el pie (footer), se utiliza php ya que es comun a todas las paginas. -->
	<nav>
	<?php 
		include("../include/nav.php")
	?>	
	</nav>

	<header>
		<?php
			include("../include/cabecera.php");
		?>
	</header>

<!-- Se utiliza main para separar el nav, header y footer de los articulos -->
	<main>
	<article class="resumen">
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
			A continuaci&oacute;n puede ver un resumen de su reserva:
		</p>
			<ul>
				<li>Nombre del servicio: 
					<?php 
					//Imprimimos el nombre del servicio.
					echo($_SESSION["codigoServicio"]["nombreS"]); 
					?>
				</li>
				<li>Descripci&oacute;n:
					<?php 
					//Imprimimos la descripción del servicio.
					echo($_SESSION['codigoServicio']['descripcionS']); 
					?>
					</li>
				<li>Precio: 
					<?php 
					//Imprimimos el precio del servicio.
					if(isset($_SESSION['precio5']['dinero'])){
						echo($_SESSION['precio5']['dinero']);
					}
					else{
						if(isset($_SESSION['precio10']['dinero'])){
							echo($_SESSION['precio10']['dinero']);
						}
						else{
							echo($_SESSION['precio15']['dinero']);
						}
					}
					?> euros (€)
				</li>
				<li>Duraci&oacute;n:
					<?php 
					//Imprimimos el tiempo de duración del servicio.
					if(isset($_SESSION['precio5']['tiempo'])){
						echo($_SESSION['precio5']['tiempo']);
					}
					else{
						if(isset($_SESSION['precio10']['tiempo'])){
							echo($_SESSION['precio10']['tiempo']);
						}
						else{
							echo($_SESSION['precio15']['tiempo']);
						}
					}
					?> minutos.
				</li>
				<li>Hora: 
					<?php 
					//Imprimimos la hora elegida.
					echo($_SESSION['hora']); 
					?> 
				</li>
			</ul>
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
				Rellene los campos para realizar el pago:
			</p>
				<form class="verticalJustificado" method="post" action="../controlador/guardarVenta.php">
					<table>
						<tr>
							<td>Titular:</td>
							<td><input type="text" name="titular" size="20" maxlength="50"/></td>
						</tr>
						<tr>
							<td>Número de tarjeta:</td>
							<td><input type="text" name="tarjeta" size="20" maxlength="16" pattern="[0-9]{16}"/></td>
						</tr>
						<tr>
							<td>Caducidad:</td>
							<td><input type="month" name="caducidad"/></td>
						</tr>
						<tr>
							<td>CIV:</td>
							<td><input type="text" name="civ" size="5" maxlength="3" pattern="[0-9]{3}"/></td>
						</tr>
					</table>
					<p class="boton"><input type="submit" value="Realizar pago"></p>
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