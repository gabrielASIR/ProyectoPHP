<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu para carrito</title>
</head>
<body>
    <div class="menu">
        <ul id="enlaces-menu">
            <?php
            // Verificamos si el carrito tiene compra y si es así mostramos un enlace a él.
            if (isset($_SESSION['compracarrito']) && !empty($_SESSION['compracarrito'])) {
                echo "<li><a href='carrito.php'>Carrito</a></li>";
            }

            echo "<li><a href='../index.php'>Página Principal</a></li>";

            // Verificamos si la sesión está iniciada y es admin para mostrar enlace a la zona de administración
            if (isset($_SESSION['userid']) && !empty($_SESSION['userid']) && $_SESSION['userid'] == 1000 ) {
                echo "<li><a href='../admin/admin.php'>Admin</a></li>";
            }
            ?>
        </ul>
    </div>    
</body>
</html>