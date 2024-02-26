<?php 
require('myfuncs.php');
require('myvars.php');

myheader("Create Blog Entry");

if (($mysql_host == "") ||
    ($https_url == "")) {
  diefooter("Environment variables have not been set");
 }

$blogname = $_POST['blogname'];
$password = $_POST['password'];
$title = $_POST['title'];
$keywords = $_POST['keywords'];
$entry = $_POST['entry'];
$shared = $_POST['shared'];
$cookie = $_COOKIE['auth'];

if ($debug) {
  print "<p>DEBUG: MySQL host: [${mysql_host}]</p>\n";
  print "<p>DEBUG: HTTPS url: [${https_url}]</p>\n";
  print "<p>DEBUG: blog name: [${blogname}]</p>\n";
  print "<p>DEBUG: password: [${password}]</p>\n";
  print "<p>DEBUG: title: [${title}]</p>\n";
  print "<p>DEBUG: keywords: [${keywords}]</p>\n";
  print "<p>DEBUG: entry: [${entry}]</p>\n";
  print "<p>DEBUG: shared: [${shared}]</p>\n";
  print "<p>DEBUG: cookie: [${cookie}]</p>\n";
}

if (($blogname == "") || 
    ($password == "") ||
    ($title == "") ||
    ($keywords == "") ||
    ($entry == "") ||
    ($shared == "") ||
    ($cookie == "")) {
  diefooter("Empty parameter. Aborting...");
}

if ($shared =="yes") {
  $shared_flag = 1;
 }
 else {
   $shared_flag = 0;
 }

$db = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
if ($db == false) {
  diefooter(mysqli_connect_error());
 }

$username = checkcookie($db, $cookie);

$st = mysqli_stmt_init($db);

/* Checks if a blog with the specified name/password exists */
$st = mysqli_prepare($db, "SELECT * FROM blogs WHERE blogname=? AND password=?");

if ($st == false) {
  diefooter(mysqli_stmt_error($st));
}

$rs = mysqli_stmt_bind_param($st, "ss", $blogname, $password);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

mysqli_stmt_store_result($st);

if (mysqli_stmt_num_rows($st) != 1) {
  diefooter("<p>Could not find a blog with the specified name and password combination.</p>");
}

/* Checks if a blog entry with the specified blogname/title exists */
$st = mysqli_prepare($db, "SELECT * FROM entries WHERE blogname=? AND title=?");

if ($st == false) {
  diefooter(mysqli_stmt_error($st));
}

$rs = mysqli_stmt_bind_param($st, "ss", $blogname, $title);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

mysqli_stmt_store_result($st);

if (mysqli_stmt_num_rows($st) != 0) {
  diefooter("<p>An entry in the specified blog with the specified title already exists.</p>");
}

/* Insert the entry */
$st = mysqli_prepare($db, "INSERT INTO entries (author, blogname, title, keywords, entry, shared) VALUES (?, ?, ?, ?, ?, ?)");

if ($st == false) {
  diefooter(mysqli_stmt_error($st));
}

$rs = mysqli_stmt_bind_param($st, "sssssi", $username, $blogname, $title, $keywords, $entry, $shared_flag);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
}

$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

print "<p>Blog entry successfully created!</p>";

mysqli_stmt_close($st);
mysqli_close($db);

myfooter();

?>
