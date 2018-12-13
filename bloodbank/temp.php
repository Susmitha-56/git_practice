<?php
include_once './config.php';
$sql = "SELECT `username` FROM `blood` WHERE 1";
$result = mysqli_query($db,$sql) or die(mysql_error());
$row = $result->fetch_assoc();
var_dump($result);
var_dump($row);
?>