<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>GloboBank | Register</title>
<link rel="stylesheet" href="css/register.css" type="text/css">
<?php
$email = "";
$forename = "";
$surname = "";
$question = "";
$answer = "";
$message = "";

if(isset($_POST['submit'])){
	include("dbconnect.php");
		$email = mysqli_real_escape_string($dbcnx,$_POST['email']);
		$forename = mysqli_real_escape_string($dbcnx,$_POST['first']);
		$surname = mysqli_real_escape_string($dbcnx,$_POST['second']);
		$pass1 = mysqli_real_escape_string($dbcnx,$_POST['password1']);
		$pass2 = mysqli_real_escape_string($dbcnx,$_POST['password2']);
		$question = mysqli_real_escape_string($dbcnx,$_POST['question']);
		$answer = mysqli_real_escape_string($dbcnx,$_POST['answer']);
		
		$sql = "SELECT password FROM Account where email='$email'";
		mysqli_query($dbcnx, $sql);
		$res = mysqli_query($dbcnx, $sql);
		
		if ( !$res ) {
			echo('Query failed ' . $sql . ' Error:' . mysqli_error($dbcnx));
			exit();
		}
		$row = mysqli_fetch_array($res);
		if($row)
			$message .= "Email already in use<br>";
		if(!preg_match("/^\S+@\S+\.\S+$/",$email))
			$message .= "Email incorrect<br>";
		if($pass1 != $pass2)
			$message .= "Passwords do not match<br>";
		if(strlen($email) > 60)
			$message .= "Email must be less than 60 characters<br>";
		if(strlen($forename) > 35)
			$message .= "Forename must be less than 35 characters<br>";
		if(strlen($surname) > 35)
			$message .= "Surname must be less than 35 characters<br>";
		if(strlen($pass1) > 35)
			$message .= "Password must be less than 35 characters<br>";
		if(strlen($question) > 60)
			$message .= "Security Question must be less than 60 characters<br>";
		if(strlen($answer) > 60)
			$message .= "Security Answer must be less than 60 characters<br>";
		if(strlen($pass1) < 5)
			$message .= "Password must be greater than 5 characters";
		
		if($message == ""){
			$sql = "INSERT INTO Account values('$email','$forename','$surname','$pass1',0,'$question','$answer')";
			$res = mysqli_query($dbcnx, $sql);
			
			header("Location: index.php");
		}
	}
?>
</head>
<body>
	<h1>GloboBank</h1>
	<div id="main">
		<h2>Register</h2>
		<form action="register.php" method="post">
		<?php 
		if($message != ""){
			echo "<div id='errorbox'>";
			echo $message; 
			echo "</div><br>";
		}
		?>
			<div id="details">
				
				<label for="email">Email</label><input type="text" required="required" name="email" size="30" value="<?php echo $email; ?>">
				<label for="first">Forename</label><input type="text" required="required" name="first" size="30" value="<?php echo $forename; ?>">
				<label for="second">Surname</label><input type="text" required="required" name="second" size="30" value="<?php echo $surname; ?>">
				<label for="password1">Password</label><input type="password" required="required" name="password1" size="30">
				<label for="password2">Repeat Password</label><input type="password" required="required" name="password2" size="30">
				<label for="question">Security Question</label><input type="text" required="required" name="question" size="30" value="<?php echo $question; ?>">
				<label for="answer">Answer</label><input type="text" name="answer" required="required" size="30" value="<?php echo $answer; ?>">
			</div>
			<input class="right" type="submit" value="Register" name="submit">
		</form>
		<input type="button" onClick="parent.location='index.php'" value="Back">
	</div>
</body>
</html>