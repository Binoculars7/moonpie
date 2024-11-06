<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST['submitContact']))
{
    $fullname = $_POST['full_name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username   = 'elitechain.com@gmail.com';                     //SMTP username
        $mail->Password   = 'gnrnrwdiodsesywt';                               //SMTP password

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //ENCRYPTION_SMTPS 465 - Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('elitechain.com@gmail.com', 'Elify CMS');
        $mail->addAddress('elitechain.com@gmail.com', 'CMS');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Elify CMS - Church Bookkeeper';

        $bodyContent = '<div>Hello, you got a new message</div>
            <div>Fullname: '.$fullname.'</div>
            <div>Email: '.$email.'</div>
            <div>Subject: '.$subject.'</div>
            <div>Message: '.$message.'</div>
        ';

        $mail->Body = $bodyContent; 
        
        if($mail->send())
        {
            $_SESSION['status'] = "Thank you for contacting us - Elify CMS";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
        
       
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else
{
    header('Location: index.php');
    exit(0);
}

?>