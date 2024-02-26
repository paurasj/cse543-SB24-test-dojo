<?php
require('myfuncs.php');
require('myvars.php');
$username = $_POST['username'];
$password = $_POST['password'];
$token = rand();
$expiration = time()+7200;
$cookie = md5("${username}:${password}:${expiration}:${token}");
/* This has to happen before the header is generated */
/* setcookie("auth", $cookie, $expiration, "/", "", 1); */
/* Changed needed by the non-SSl version */
setcookie("auth", $cookie, $expiration, "/", "", 0);
myheader("Login");

if ($debug) {
  print "<p>DEBUG: MySQL host: ${mysql_host}</p>\n";
  print "<p>DEBUG: HTTPS url: ${https_url}</p>\n";
  print "<p>DEBUG: username: ${username}</p>\n";
  print "<p>DEBUG: password: ${password}</p>\n";
  print "<p>DEBUG: cookie: ${cookie}</p>\n";
}

$db = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

if ($db == false) {
  diefooter(mysqli_connect_error());
}

$st = mysqli_stmt_init($db);

$st = mysqli_prepare($db, "SELECT * FROM users WHERE username=? AND password=?");
if ($st == false) {
  diefooter(mysqli_error($db));
}
$rs = mysqli_stmt_bind_param($st, "ss", $username, $password);
  
if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
}
$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }
mysqli_stmt_store_result($st);
if (mysqli_stmt_num_rows($st) == 0) {
  diefooter("<p>Username/password combination is invalid.</p>");
 }

print "<p>User successfully authenticated.</p>";

$st = mysqli_prepare($db, "UPDATE users SET cookie=? WHERE username=?");
if ($st == false) {
  diefooter(mysqli_error($db));
}

$rs = mysqli_stmt_bind_param($st, "ss", $cookie, $username);

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
