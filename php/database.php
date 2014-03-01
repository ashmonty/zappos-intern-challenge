<?php
$mysqli = new mysqli('localhost', 'zappos', 'zappos_pw', 'price_notifier');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>