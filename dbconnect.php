<?php
$dbcnx = mysqli_connect("localhost", "root", "", "GloboBank");
if (mysqli_connect_errno($dbcnx)){
	echo "Failed to connect to MySQL: " .mysqli_connect_error($dbcnx);
	exit();
}