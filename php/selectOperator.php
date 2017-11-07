<?php
header('content-type:application/json;charset=utf8');
$mysql_server_name = '111.67.196.219';
$mysql_username = 'zjwdb_6102019';
$mysql_password = 'Ufsky8888';
$mysql_database = 'zjwdb_6102019';

$conn = mysql_connect($mysql_server_name, $mysql_username, $mysql_password, $mysql_database) or die("error connecting");
mysql_query("set names 'utf8'");
mysql_select_db($mysql_database);
$sql = "SELECT * FROM `wyy_operator`";
$result = mysql_query($sql, $conn);
$results = array();
while ($row = mysql_fetch_array($result)){
	$results[] = $row;
}
echo json_encode($results);
mysql_free_result($result);
 
mysql_close($conn);
?>