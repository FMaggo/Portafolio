<?php
date_default_timezone_set("America/Mexico");
setlocale(LC_ALL,"es_ES");

require "../php/databases.php";
require '../phpmailer/Exception.php';
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$evento            = ucwords($_POST['evento']);
$nombre            = ucwords($_POST['nombre']);
$correo            = $_POST['correo'];
$f_inicio          = $_POST['fecha_inicio'];
$fecha_inicio      = date('Y-m-d', strtotime($f_inicio)); 

$f_fin             = $_POST['fecha_fin']; 
$seteando_f_final  = date('Y-m-d', strtotime($f_fin));  
$fecha_fin1        = strtotime($seteando_f_final."+ 1 days");
$fecha_fin         = date('Y-m-d', ($fecha_fin1));  

$InsertSolicitud = "INSERT INTO solicitud(
      evento,
      nombre,
      correo,
      fecha_inicio,
      fecha_fin
      )
    VALUES (
      '" .$evento. "',
      '" .$nombre. "',
      '" .$correo. "',
      '". $fecha_inicio."',
      '" .$fecha_fin. "'
  )";
$resultadoSolicitud = mysqli_query($conn, $InsertSolicitud);

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'rodolfoperezrodriguez848@gmail.com';                     
    $mail->Password   = 'zuvk wewm iktj yjwt';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    $mail->setFrom($mail->Username, 'Madriguera FC');
    $mail->addAddress($correo);     
    $mail->addReplyTo($mail->Username, $nombre);

    $mail->isHTML(true);    
    $mail->CharSet = 'UTF-8';                              
    $mail->Subject = 'Solicitud para Agregar Evento'; 
    $mail->Body = "
        <html>
        <head>
            <style>
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    margin: 20px 0;
                    font-size: 16px;
                    color: #ffffff;
                    background-color: #28a745;
                    text-align: center;
                    text-decoration: none;
                    border-radius: 5px;
                }
            </style>
        </head>
        <body>
            <p> Hola, mi nombre es {$nombre} y deseo reservar el espacio de la cancha para el siguiente evento: {$evento}. </p>
            <p> La fecha de inicio es: {$fecha_inicio} y el evento terminaría el: {$fecha_fin}</p>
            <p> Muchas gracias. </p>
        </body>
        </html>";
    
    $mail->AltBody = 'Reserva de cancha';
    $mail->send();
    echo 'Mensaje enviado con éxito';
    header("Location: calendariouser.php?e=1");
    exit();
} 
catch (Exception $e) {
    echo "No se ha podido enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
}
?>
