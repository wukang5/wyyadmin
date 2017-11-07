<?php
$usercode = $_POST["usercode"];
require_once "conn.php";

$sql = "DELETE FROM `wyy_operator` WHERE `code` = '$usercode'";
$stmt = mysql_query($sql);
if ($stmt === false) {
	echo "false";
} else {
	echo "true";
}
mysql_close();
?>