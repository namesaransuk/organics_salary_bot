<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINE";
$mysql = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($mysql, "utf8");

if ($mysql->connect_error) {
  $errorcode = $mysql->connect_error;
  print("MySQL(Connection)> " . $errorcode);
}
?>