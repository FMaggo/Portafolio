<?php
    require 'databases.php';

    // Seleccionamos todas las ligas disponibles
    if (isset($_GET['id_team'])) {

        //Obtenemos la liga para elegir los equipos correspondientes
        $id_team = $_GET['id_team'];

        $sql = "SELECT * FROM team_member WHERE id_team = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_team);

        if ($stmt->execute()) {

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                ?>
                <option value="" disabled selected> Selecciona un jugador </option>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_team_member']; ?>"> <?php echo $row['full_name']; ?> </option>
                    <?php
                }
            }

            else {
                ?>
                    <option value=""> Sin resultados </option>
                <?php
            }
        }
    }

    // Cerramos la conexión
    $conn->close();
?>