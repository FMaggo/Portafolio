<?php 
    require 'databases.php';

    // Agregar datos de equipo a la tabla "team"
    $id_league = $_POST['id_league'];
    $team_name = $_POST['team_name'];

    // Agregar datos de capitán a la tabla "team-member"
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $cologne = $_POST['cologne'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $additional = $_POST['additional'];

    // Aplicamos ucwords y almacenamos en variables intermedias
    $team_name_uc = ucwords($team_name);
    $full_name_uc = ucwords($full_name);

    // Preparamos la consulta SQL para evitar inyecciones (tabla "team")
    $sql = "INSERT INTO team (team_name, id_league) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $team_name_uc, $id_league);
    
    if ($stmt->execute()) {
        
        // Cerramos la declaración preparada para la tabla "team"
        $stmt->close();

        // Extraemos el ID del último registro insertado en la tabla "team"
        $id_team = $conn->insert_id;

        // Preparamos la consulta SQL para evitar inyecciones (tabla "team-member")
        $sql = "INSERT INTO team_member (full_name, email, age, cologne, telephone_contact, state, additional, id_team) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisissi", $full_name_uc, $email, $age, $cologne, $phone, $state, $additional, $id_team);

        if ($stmt->execute()) {
            
            // Obtenemos el ID del último miembro registrado
            $id_team_member = $conn->insert_id;

            // Cerramos la declaración preparada para la tabla "team-member"
            $stmt->close();
        
            // Obtenemos la longitud de la tabla "estadistica_nueva" para obtener la posición por defecto
            $sql = "SELECT COUNT(*) AS posicion FROM estadistica_nueva";
            $result = $conn->query($sql);
            $row_count = $result->fetch_assoc();
            $posicion = $row_count['posicion'] + 1;

            // Preparamos la consulta SQL para evitar inyecciones
            $sql = "INSERT INTO estadistica_nueva (posicion, pj, g, e, p, gf, gc, dg, pts, id_team, id_league) VALUES (?, 0, 0, 0, 0, 0, 0, 0, 0, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $posicion, $id_team, $id_league);

            if ($stmt->execute()) {
                
                // Cerramos la declaración preparada
                $stmt->close(); 

                // Insertamos valores a la tabla "goal" en donde se estará enviando valores por defecto 
                $sql = "INSERT INTO goal (goal_number, id_team, id_team_member) VALUES (0, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $id_team, $id_team_member);

                if ($stmt->execute()) {

                    // Cerramos la declaración preparada
                    $stmt->close(); 

                    header("Location: ../html/administrator/team-admin.php?id_league=$id_league");
                    exit();
                }

            }

        }
    } else {
        echo "Error al insertar el nuevo equipo: " . $stmt->error;
    }

    // Cerramos la conexión
    $conn->close();
?>
