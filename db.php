<?php
$host="localhost"; 
$user="root"; 
$pass=""; 
$db="kuryer";
$mysql = new mysqli($host,$user,$pass,$db);
if ($mysql->connect_error) {
    die("Connection error:" . $mysql->connect_error);
}

$mysql->set_charset("utf8mb4");
?>
