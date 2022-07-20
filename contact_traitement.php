<?php
session_start();
include_once '_gestionBase.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'includes/phpmailer/Exception.php';
require_once 'includes/phpmailer/PHPMailer.php';
require_once 'includes/phpmailer/SMTP.php';

$utilisateur = afficherUtilisateur();

foreach($utilisateur as $infoUtilisateurs){
    $adrMelUtilisateur = $infoUtilisateurs['adrMel'];
    $raisonSocialeUtilisateur = $infoUtilisateurs['raisonSociale'];
}
    //$name = htmlspecialchars($_POST['name']);
    $to = $adrMelUtilisateur;
    $raisonSociale = $raisonSocialeUtilisateur;
    //$subject = htmlspecialchars($_POST['subject']);
    //$message = wordwrap($_POST['message'], 70, "\r\n");


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = '';                  //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'support@tholdi.sami-bahij.com';                 //SMTP username
    $mail->Password   = '';                      //SMTP password
    $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@tholdi.sami-bahij.com', 'Tholdi');
    $mail->addAddress($to);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('no-reply@tholdi.sami-bahij.com');
    $mail->addBCC('no-reply@tholdi.sami-bahij.com');

    $codeReservation = obtenirCodeReservation();
    //Attachments
    //$mail->addAttachment("/Users/samibahij/Downloads/devis\ Tholdi\ Commande\ " . $codeReservation . ".pdf");         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = " Commande en attente de confirmation";
    $mail->Body    = "Bonjour " . $raisonSociale  . ", <br> Merci d'avoir choisi la société Tholdi, <br>" .
            " Votre commande a bien été prise en compte et sera traitée dans les plus bref délais <br> " .
            " <br> Cordialement, <br> THOLDI";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

header('location: consultationReservation');








?>