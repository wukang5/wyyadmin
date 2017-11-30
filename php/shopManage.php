<?php
	require_once "upImg.php";
	$goodsName = $_POST["goodsName"];
	$goodsType = $_POST["goodsType"];
	$itemInfo = $_POST["itemInfo"];
	$introduce = $_POST["introduce"];
	$price = $_POST["price"];
	$imgPath = substr($rows[0]["path_name"],3);
	require_once "conn.php";
	$sql = "INSERT INTO `wyy_shopgoods` (`goodsName`,`goodsType`,`itemInfo`,  `images`,`introduce`,`price`) VALUES ('$goodsName', '$goodsType', '$itemInfo', '$imgPath','$introduce','$price')";
	$stmt = mysql_query($sql);
	if ($stmt === false) {
		echo "false";
	} else {
		echo "true";
	}
	mysql_close();

?>