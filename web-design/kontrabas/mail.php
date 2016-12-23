<?php

$message = "New purchase!!!\r\n"."Name:".$_POST['name']."\r\nPhone number:";
$message .= $_POST['number']."\r\n"."Email:".$_POST['email']."\r\n"."Message:".$_POST['customer_message']."\r\n";

mail('getyougone@gmail.com','Purchase', $message);

echo 'Thank you for mail!
	<a href="./index.html">Come back</a>
';
?>