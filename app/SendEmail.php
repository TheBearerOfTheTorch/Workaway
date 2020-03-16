<?php
    // Start with PHPMailer class
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once './vendor/autoload.php';

    //getting tis form any page using the mailer
    function testDetails($data)
    {
        $data = stripcslashes($data);
        $data = trim($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    $email = testDetails($email);

    // create a new object
    $mail = new PHPMailer();
    // configure an SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '1a2b3c4d5e6f7g';
    $mail->Password = '1a2b3c4d5e6f7g';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    $mail->setFrom('admin@workaway.com', 'workaway');
    $mail->addAddress($email, 'Me');
    $mail->Subject = 'Workaway email link';
    // Set HTML 
    $mail->isHTML(TRUE);
    $mail->Body = '<html>Hi there, we are happy to <br>confirm your registration.</br> Please check the document in the attachment.</html>';
    // add attachment
    $mail->addAttachment('//confirmations/yourbooking.pdf', 'yourbooking.pdf');
    // send the message
    if(!$mail->send())
    {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else 
    {
        echo 'Message has been sent';
    }