<?php
	$username = $_POST["username"];
	$shortname = $_POST["shortname"];
	$usercode = $_POST["usercode"];
	$adress = $_POST["adress"];
	$linkMan = $_POST["linkMan"];
	$linkManPhone = $_POST["linkManPhone"];
	$password = md5($_POST["userpass"]);

	require_once "conn.php";
	$sql = "INSERT INTO `wyy_user` (`company`,`shortName`,`loginCode`,  `password`, `adress`,`linkman`,`linkmanPhone`) VALUES ('$username', '$shortname', '$usercode', '$password','$adress', '$linkMan', '$linkManPhone')";
	$stmt = mysql_query($sql);
	if ($stmt === false) {
		echo "false";
	} else {
		echo "true";
	}
	mysql_close();
?>