<?php
//Iniciamos o mantenemos de sesión.
session_start();

//Si no ha iniciado sesión, se le reenvía a la la página de inicio.
if(!isset($_SESSION["usuario"]["email"])){
	$_SESSION["error"]="¡ALTO! LA GUARDIA CIVIL. IDENTIFÍQUESE.";
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
			<?php 
			//Establecemos el mensaje de bienvenida para el administrador
			if ($_SESSION['usuario']['email']=='adminu@admin.admin'){
				echo("Usuario Administrador");
			}

			//Establecemos el mensaje de bienvenida para el resto de usuarios
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
			Recordemos que son varios los servicios y ofertas que le ofrecemos: 
		</p>

<!-- Tabla para mostrar los servicios -->
		<p>
		<table class="tablaservicios" border="2">
			<?php
			//Si y solo sí el usuario es administrador mostramos la columna del código
			if($_SESSION["usuario"]["email"]=='adminu@admin.admin'){
				echo('<th rowspan="2" class="oc">C&oacute;digo</th>');
			}
			?>
			<th rowspan="2">Nombre &#47; Tipo</th>
			<th rowspan="2" class="oc">Breve descripci&oacute;n</th>
			<th colspan="3">Precios (&euro;)</th>
			<?php 
			//Si el usuario es administrador mostramos las columnas de acción
			if ($_SESSION['usuario']['email']=='adminu@admin.admin'){
				echo("<th rowspan='2' class='admin'>Acci&oacute;n</th>");
			}
			?>
			<tr>
				<td class="negrita">5 min.</td>
				<td class="negrita">10 min.</td>
				<td class="negrita">15 min.</td>
			</tr>
			<?php
			//Si el usuario es administrador Y no existen servicios imprimimos un formulario para insertar servicios.
			if($_SESSION["servicios"]["num"]==0 && $_SESSION["usuario"]["email"]=='adminu@admin.admin'){
				echo("No existen servicios. Rellene los campos para añadir un servicio.");
				echo ("<form method='post' action='../controlador/guardarServicio.php'>");
					echo("<tr>");
						echo ("<td class='oc'>");
							echo("<input type='hidden' name='codigoS'/>");
						echo ("</td>");
						echo ("<td>");
							echo("<input type='text' name='nombreS'/>");
						echo ("</td>");
						echo ("<td class='oc'>");
							echo("<input type='text' name='descripcionS'/>");
						echo ("</td>");
						echo ("<td>");
							echo("<input type='text' name='precio5'/>");
						echo ("</td>");
						echo ("<td>");
							echo("<input type='text' name='precio10'/>");
						echo ("</td>");
						echo ("<td>");
							echo("<input type='text' name='precio15'/>");
						echo ("</td>");
						echo ("<td>");
							echo("<input type='submit' value='Guardar'/>");
						echo ("</td>");
					echo("</tr>");
				echo("</form>");
			}

			//En caso de que existan servicios, que los muestre por pantalla.			
			else{

				//Los imprimimos usando un bucle.
				for($i=0; $i<$_SESSION["servicios"]["num"];$i++){

					//En caso que se quiera editar un servicio.
					if(isset($_GET["indice"])){
						
						//Se identifica el servicio con la variable y se imprime el formulario para editar el servicio.
						if($i==$_GET['indice']){
							echo ("<form method='POST' action='../controlador/actualizarServicio.php'>");
							echo("<tr>");

							//El código del servicio no se imprime (hidden) para evitar inconsistencias.
							//Tampoco se imprime el nombre para que no lo pueda cambiar (ya es es único)
								echo ("<td class='oc'>");
									echo("<input type='hidden' name='codigoS' value='".$_SESSION['servicios'][$i]['codigoS']."'/>");
								echo ("</td>");
								echo ("<td>");
									echo("<input type='hidden' name='nombreS' value='".$_SESSION['servicios'][$i]['nombreS']."'/>");
								echo ("</td>");
								echo ("<td class='oc'>");
									echo("<input type='text' name='descripcionS' value='".$_SESSION['servicios'][$i]['descripcionS']."'/>");
								echo ("</td>");
								echo ("<td>");
									echo("<input type='text' name='precio5' value='".$_SESSION['servicios'][$i]['precio5']."'/>");
								echo ("</td>");
								echo ("<td>");
									echo("<input type='text' name='precio10' value='".$_SESSION['servicios'][$i]['precio10']."'/>");
								echo ("</td>");
								echo ("<td>");
									echo("<input type='text' name='precio15' value='".$_SESSION['servicios'][$i]['precio10']."'/>");
								echo ("</td>");

								//El botón para guardar la actualización (el servicio que se ha editado).
								echo ("<td>");
									echo("<input type='submit' value='Actualizar'/>");
								echo ("</td>");
							echo("</tr>");
							echo("</form>");
						}

						//Para imprimir el resto de los servicios (los que no se editan), además del que se edita.
						else{
						echo("<tr>");
						echo("<td class='oc'>");
							echo($_SESSION["servicios"][$i]["codigoS"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["servicios"][$i]["nombreS"]);
						echo("</td>");
						echo("<td class='oc'>");
							echo($_SESSION["servicios"][$i]["descripcionS"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["servicios"][$i]["precio5"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["servicios"][$i]["precio10"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["servicios"][$i]["precio15"]);
						echo("</td>");
							if ($_SESSION['usuario']['email']=='adminu@admin.admin'){
								echo("<td class='admin'>");
									echo("<a href='./bienvenido.php?indice=".$i."'><img class='editar' src='../images/editar.png'/></a>
										<a href='../controlador/borrarServicio.php?codigo=".$_SESSION["servicios"][$i]["codigoS"]."'><img class='borrar' src='../images/borrar.png'/></a>");
								echo("</td>");
							}
						echo("</tr>");	
						}

					}

					//Se imprimen todos los servicio que hay (la lista normal), si no se edita nada.
					else{
					echo("<tr>");

						//Solamente si es administrador se muestra el código
						if($_SESSION['usuario']['email']=='adminu@admin.admin'){
							echo("<td class='oc'>");
								echo($_SESSION["servicios"][$i]["codigoS"]);
							echo("</td>");
						}
						echo("<td>");
							echo($_SESSION["servicios"][$i]["nombreS"]);
						echo("</td>");
						echo("<td class='oc'>");
							echo($_SESSION["servicios"][$i]["descripcionS"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["servicios"][$i]["precio5"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["servicios"][$i]["precio10"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["servicios"][$i]["precio15"]);
						echo("</td>");

						//Si el usuario es administrador, se imprime las opciones de acción (editar y borrar)
						if ($_SESSION['usuario']['email']=='adminu@admin.admin'){
							echo("<td class='admin'>");
								echo("<a href='./bienvenido.php?indice=".$i."'><img class='editar' src='../images/editar.png'/></a>
									<a href='../controlador/borrarServicio.php?codigo=".$_SESSION["servicios"][$i]["codigoS"]."'><img class='borrar' src='../images/borrar.png'/></a>");
							echo("</td>");
						}
					echo("</tr>");
					}
				}

				//Si se pulsa el botón de añadir, se imprime el formulario para añadir un servicio.
				if(isset($_GET['mas'])){
						echo ("<form method='post' action='../controlador/guardarServicio.php'>");
							echo("<tr>");
								echo ("<td class='oc'>");
									echo("<input type='hidden' name='codigoS'/>");
								echo ("</td>");
								echo ("<td>");
									echo("<input type='text' name='nombreS'/>");
								echo ("</td>");
								echo ("<td class='oc'>");
									echo("<input type='text' name='descripcionS'/>");
								echo ("</td>");
								echo ("<td>");
									echo("<input type='text' name='precio5'/>");
								echo ("</td>");
								echo ("<td>");
									echo("<input type='text' name='precio10'/>");
								echo ("</td>");
								echo ("<td>");
									echo("<input type='text' name='precio15'/>");
								echo ("</td>");
								echo ("<td>");
									echo("<input type='submit' value='Guardar'/>");
								echo ("</td>");
							echo("</tr>");
						echo("</form>");
					}
			}
			?>
		</table>
		<!-- Boton para el administrador -->
		<?php
		//Sólo se imprime si es administrador
		if ($_SESSION['usuario']['email']=='adminu@admin.admin'){

			//Usamos el método GET para enviar sobre sí mismoy añadir un servicio.
			echo ('<div class="engranaje">
						<a href="./bienvenido.php?mas=2" target="_self"><img class="engranajefoto" src="../images/mas.png"/></a>
					</div>');
		}
		?>
		</p>

		<p>
		<?php
		//Si existe la variable usuario, se imprimirá la tabla de usuarios.
		if(isset($_SESSION["usuarios"])){
		echo ('<table class="tablaservicios" border="2">');
			echo ("<th colspan='6'>Usuarios</th>");
			echo ("<tr>");
			echo ("<td class='negrita'>C&oacute;digo</td>");
			echo ("<td class='negrita'>Nombre</td>");
			echo ("<td class='negrita'>Apellidos</td>");
			echo ("<td class='negrita'>DNI</td>");
			echo ("<td class='negrita'>Correo</td>");
			echo ("<td class='negrita'>Acci&oacute;n</td>");
			echo ("</tr>");

		if($_SESSION["usuarios"]["num"]==0){
				echo("No existen usuarios");
			}
			else{

				//Imprimimos los usuarios con un bucle.
				for($i=0; $i<$_SESSION["usuarios"]["num"];$i++){

					//Si se quiere editar un usuario.
					if(isset($_GET["indiceusuario"])){

						//Identificamos el usuario a editar e imprimimos un formulario para editar.
						if($i==$_GET["indiceusuario"]){

							//El código no lo mostramos (hidden) para evitar inconsistencias.
							//Tampoco imprimimos el correo porque es identificativo.
							echo("<form method='POST' action='../controlador/actualizarUsuario.php'>");
							echo("<tr>");
								echo("<td class='oc'>");
									echo("<input type='hidden' name='codigo' value='".$_SESSION['usuarios'][$i]['codigo']."'/>");
								echo("</td>");
								echo("<td>");
									echo("<input type='text' name='nombre' value='".$_SESSION['usuarios'][$i]['nombre']."'/>");
								echo("</td>");
								echo("<td>");
									echo("<input type='text' name='apellidos' value='".$_SESSION['usuarios'][$i]['apellidos']."'/>");
								echo("</td>");
								echo("<td>");
									echo("<input type='text' name='dni' value='".$_SESSION['usuarios'][$i]['dni']."'/>");
								echo("</td>");
								echo("<td>");
									echo("<input type='hidden' name='email' value='".$_SESSION['usuarios'][$i]['email']."'/>");
								echo("</td>");
								echo("<td>");
									echo("<input type='submit' value='Actualizar'/>");
								echo("</td>");
							echo("<tr>");	
							echo("</form>");
						}

						//Imprimimos el resto de los usuarios (los que no se editan).
						else{
							echo("<tr>");
								echo("<td>");
									echo($_SESSION["usuarios"][$i]["codigo"]);
								echo("</td>");
								echo("<td>");
									echo($_SESSION["usuarios"][$i]["nombre"]);
								echo("</td>");
								echo("<td>");
									echo($_SESSION["usuarios"][$i]["apellidos"]);
								echo("</td>");
								echo("<td>");
									echo($_SESSION["usuarios"][$i]["dni"]);
								echo("</td>");
								echo("<td>");
									echo($_SESSION["usuarios"][$i]["email"]);
								echo("</td>");
								echo("<td class='admin'>");
									echo("<a href='./bienvenido.php?indiceusuario=".$i."'><img class='editar' src='../images/editar.png'/></a>
										<a href='../controlador/borrarUsuario.php?codigo=".$_SESSION["usuarios"][$i]["codigo"]."'><img class='borrar' src='../images/borrar.png'/></a>");
								echo("</td>");
							echo("</tr>");
						}
					}
					else{
					echo("<tr>");
						echo("<td>");
							echo($_SESSION["usuarios"][$i]["codigo"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["usuarios"][$i]["nombre"]);
						echo("</td>");
						
						echo("<td>");
							echo($_SESSION["usuarios"][$i]["apellidos"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["usuarios"][$i]["dni"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["usuarios"][$i]["email"]);
						echo("</td>");
						echo("<td class='admin'>");
							echo("<a href='./bienvenido.php?indiceusuario=".$i."'><img class='editar' src='../images/editar.png'/></a>
								<a href='../controlador/borrarUsuario.php?codigo=".$_SESSION["usuarios"][$i]["codigo"]."'><img class='borrar' src='../images/borrar.png'/></a>");
							echo("</td>");
					echo("</tr>");
					}
				}
			}
		echo ("</table>");
		}
		?>
		
<!-- Boton para el administrador -->
		<?php
		//Sólo se imprime si es administrador
		if ($_SESSION['usuario']['email']=='adminu@admin.admin'){
			echo ('<div class="engranaje">
						<a href="../controlador/cargarUsuarios.php" target="_self"><img class="engranajefoto" src="../images/usuario.png"/></a>
						<a href="../controlador/quitarUsuarios.php" target="_self"><img class="engranajefoto" src="../images/no_usuario.png"/></a>
					</div>');
		}
		?>
		</p>
		<?php
		//Si existe la variable ventas, se imprimirá la tabla de usuarios.
		if(isset($_SESSION["ventas"])){
		echo ('<table class="tablaservicios" border="2">');
			echo ("<th colspan='6'>Ventas de todos los usuarios</th>");
			echo ("<tr>");
			echo ("<td class='negrita'>C&oacute;digo</td>");
			echo ("<td class='negrita'>Usuario (email)</td>");
			echo ("<td class='negrita'>C&oacute;d. Servicio</td>");
			echo ("<td class='negrita'>Nombre Servicio</td>");
			echo ("<td class='negrita'>Precio</td>");
			echo ("<td class='negrita'>Duraci&oacute;n</td>");
			echo ("</tr>");

		//Si no existen ventas
		if($_SESSION["ventas"]["num"]==0){
				echo("No existen ventas");
			}
			else{

				//Imprimimos los usuarios con un bucle.
				for($i=0; $i<$_SESSION["ventas"]["num"];$i++){

					echo("<tr>");
						echo("<td>");
							echo($_SESSION["ventas"][$i]["codigoV"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["ventas"][$i]["emailV"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["ventas"][$i]["codServicio"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["ventas"][$i]["nomServicio"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["ventas"][$i]["precio"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["ventas"][$i]["duracion"]);
						echo("</td>");
					echo("</tr>");
					}
				}
		echo ("</table>");
		}
		?>

<!-- Boton para el administrador -->
		<?php
		//Sólo se imprime si es administrador
		if ($_SESSION['usuario']['email']=='adminu@admin.admin'){
			echo ('<div class="engranaje">
						<a href="../controlador/cargarVentas.php" target="_self"><img class="engranajefoto" src="../images/venta.png"/></a>
						<a href="../controlador/quitarVentas.php" target="_self"><img class="engranajefoto" src="../images/no_venta.png"/></a>
					</div>');
		}
		?>

<!-- Boton para los usuarios -->
		<?php
		//Sólo se imprime si es un usuario no administrador
		if ($_SESSION['usuario']['email']!='adminu@admin.admin'){
			echo ('<p>Para mostrar los servicios que ya ha contratado o dejar de mostrarlos, pulse en los siguientes iconos</p>');
			echo ('<div class="engranaje">
						<a href="../controlador/cargarVentasUsuario.php" target="_self"><img class="engranajefoto" src="../images/venta.png"/></a>
						<a href="../controlador/quitarVentasUsuario.php" target="_self"><img class="engranajefoto" src="../images/no_venta.png"/></a>
					</div>');
		}
		?>

<!-- Esta tabla es para que los usuarios vean sus servicios contratados anteriormente -->
		<?php
		//Si existe la variable ventas, se imprimirá la tabla de usuarios.
		if(isset($_SESSION["ventasUsuario"])){
		echo ('<p><table class="tablaservicios" border="2">');
			echo ("<th colspan='6'>Mis servicios contratados</th>");
			echo ("<tr>");
			echo ("<td class='negrita'>Nombre Servicio</td>");
			echo ("<td class='negrita'>Precio</td>");
			echo ("<td class='negrita'>Duraci&oacute;n</td>");
			echo ("</tr>");

		//Si no existen ventas
		if($_SESSION["ventasUsuario"]["num"]==0){
				echo("No existen servicios contratados todavía.");
			}
			else{

				//Imprimimos los usuarios con un bucle.
				for($i=0; $i<$_SESSION["ventasUsuario"]["num"];$i++){
					echo("<tr>");
						echo("<td>");
							echo($_SESSION["ventasUsuario"][$i]["nomServicio"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["ventasUsuario"][$i]["precio"]);
						echo("</td>");
						echo("<td>");
							echo($_SESSION["ventasUsuario"][$i]["duracion"]);
						echo("</td>");
					echo("</tr>");
					}
				}
		echo ("</table></p>");
		}
		?>

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