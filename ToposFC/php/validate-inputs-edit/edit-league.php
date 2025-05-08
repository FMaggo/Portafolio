<?php
    require '../databases.php';

    # Editar una fila 
    $editLeague = $_POST['editLeague']; 
    $name = $_POST['league_name'];
    $date = $_POST['date'];
    $date2 = $_POST['date2'];
    $type = $_POST['type'];

    // Preparamos la consulta SQL para evitar inyecciones
    $sql = "UPDATE league SET name = ?, date_i = ?, date_e = ?, type = ? WHERE id_league = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $date, $date2, $type, $editLeague);

    if ($stmt->execute()) {
        // Cerrar la declaración preparara
        $stmt->close();

        header("Location: ../../html/administrator/league-admin.php");
        // exit();
    }
    else echo "Error al actualizar información de la liga seleccionado: ". $stmt->error;

?>