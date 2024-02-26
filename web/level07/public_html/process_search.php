<?php 
require('myfuncs.php');
require('myvars.php');

myheader("Search Blog Entries");

if (($mysql_host == "") ||
    ($https_url == "")) {
  diefooter("Environment variables have not been set");
 }

$keyword = $_POST['keyword'];
$cookie = $_COOKIE['auth'];
$search = "${keyword}";

if ($debug) {
  print "<p>DEBUG: MySQL host: [${mysql_host}]</p>\n";
  print "<p>DEBUG: HTTPS url: [${https_url}]</p>\n";
  print "<p>DEBUG: keyword: [${keyword}]</p>\n";
  print "<p>DEBUG: search: [${search}]</p>\n";
  print "<p>DEBUG: cookie: [${cookie}]</p>\n";
}

if (($keyword == "") || 
    ($cookie == "")) {
  diefooter("Empty parameter. Aborting...");
}

$db = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

if ($db == false) {
  diefooter(mysqli_connect_error());
 }

$username = checkcookie($db, $cookie);

/* Retrieves the entries */
$st = mysqli_prepare($db, "SELECT author, blogname, title, entry, shared FROM entries WHERE MATCH(keywords) AGAINST (? IN BOOLEAN MODE)");

if ($st == false) {
  diefooter("Search SQL statement failed");
}

$rs = mysqli_stmt_bind_param($st, "s", $search);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

mysqli_stmt_store_result($st);

/* Checks if the blog belongs to the user */
mysqli_stmt_bind_result($st, $author, $blogname, $title, $entry, $shared);

print "<dl>";
while (mysqli_stmt_fetch($st)) {
	if ($shared) {
		print "<dt>${title} by ${author}, in blog ${blogname}</dt>";
		print "<dd>${entry}</dd>";
	}
}
print "</dl>";

mysqli_stmt_close($st);
mysqli_close($db);

myfooter();

?>
