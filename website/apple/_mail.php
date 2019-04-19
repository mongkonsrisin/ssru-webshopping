<?php
require_once('class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsHTML(true);
$mail->IsSMTP();
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
$mail->Port = 465; // set the SMTP port for the GMAIL server
$mail->Username = "s58122202001@gmail.com"; // GMAIL username
$mail->Password = "Kendo50516"; // GMAIL password
$mail->From = "s58122202001@gmail.com"; // "name@yourdomain.com";
//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
$mail->FromName = "Mongkon Srisin";  // set from Name
?>
