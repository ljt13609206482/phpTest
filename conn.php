<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html;charset=utf-8");
$serverName = "DESKTOP-NB736EQ"; //serverName\instanceName
$connectionInfo = array( "Database"=>"activity", "UID"=>"sa", "PWD"=>"123456");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    echo "连接成功";
}else{
    echo "连接失败";
    die( print_r( sqlsrv_errors(), true));
}
?>