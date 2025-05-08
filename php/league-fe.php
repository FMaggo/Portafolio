<?php
    require 'databases.php';

    // Seleccionamos todas las ligas disponibles
    $sql = "SELECT * FROM league WHERE type = 'Femenil'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <option value="" disabled selected> Selecciona una opción </option>
        <?php
        while ($row = $result->fetch_assoc()) {
            ?> 
            <option value="<?php echo $row['id_league']; ?>"> <?php echo $row['name']?></option>
            <?php
        }
    }
    else {
        ?>
            <option value=""> No se encontraron ligas disponibles </option>
        <?php 
    }

    // Cerramos la conexión
    $conn->close();
?>