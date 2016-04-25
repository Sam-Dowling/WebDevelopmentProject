<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>GloboBank</title>
<link rel="stylesheet" href="../css/tabs.css" type="text/css">
<link rel="stylesheet" href="../css/bill.css" type="text/css">
<?php
include("../dbconnect.php");
include("authenticated.php");

if(isset($_GET['logout'])){
	session_destroy();
	header("Location: ../index.php");
}
$email = $_SESSION['email'];

$sql = "SELECT bill_id, date_issued, amount, date_paid, send_email, note from Bill where rec_email = '$email' ORDER BY trans_id DESC";
$res = mysqli_query($dbcnx,$sql);
?>
</head>
<body>
<a class="right" href="index.php?logout=true">Logout</a>
	<h1>GloboBank</h1>
	<div id="main">
	<h2>Bills</h2>
		<div id="details">
			<table id="transactions">
				<tr>
					<th colspan="5"
					<h3>Bills</h3>
					</th>
				</tr>
				<tr>
					<th>Date</th>
					<th>From</th>
					<th>Status</th>
					<th>Amount</th>
					<th>Note</th>
				</tr>
				<?php
					while ( $row = mysqli_fetch_array($res) ) {
						$id = $row['bill_id'];
						$pay = "<a href='bill.php?pay='$id'>Pay Now</a>";
						echo "<tr>";
						echo "<td>".$row['date_issued']."</td>";
						echo "<td>".$row['send_email']."</td>";
						echo "<td>".($row['date_paid']=='' ? $pay: 'Paid')."</td>";
						echo "<td>".$row['amount']."</td>";
						echo "<td>".$row['note']."</td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
		<a href="index.php">Back</a>
	</div>
</body>
</html>