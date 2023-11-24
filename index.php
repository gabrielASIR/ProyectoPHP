<?php
// Iniciamos la sesión
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosindex.css">
    <title>Pagina principal tienda</title>
</head>
<body class="grid">
    <header class="header">
        <?php
            // Incluimos la cabecera
            include('incluidos/cabeceraindex.php');
        ?>
    </header>

    <nav class="lista">
        <?php
            // Incluimos el menú
            include('incluidos/menuindex.php');
        ?>
    </nav>

    <div class="cuerpo">
        <?php
        // Creamos una conexión
        include('incluidos/conexionBBDD.php');

        // Construimos la consulta para ver todos los productos disponibles
        $sql = "select * from productos";

        // Ejecutamos y recogemos el resultado
        $result = $conn->query($sql);

        echo "<h1>NUESTROS PRODUCTOS</h1>";

        // Creamos el contenedor para las tarjetas
        echo "<main>";

        // Iteramos por cada registro de la BBDD
        while ($row = $result->fetch_assoc()) {
            // Creamos una tarjeta para cada producto
            echo "<div class='tarjeta-producto'>";
                echo $row['imagen'];
                echo "<div class='info'>";
                    echo "<h2>" . $row['nombre'] . "</h2>";
                    echo "<p>" . $row['descripcion'] . "</p>";
                    echo "<p>Precio: $" . $row['precio'] . "</p>";
                    echo "<p>Stock: " . $row['stock'] . "</p>";
                    echo "<a href='productos/añadirproductos.php?id_añadir=" . $row['id_producto'] . "'>Comprar</a>";
                echo "</div>";
            echo "</div>";
        }

        echo "</main>";
        // Cerramos la conexión
        $conn->close();
        ?>
        <div class='productos-confirmacion'>
        <?php
            // Compruebo si existe el mensaje (en la primera carga no existirá)
            if (isset($_SESSION['compracarrito']) && !empty($_SESSION['compracarrito'])) {
                echo "Productos situados en carrito: " . count($_SESSION['compracarrito']);
                echo "<br>";
                echo "<a href='productos/carrito.php'>Confirmar</a>";
            }
            echo "<br>";
            if (isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje']; // Muestro el mensaje
                unset($_SESSION['mensaje']); // Borro el mensaje para que no aparezca siempre
            }
        ?>
        </div> 
    </div>

    <footer class="footer">
    <?php
        // Incluye el pie de página
        include('incluidos/pie.php');
    ?>
    </footer> 
</body>
</html>