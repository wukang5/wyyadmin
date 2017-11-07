<?php
$usercode = $_POST["usercode"];
require_once "conn.php";

$sql = "DELETE FROM `wyy_user` WHERE `loginCode` = '$usercode'";
$stmt = mysql_query($sql);
if ($stmt === false) {
	echo "false";
} else {
	echo "true";
}
mysql_close();
?>