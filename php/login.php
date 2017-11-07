<?php
session_start();
$usercode = $_POST["user"];
$password = md5($_POST["password"]);

$mysql_server_name = '111.67.196.219';
$mysql_username = 'zjwdb_6102019';
$mysql_password = 'Ufsky8888';
$mysql_database = 'zjwdb_6102019';

$conn = mysql_connect($mysql_server_name, $mysql_username, $mysql_password, $mysql_database) or die("error connecting");
mysql_query("set names 'utf8'");
mysql_select_db($mysql_database);
$sql = "SELECT * FROM `wyy_operator` WHERE `code` = '$usercode' AND `pass` = '$password'";
$result = mysql_query($sql, $conn);
while ($row = mysql_fetch_array($result)){
	if($row){
		$_SESSION['id']=$row['id'];
		$_SESSION['userCode']=$row['code'];
		$_SESSION['password']=$row['pass'];
		$_SESSION['userName']=$row['userName'];
		$_SESSION['isadmin']=$row['isadmin'];
		$reBack = "success";
	}
}
echo $reBack;
mysql_close();
?>