<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$email = new PHPMailer(true);

try {
    //Server settings
    //$email->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $email->isSMTP(); 
    $email->Host = "smtp.gmail.com";
    $email->Port = 587;
    $email->SMTPSesure= "tls";
    $email->SMTPAuth = true;
    $email->Username   = 'aromaricadjei2013@gmail.com';
    $email->Password  = "rzde frfb smeg odwv";

    //Recipients
    $email->setFrom('aromaricadjei2013@gmail.com', 'RomusDev');
    $email->addAddress($_POST['email']);     //Add a recipient

    //Attachments
    $email->addAttachment($filePath);         //Add attachments
    

    //Content
    $email->isHTML(true);                                  //Set email format to HTML
    $email->Subject = 'Confirmation de votre demande';
    $email->Body    = 'Bonjour, votre demande a bien été prise en compte. Vous trouverez en pièce jointe un récap. Merci!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $email->send();
    echo 'Message envoyeé avec succès';

} catch (Exception $e) {
    echo "Le message n'a pu être envoyé. Mailer Error: {$email->ErrorInfo}";
}