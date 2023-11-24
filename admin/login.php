<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventana de usuarios</title>
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
    <h2>Ventana de usuarios</h2>
    <h3>INICIAR SESION</h3>
    <form action="login.php">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="contraseña" required><br><br>

        <input type="submit" name="login" value="Iniciar Sesión">
    </form>
    <br>
    <br>
    <h3>REGISTRARSE</h3>
    <form action="login.php">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="contraseña" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellido1">Apellido 1:</label>
        <input type="text" name="apellido1" required><br>

        <label for="apellido2">Apellido 2:</label>
        <input type="text" name="apellido2"><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono"><br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" required><br><br>

        <input type="submit" name="registro" value="Registrarse">
    </form>
    <?php
    // INICIAR SESIÓN
    // Iniciamos la sesión
    session_start();

    // Nos conectamos a la BBDD
    include('../incluidos/conexionBBDD.php');

    // Verificamos si el formulario de inicio de sesión ha sido enviado correctamente
    if (isset($_REQUEST['login']) && !empty($_REQUEST['login'])) {
        $username = $_REQUEST['username'];
        $contraseña = $_REQUEST['contraseña'];

        // Comprobamos si el usuario especificado ya existe
        $sqliniciaruser = "select * from usuarios where username = '$username' and contraseña = '$contraseña'";
        $resultiniciaruser = $conn->query($sqliniciaruser); 

        // Cuento el número de líneas que me devuelve
        $row_count = $resultiniciaruser->num_rows;

        // Recogemos el resultado
        $row = $resultiniciaruser->fetch_assoc();

        // Si está dentro de nuestra BBDD y es correcto, redirigir para confirmar la compra.
        if($row_count != 0) {
            $_SESSION['conexion'] = 'Si';
            $_SESSION['userid'] = $row['id_usuario'];
            $_SESSION['mensaje'] = 'Usuario iniciado correctamente';
            header('Location: ../index.php');
        } else {
            $_SESSION['mensajeLOG'] = 'Nombre de usuario o contraseña incorrectos. Inténtelo de nuevo.';
        }
    }

    // REGISTRARSE
    // Verificamos si el formulario de registro ha sido enviado y si es así almacenamos los resultados
    if (isset($_REQUEST['registro']) && !empty($_REQUEST['registro'])) {
        $username = $_REQUEST['username'];
        $contraseña = $_REQUEST['contraseña'];
        $nombre = $_REQUEST['nombre'];
        $apellido1 = $_REQUEST['apellido1'];
        $apellido2 = $_REQUEST['apellido2'];
        $telefono = $_REQUEST['telefono'];
        $direccion = $_REQUEST['direccion'];

       // Comprobamos si el usuario especificado ya existe
       $sqlcomprobaruser = "select * from usuarios where username = '$username'";
       $resultcomprobaruser = $conn->query($sqlcomprobaruser); 

        // Cuento el numero de filas que me devuelve SQL
        $row_count = $resultcomprobaruser->num_rows;

        // Si existe mostrar mensaje de error y si no existe insertarlo en la BBDD.
        if ($row_count != 0) {
            $_SESSION['mensajeLOG'] = 'El nombre de usuario ya está en uso o no ha sido posible registrarlo. Por favor, elija otro.';
        } else {
            $sqlcrearuser = "insert into usuarios (id_usuario, username, contraseña, nombre, apellido1, apellido2, telefono, direccion) 
            VALUES ('NULL', '$username', '$contraseña', '$nombre', '$apellido1', '$apellido2', '$telefono', '$direccion')";

            // Ejecutamos el sql para insertar nuestro usuario.
            $conn->query($sqlcrearuser);

            // Luego, redirigimos al usuario a iniciar sesión.
            $_SESSION['mensajeLOG'] = 'Usuario creado con éxito.';
        }
    }
    ?>
    <?php
    // Compruebo si existe el mensaje (en la primera carga no existira)
    echo "<br>";
    echo "<div class='mensajeadmin'>";
        if(isset($_SESSION['mensajeLOG'])){
            echo $_SESSION['mensajeLOG']; // Muestro el mensaje
            unset($_SESSION['mensajeLOG']); // Lo borro para que no siga apareciendo
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