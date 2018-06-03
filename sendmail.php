<?php 

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$description = $_POST['description'];



$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: Your name <'.$email .'>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 


$message = "
Name: $name <br/>
Email: $email <br/>
Subject: $subject <br/>
Description: $description 
";
mail('contact@saydhaque.com', 'email subject', $message , $headers);
?>
<?php
echo "<h2>Thanks for Contact:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $subject;
echo "<br>";
echo $description;
?>