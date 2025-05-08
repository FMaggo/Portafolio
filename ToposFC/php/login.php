<?php
    require 'databases.php';
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparamos la consulta SQL para evitar inyecciones
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $username);

    if ($stmt->execute()) {

        // Obtenemos el resultado de la consulta ejecutada
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $datauser = $result->fetch_assoc();
    
            if ($password === $datauser['password']) {
                $_SESSION["username"] = $username;  
                $_SESSION["logged"] = true;
                header("Location: ../html/administrator/admin.php");
                exit;
            }
            else {
                echo "Usuario o contraseña incorrecta";
                $_SESSION["logged"] = false;
                exit;
            }
        }
        else {
            echo "Error total";
        }

        // Cerramos la declaración preparada 
        $stmt->close();
    }

    $conn->close();
?>