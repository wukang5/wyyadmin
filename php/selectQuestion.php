<?php
header('content-type:application/json;charset=utf8');
$type = $_POST["type"];
$searchCompany = $_POST["searchCompany"];
$searchKeynum = $_POST["searchKeynum"];
$searchName = $_POST["searchName"];
$searchPhone = $_POST["searchPhone"];

$mysql_server_name = '111.67.196.219';
$mysql_username = 'zjwdb_6102019';
$mysql_password = 'Ufsky8888';
$mysql_database = 'zjwdb_6102019';

$conn = mysql_connect($mysql_server_name, $mysql_username, $mysql_password, $mysql_database) or die("error connecting");
mysql_query("set names 'utf8'");
mysql_select_db($mysql_database);
if($type == "0"){
	$sql = "SELECT * FROM `wyy` order by id desc";
}else if($type == "1"){
	$searchCompany1 = '%'.$searchCompany.'%';
	$searchKeynum1 = '%'.$searchKeynum.'%';
	$searchName1 = '%'.$searchName.'%';
	$searchPhone1 = '%'.$searchPhone.'%';
	$str = null;
	if($searchCompany!=null){
		$str = "company like '$searchCompany1'";
	}
	if($searchKeynum!=null && $str !=null){
		$str = $str." And keynum like '$searchKeynum1'";
	}else if($searchKeynum!=null && $str ==null) {
		$str = "keynum like '$searchKeynum1'";
	}
	if($searchName!=null && $str !=null){
		$str = $str." And name like '$searchName1'";
	}else if($searchName!=null && $str ==null) {
		$str = "name like '$searchName1'";
	}
	if($searchPhone!=null && $str !=null){
		$str = $str." And phone like '$searchPhone1'";
	}else if($searchPhone!=null && $str ==null) {
		$str = "phone like '$searchPhone1'";
	}
	$sql = "SELECT * FROM `wyy` where $str order by id desc";
}

$result = mysql_query($sql, $conn);
$results = array();
while ($row = mysql_fetch_array($result)){
	$results[] = $row;
}
echo json_encode($results);
mysql_free_result($result);
 
mysql_close($conn);
?>