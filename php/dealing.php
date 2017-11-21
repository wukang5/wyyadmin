<?php
session_start();
$state = $_POST["state"];
$id = $_POST["id"];
require_once "conn.php";
$sql = "UPDATE `wyy` SET `state` = '$state' WHERE `id` = '$id'";
$stmt = mysql_query($sql);
if ($stmt === false) {
	echo "false";
} else {
	echo "true";
}

mysql_close();
?>