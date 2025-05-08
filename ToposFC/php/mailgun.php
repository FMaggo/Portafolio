<?php

require 'databases.php';
require '../phpmailer/Exception.php';
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Captura los datos del formulario
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subjec = $_POST['subjec'];
$question = $_POST['question'];

// Inserta el registro en la base de datos
$InsertContact = "INSERT INTO contact (full_name, email, phone, subjec, question) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($InsertContact);
$stmt->bind_param("sssss", $full_name, $email, $phone, $subjec, $question);
$stmt->execute();

// Obtén el ID del nuevo registro insertado
$id_contact = $stmt->insert_id;

// Cierra la consulta preparada
$stmt->close();

// Selecciona el registro recién insertado usando el ID
$sql = "SELECT full_name, phone, subjec, question FROM contact WHERE id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_contact);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// Asigna los datos del registro a variables
$full_name = $row['full_name'];
$phone = $row['phone'];
$subjec = $row['subjec'];
$question = $row['question'];

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 0;                   
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'rodolfoperezrodriguez848@gmail.com';  //SMTP - Debería usarse un correo personal con otro método
    $mail->Password   = 'zuvk wewm iktj yjwt';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    $mail->setFrom($mail->Username, 'Madriguera FC');
    $mail->addAddress('rodolfoperezrodriguez848@gmail.com');  //Colocar correo de la empresa   
    $mail->addReplyTo($mail->Username, $full_name);

    $mail->isHTML(true);    
    $mail->CharSet = 'UTF-8';                              
    $mail->Subject = $subjec; 
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
            <p> Nombre: {$full_name} </p>
            <p> Phone: {$phone} </p>
            <p> Message: {$question}</p>
        </body>
        </html>";
    
    $mail->AltBody = 'Comunicación con usuario';
    $mail->send();
    echo 'Mensaje enviado con éxito';
    header("Location: ../html/user/contact.php");
    exit();
} 
catch (Exception $e) {
    echo "No se ha podido enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
} 
?>
