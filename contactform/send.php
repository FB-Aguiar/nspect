<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '..//vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'br972.hostgator.com.br';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'noreply@inspeect.com';                     //SMTP username
    $mail->Password   = 'noreply1804*';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('noreply@inspeect.com', 'Inspect Consultoria');
    $mail->addAddress('rodolfo.silva.belo@gmail.com');     //Add a recipient
    // $mail->addReplyTo('fabriciotcn@gmail.com');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Novo Contato - Site Inspect';
    $mail->Body    = 
      "<h2>" . $_POST['name'] . "</h2>" . "</br>" . 
      "<h4>" . $_POST['message'] . "</h4>" . "</br>" . 
      "Email: " . $_POST['email']
      ;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
