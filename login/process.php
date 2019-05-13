<?php
session_start();

$rndno=rand(100000, 999999);//OTP generate
$message = urlencode("otp number.".$rndno);
$to=$_POST['email'];
$subject = "Reg. OTP";
$txt = "Your OTP is: ".$rndno."";
$headers = "From: sport@bitdsports.in" . "\r\n" .
"CC: kumarsourabh556@gmail.com";
mail($to,$subject,$txt,$headers);
if(isset($_POST['btn-save']))
{
$_SESSION['name']=$_POST['name'];
$_SESSION['email']=$_POST['email'];
$_SESSION['phone']=$_POST['phone'];
$_SESSION['otp']=$rndno;
header( "Location: otp.php" ); 
} ?>