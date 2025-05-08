<!-- Conexión con base de datos MYSQL - XAMPP  -->
<?php
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $databases = "test";

    // Crear conexión
    $conn = new mysqli($servidor, $usuario, $password, $databases);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida - ERROR de conexión: " . $conn->connect_error);
    }
?>