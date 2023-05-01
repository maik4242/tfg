<?php
//Iniciamos o mantenemos la sesión.
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<!-- Para que tenga varias hojas de estilo en funcion del tamaño del dispositivo -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="(min-width: 681px)" href="../css/estilo_centroGlobal.css">
	<link rel="stylesheet" type="text/css" media="(max-width: 680px)" href="../css/estilo_centroSmall.css">
	
<!-- Para poner el icono de la pestania del navegador -->
	<link rel="icon" href="../images/logoCentroDiscusion.png">
	<title>Centro de Discusi&oacute;n</title>
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

<!-- Primer articulo con su clase propia para que se alinee al centro -->
	<article class="verticalCentrado">
		<a name="accesoaqui"></a></br>
		<p>
		<h1>Acceso Usuarios</h1>
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
		<form action="../controlador/loginUsuario.php" method="post">
			<table>
				<tr>
					<td><label for="email">Correo electr&oacute;nico:</label></td>
					<td><input type="email" name="user" size="20" maxlength="60" value="<?php if(isset($_POST["user"])){echo($_POST["user"]);} ?>"/></td>
				</tr>
				<tr>
					<td><label for="pass">Contrase&ntilde;a:</label></td>
					<td><input type="password" name="pass" size="20" maxlength="40" value="<?php if(isset($_POST["pass"])){echo($_POST["pass"]);} ?>" /></td>
				</tr>
				</table>
				<p class="boton">
					<input type="submit" value="Entrar"/>
				</p>
		</form>
		<p>
			¿Todav&iacute;a no formas parte de esta incre&iacute;ble comunidad?
		</p>

<!-- Para el correo se utiliza un id ya que es unico en todo el documento -->
		<p>
			<a id="miembro" href="formulario.php">Hazte miembro aqu&iacute;</a>
		</p>

	</article>
	
	<article class="verticalJustificado">
		<a name="quienessomos"></a></br>
		<p>
			<h1 ondblclick="alert('Has pulsado dos veces')">Qui&eacute;nes somos</h1>
		</p>
		<p>
			Somos un grupos de frikis que hace tiempo nos vimos aquel episodio de Monty Phyton's Flying Circus donde hab&iacute;a un sketch que lleva el t&iacute;tulo de &quot;Argument Clinic&quot;.
		</p>
		<p>	
			Como casi toda idea loca esto empez&oacute; con unas risas y unas cervezas, luego algo m&iacute;s serio hasta que empezamos a tirar para adelante sin miedo alguno y, bueno, aqu&iacute; estamos, dando gritos que es muy sano.
		</p>
		<p>
			El sketch en cuesti&oacute;n es el que hay debajo de este texto. Si el enlace no funciona puede pinchar <a href="https://www.youtube.com/watch?v=DkQhK8O9Jik" target="_blank">aqu&iacute;</a> para verlo en Youtube. Si no funciona puede pinchar <a href="https://www.dailymotion.com/video/x2hwqn9" target="_blank">aqu&iacute;</a> para verlo en Dailymotion.
		</p>

