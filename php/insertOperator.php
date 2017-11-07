<?php
	$usercode = $_POST["usercode"];
	$username = $_POST["username"];
	$isadmin = $_POST["isadmin"];
	$password = md5($_POST["userpass"]);

	require_once "conn.php";
	$sql = "INSERT INTO `wyy_operator` (`code`, `userName`, `pass`, `isadmin`) VALUES ('{$usercode}', '{$username}', '{$password}', '{$isadmin}')";
	$stmt = mysql_query($sql);
	if ($stmt === false) {
		echo "false";
	} else {
		echo "true";
	}
	mysql_close();
?>