<?php
require_once('../php/databases.php');
$id= $_REQUEST['id']; 

$sqlDeleteEvento = ("DELETE FROM reserva WHERE  id='" .$id. "'");
$resultProd = mysqli_query($conn, $sqlDeleteEvento);

?>
  