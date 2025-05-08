<?php
include("../../php/databases.php");

// Recibir los datos del formulario
$id_team = $_POST['id_team_'];
$pj = $_POST['pj_'];
$g = $_POST['g_'];
$e = $_POST['e_'];
$p = $_POST['p_'];
$gf = $_POST['gf_'];
$gc = $_POST['gc_'];
$dg = $_POST['dg_'];
$pts = $_POST['pts_'];

// Preparar la consulta con sentencia preparada
$cambiar = "UPDATE estadistica_nueva SET 
    pj = ?,
    g = ?, 
    e = ?, 
    p = ?, 
    gf = ?, 
    gc = ?, 
    dg = ?, 
    pts = ?
    WHERE id_team = ?";

// Preparar la sentencia
$stmt = mysqli_prepare($conexion, $cambiar);


$stmt->bind_param("iiiiiiiii", $pj, $g, $e, $p, $gf, $gc, $dg, $pts, $id_team);

// Ejecutar la consulta
$resultado = mysqli_stmt_execute($stmt);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
    echo "Los datos se actualizaron correctamente.";
} else {
    echo "Error al actualizar los datos: " . mysqli_stmt_error($stmt);
}

// Cerrar la sentencia y la conexión
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
