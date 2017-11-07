<?php
	$mysql_server_name = '111.67.196.219';
	$mysql_username = 'zjwdb_6102019';
	$mysql_password = 'Ufsky8888';
	$mysql_database = 'zjwdb_6102019';
	
	$conn = mysql_connect($mysql_server_name, $mysql_username, $mysql_password, $mysql_database) or die("error connecting");
	mysql_query("set names 'utf8'");
	mysql_select_db($mysql_database);
?>