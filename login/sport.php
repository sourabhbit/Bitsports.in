<?php
session_start();
$id=$_SESSION['id'];
//echo"welcome to our website";
if(!isset($_SESSION['id'])){
	header('location:login.php');
}else{
	$id=$_SESSION['id'];
	$email=$_SESSION['email'];
	echo"<h1>Welcome $email</h1>";
	echo"<h1>Your Regno. is $id</h1>";
	echo"<a href='logout.php'><h3>Logout</h3></a>";
	$q="select * from sportnew where id=$id";
	include('connection.php');
	$r=mysqli_query($con,$q);
	$arr=mysqli_fetch_assoc($r);
	//print_r($arr);
}
?>

<?php
if(isset($_POST['submit'])){
$server="localhost";
$user="bitdspor";
$pass="23u5g4RYch";
$dbname="bitdspor_bit";

//creating connection for mysqli

$conn = new mysqli($server,$user,$pass,$dbname);

//checking connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$a = $_POST['athlete'];
$b = $_POST['throw'];
$c = $_POST['marathon'];
$chk="";  
$chk2="";  
foreach($a as $chk1)  
   {  
      $chk .= $chk1.",";  
   }
foreach($b as $chk3)  
   {  
      $chk2 .= $chk3.",";  
   }   
$qry="UPDATE sportnew set athlete='$chk' , throw='$chk2', marathon='$c'where ID='$id'";
	$res=mysqli_query($con,$qry);
	if($res){
			echo"<br> Record updated successfully";
			echo"<br>Athlete are $chk  Throws are $chk2  Marathon $c";
			//header('location:profile.php');
		}

$conn->close();

}


?>
<html>
<head>
<style>
* {
    box-sizing: border-box;
}
.container {
    border-radius: 85px;
    background-color: #f2f2f2;
    padding:50px;
}
h2{
	text-decoration: underline;
	text-decoration-color: red;
}

</style>
	<script type="text/javascript">

function checkboxlimit(checkgroup, limit){
	var checkgroup=checkgroup
	var limit=limit
	for (var i=0; i<checkgroup.length; i++){
		checkgroup[i].onclick=function(){
		var checkedcount=0
		for (var i=0; i<checkgroup.length; i++)
			checkedcount+=(checkgroup[i].checked)? 1 : 0
		if (checkedcount>limit){
			alert("You can only select a maximum of "+limit+" checkboxes")
			this.checked=false
			}
		}
	}
}

</script>
</head>
<body>
<!--<h1 style="color:red;" align="center">Your Registered Events are:</h1>-->
<div class= "container">
<h2 align="center">Registration For Events</h2>
<form id="sport" name="sport" method="POST" action="sport.php">

<h3>Athlete<br></h3>
<input type="checkbox" id="athlete" name="athlete[]" value="100m"/> 100m<br />
<input type="checkbox" id="athlete" name="athlete[]" value="200m"/> 200m<br />
<input type="checkbox" id="athlete" name="athlete[]" value="400m"/> 400m<br />
<input type="checkbox" id="athlete" name="athlete[]" value="800m"/> 800m<br />
<input type="checkbox" id="athlete" name="athlete[]" value="1500m"/> 1500m<br />
<br>
<h3>Throws<br></h3>
<input type="checkbox" id="throw" name="throw[]" value="Javelin"/> Javelin<br />
<input type="checkbox" id="throw" name="throw[]" value="Shortput"/> Shortput<br />
<input type="checkbox" id="throw" name="throw[]" value="Discthrow"/> Discthrow<br />
<br>
<h3>Jumps<br></h3>
<input type="checkbox" id="throw" name="throw[]" value="Long"/> Long jump<br />
<input type="checkbox" id="throw" name="throw[]" value="Triple"/> Triple jump<br />

<br>
<h3>Marathon<br></h3>
<input type="checkbox" name="marathon" value="Yes"/> Marathon<br />
<br>
<input type="submit" name="submit" value="SUBMIT" style="width:100px; height:40px; font-size:15px; color:black; background-color:#63AEF5; padding:10px"/>
</form>
<div>

<script type="text/javascript">

//Syntax: checkboxlimit(checkbox_reference, limit)
checkboxlimit(document.forms.sport.athlete, 3)
checkboxlimit(document.forms.sport.throw, 2)

</script>

</body>
</html>



<?php
include('connection.php');
$q="select ID,name,athlete,throw,marathon from sportnew where ID=$id";

$res=mysqli_query($con,$q);

echo"<pre>";
/**
while($arr=mysqli_fetch_assoc($res)){
	
	var_dump($arr);
**/
	

?>
<table border="1" height="100px" width="10px" style="position: relative;" align="center">
<tr><th>ID</th><th>name</th><th>athlete</th><th>throw</th><th>marathon</th></tr>


<?php



while($arr=mysqli_fetch_assoc($res)){
	
	echo "<tr>";
	// for showing all multiple data in a loop
	foreach($arr as $x=>$y){
		
		echo"<td>$y</td>";
	}
	
	/**
	echo"<td>$arr[ID]</td>";
	echo"<td>$arr[fname]</td>";
	echo"<td>$arr[address]</td>";
	**/
	echo"</tr>";
}

?>
</html>
