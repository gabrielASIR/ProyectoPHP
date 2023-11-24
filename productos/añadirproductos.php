<?php
// Verificamos si se ha enviado el ID del producto
if(isset($_REQUEST['id_añadir'])) {

    // Obtenemos el ID del producto
    $idProducto = $_REQUEST['id_añadir'];

    // Iniciamos la sesión
    session_start();

    // Declaramos un nuevo array vacío
    $objetoscarrito = array();

    // Si ya existe el array con numero en sesion lo recupero
    // para no sobreescribirlo
    if(isset($_SESSION['compracarrito'])) {
        $objetoscarrito = $_SESSION['compracarrito'];
    }
    
    // Añadimos el nuevo numero al final de la lista
    $objetoscarrito[] = $idProducto;

    $_SESSION['compracarrito'] = $objetoscarrito;

    // Redirigimos a la ventana donde se verá todo nuestro carrito.
    header("Location: ../index.php");
} else {
    // Si no se proporciona el ID del producto, redirigimos a la página principal
    header("Location: ../index.php");
}
?>