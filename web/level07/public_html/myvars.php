<?php

$mysql_host = "localhost";
$mysql_user = "root";
$mysql_password = "DATABASEPASSWORD";
$mysql_db = "bloggo";
#$https_url = "https://192.168.1.107/bloggo";
$https_url = ".";

if (isset($_GET['debug'])) {
  $debug = true;
 } else {
  $debug = false;
 }
/* $debug= true; */
?>
