<?php
    require 'databases.php';

    // Seleccionamos todas las ligas disponibles
    if (isset($_GET['id_league'])) {

        //Obtenemos la liga para elegir los equipos correspondientes
        $id_league = $_GET['id_league'];

        $sql = "SELECT * FROM team WHERE id_league = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_league);

        if ($stmt->execute()) {

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                ?>
                <option value="" disabled selected> Selecciona un equipo </option>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_team']; ?>"> <?php echo $row['team_name']; ?> </option>
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