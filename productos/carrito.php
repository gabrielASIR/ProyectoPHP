<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="../css/estiloscarrito.css">
</head>
<body>
    <?php
    // Incluimos la cabecera
    echo "<header class='header'>";
        include('../incluidos/cabeceracarrito.php');
    echo "</header>";

    // Incluimos el menú
    echo "<nav class='lista'>";
        include('../incluidos/menucarrito.php');
    echo "</nav>";
    ?>
    <?php
    // Iniciamos la sesión
    session_start();

    // Verificamos si compracarrito existe y no está vacía
    if (isset($_SESSION['compracarrito']) && !empty($_SESSION['compracarrito'])) {
        echo "<h3>SU CARRITO DE LA COMPRA.</h3>";
        echo "<table border='1'>";
        echo "<tr>";
            echo "<th>Imagen</th>";
            echo "<th>Producto</th>";
            echo "<th>Talla</th>";
            echo "<th>Precio Producto</th>";
            echo "<th>Eliminar</th>";
        echo "</tr>";

        // Almacenamos en una variable lo contenido en compracarrito
        $idCompra = $_SESSION['compracarrito'];

        // Inicializamos el precio total
        $precioTotal = 0;

        // Inicializamos el idBorrar
        $idBorrar = 0;
        
        // Iteramos por cada valor que tengamos
        for ($i = 0; $i < count($idCompra); $i++) {
            $idProducto = $idCompra[$i];

            // Creamos la conexion a nuestra base de datos
            include('../incluidos/conexionBBDD.php');

            // Construimos la consulta para ver todos los productos disponibles
            $sql = "select * from productos where id_producto = $idProducto";

            // Ejecutamos y recogemos el resultado
            $result = $conn->query($sql);

            // Recogemos el resultado
            $row = $result->fetch_assoc();

            // Mostramos los datos recogidos.
            echo "<tr>";
                echo "<td>".$row['imagen']."</td>";
                echo "<td>".$row['nombre']."</td>";
                echo "<td>".$row['talla']."</td>";
                echo "<td>".$row['precio']."</td>";
                echo "<td><a href='borrar_un_producto.php?id_borraruno=".$idBorrar."'>X</a></td>";
            echo "</tr>";

            // Calculamos el precio total
            $precioTotal = $precioTotal + $row['precio'];

            // Calculamos el idBorrar
            $idBorrar = $idBorrar + 1;

            // Cerramos la conexion
            $conn->close();
        }
            echo "<tr>";
                echo "<td colspan='3'>Precio total</td>";
                echo "<td colspan='2'>".$precioTotal."</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td colspan='5'><a href='borrar_todos_productos.php?id_borrartodo=1'>Borrar todo</a></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td colspan='5'><a href='compra.php'>Confirmar compra</a></td>";
            echo "</tr>";
        echo "</table>";
        echo "<div class='mensajecarrito'>";
            if(isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje']; // Muestro el mensaje
                unset($_SESSION['mensaje']); // Borro el mensaje
            }
        echo "</div>";
    }
    ?>

    <?php
    // Incluye el pie de página
    echo "<footer class='footer'>";
        include('../incluidos/pie.php');
    echo "</footer>"; 
    ?>
</body>
</html>
 