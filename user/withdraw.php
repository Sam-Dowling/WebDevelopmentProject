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
$email = $_SESSION['email'];
$sql = "SELECT balance FROM Account WHERE email = '$email'";
$res = mysqli_query($dbcnx,$sql);
$row = mysqli_fetch_array($res);
$balance = $row['balance'];

if(isset($_POST['submit']) AND $_POST['amount']>0 AND $_POST['amount']<$balance){
	$account = $_POST['accountnumber'];
	$amount = $_POST['amount'];
	$sql = "INSERT INTO Transaction(email,date,amount,type,account_number) VALUES('$email','".date('Y-m-d H:i:s')."',$amount,'w','$account')";
	mysqli_query($dbcnx,$sql);
	
	$sql = "UPDATE Account SET balance = balance - $amount WHERE email = '$email'";
	mysqli_query($dbcnx,$sql);
	echo $sql;
	header("Location: index.php");
}
?>
</head>
<body>
	<a class="right" href="index.php?logout=true">Logout</a>
	<h1>GloboBank</h1>
	<div id="main">
	<h2>Add Funds</h2>
		<form action="withdraw.php" method="post">
			<div id="details">
				<label for="accountnumber">Bank Account Number </label><input type="text" required="required" name="accountnumber" size="30"><br>
				<label for="amount">Amount </label><br><input type="text" required="required" name="amount" size="8">
				<input class="right" type="submit" name="submit" value="Add Funds">
			</div>
			<a href="index.php">Back</a>
		</form>
	</div>
</body>
</html>