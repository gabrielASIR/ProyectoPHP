<?php
// Iniciamos la sesión
session_start();

// Destruimos la sesión
session_destroy();

// Redirigimos a la página principal con un mensaje
session_start();
$_SESSION['mensaje'] = 'Sesión cerrada con éxito';
header('Location: ../index.php');
?>