<?php
session_start();
$password = md5($_POST["userpass"]);
$usercode = $_POST["usercode"];
$linkMan = $_POST["linkMan"];
$linkManPhone = $_POST["linkManPhone"];
require_once "conn.php";
$sql = "UPDATE `wyy_user` SET `linkman` = '$linkMan',`linkmanPhone`='$linkManPhone', `password` = '$password' WHERE `loginCode` = '$usercode'";
$stmt = mysql_query($sql);
if ($stmt === false) {
	echo "false";
} else {
	echo "true";
}

mysql_close();
?>