<?php 
require('myfuncs.php');
require('myvars.php');

myheader("View a Blog");

if (($mysql_host == "") ||
    ($https_url == "")) {
  diefooter("Environment variables have not been set");
 }

$blogname = $_GET['blog'];
$cookie = $_COOKIE['auth'];

if ($debug) {
  print "<p>DEBUG: MySQL host: [${mysql_host}]</p>\n";
  print "<p>DEBUG: HTTPS url: [${https_url}]</p>\n";
  print "<p>DEBUG: blog name: [${blogname}]</p>\n";
  print "<p>DEBUG: cookie: [${cookie}]</p>\n";
}

if (($blogname == "") || 
    ($cookie == "")) {
  diefooter("Empty parameter. Aborting...");
}

$db = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
if ($db == false) {
  diefooter(mysqli_connect_error());
 }

$username = checkcookie($db, $cookie);

$st = mysqli_stmt_init($db);

/* Checks if a blog with the specified name exists */
$st = mysqli_prepare($db, "SELECT owner FROM blogs WHERE blogname=?");

if ($st == false) {
  diefooter(mysqli_error($db));
}

$rs = mysqli_stmt_bind_param($st, "s", $blogname);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

mysqli_stmt_store_result($st);

if (mysqli_stmt_num_rows($st) != 1) {
  diefooter("<p>Could not find a blog with the specified name.</p>");
}

/* Checks if the blog belongs to the user */
mysqli_stmt_bind_result($st, $owner);
mysqli_stmt_fetch($st);

if ($debug) {
  print "<p>Showing blog \"${blogname}\" owned by \"${owner}\" to user \"${username}\"";
 }

$show_all = 0;
if ($owner == $username) {
  $show_all = 1;
 }

/* Retrieves the entries */
$st = mysqli_prepare($db, "SELECT author, title, entry, shared FROM entries WHERE blogname=?");

if ($st == false) {
  diefooter(mysqli_error($db));
}

$rs = mysqli_stmt_bind_param($st, "s", $blogname);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

mysqli_stmt_store_result($st);

/* Checks if the blog belongs to the user */
mysqli_stmt_bind_result($st, $author, $title, $entry, $shared);

print "<dl>";

while (mysqli_stmt_fetch($st)) {
  if ($shared || $show_all || $author == $username) {
    print "<dt>${title}, by ${author}</dt>";
    print "<dd>${entry}</dd>";
  }
 }

mysqli_stmt_close($st);
mysqli_close($db);

myfooter();

?>
