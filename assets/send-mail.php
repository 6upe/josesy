<?php
// Retrieve form data
$name = $_POST["name"];
$email = $_POST["email"];
$subject = 'Message From Website: ' . $_POST["subject"];
$message = $_POST["message"];

// Include PHPMailer library
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

try {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP();                                         // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                          // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                  // Enable SMTP authentication
    $mail->Username = 'josesyltd@gmail.com';            // SMTP username
    $mail->Password = 'slka qdrc wjyd sain';                 // SMTP password (App-specific password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                       // TCP port to connect to

    // Recipients
    $mail->setFrom('info@josesyltd.com', $name);       // Sender email and name
    $mail->addAddress('info@josesyltd.com', $name);                        // Add a recipient

    // Content
    $mail->isHTML(true);                                     // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);                   // Plain text version for non-HTML mail clients

    // Send the email
    if ($mail->send()) {
        echo 'Your message has been received. Thank you!, We shall respond shortly';
    } else {
        echo 'Ooops!🤔 Something went wrong!';
    }
} catch (Exception $e) {
    echo "Ooops!🤔 Something went wrong!";
}

