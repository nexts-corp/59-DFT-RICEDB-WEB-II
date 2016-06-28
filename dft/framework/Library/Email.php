<?php
require './framework/ThirdParty/PHPMailer-master/PHPMailerAutoload.php';

function send_mail_buy($Subject,$FromName,$addBCC,$registerName,$registerEmail,$message)
	{
							$mail = new PHPMailer();
							$mail->IsSMTP();
							$mail->CharSet="UTF-8";

							$mail->SMTPAuth   = true;
							$mail->SMTPSecure = "ssl";
							$mail->Host       = "smtp.gmail.com";
							$mail->Port       = 465;
							$mail->Username   = "changeza.alert@gmail.com";
							$mail->Password   = "Tomyumkung2557";
							
							$mail->From = "changeza.alert@gmail.com"; // "name@yourdomain.com";
							$mail->FromName = ($FromName);
							$mail->AddReplyTo = "changeza.alert@gmail.com"; // Reply
							$mail->addBCC = ($addBCC);
							$mail->set('X-Priority', '1');

							$mail->isHTML(true);
							
							$mail->Subject = ($Subject);
							
							$mail->Body=($message);

							$mail->AddAddress($registerEmail,$registerName); // to Address

							$mail->Send();

							if(!$mail->Send()) {
							echo "Mailer Error: " . $mail->ErrorInfo;
							} else {
							 echo "Message sent!";
							}
	}


?>