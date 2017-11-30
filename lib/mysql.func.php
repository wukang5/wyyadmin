<?php
require_once "../include.php";
$conn = mysql_connect(DB_HOST, DB_USER, DB_PWD, DB_DBNAME) or die("error connecting");
mysql_set_charset(DB_CHARSET);
mysql_select_db(DB_DBNAME);
?>