<?php 
    require 'databases.php';

    # Agregar una fila
    $league_name = $_POST['league_name'];
    $date = $_POST['date'];
    $date2 = $_POST['date2'];
    $type = $_POST['type'];

    // Preparamos la consulta SQL para evitar inyecciones
    $sql = "INSERT INTO league (name, date_i, date_e, type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $league_name, $date, $date2, $type);

    if ($stmt->execute()) {
        // Obtener el "id" del último registro insertado
        $stmt->close(); // Cerramos la declaración preparada para la tabla league

        // Redireccionamos después de la inserción exitosa
        header("Location: ../html/administrator/league-admin.php");
        exit();
        
    } 
    else {
        echo "Error al registrar una nueva liga: " . $stmt->error;
    }

    // Cerramos la conexión
    $conn->close();
?>
