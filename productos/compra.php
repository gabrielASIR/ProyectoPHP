<?php
// Iniciamos la sesión
session_start();

// Verificamos si hemos iniciado sesión.
if (isset($_SESSION['conexion']) && !empty($_SESSION['conexion'])) {
    
    // Creamos la conexión a la BBDD
    include('../incluidos/conexionBBDD.php');

    // Construimos la consulta para insertar el nuevo pedido.
    $sql = "insert into pedidos (id_usuario, fecha_pedido) VALUES ('{$_SESSION['userid']}', NOW())";

    // Ejecutamos y recogemos el resultado
    $result = $conn->query($sql);


    // Obtenemos el ID del pedido recién insertado
    $idPedido = $conn->insert_id;

    // Almacenamos en una variable lo contenido en compracarrito
    $idCompra = $_SESSION['compracarrito'];

    // Iteramos por cada valor que tengamos
    foreach ($idCompra as $idProducto) {
        // Construimos la consulta para insertar los productos en el detalle del pedido
        $sqlDetalle = "insert into detalle_pedido (id_pedido, id_producto) VALUES ('$idPedido', '$idProducto')";

        // Ejecutamos y recogemos el resultado
        $resultDetalle = $conn->query($sqlDetalle);

        // Vaciamos el carrito
        unset($_SESSION['compracarrito']);

        // Guardamos un mensaje y redirigimos a la página principal.
        $_SESSION['mensaje'] = "Compra realizada con éxito";
        header('Location: ../index.php');
    }

    // Cerramos la conexión
    $conn->close();
} else {
    // Si no se puede acceder, redirigimos a la página de iniciar sesión.
    $_SESSION['mensajeLOG'] = 'No se ha podido realizar la compra. Debes iniciar sesión antes.';
    header("Location: ../admin/login.php");
}
?>