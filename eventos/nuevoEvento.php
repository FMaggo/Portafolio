<?php
date_default_timezone_set("America/Mexico");
setlocale(LC_ALL, "es_ES");

require("../php/databases.php");

$evento = ucwords($_REQUEST['evento']);
$fecha_inicio = $_REQUEST['fecha_inicio'];
$fecha_fin = $_REQUEST['fecha_fin'];
$color_evento = $_REQUEST['color_evento'];

// Verificar si hay eventos superpuestos
$checkOverlap = "SELECT * FROM reserva WHERE (fecha_inicio < '$fecha_fin') AND (fecha_fin > '$fecha_inicio')";
$resultOverlap = mysqli_query($conn, $checkOverlap);

if (mysqli_num_rows($resultOverlap) > 0) {
    // Hay superposición
    header("Location: index.php?e=2"); // Puedes cambiar este valor para mostrar un mensaje de error específico
    exit();
} else {
    // No hay superposición, insertar nuevo evento
    $InsertNuevoEvento = "INSERT INTO reserva (
        evento, fecha_inicio, fecha_fin, color_evento
    ) VALUES (
        '$evento', '$fecha_inicio', '$fecha_fin', '$color_evento'
    )";

    $resultadoNuevoEvento = mysqli_query($conn, $InsertNuevoEvento);

    header("Location: index.php?e=1");
    exit();
}
?>
