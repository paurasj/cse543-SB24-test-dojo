<?php
require('myfuncs.php');
require('myvars.php');

myheader("Logout");

$cookie = $_COOKIE['auth'];

if (($mysql_host == "") ||
    ($https_url == "")) {
  diefooter("Environment variables have not been set");
 }

if ($debug) {
  print "<p>DEBUG: MySQL host: ${mysql_host}</p>\n";
  print "<p>DEBUG: HTTPS url: ${https_url}</p>\n";
  print "<p>DEBUG: cookie: ${cookie}</p>\n";
}

$db = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
if ($db == false) {
  diefooter(mysqli_connect_error());
}

$username = checkcookie($db, $cookie);

$st = mysqli_stmt_init($db);

$st = mysqli_prepare($db, "UPDATE users SET cookie=NULL WHERE username=?");

if ($st == false) {
  diefooter(mysqli_error($db));
}
$rs = mysqli_stmt_bind_param($st, "s", $username);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
}

$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
}

mysqli_stmt_close($st);
mysqli_close($db);

myfooter();
?>
