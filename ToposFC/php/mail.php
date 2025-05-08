<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    require 'databases.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../phpmailer/Exception.php';
    require '../phpmailer/PHPMailer.php';
    require '../phpmailer/SMTP.php';

    // Obtenemos el correo electrónico correspondiente

    if (isset($_GET['id_team'])) {
        $id_team = $_GET['id_team'];
        $email = $_POST['email'];

        $sql = "SELECT full_name FROM team_member WHERE id_team = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_team);
        if ($stmt->execute()) {

            // Obtenemos el nombre del capitán
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Cerramos la consulta preparada
            $stmt->close();
        }

        // Obtener el nombre del capitán del equipo para el saludo 
        $full_name = $row['full_name'];

        // Obtener el nombre del equipo 
        $sql = "SELECT team_name FROM team WHERE id_team = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_team);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Cerramos la consulta preparada 
            $stmt->close();
        }

        $team_name = $row['team_name'];
    }

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'rodolfoperezrodriguez848@gmail.com';                     //SMTP - Debería usarse un correo de la organización
        $mail->Password   = 'zuvk wewm iktj yjwt';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($mail->Username, 'Madriguera FC');
        $mail->addAddress($email);     //2do parámetro que determina a que nombre va dirigido
        $mail->addReplyTo($mail->Username, $full_name);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments Enviar archivos adjuntos
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);    
        $mail->CharSet = 'UTF-8';                              //Set email format to HTML
        $mail->Subject = 'Invitación a equipo'; // Asunto del correo

        // El mensaje que entregará en HTML
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
                <p> Hola, mi nombre es {$full_name} y quiero invitarte a que seas parte de mi equipo de futbol: {$team_name} 😎⚽. </p>
                <p> Solo necesitas dar click en el siguiente botón: </p>
                <a href='http://10.50.70.236/TC2005B_601_07/Proyecto-Topos/html/user/member-register-user2.php?id_team={$id_team}' class='button'> Unirse al equipo </a>
                <p> Si no obtengo respuestas de tu parte en los próximos días invitaré a otras personas. </p>
            </body>
            </html>";
        
        // Vista previa de nuestro correo electrónico
        $mail->AltBody = 'Invitación de inscripción a equipo';

        //Enviar el correo electrónico 
        $mail->send();
        header("Location: ../html/user/team-member-user.php?id_team=$id_team");
        exit();
    } 
    catch (Exception $e) {
        echo "No se ha podido enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
    } 