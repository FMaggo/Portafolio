<?php 
    require 'databases.php';

    # Agregar una fila
    $id_team = $_POST['id_team'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $cologne = $_POST['cologne'];
    $phone = $_POST['phone'];
    $state = "Inactivo";
    $additional = $_POST['additional'];

    // Preparamos la consulta SQL para evitar inyecciones
    $sql = "INSERT INTO team_member (full_name, email, age, cologne, telephone_contact, state, additional, id_team) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisissi", $full_name, $email, $age, $cologne, $phone, $state, $additional, $id_team);

    if($stmt->execute()) {
        
        //Cerramos la consulta preparada
        $stmt->close();
        
        $id_team_member = $conn->insert_id;

        // Insertamos valores a la tabla "goal" en donde se estará enviando valores por defecto 
        $sql = "INSERT INTO goal (goal_number, id_team, id_team_member) VALUES (0, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_team, $id_team_member);

        if ($stmt->execute()) {

            // Cerramos la declaración preparada
            $stmt->close();

            header("Location: ../html/user/team-member-user.php?id_team=$id_team");
            exit();
        }
    }
    else {
        echo "Error al registrar nuevo miembro: " . $stmt->error;
    }
    
    // Cerramos la conexión
    $conn->close();
?>

    