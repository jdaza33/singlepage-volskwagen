<?php

    //require ('/PHPMailer/Autoload.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    $data = json_decode(file_get_contents("php://input"), true);
    $name=$data['name'];
    $phone=$data['phone'];
    $car=$data['car'];
    $email=$data['email'];
  

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    //$mail->isSMTP();

    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    //$mail->isSMTP();
    //$mail->Host = 'localhost';
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "jvectronic@gmail.com";

    //Password to use for SMTP authentication
    $mail->Password = "49166752";

    //Whether mail body contains HTML,false is plain text
    $mail->IsHTML(true);

    //Set who the message is to be sent from
    $mail->setFrom('tucerokmencuotas@hotmail.com', 'AutoAhorro - Volkswagen');

    //Set who the message is to be sent to
    /*$mail_receiver = 'blackencio33@gmail.com';

    //email Address of reciever,
    //here php variable has been used which stores and
    //provides email-id entered through form
    $mail->addAddress($mail_receiver, "");*/
    //$mail->AddAddress('jvicente_33@hotmail.com');
    $mail->AddAddress('tucerokmencuotas@hotmail.com');

    //Set the subject line
    $mail->Subject = "Nuevo Interesado | AutoAhorro - Volkswagen";
    
    $mail->Body = "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>Plantilla</title>
        </head>
        <body>
            <h1>Nuevo cliente interesado</h1>
            <h2>Nombre: ".$name."</h2>
            <h2>Telefono: ".$phone."</h2>
            <h2>Carro de Interes: ".$car."</h2>
            <h2>Email: ".$email."</h2>
        </body>
        </html>";
        
    $r['result']=false;

    //send the message, check for errors
    if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
    echo $email;
    } else {
    $r['result']=true;
    }

    echo json_encode($r);

 ?>