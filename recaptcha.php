<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptchaSecret = '6LfBbA4qAAAAAITk24vEtReYX5j29zJFuCVgGoqc'; //chave secreta do site, substituir pela do site
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);
}
?>
