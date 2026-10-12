<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

$name            = trim($_POST['name'] ?? '');
$email           = trim($_POST['email'] ?? '');
$subject         = trim($_POST['subject'] ?? '');
$contact_message = trim($_POST['message'] ?? '');

// Basic validation
if ($name === '' || $email === '' || $subject === '' || $contact_message === '') {
    echo "All fields are required.";
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address.";
    exit;
}

$mail = new PHPMailer(true);

try {
    // SMTP settings (same as mail.php)
    $mail->isSMTP();
    $mail->Host       = 'mail.parisfasttransfer.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'noreply@parisfasttransfer.com';
    $mail->Password   = 'It7WW!g6#mvr';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    $mail->setFrom('noreply@parisfasttransfer.com', 'Paris Fast Transfer');
    $mail->addAddress('noreply@parisfasttransfer.com', 'Paris Fast Transfer');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = 'Contact Form: ' . $subject;
    $mail->Body    = "
        <p><b>Name:</b> " . htmlspecialchars($name) . "</p>
        <p><b>Email:</b> " . htmlspecialchars($email) . "</p>
        <p><b>Subject:</b> " . htmlspecialchars($subject) . "</p>
        <p><b>Message:</b><br>" . nl2br(htmlspecialchars($contact_message)) . "</p>
    ";

    $mail->send();
    echo "Your message has been sent successfully!";

} catch (Exception $e) {
    error_log("Contact form mail error: " . $mail->ErrorInfo);
    echo "Your message could not be sent. Please try again later.";
}
?>
