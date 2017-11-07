<?php
session_start();
$password = md5($_POST["userpass"]);
$usercode = $_POST["usercode"];
require_once "conn.php";
$sql = "UPDATE `wyy_operator` SET `pass` = '$password' WHERE `code` = '$usercode'";
$stmt = mysql_query($sql);
if ($stmt === false) {
	echo "false";
} else {
	echo "true";
}

mysql_close();
?>