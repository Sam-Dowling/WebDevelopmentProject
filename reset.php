<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>GloboBank | Reset Password</title>
<link rel="stylesheet" href="css/reset.css" type="text/css">

</head>
<body>
	<h1>GloboBank</h1>
	<div id="main">
	<h2>Reset Password</h2>
		<form action="reset.php" method="post">
		
			<div id="details">
				<?php
					session_start();
					include("dbconnect.php");
					if(isset($_POST['submit'])){

						$email = mysqli_real_escape_string($_POST['email']);
						$sql = "SELECT sec_question FROM Account WHERE email = '$email'";
						
						mysqli_query($dbcnx, $sql);
						$res = mysqli_query($dbcnx, $sql);
						
						if ( !$res ) {
							echo('Query failed ' . $sql . ' Error:' . mysqli_error($dbcnx));
							exit();
						}
						
						$row = mysqli_fetch_array($res);
						if($row){
							$_SESSION['question'] = $row['sec_question'];
							
							$_SESSION['emailReset'] = $email;
							header("Location: resetverify.php");
						}else{
							echo "<p style='color:red'>Incorrect Email</p>";
						}
					}
				?>
				<label for='email'>Email:</label><input type='text' required='required' name='email' size='30'>
			</div>
			
			<input type="submit" name="submit" value="Submit">
		</form>
	</div>
</body>
</html>