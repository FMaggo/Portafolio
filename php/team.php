<?php
    require 'databases.php';

    // Seleccionamos los equipos según la liga seleccionada
    if (isset($_POST['league_name'])) {
        $id_league = $_POST['league_name'];

        // P
        $sql = "SELECT * FROM team WHERE id_league = $id_league";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_league);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // Cerramos la conexión de la declaración preparada 
            $stmt->close();
            ?>
                <option value="" disabled selected> Selecciona una opción </option>
            <?php

            if ($result->num_rows > 0) {
                ?>
                    <option value="<?php echo $row['id_team']; ?>"> <?php echo $row['team_name']; ?></option>
                <?php
            }
            else {
                ?>
                    <option value=""> No se encontraron equipos disponibles </option>
                <?php
            }
        }
    }
?>