<?php
require('PHPMailer.php');
require('SMTP.php');
require('Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



function mailsend($email, $body, $subject, $name, $filenames = NULL)
{
	$mail = new PHPMailer();

	$mail->IsSMTP();                                      	// set mailer to use SMTP
	$mail->CharSet = 'UTF-8';
	$mail->Host = "smtp.hostinger.in";  					// specify main and backup server
	$mail->SMTPAuth = true;    	 							// turn on SMTP authentication
	$mail->Username = "no-reply@svlautomations.in";  		// SMTP username
	$mail->Password = "password";							// SMTP password
	$mail->SMTPSecure = 'ssl';                              //Enable implicit TLS encryption
	$mail->Port       = 465;
	$mail->From = "no-reply@svlautomations.in";
	$mail->FromName = "SVL Automations";
	$mail->addReplyTo($email);
	$mail->addAddress('info@svlautomations.in');    

	$mail->WordWrap = 50;                                 // set word wrap to 50 character
	$mail->IsHTML(true);                                  // set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = "Mail from " . $name . '<br>Email : ' . $email . ' <br>Message <br>' . $body;
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";


	if (!$mail->Send()) {
		echo $mail->ErrorInfo;
		return "Fail";
	} else {
		$mail->addAddress( $email); 
		$mail->Subject = "Thank you for interest";
		$mail->Body    = "Dear " . $name . ',<br> Thank you for your interest. Our team will contact soon. <br> Regards,<br> SVL Automations';
		$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
		$mail->Send();
		return "Success";
	}
}
