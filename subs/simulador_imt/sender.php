<?php
require '../../php_mailer/config.php';
require '../../php_mailer/src/PHPMailer.php';
require '../../php_mailer/src/SMTP.php';
require '../../php_mailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
    // Sanitize inputs
    $preco = htmlspecialchars($_POST['preco']);
    $imt = htmlspecialchars($_POST['imt']);
    $selo = htmlspecialchars($_POST['selo']);
    $total = htmlspecialchars($_POST['total']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo "<script>alert('Invalid email address');</script>";
        exit;
    }
    // Initialize PHPMailer
    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL;
        $mail->Password = PW;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Sender and recipient
        $mail->setFrom(EMAIL, 'CLIENTE');
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'IMT Information';
        $mail->Body = "<h3>Information Sent:</h3>
        <ul>
            <li><strong>Preço:</strong> $preco €</li>
            <li><strong>IMT:</strong> $imt </li>
            <li><strong>Selo:</strong> $selo </li>
            <li><strong>Total:</strong> $total </li>
        </ul>";

        $mail->send();
        echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 200);</script>";
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        echo "<script>alert('Message could not be sent. Please try again later.');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}
