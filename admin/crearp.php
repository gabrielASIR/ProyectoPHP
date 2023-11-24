<?php
// Iniciamos sesión
session_start();

// Verificamos si se nos ha enviado el formulario de creación
if (isset($_REQUEST['nombre']) && !empty($_REQUEST['nombre'])) {
    // Almacenamos los datos del formulario en variables
    $nombre = $_REQUEST['nombre'];
    $descripcion = $_REQUEST['descripcion'];
    $imagen = $_REQUEST['imagen'];
    $talla = $_REQUEST['talla'];
    $stock = $_REQUEST['stock'];
    $precio = $_REQUEST['precio'];
    $id_grupo = $_REQUEST['id_grupo'];

    // Creamos la conexión a la BBDD
    include('../incluidos/conexionBBDD.php');

    // Construimos la consulta para insertar el nuevo producto
    $sql = "insert into productos (id_producto, nombre, descripcion, imagen, talla, stock, precio, id_grupo) values ('NULL', '$nombre', '$descripcion', '$imagen', '$talla', '$stock', '$precio', '$id_grupo')";

    // Ejecutamos y recogemos el resultado
    $result = $conn->query($sql);

    // Verificamos si se realizó con éxito la operación
    if ($result) {
        $_SESSION['mensajeADMIN'] = "Nuevo producto creado con éxito.";
    } else {
        $_SESSION['mensajeADMIN'] = "Error al crear el nuevo producto.";
    }

    // Redirigimos a la página principal de administración
    header('Location: admin.php');

    // Cerramos la conexión
    $conn->close();
} else {
    // Si no se ha enviado el formulario de creación, redirigimos a la página principal de administración
    $_SESSION['mensajeADMIN'] = "Error. No se ha podido crear el nuevo producto. Intentelo de nuevo.";
    header('Location: admin.php');
}
?>