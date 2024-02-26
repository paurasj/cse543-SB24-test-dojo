<?php 
require('myfuncs.php');
require('myvars.php');

myheader("View Blogs");
$cookie = $_COOKIE['auth'];

if (($mysql_host == "") || 
    ($https_url == "")) {
  diefooter("Environment variables have not been set");
 }

if ($debug) {
  print "<p>DEBUG: MySQL host: ${mysql_host}</p>\n";
  print "<p>DEBUG: HTTPS url: ${https_url}</p>\n";
  print "<p>DEBUG: Cookie: ${cookie}</p>\n";
 }

?>

<p>Choose the blog you want to read for the list below.</p>
<p>If you don't find the topic you are interested in, you can always
create a new one, by going to the "New blog" page...</p>

<?php
$db = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
if ($db == false) {
  diefooter(mysqli_connect_error());
 }

$st = mysqli_stmt_init($db);

/* Checks if a blog with the specified name/password exists */
$st = mysqli_prepare($db, "SELECT blogname FROM blogs");

if ($st == false) {
  diefooter(mysqli_error($db));
}

$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
 }

mysqli_stmt_store_result($st);

mysqli_stmt_bind_result($st, $blogname);

print "<ul>\n";

while (mysqli_stmt_fetch($st)) {
  if ($debug) {
    print "<li><a href=\"${https_url}/process_view.php?blog=${blogname}&debug=1\">${blogname}</li>\n";
  }
  else {
    print "<li><a href=\"${https_url}/process_view.php?blog=${blogname}\">${blogname}</li>\n";
  }
}
print "</ul>\n";

  myfooter();
?>
