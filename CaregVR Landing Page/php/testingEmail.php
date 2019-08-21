<?php

require("C:\Apache24\htdocs\CaregVR Landing Page\php\PHPMailer\PHPMailer\src\PHPMailer.php");
require("C:\Apache24\htdocs\CaregVR Landing Page\php\PHPMailer\PHPMailer\src\Exception.php");
require("C:\Apache24\htdocs\CaregVR Landing Page\php\PHPMailer\PHPMailer\src\SMTP.php");

$mail = new PHPMailer\PHPMailer\PHPMailer(True);

//Server settings
$mail->IsSMTP();                                                // enable SMTP
$mail->SMTPDebug  = 2;                                          // Enable verbose debug output
$mail->SMTPAuth   = true;                                       // Enable SMTP authentication
$mail->SMTPSecure = 'ssl';                                      // Enable TLS encryption, `ssl` also accepted
$mail->Host       = 'smtp.gmail.com';                           // Specify main and backup SMTP servers
$mail->Port       = 465;                                        // TCP port to connect to
$mail->IsHTML(true);                                            // Set email format to HTML
$mail->Username   = 'no.reply.caregiVR@gmail.com';              // SMTP username
$mail->Password   = 'StealthMode';                              // SMTP password
$mail->setFrom('no.reply.caregiVR@gmail.com', 'CaregiVR');
$mail->addAddress('PGhadban@gmail.com', 'Patrick Ghadban');     // Add a recipient
$mail->Subject = 'CaregiVR Subscription Confirmation';
$mail->Body = "HELLLOOOO, CAN YOU HEAR ME??????";

if (!$mail->Send()){
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
} else{
  echo 'Message has been sent';
}
