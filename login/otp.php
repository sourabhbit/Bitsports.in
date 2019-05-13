<?php
session_start();

$name=$_SESSION['name'];



if(isset($_POST['save']))
{
$rno=$_SESSION['otp'];
$urno=$_POST['otpvalue'];
if(!strcmp($rno,$urno))
{
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$phone=$_SESSION['phone'];
//For admin if he want to know who is register
$to="example@gmail.com";
$subject = "Thank you!";
$txt = "Some one show your demo Email id: ".$email." Mobile number : ".$phone."";
$headers = "From: kumarsourabh556@gmail.com" . "\r\n" .
"CC: kumarsourabh556@gmail.com";
mail($to,$subject,$txt,$headers);


$server="localhost";
$user="bitdspor";
$pass="23u5g4RYch";
$dbname="bitdspor_bit";

//creating connection for mysqli

$con = new mysqli($server,$user,$pass,$dbname);

//checking connection

include('connection.php');

$a = mysqli_real_escape_string($con, $_SESSION['name']);
$b = mysqli_real_escape_string($con, $_SESSION['Roll']);
$c = mysqli_real_escape_string($con, $_SESSION['Branch']);
$d = mysqli_real_escape_string($con, $_SESSION['Gender']);
$e = mysqli_real_escape_string($con, $_SESSION['Year']);
$f = mysqli_real_escape_string($con, $_SESSION['Email']);
$g = mysqli_real_escape_string($con, $_SESSION['Password']);


$sql="INSERT INTO sportnew (name, rollno, branch, gender, year, email, password ) VALUES ('$a','$b','$c','$d','$e','$f','$g')";

if ($con->query($sql) === TRUE) {
	header('location:login.php');
    echo "<h3 style='color:blue;'>Database created</h3>";
}
 else {
    echo "Error creating database: " .$sql . "<br/>" . $con->error;
}


$con->close();







//For admin if he want to know who is register
}
else{
echo "<p>Invalid OTP</p>";
}
}
//resend OTP
if(isset($_POST['resend']))
{
$message="<p class='w3-text-green'>Sucessfully send OTP to your mail.</p>";
$rno=$_SESSION['otp'];
$to=$_SESSION['email'];
$subject = "OTP";
$txt = "Your OTP is: ".$rno."";
$headers = "From: sport@bitdsports.in" . "\r\n" .
"CC: kumarsourabh556@gmail.com";
mail($to,$subject,$txt,$headers);
$message="<p class='w3-text-green w3-center'><b>Sucessfully resend OTP to your mail.</b></p>";
}
?>
<!DOCTYPE html>
<html>
<header>
<title>OTP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://studentstutorial.com/div/d.css">
<style>
a{
text-decoration:none;
}
</style>
<header>
<body>
<br>
<div class="w3-row">
<div class="w3-half w3-card-2 w3-round">
<div class="w3-container w3-center w3-green">
<h2>OTP</h2>
</div>
<br>
<form class="w3-container" method="post" action="">
<br>
<br>
<p><input class="w3-input w3-border w3-round" type="password" placeholder="OTP" name="otpvalue"></p>
<p color="red";>Please Wait 2-3min for OTP</p>
<p class="w3-center"><button class="w3-btn w3-green w3-round" style="width:100%;height:40px" name="save">Submit</button></p>
<p class="w3-center"><button class="w3-btn w3-green w3-round" style="width:100%;height:40px" name="resend">Resend</button></p>
</form>
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<br>

</div>
<div class="w3-half">
</div>
</div>
</body>
</html>