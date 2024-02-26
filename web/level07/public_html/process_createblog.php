<?php 
require('myfuncs.php');
require('myvars.php');

myheader("Create Blog");

if (($mysql_host == "") ||
    ($https_url == "")) {
  diefooter("Environment variables have not been set");
 }

$blogname = $_POST['blogname'];
$password = $_POST['password'];
$cookie = $_COOKIE['auth'];

if ($debug) {
  print "<p>DEBUG: MySQL host: [${mysql_host}]</p>\n";
  print "<p>DEBUG: HTTPS url: [${https_url}]</p>\n";
  print "<p>DEBUG: blog name: [${blogname}]</p>\n";
  print "<p>DEBUG: password: [${password}]</p>\n";
  print "<p>DEBUG: cookie: [${cookie}]</p>\n";
}

if (($blogname == "") || 
    ($password == "") ||
    ($cookie == "")) {
  diefooter("Empty parameter. Aborting...");
}


$db = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
if ($db == false) {
  diefooter(mysqli_connect_error());
}

$username = checkcookie($db, $cookie);

$st = mysqli_stmt_init($db);

/* Checks if a blog with the same name exists */
$query = "SELECT * FROM blogs WHERE blogname='" . $blogname . "'";
$rs = mysqli_query($db, $query); 
if ($rs == false) {
   diefooter("Failed to execute query");
}
if (mysqli_num_rows($rs) > 0) {
   diefooter("<p>A blog with the specified name already exists.</p>");
}

$st = mysqli_prepare($db, "INSERT INTO blogs (owner, blogname, password) VALUES (?, ?, ?)");

if ($st == false) {
  diefooter(mysqli_stmt_error($st));
}

$rs = mysqli_stmt_bind_param($st, "sss", $username, $blogname, $password);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
}

$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
}

print "<p>Blog successfully created!</p>";

mysqli_stmt_close($st);
mysqli_close($db);

myfooter();

?>
