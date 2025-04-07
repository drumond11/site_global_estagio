<?php
include_once("../../site_metasearch/config.php");
class Captcha{

    public function verificar(){
		$recaptchaResponse = $_POST['g-recaptcha-response'];
		$secret = CAPTCHA_PRIVATE_KEY;
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array('secret' => $secret, 'response' => $recaptchaResponse);
		/*
		Bib. interna do PHP -> estabelece uma ligação direta a um servidor
		php.ini exntesion:curl
		*/
		$curl = curl_init(); // criar o recurso
		curl_setopt($curl, CURLOPT_URL, $url); // caminho do server
		curl_setopt($curl, CURLOPT_POST, TRUE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		// realizar ligação
		$response = curl_exec($curl);
		curl_close($curl);
		$responseStatus = json_decode($response, TRUE);
		if($responseStatus['success']){
            return true;
        }
        return false;
	}
}
?>