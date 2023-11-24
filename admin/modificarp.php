<?php
// Iniciamos sesión
session_start();

// Verificamos si se nos ha enviado el formulario de modificación
if (isset($_REQUEST['id_modificar']) && !empty($_REQUEST['id_modificar'])) {
    // Almacenamos los nuevos datos en variables
    $id_producto_modificar = $_REQUEST['id_modificar'];
    $nombre = $_REQUEST['nombre'];
    $descripcion = $_REQUEST['descripcion'];
    $imagen = $_REQUEST['imagen'];
    $talla = $_REQUEST['talla'];
    $stock = $_REQUEST['stock'];
    $precio = $_REQUEST['precio'];
    $id_grupo = $_REQUEST['id_grupo'];

    // Creamos la conexión a la BBDD
    include('../incluidos/conexionBBDD.php');

    // Construimos la consulta para actualizar los datos del producto
    $sql = "update productos set nombre = '$nombre', descripcion = '$descripcion', imagen = '$imagen', talla = '$talla', stock = '$stock', precio = '$precio', id_grupo = '$id_grupo' where id_producto = $id_producto_modificar";

    // Ejecutamos y recogemos el resultado
    $result = $conn->query($sql);

    // Verificamos si se realizó con éxito la operación
    if ($result) {
        $_SESSION['mensajeADMIN'] = "Producto modificado con éxito.";
    } else {
        $_SESSION['mensajeADMIN'] = "Error al modificar el producto.";
    }

    // Redirigimos a la página principal de administración
    header('Location: admin.php');
    
    // Cerramos la conexión
    $conn->close();
} else {
    $_SESSION['mensajeADMIN'] = "Error al intentar modificar el producto.";
    header('Location: admin.php');
}
?>