<?php
//Importa classes PHPMailer para o namespace global 
//Elas devem estar no topo do seu script, não dentro de uma função 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = '#####################';                     //Configura o servidor SMTP para enviar através de 
    $mail->Port = 587; 
    $mail->SMTPAuth = true;                                   //Ativar autenticação SMTP 
    $mail->Username = '####################';                     //Nome de usuário SMTP 
    $mail->Password = '##########################';
    $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
    ####$mail->SMTPDebug = 2;
    $mail->setFrom('####################', "Sistema FNCC");
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    
    ?>