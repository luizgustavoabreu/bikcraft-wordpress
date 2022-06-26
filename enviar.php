<?php

// Mudar aqui o e-mail
$emailenvio = 'contato@bikcraft.great-site.net';
$assunto = 'Formulário Bikcraft';
$url = 'https://bikcraft.great-site.net';

// Variáveis do Formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];

// Conteúdo do Formulário
$body = "$mensagem\n\n---------------\n\n$nome\n$telefone\n$email";
// Não mudar a partir daqui

if ($_POST['leaveblank'] != '' or $_POST['dontchange'] != 'http://') {

  echo "Não foi possível enviar o e-mail. Tente novamente ou entre em contato com " . $emailenvio;
  echo "<meta HTTP-EQUIV='Refresh' CONTENT='10;URL=" . $url . "'>";
  
} else if (isset($_POST['email'])) {

  require('./PHPMailer/PHPMailerAutoload.php');

  $mail = new PHPMailer;
  $mail->CharSet = 'UTF-8';
  $mail->WordWrap = 70;
  $mail->addAddress($emailenvio);

  $mail->From = $email;
  $mail->FromName = $nome;
  $mail->AddReplyTo($email, $nome);
  $mail->Subject = $assunto;

  $mail->Body = $body;

  if (!$mail->send()) {
    echo "Não foi possível enviar o e-mail. Tente novamente ou entre em contato com " . $emailenvio;
    echo "<meta HTTP-EQUIV='Refresh' CONTENT='10;URL=" . $url . "'>";
  } else {
    echo "E-mail enviado com sucesso!";
    echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=" . $url . "'>";
  }
}

?>