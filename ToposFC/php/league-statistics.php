<?php
require 'databases.php';

// Seleccionamos todas las ligas disponibles
$sql = "SELECT * FROM league";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Inicializamos una variable para marcar la primera iteración
    $first = true;
    while ($row = $result->fetch_assoc()) {
        if ($first) {
            // Marcamos la primera opción como seleccionada
            echo '<option value="' . $row['id_league'] . '" selected>' . $row['name'] . '</option>';
            // Cambiamos la variable para que solo la primera iteración sea seleccionada
            $first = false;
        } else {
            echo '<option value="' . $row['id_league'] . '">' . $row['name'] . '</option>';
        }
    }
} else {
    echo '<option value="">No se encontraron ligas disponibles</option>';
}

// Cerramos la conexión
$conn->close();
?>