<!-- Un div para el video de youtube -->
		<div class="video">
		<iframe  src="https://www.youtube.com/embed/DkQhK8O9Jik" title="Monty Phyton's Flying Circus" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</article>
	<!-- Este articulo tiene section para que el texto se muestr por columnas (responsivo)-->
	<article class="verticalJustificado">
		<a name="dequevaesto"></a></br>
		<p>
			<h1>De Qu&eacute; va esto</h1>
		</p>
		<div class="textoResponsivo">
		<section>
		<p>
			Es completamente l&oacute;gico y comprensible que le est&eacute;n rondando muchas preguntas la cabeza como: ¿pero d&oacute;nde me he metido? ¿Exactamente qu&eacute; es esto? ¿Esto va en serio? O preguntas algo m&aacute;s existencialista como: ¿esto es verdad? ¿en serio existe esto? En resumidas cuentas, ¿de qu&eacute; va esto? No se preocupe, es entendible.
		</p>
		</section>
		<section>
		<p>	
			No hay mucha complicaci&oacute;n. El t&iacute;tulo no engaña, esto es un <b>Centro de discusi&oacute;n</b>. Aqu&iacute; se viene a discutir, simple y sencillo.
			Pero por si alguno que otro se encuentra algo perdido, es necesario aclarar el concepto. La RAE define <a href="https://www.rae.es/dpd/discusi%C3%B3n" target="_blank">discusi&oacute;n </a> como: &quot;Acci&oacute;n y efecto de discutir&quot;. En cuanto a <a href="https://www.rae.es/dpd/discutir" target="_blank">discutir</a>, lo define como: &quot;Contraponer opiniones sobre algo&quot;. 
		</p>
		</section>
		</div>
	</article>
	
	<article class="verticalJustificado">
		<a name="servicios"></a></br>
		<p>
			<h1>Servicios ofertados</h1>
		</p>
		<p>
			Son varios los servicios y ofertas que le ofrecemos: desde una tranquila charla con un caf&eacute; bas&aacute;ndose en un cordial intercambio de opiniones hasta conversaciones donde el tono est&aacute; algo m&aacute;s subido e incluso opci&oacute;n de ir a descargar la furia interna e ir a intercambiar gritos y berridos con otra persona.
		</p>
		<p>	
			Porque s&iacute;, hay mucha gente que opina que no est&aacute; mal hablar las cosas de manera calmada y sosegada, tener un intercambio de ideas educada. Pero hay gente que simplemente le apetece discutir por discutir. Pues toda esa gente, aqu&iacute; tiene su sitio, el lugar que estaba buscando.
		</p>

		<p>
			A continuaci&oacute;n puede ver en la siguiente tabla los distintos servicios con el coste de cada uno de ellos.
		</p>

<!-- Tabla para mostrar los servicios -->
		<table class="tablaservicios" border="2">
			<th rowspan="2">Nombre &#47; Tipo</th>
			<th rowspan="2" class="oc">Breve descripci&oacute;n</th>
			<th colspan="3">Precios (&euro;)</th>
			<tr>
				<td class="negrita">5 min.</td>
				<td class="negrita">10 min.</td>
				<td class="negrita">15 min.</td>
			</tr>
			<?php
			//Incluimos el fichero con las cunciones.
			include("../modelo/servicios.php");

			//Cargamos los servicios en una variable de sesión.
			$_SESSION["servicios"]=cargarServicios();

			//En caso de que no existan servicios, imprime el mensaje.
			if($_SESSION["servicios"]["num"]==0){
				echo("No existen servicios");
			}
			else{

				//Imprimimos los servicios con un bucle.
				for($i=0; $i<$_SESSION["servicios"]["num"];$i++){
					echo("<tr>");
						echo("<td>");
							echo($_SESSION["servicios"][$i]["nombreS"]);
						echo("</td>");
						echo("<td>");
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
					echo("</tr>");
				}
			}
			?>
		</table>
	</article>

	<article class="verticalJustificado">
		<a name="contacto"></a></br>
		<p>
			<h1>Contacto y Localizaci&oacute;n</h1>
		</p>
		<p>
			Si quisiera ponerse en contacto con nostros para resolver alguna duda, adelante con ello. Cualquier duda que podamos resolverle, lo haremos encantados. Para ello utilice el siguiente correo electr&oacute;nico: centrodediscusion&#64;gmail.com
		</p>

<!-- Dentro del articulo se le asigna un estilo distinto mediante una clase para el enlace del correo -->
		<p class="verticalCentrado">
		<a id="correo" href="mailto:centrodediscusion@gmail.com?Subject=Dudas%20sobre%20los%20servicios"> centrodediscusion&#64;gmail.com</a>
		</p>
		<p>
			Siempre puede venir a nuestro centro en persona para aclararle cualquier duda, y si le conviene, le convence y tenemos hueco, podr&aacute; disfrutar de uno o varios de nuestros servicios. 
		</p>
		<p>
			Si simplente se va a quejar y todo eso, le recomendamos que use alguno de nuestros servicios, que para eso est&aacute;n.
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