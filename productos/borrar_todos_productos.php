<?php
// Verificamos si se nos ha enviado el código para borrar.
if($_REQUEST['id_borrartodo'] = 1) {

    // Lo almacenamos en una variable por si lo necesitasemos manejar.
    $idborrartodo = $_REQUEST['id_borrartodo'];

    // Iniciamos la sesión
    session_start();

    // Borramos todo nuestro array
    unset($_SESSION['compracarrito']);

    // Creamos un mensaje que se va a mostrar en index.php
    $_SESSION['mensaje'] = 'Su carrito a sido vaciado. Compre nuevos productos para volver a tenerlo.';
    header('Location: ../index.php');
} else {
    // Iniciamos la sesión
    session_start(); 
    $_SESSION['mensaje'] = 'Su carrito no ha podido ser vaciado.';
    header('Location: carrito.php');
}
?>