<?php
//manentenemos iniciada la sesión.
session_start();

//cerramos la sesión.
session_destroy();

//redireccionamos.
header("Location: ../index.php");
die();
?>