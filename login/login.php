<?php
if(isset($_POST['login'])){
	 $a=$_POST['email'];
	 $b=$_POST['pass'];
	
	//checking connection
    include('connection.php');

	
	$q="select * from sportnew where email='$a' and password='$b'";
	$res=mysqli_query($con,$q);
	
	if($res==true){
		$n=mysqli_num_rows($res);
		if($n==0){
			echo"<h3 style='color:red;'>Login Failed{Incorrect data}</h3>";
		}
	else{
		$arr=mysqli_fetch_assoc($res);
		//var_dump($arr);
		session_start();
		$_SESSION['id']=$arr['ID'];
		$_SESSION['email']=$arr['email'];
		//echo"Login success";
		header('location:sport.php');
	}
	}
}


?>

<?php
if(isset($_POST['create'])){
session_start();

	$_SESSION['Name'] = $_POST['Name'];
	$_SESSION['Roll'] = $_POST['Roll'];
	$_SESSION['Branch'] = $_POST['Branch'];
	$_SESSION['Gender'] = $_POST['Gender'];
	$_SESSION['Year'] = $_POST['Year'];
	$_SESSION['Email'] = $_POST['Email'];
	$_SESSION['Password'] = $_POST['Password'];
	header('location:sender.php');


}

?>

<html>
<head>
<script>
function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}
</script>
<title>Registration form</title>
<link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login">
<div class="form">
<form class="register" method="POST" action="login.php">
<input type="text" name="Name" placeholder="Name" required onkeydown="upperCaseF(this)"/><span style="color:black;" ></span> 
<input type="text" name="Roll" placeholder="Roll No. (BE/6XXX/XX)" required /><span style="color:black;"></span>
<select name="Branch" style="width: 270px; height:40px;" placeholder="Branch" required>
    <option value="">--Select Branch--</option>
    <option value="CSE">CSE</option>
	<option value="EEE">EEE</option>
    <option value="ECE">ECE</option>
    <option value="IT">Information Technology</option>
    <option value="MECH">MECHANICAL</option>
	</select> 
<br><br>

<select name="Gender" style="width: 270px; height:40px;" placeholder="Branch" required>
    <option value="">--Select Gender--</option>
    <option value="Male">Male</option>
	<option value="Female">Female</option>
</select><br><br>

<select name="Year" style="width: 270px; height:40px;" placeholder="Year" required>
    <option value="">--Select Year--</option>
    <option value="2014">2014</option>
	<option value="2015">2015</option>
    <option value="2016">2016</option>
    <option value="2017">2017</option>
  </select> 
<br><br>
<input type="email" name="Email" placeholder="Email" required/><br>
<input type="password" name="Password" placeholder="Password" required/><br>
<input type="password" name="Repass" placeholder="Re-enter password" required/><br><br>

<button name="create">Create</button>
<p class="message">Already Registered?<a href="#">Log In</a></p>
</form>
<form class="login-form" method="POST" action="login.php">
<input type="mail" name="email" placeholder="E-mail"/>
<input type="password" name="pass" placeholder="Password"/>
<button name="login">Log In </button>
<p class="message">Registration Closed!
<!--<a href="#">Register</a>-->
</p>
</form>
</div>
</div>
<script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
<script>
$('.message a').click(function(){
$('form').animate({height:"toggle", opacity:"toggle"},"slow");
});
</script>
</body>
</html>
