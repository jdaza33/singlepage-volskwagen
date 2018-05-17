<?php

    //require ('/PHPMailer/Autoload.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    
    
    /*$fecha_envio=$_GET['$fecha_envio'];
    $cedula=$_GET['$cedula'];
    $nombres=$_GET['$nombres'];
    $cantidad=$_GET['cant'];*/
    
    /*$temp=$_GET['dato'];
    $email=$_GET['email'];*/
    
    $nombres=$_POST['nombres'];
    $cedula=$_POST['cedula'];
    $email=$_POST['email'];
    $cantidad=$_POST['cantidad'];
    //$cantidad=2;
    date_default_timezone_set($zonaHoraria);
    $fecha = new DateTime();
    $fechaa = $fecha->format('Y-m-d');
    $fecha_envio=$fechaa;
    //$destino=$_POST['destino'];

    



    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    //$mail->isSMTP();

    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = 'mail.gutmedica.co';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 465;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "tuexamen@gutmedica.co";

    //Password to use for SMTP authentication
    $mail->Password = "PK900old.ZaX";

    //Whether mail body contains HTML,false is plain text
    $mail->IsHTML(true);

    //Set who the message is to be sent from
    $mail->setFrom('tuexamen@gutmedica.co', 'Gut-Medica');

    //Set who the message is to be sent to
    /*$mail_receiver = 'blackencio33@gmail.com';

    //email Address of reciever,
    //here php variable has been used which stores and
    //provides email-id entered through form
    $mail->addAddress($mail_receiver, "");*/
    $mail->AddAddress($email);

    //Set the subject line
    $mail->Subject = "Gut-Medica - Examenes";
    
    function imprimir($fecha_envio, $cedula, $nombres, $cantidad){
        include ("conexion.php");
        $conexion = new mysqli($host, $user, $pw, $db);
    
        if ($conexion->connect_error) {
        die("La conexion fallo: " . $conexion->connect_error);
        }
        echo $cantidad;
        $sql = "SELECT * FROM log_envios GROUP BY id DESC";
        $result = $conexion->query($sql);
        
        $temp="";
        $c=$cantidad;
            
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            if($c>0){
                
                $aux = "    <tr>
                            <td>".$fecha_envio."</td>
                            <td>".$cedula."</td>
                            <td>".$nombres."</td>
                            <td>".$row['tipo_examen']."</td>
                            <td><a href='http://www.gestionmotilidad.gutmedica.co/archivos/".$row['ruta_archivo']."' download='Examen'><img src='https://image.ibb.co/fgUGV6/pdf_1.png' alt=''></a></td>
                            </tr>";
                $temp .= $aux;
                
            }
        
            $c--;
        }
        
        return $temp;
      }
    
    $mail->Body = "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>Plantilla</title>
            <style>
                @import url('https://fonts.googleapis.com/css?family=Amarante');

                html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
                margin: 0;
                padding: 0;
                border: 0;
                font-size: 100%;
                font: inherit;
                vertical-align: baseline;
                outline: none;
                -webkit-font-smoothing: antialiased;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                }
                html { overflow-y: scroll; }
                body { 
                background: #eee url('https://i.imgur.com/eeQeRmk.png'); /* https://subtlepatterns.com/weave/ */
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 66.5%;
                line-height: 1;
                color: #585858;
                padding: 22px 10px;
                padding-bottom: 55px;
                }

                ::selection { background: #5f74a0; color: #fff; }
                ::-moz-selection { background: #5f74a0; color: #fff; }
                ::-webkit-selection { background: #5f74a0; color: #fff; }

                br { display: block; line-height: 1.6em; } 

                article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }
                ol, ul { list-style: none; }

                input, textarea { 
                -webkit-font-smoothing: antialiased;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                outline: none; 
                }

                blockquote, q { quotes: none; }
                blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
                strong, b { font-weight: bold; } 

                table { border-collapse: collapse; border-spacing: 0; }
                img { border: 0; max-width: 100%; }

                h1 { 
                font-family: 'Amarante', Tahoma, sans-serif;
                font-weight: bold;
                font-size: 3.6em;
                line-height: 1.7em;
                margin-bottom: 10px;
                text-align: center;
                }


                /** page structure **/
                #wrapper {
                display: block;
                width: 90em;
                background: #fff;
                margin: 0 auto;
                padding: 5em 2em;
                -webkit-box-shadow: 2px 2px 3px -1px rgba(0,0,0,0.35);
                overflow-x:auto;
                }

                #keywords {
                margin: 0 auto;
                font-size: 1.2em;
                margin-bottom: 15px;
                }


                #keywords thead {
                cursor: pointer;
                background: #c9dff0;
                }
                #keywords thead tr th { 
                font-weight: bold;
                padding: 12px 30px;
                padding-left: 42px;
                }
                #keywords thead tr th span { 
                padding-right: 20px;
                background-repeat: no-repeat;
                background-position: 100% 100%;
                }

                #keywords thead tr th.headerSortUp, #keywords thead tr th.headerSortDown {
                background: #acc8dd;
                }

                #keywords thead tr th.headerSortUp span {
                background-image: url('https://i.imgur.com/SP99ZPJ.png');
                }
                #keywords thead tr th.headerSortDown span {
                background-image: url('https://i.imgur.com/RkA9MBo.png');
                }


                #keywords tbody tr { 
                color: #555;
                }
                #keywords tbody tr td {
                text-align: center;
                padding: 15px 10px;
                }
                #keywords tbody tr td.lalign {
                text-align: left;
                }



                /*----------------------*/

                #logo{
                    width: 30%;
                }


                /*** Table Styles **/

            hr{
                width: 80%;
                border: 1px solid rgb(133, 133, 133);
                margin-top: 1.5em;
                margin-bottom: 1.5em;
            }
            h3{
                text-align: left;
                font-size: 2em;
                padding-left: 2em;
                padding-right: 2em;
                padding-top: 0.5em;
                padding-bottom: 0.5em;
            }
            h4{
                text-align: left;
                
                padding-left: 4em;
                padding-right: 4em;
                padding-top: 0.5em;
                padding-bottom: 0.5em;
            }


            </style>
        </head>
        <body>


            <div id='wrapper' >
                <h1><img src='https://image.ibb.co/gyybV6/logo.png' alt='' id='logo'></h1>
                
                <h3>Apreciado ".$nombres."</h3>
                
                <h3>Pensando en su comodidad, ahora usted pordrá consultar y/o descargar el resultado de su procedimiento en el archivo adjunto.</h3>
                <h4>En Gut-Medica \"Primero el Paciente\"</h4>
                <hr>
                
                <table id='keywords' cellspacing='0' cellpadding='0'>
                    <thead>
                    <tr>
                        <th><img src='https://image.ibb.co/h7xWxm/calendario.png' alt=''> Fecha</th>
                        <th><img src='https://image.ibb.co/mHeTcm/carnet_de_identidad.png' alt=''> Cedula</th>
                        <th><img src='https://image.ibb.co/nNLn3R/usuarios.png' alt=''> Nombres</th>
                        <th><img src='https://image.ibb.co/m5dkq6/prueba.png' alt=''> Examen</th>
                        <th><img src='https://image.ibb.co/iEdUHm/la_computacion_en_nube.png' alt=''> Descargar</th>
                    </tr>
                    </thead>
                    <tbody>".
                  
                  imprimir($fecha_envio, $cedula, $nombres, $cantidad)
                        
                ."</tbody>
                </table>

                <hr>
                <h4>© Copyright 2017 - <strong>GUT-MEDICA - Colombia</strong> | 
                    El uso de esta herramienta está sujeto bajo los lineamientos de la ley 1581 protección de datos, el acceso 
                    a esta información solo tiene fines de consulta y se ampara bajo los lineamientos de ética y respeto a la privacidad de 
                    los datos personales de los usuarios. Por esta razón CENTRO DE ENFERMEDADES DIGESTIVAS estipula los 
                    términos y condiciones de uso de la información aquí contenida. <a href='terminos.gutmedica.co'>Términos y condiciones</a>
                    Para asegurar la entrega de nuestros e-mail en su correo, por favor agregue 
                    <strong>turesultado@gutmedica.co</strong> a su libreta de contactos.
                </h4>
            </div> 

        </body>
        </html>";
        


    //send the message, check for errors
    if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
    echo '<script type="text/javascript">alert("Message has been sent");</script>';
    }

 ?>