<?php
header('Access-Control-Allow-Origin:*');
//允许所有来源访问
header('Access-Control-Allow-Method:POST,GET');
//允许访问的方式
echo md5("666666");
?>