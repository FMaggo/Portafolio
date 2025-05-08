<?php
    require 'databases.php';

    // Obtenemos los datos 
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];

    $numGol1 = $_POST['num-gol-1'];
    $numGol2 = $_POST['num-gol-2'];
    $player1 = $_POST['player1'];
    $player2 = $_POST['player2'];

    // Preparamos la consulta SQL para evitar inyecciones (tabla "goal")
    $sql = "UPDATE goal SET goal_number = goal_number + ? WHERE id_team_member = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $numGol1, $player1);
    $stmt->execute();

    $stmt->bind_param("ii", $numGol2, $player2);
    $stmt->execute();
    
    $stmt->close();

    // Se calcula el ganador a través de la diferencia de goles
    if ($numGol1 > $numGol2) {
        // Equipo 1 ganó
        $equipo1_g = 1;
        $equipo2_g = 0;
        $empate = 0;
    } elseif ($numGol1 < $numGol2) {
        // Equipo 2 ganó
        $equipo1_g = 0;
        $equipo2_g = 1;
        $empate = 0;
    } else {
        // Empate
        $equipo1_g = 0;
        $equipo2_g = 0;
        $empate = 1;
    }

    // Determinar la cantidad de puntos para cada equipo
    if ($empate == 1) {
        $puntos1 = 1;
        $puntos2 = 1;
        $equipo1_p = 0;
        $equipo2_p = 0;
    } elseif ($equipo1_g == 1) {
        $puntos1 = 3;
        $puntos2 = 0;
        $equipo1_p = 0;
        $equipo2_p = 1;
    } else {
        $puntos1 = 0;
        $puntos2 = 3;
        $equipo1_p = 1;
        $equipo2_p = 0;
    }

    // Actualizar datos de la tabla "estadistica_nueva"

    // Equipo 1
    $sql = "UPDATE estadistica_nueva 
            SET pj = pj + 1, 
                g = g + ?, 
                e = e + ?, 
                p = p + ?, 
                gf = gf + ?, 
                gc = gc + ?, 
                dg = dg + (? - ?), 
                pts = pts + ? 
            WHERE id_team = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiiiiiii", $equipo1_g, $empate, $equipo1_p, $numGol1, $numGol2, $numGol1, $numGol2, $puntos1, $team1);
    $stmt->execute();

    // Equipo 2
    $stmt->bind_param("iiiiiiiii", $equipo2_g, $empate, $equipo2_p, $numGol2, $numGol1, $numGol2, $numGol1, $puntos2, $team2);
    $stmt->execute();

    // Cerramos la declaración preparada
    $stmt->close();

    header("Location: ../html/administrator/statistics.php");
    exit();
?>
