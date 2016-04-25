<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>GloboBank</title>
<link rel="stylesheet" href="../css/user.css" type="text/css">
<link rel="stylesheet" href="../css/tabs.css" type="text/css">
<?php
include("../dbconnect.php");
include("authenticated.php");

if(isset($_GET['logout'])){
	session_destroy();
	header("Location: ../index.php");
}
$email = $_SESSION['email'];
$res = mysqli_query($dbcnx, "select f_name, s_name, balance from account where email = '$email'");
$row = mysqli_fetch_array($res);
$surname = $row['s_name'];
$forename = $row['f_name'];
$balance = $row['balance'];

$sql = "SELECT date, amount, type, account_number from transaction where email = '$email' ORDER BY trans_id DESC limit 5";
$res = mysqli_query($dbcnx,$sql);
?>
</head>
<body>
<a class="right" href="index.php?logout=true">Logout</a>
	<h1>GloboBank</h1>
	<div id="main">
		
		<div id="centeredmenu">
			<ul>
			<li><a href="sendfunds.php">Send Money</a></li>
			<li><a href="bill.php">Bills</a></li>
			<li><a href="addfunds.php">Add Funds</a></li>
			<li><a href="withdraw.php">Withdraw Funds</a></li>
			</ul>
		</div>
		<div id="details">
		<h3>Welcome <?php echo "$forename $surname"; ?></h3>
		<div id="balance">
			<h3>Account Balance: <?php echo "&euro;$balance"; ?></h3>
		</div>
		<div id="content">
		
		<table id="transactions">
			<tr>
				<th colspan="4">
				<h3>Recent Transactions</h3>
				</th>
			</tr>
			<tr>
				<th>Date</th>
				<th>Bank Account / Email</th>
				<th>Type</th>
				<th>Amount</th>
			</tr>
			<?php
				while ( $row = mysqli_fetch_array($res) ) {
				echo "<tr>";
				echo "<td>".$row['date']."</td>";
				echo "<td>".$row['account_number']."</td>";
				echo "<td>".($row['type']=='w' ? 'Withdrawal' : 'Deposit')."</td>";
				echo "<td>".($row['type']=='w' ? '-' : '+').$row['amount']."</td>";
				echo "</tr>";
				}
			?>
		</table>
		</div>
		</div>
	</div>
</body>
</html>