<?php
require '../../php_mailer/config.php';
require '../../php_mailer/src/PHPMailer.php';
require '../../php_mailer/src/SMTP.php';
require '../../php_mailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Set headers for AJAX response
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $terreno = htmlspecialchars($_POST['terreno']);
    $bruto = htmlspecialchars($_POST['bruto']);
    $vTerreno = htmlspecialchars($_POST['vTerreno']);
    $vBruto = htmlspecialchars($_POST['vBruto']);
    $vtotal = htmlspecialchars($_POST['vTotal']);
    $nome = htmlspecialchars($_POST['nome']);
    $morada = htmlspecialchars($_POST['morada']);
    $tele = htmlspecialchars($_POST['tele']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
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
        $mail->setFrom(EMAIL, 'D31');
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Simulador';
        $mail->Body = "<h4>Info Cliente</h4>
        <ul>
            <li>Nome: $nome</li>
            <li>Morada: $morada</li>
            <li>Telemovel: $tele</li>
            <li>Email: $email</li>
        </ul>
        <h4>Info Simulacao</h4>
        <ul>
            <li>Area do terreno: $terreno m<sup>2</sup></li>
            <li>Area do terreno bruto: $bruto m<sup>2</sup></li>
            <li>Valor do Terreno: $vTerreno</li>
            <li>Valor Bruto do Terreno: $vBruto</li>
            <li>Total: $vtotal</li>
        </ul>";

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Email sent successfully']);
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        echo json_encode(['success' => false, 'message' => 'Message could not be sent. Please try again later.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>