<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabecera para admin</title>
</head>
<body>
    <div id="cabecera">
        <div id="logo">
            <img src="../img/logotienda.png" alt="Logo de la tienda">
        </div>
        <div id="nombre-tienda">
            <span>Tienda online oficial de MundoBasket</span>
        </div>
        <div id="logusuario">
            <?php
            // Verificamos si la sesión está iniciada para mostrar el enlace de cierre de sesión
            if (!isset($_SESSION['conexion']) || empty($_SESSION['conexion'])) {
                echo "<a href='logout.php'>Cerrar sesión</a>";
            } else {
                echo "<a href='login.php'>Iniciar sesión</a>";
            }
            ?>
    </div>
</div>      
</body>
</html>