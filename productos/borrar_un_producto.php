<?php
// Verificamos si se nos ha enviado el código para borrar.
if(isset($_REQUEST['id_borraruno'])) {

    // Iniciamos la sesión
    session_start();

    // Lo almacenamos en una variable por si lo necesitasemos manejar.
    $idborraruno = $_REQUEST['id_borraruno'];

    $productoscarrito = $_SESSION['compracarrito'];
    
    // Borramos las posiciones.
    unset($productoscarrito[$idborraruno]);

    // Declaramos un array vacio
    $nuevocarrito = array();

    // Asignar las posiciones bien
    foreach($productoscarrito as $posicion => $nombre) {
        $nuevocarrito[] = $nombre;
    }

    // Guardamos de nuevo el array en la sesion.
    $_SESSION['compracarrito'] = $nuevocarrito;

    // Creamos un mensaje que se va a mostrar en carrito.php y volvemos a mostrarlo.
    $_SESSION['mensaje'] = 'Producto borrado de su carrito.';
    header('Location: carrito.php');
} else {
    // Iniciamos la sesión
    session_start(); 
    $_SESSION['mensaje'] = 'Su carrito no ha podido ser vaciado.';
    header('Location: carrito.php');
}
?>
<?php
    if (isset($_SESSION['compracarrito']) && empty($_SESSION['compracarrito'])) {
        // Iniciamos la sesión
        session_start();

        unset($_SESSION['compracarrito']);
        $_SESSION['mensaje'] = 'Su carrito a sido vaciado. Compre nuevos productos para volver a tenerlo.';
        header('Location: ../index.php');
    }
?>