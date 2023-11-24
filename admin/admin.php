<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona administración tienda</title>
    <link rel="stylesheet" href="../css/estilosadmin.css">
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
    // Iniciamos sesion
    session_start();
    echo "<div class='tocar'>";
        // Comprobamos que accedemos como admin.
        if (isset($_SESSION['userid']) && !empty($_SESSION['userid']) && $_SESSION['userid'] == 1000 ) {
            echo "<h2>Zona de administración</h2>";
            echo "<p>Bienvenido a la zona de administración de nuestra página web, aquí tienes las diferentes opciones que puedes realizar:</p>";
            // Construimos lo necesario para mostrar las posibles partes de la administracion.
            echo "<ul>";
                echo "<li><a href='admin.php?id_listarped=1'>Listar todos los pedidos de la BBDD.</a></li>";
                echo "<li><a href='admin.php?id_listarpro=1'>Listar todos los productos de la BBDD.</a></li>";
                echo "<li><a href='admin.php?id_crearpro=1'>Crear nuevos productos en la BBDD.</a></li>";
                echo "<li><a href='admin.php?id_borrarpro=1'>Borrar productos de la BBDD.</a></li>";
                echo "<li><a href='admin.php?id_modificarpro=1'>Modificar productos de la BBDD.</a></li>";
            echo "</ul>";
            echo "<br>";
        } else {
            // Si no es así volvemos a la pagina principal
            $_SESSION['mensaje'] = 'ERROR. No se ha podido acceder a la zona admin. Es zona restringida.';
            header('Location: ../index.php');
        }
    echo "</div>";
    ?>
    <?php
        // LISTAR LOS PEDIDOS
        // Verificamos si el usuario admin a accedido a esta parte, sino no se mostrará.
        if (isset($_REQUEST['id_listarped']) && !empty($_REQUEST['id_listarped'])) {
            // Construimos nuestra zona de administracion
            echo "<h3>Listado de pedidos</h3>";
            // Creamos la estructura para mostrar los pedidos
            // PEDIDOS
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<th colspan='3'>Pedidos</th>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>Id Pedido</th>";
                    echo "<th>Id Usuario</th>";
                    echo "<th>FechaPedido</th>";
                echo "</tr>";


                // Creamos la conexion a nuestra base de datos
                include('../incluidos/conexionBBDD.php');
                
                // Construimos la consulta para ver todos los pedidos de la BBDD
                $sql = "select * from pedidos";

                // Ejecutamos y recogemos el resultado
                $result = $conn->query($sql);

                // Mostramos los datos recogidos iterando por cada uno de ellos.
                while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                            echo "<td>".$row['id_pedido']."</td>";
                            echo "<td>".$row['id_usuario']."</td>";
                            echo "<td>".$row['fecha_pedido']."</td>";
                        echo "</tr>";
                }

            echo "</table>";

            echo "<br>";
            echo "<br>";

            // DETALLE PEDIDOS
            // Creamos la estructura para mostrar los detalles de pedido
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<th colspan='3'>Detalle Pedidos</th>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>Id Detalle</th>";
                    echo "<th>Id Pedido</th>";
                    echo "<th>Id Producto</th>";
                echo "</tr>";
                
                // Construimos la consulta para ver todos los detalles de pedidos de la BBDD
                $sqldp = "select * from detalle_pedido";

                // Ejecutamos y recogemos el resultado
                $resultdp = $conn->query($sqldp);

                // Mostramos los datos recogidos iterando por cada uno de ellos.
                while ($rowdp = $resultdp->fetch_assoc()) {
                    echo "<tr>";
                        echo "<td>".$rowdp['id_detalle']."</td>";
                        echo "<td>".$rowdp['id_pedido']."</td>";
                        echo "<td>".$rowdp['id_producto']."</td>";
                    echo "</tr>";
                }

            echo "</table>";
        }
    ?>
    <?php
        // LISTAR LOS PRODUCTOS
        // Verificamos si el usuario admin a accedido a esta parte, sino no se mostrará.
        if (isset($_REQUEST['id_listarpro']) && !empty($_REQUEST['id_listarpro'])) {
            // Construimos nuestra zona de administracion
            echo "<h3>Listado de productos</h3>";

            // Creamos la estructura para mostrar los productos
            // PRODUCTOS
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<th colspan='8'>Productos</th>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>Id Producto</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Descripcion</th>";
                    echo "<th>Imagen</th>";
                    echo "<th>Talla</th>";
                    echo "<th>Stock</th>";
                    echo "<th>Precio</th>";
                    echo "<th>Id Grupo</th>";
                echo "</tr>";

            // Creamos la conexion a nuestra base de datos
            include('../incluidos/conexionBBDD.php');
            
            // Construimos la consulta para ver todos los productos de la BBDD
            $sql = "select * from productos";

            // Ejecutamos y recogemos el resultado
            $result = $conn->query($sql);

            // Mostramos los datos recogidos iterando por cada uno de ellos.
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>".$row['id_producto']."</td>";
                    echo "<td>".$row['nombre']."</td>";
                    echo "<td>".$row['descripcion']."</td>";
                    echo "<td>".$row['imagen']."</td>";
                    echo "<td>".$row['talla']."</td>";
                    echo "<td>".$row['stock']."</td>";
                    echo "<td>".$row['precio']."</td>";
                    echo "<td>".$row['id_grupo']."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
    <?php
    // CREAR NUEVOS PRODUCTOS
        // Verificamos si el usuario admin a accedido a esta parte, sino no se mostrará.
        if (isset($_REQUEST['id_crearpro']) && !empty($_REQUEST['id_crearpro'])) {
            echo "<h3>CREAR NUEVO PRODUCTO</h3>";
            echo "<form action='crearp.php'>";
            echo "<label for='nombre'>Nombre: </label>";
            echo "<input type='text' name='nombre' required><br>";

            echo "<label for='descripcion'>Descripción: </label>";
            echo "<input type='text' name='descripcion' required><br>";

            echo "<label for='imagen'>Código HTML para imagen: </label>";
            echo "<input type='text' name='imagen' required><br>";

            echo "<label for='talla'>Talla: </label>";
            echo "<select id='talla' name='talla' required>";
            echo "<option value='XS'>XS</option>";
            echo "<option value='S'>S</option>";
            echo "<option value='M'>M</option>";
            echo "<option value='L'>L</option>";
            echo "<option value='XL'>XL</option>";
            echo "<option value='XXL'>XXL</option>";
            echo "</select><br>";

            echo "<label for='stock'>Stock: </label>";
            echo "<input type='number' name='stock' required><br>";

            echo "<label for='precio'>Precio: </label>";
            echo "<input type='number' name='precio' step='any' required><br>";

            echo "<label for='id_grupo'>ID Grupo: </label>";
            echo "<input type='number' name='id_grupo' required><br><br>";

            echo "<input type='submit' value='Crear Producto'>";
            echo "</form>";
        }
    ?>
    <?php
    // BORRAR PRODUCTOS
        // Verificamos si el usuario admin a accedido a esta parte, sino no se mostrará.
        if (isset($_REQUEST['id_borrarpro']) && !empty($_REQUEST['id_borrarpro'])) {
            echo "<h3>BORRAR PRODUCTO</h3>";
            echo "<form action='borrarp.php' method='post'>";
            echo "<label for='id_borrar'>ID del Producto a Borrar: </label>";
            echo "<input type='text' name='id_borrar' required><br><br>";
            echo "<input type='submit' value='Borrar Producto'>";
            echo "</form>";
        }
    ?>
    <?php
    // MODIFICAR PRODUCTOS
        // Verificamos si el usuario admin a accedido a esta parte, sino no se mostrará.
        if (isset($_REQUEST['id_modificarpro']) && !empty($_REQUEST['id_modificarpro'])) {
            echo "<h3>MODIFICAR PRODUCTO</h3>";
            echo "<form action='modificarp.php' method='post'>";
            echo "<label for='id_modificar'>ID del Producto a Modificar: </label>";
            echo "<input type='text' name='id_modificar' required><br>";

            echo "<label for='nombre'>Nuevo Nombre: </label>";
            echo "<input type='text' name='nombre' required><br>";

            echo "<label for='descripcion'>Nueva Descripción: </label>";
            echo "<input type='text' name='descripcion' required><br>";

            echo "<label for='imagen'>Nueva Imagen URL: </label>";
            echo "<input type='text' name='imagen' required><br>";

            echo "<label for='talla'>Nueva Talla: </label>";
            echo "<input type='text' name='talla' required><br>";

            echo "<label for='stock'>Nuevo Stock: </label>";
            echo "<input type='number' name='stock' required><br>";

            echo "<label for='precio'>Nuevo Precio: </label>";
            echo "<input type='number' name='precio' step='any' required><br>";

            echo "<label for='id_grupo'>Nuevo ID de Grupo: </label>";
            echo "<input type='number' name='id_grupo' required><br><br>";

            echo "<input type='submit' value='Modificar Producto'>";
            echo "</form>";
        }
    ?>
    <?php
        // Comprobamos si existe el mensaje. Si no es así no se mostrará.
        echo "<div class='mensajeadmin'>";
            if (isset($_SESSION['mensajeADMIN'])) {
                echo "<br>";
                echo "<br>";
                echo $_SESSION['mensajeADMIN']; // Muestro el mensaje
                unset($_SESSION['mensajeADMIN']); // Borro el mensaje para que no aparezca siempre
            }
        echo "</div>";
    ?>
    <?php
        // Incluye el pie de página
        echo "<footer class='footer'>";
            include('../incluidos/pie.php');
        echo "</footer>"; 
    ?>
</body>
</html>