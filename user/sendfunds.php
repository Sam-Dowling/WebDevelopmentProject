<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>GloboBank | Withdraw</title>
<link rel="stylesheet" href="../css/funds.css" type="text/css">
<link rel="stylesheet" href="../css/tabs.css" type="text/css">
<?php
include("../dbconnect.php");
include("authenticated.php");
$error="";
$email = $_SESSION['email'];
$sql = "SELECT balance FROM Account WHERE email = '$email'";
$res = mysqli_query($dbcnx,$sql);
$row = mysqli_fetch_array($res);
$balance = $row['balance'];
if(isset($_POST['submit'])){
	if($_POST['amount']<$balance){ 
		if($_POST['amount']>0){
		
			$amount = $_POST['amount'];
			$sendingemail = $_SESSION['email'];
			$recievingemail = $_POST['email'];
			
			// sending
			$sql = "INSERT INTO Transaction(email,date,amount,type,account_number) VALUES('$sendingemail','".date('Y-m-d H:i:s')."',$amount,'w','$recievingemail')";
			mysqli_query($dbcnx,$sql);
			
			// receiving
			$sql = "INSERT INTO Transaction(email,date,amount,type,account_number) VALUES('$recievingemail','".date('Y-m-d H:i:s')."',$amount,'d','$sendingemail')";
			mysqli_query($dbcnx,$sql);
			
			//sending
			$sql = "UPDATE Account SET balance = balance - $amount WHERE email = '$sendingemail'";
			mysqli_query($dbcnx,$sql);
			
			//receiving
			$sql = "UPDATE Account SET balance = balance + $amount WHERE email = '$recievingemail'";
			mysqli_query($dbcnx,$sql);
			
			echo $sql;
			header("Location: index.php");
		}else{
			$error .= "Please enter a value greater than 0<br>";
		}
	}else{
		$error .= "Please enter a value less than your current balance.<br>";
	}
}
?>
</head>
<body>
	<a class="right" href="index.php?logout=true">Logout</a>
	<h1>GloboBank</h1>
	<div id="main">
	<h2>Add Funds</h2>
		<form action="sendfunds.php" method="post">
		<?php echo "<p style='color:red'>$error</p>"; ?>
			<div id="details">
				<label for="email">To (Email) </label><input type="text" required="required" name="email" size="30"><br>
				<label for="amount">Amount </label><br><input type="text" required="required" name="amount" size="8">
				<input class="right" type="submit" name="submit" value="Send Funds">
			</div>
			<a href="index.php">Back</a>
		</form>
	</div>
</body>
</html>