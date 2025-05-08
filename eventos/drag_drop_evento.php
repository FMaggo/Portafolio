<?php
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

include('../php/databases.php');
                        
$idEvento         = $_POST['idEvento'];
$start            = $_REQUEST['start'];
$fecha_inicio     = date('Y-m-d', strtotime($start)); 
$end              = $_REQUEST['end']; 
$fecha_fin        = date('Y-m-d', strtotime($end));  


$UpdateProd = ("UPDATE reserva 
    SET 
        fecha_inicio ='$fecha_inicio',
        fecha_fin ='$fecha_fin'

    WHERE id='".$idEvento."' ");
$result = mysqli_query($conn, $UpdateProd);

?>