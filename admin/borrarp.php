<?php
// Iniciamos sesión
session_start();

// Verificamos si se nos ha enviado el formulario de borrado
if (isset($_REQUEST['id_borrar']) && !empty($_REQUEST['id_borrar'])) {
    // Almacenamos el ID del producto a borrar en una variable
    $id_producto_borrar = $_REQUEST['id_borrar'];

    // Creamos la conexión a la BBDD
    include('../incluidos/conexionBBDD.php');

    // Construimos la consulta para borrar el producto
    $sql = "delete from productos where id_producto = $id_producto_borrar";

    // Ejecutamos y recogemos el resultado
    $result = $conn->query($sql);

    // Verificamos si se realizó con éxito la operación
    if ($result) {
        $_SESSION['mensajeADMIN'] = "Producto borrado con éxito.";
    } else {
        $_SESSION['mensajeADMIN'] = "Error al borrar el producto.";
    }

    // Redirigimos a la página principal de administración
    header('Location: admin.php');
    
    // Cerramos la conexión
    $conn->close();
} else {
    $_SESSION['mensajeADMIN'] = "Error al intentar borrar el producto.";
    header('Location: admin.php');
}
?>