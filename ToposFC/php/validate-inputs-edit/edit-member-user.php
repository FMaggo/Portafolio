<?php
    require '../databases.php';

    // Obtenemos el id del equipo para verificar a que equipo pertenece
    $id_team = $_POST['id_team'];

    $editMember = $_POST['editMember'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $cologne = $_POST['cologne'];
    $phone = $_POST['phone'];
    $state = $_POST['state']; 

    // Preparamos la consulta SQL para evitar inyecciones
    $sql = "UPDATE team_member SET full_name = ?, email = ?, age = ?, cologne = ?, telephone_contact = ?, state = ? WHERE id_team_member = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisisi", $full_name, $email, $age, $cologne, $phone, $state, $editMember);
    
    if ($stmt->execute()) {
        // Cerramos la consulta preparada
        $stmt->close();

        header("Location: ../../html/user/team-member-user.php?id_team=$id_team");
    } 
?>