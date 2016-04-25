<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>GloboBank | Login</title>
<link rel="stylesheet" href="css/index.css" type="text/css">
<?php


$error = false;
if(isset($_POST['submit'])){
	include("dbconnect.php");

	if(isset($_POST['email']) AND isset($_POST['password'])){
		$email = $_POST['email'];
		$pass = $_POST['password'];
		
		$sql = "SELECT password FROM Account where email='$email'";
		mysqli_query($dbcnx, $sql);
		$res = mysqli_query($dbcnx, $sql);
		
		if ( !$res ) {
			echo('Query failed ' . $sql . ' Error:' . mysqli_error($dbcnx));
			exit();
		}
		$row = mysqli_fetch_array($res);

		if($pass == $row['password']){
			session_start();
			$_SESSION['email'] = $email;
			$_SESSION['logged_in'] = true;
			header("Location: user/index.php");
		}else{
			$error = true;
		}
		
	}

}
?>
</head>
<body>
	<h1>GloboBank</h1>
	<div id="main">
			<h2>Login</h2>
			<form method="post" action="index.php">
				<?php
					if($error)
						echo "<p class='error'>Incorrect email or password</p>";
				?>
				<div id="details">
					<label for="email">Email:</label><input type="text" required="required" name="email" size="30">
					<label for="password">Password:</label><input type="password" required="required" name="password" size="30">
				</div>
				<input type="button" onClick="parent.location='register.php'" value="Register">
				<input class="right" type="submit" name="submit" value="Login"><br>
				<a class="right" href="reset.php">Forgot Password</a>
			</form>
			
			
	</div>
</body>
</html>