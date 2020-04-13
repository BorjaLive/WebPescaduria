<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$MAIL_sender="XXXX";
$MAIL_pass="XXXX";
$MAIL_name="XXXX";
$MAIL_replyMail="XXXX";
$MAIL_replyName="XXXX";

Function enviarCorreo($destinoMail,$destinoNombre,$asunto,$cuerpo,$cuerpoAlternativo,$adjunto){
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Host = 'smtp.gmail.com';
	// $mail->Host = gethostbyname('smtp.gmail.com');
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	
	global $MAIL_sender,$MAIL_pass,$MAIL_name,$MAIL_replyMail,$MAIL_replyName;
	$mail->Username = $MAIL_sender;
	$mail->Password = $MAIL_pass;
	$mail->setFrom($MAIL_sender, $MAIL_name);
	$mail->addReplyTo($MAIL_replyMail, $MAIL_replyName);
	
	$mail->addAddress($destinoMail, $destinoNombre);
	$mail->Subject = $asunto;
	$mail->msgHTML($cuerpo);
	$mail->AltBody = $cuerpoAlternativo;
	$mail->addAttachment($adjunto);
	
	return $mail->send();
}
?>
