<?php
    require '../databases.php';

    $id_team = $_POST['editTeam'];
    $team_name = $_POST['name'];
    $id_league = $_POST['league'];
    
    // Preparamos la consulta SQL para evitar inyecciones
    $sql = "UPDATE team SET team_name = ? WHERE id_team = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $team_name, $id_team);

    if ($stmt->execute()) {
    
        // Cerramos la declaración preparada
        $stmt->close();

        header("Location: ../../html/administrator/team-admin.php?id_league=$id_league");
        exit();

    }
    else echo "Error al actualizar información del equipo: " . $stmt->error;
?>