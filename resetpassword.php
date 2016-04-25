<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>GloboBank | Reset Password</title>
<link rel="stylesheet" href="css/reset.css" type="text/css">
<?php
session_start();
if(!isset($_SESSION['resetAuth']) AND !$_SESSION['resetAuth'])
	header("Location: reset.php");
	
$error = false;

if(isset($_POST['submit'])){
	if($_POST['pass1'] == $_POST['pass2']){
		$pass = $_POST['pass1'];
		$email = $_SESSION['emailReset'];
		$sql = "UPDATE Account SET password = '$pass' WHERE email = '$email'";
		
		include("dbconnect.php");
		
		mysqli_query($dbcnx, $sql);
		session_destroy();
		header("Location: index.php");
	}else{
		$error = true;
	}
}

?>
</head>
<body>
	<h1>GloboBank</h1>
	<div id="main">
	<h2>Reset Password</h2>
		
		<form action="resetpassword.php" method="post">
		
			<div id="details">
			<?php 
				if($error)
					echo "<p style='color:red'>Passwords do not match</p>";
			?>
				<label for='pass1'>Password:</label><input type='password' required='required' name='pass1' size='30'>
				<label for='pass2'>Repeat Password:</label><input type='password' required='required' name='pass2' size='30'>
			</div>
			
			<input type="submit" name="submit" value="Reset Password">
		</form>
	</div>
</body>
</html>