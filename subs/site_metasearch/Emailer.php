<?php
require '../../php_mailer/src/PHPMailer.php';
require '../../php_mailer/src/SMTP.php';
require '../../php_mailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Emailer {
    private $mail;

	function __construct(){

        //$this->load->library('form_validation');
		$this->mail = new PHPMailer(true);

	}

    public function send($subj,$msg){

        //$this->instance($this->input->post('email'),$this->input->post('assunto'),$this->input->post('msg'));
        $this->instance($subj,$msg);//depois coloco na mesma função
    }
    private function instance($subj,$msg){
        try{
            //for($i=0;$i<30;$i++){
            $this->mail->SMTPDebug = 0;
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPAuth = true;
            $this->mail->Username = EMAIL;
            $this->mail->Password = PW;
            $this->mail->SMTPAutoTLS = false;
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port = 587;
            //server não controlar certificad
            $this->mail->smtpConnect(
                array(
                    "ssl"=>array(
                        "verify_peer"=>false,
                        "verify_peer_name"=>false,
                        "allow_self_signed"=>true
                    )
                )
            );
            //remetente
            $this->mail->setFrom(EMAIL,NAME);
            //destinatario
            $this->mail->addAddress(EMAIL);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subj;//." ".$i;
            $this->mail->Body = $msg;
            $this->mail->AltBody = "Para ver esta mensagem, por favor utilize um visualizador de e-mail compatível com HTML!";
            $this->mail->send();
        //}
        }catch(Exception $e){

            echo "erro, email não enviado".$this->mail->ErrorInfo;
        }
    }
}

?>