<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>GloboBank | Reset Password</title>
<link rel="stylesheet" href="css/reset.css" type="text/css">
<?php
session_start();
if(!isset($_SESSION['emailReset']))
	header("Location: reset.php");
	
$error = false;
	
include("dbconnect.php");
if(isset($_POST['submit'])){
	$email = $_SESSION['emailReset'];
	$sql = "SELECT sec_answer FROM Account WHERE email = '$email'";
						
	mysqli_query($dbcnx, $sql);
	$res = mysqli_query($dbcnx, $sql);
	
	if ( !$res ) {
		echo('Query failed ' . $sql . ' Error:' . mysqli_error($dbcnx));
		exit();
	}
	$row = mysqli_fetch_array($res);
	if($row['sec_answer']==$_POST['answer']){
		$_SESSION['resetAuth'] = true;
		header("Location: resetpassword.php");
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
		
		<form action="resetverify.php" method="post">
		<?php 
			if($error)
				echo "<p style='color:red'>Incorrect Answer</p>";
		?>
			<div id="details">
				<p>Security Question: <?php echo $_SESSION['question']; ?></p>
				<label for='answer'>Answer:</label><input type='text' required='required' name='answer' size='30'>
			</div>
			
			<input type="submit" name="submit" value="Reset Password">
		</form>
	</div>
</body>
</html>