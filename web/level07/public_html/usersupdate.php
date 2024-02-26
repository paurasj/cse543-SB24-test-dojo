<?php 
require('myfuncs.php');
require('myvars.php');

if (isset($_GET['filter'])) {
  $filter = "/" . $_GET['filter'] . "/i";
 } else {
  $filter = "";
 }

$db = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

$rs = mysqli_query($db, "SELECT * FROM users");

print "<ul>\n";
while ($row = mysqli_fetch_assoc($rs)) {
  if ($row['cookie'] != "") {
    $username = $row['username'];
    if ($filter == "") {
      print "  <li>${row['username']}</li>\n";
    } else {
      if (preg_match($filter, $username)) {
	print "  <li>${row['username']}</li>\n";
      }
    }
  }
} 
print "</ul>\n";

mysqli_free_result($rs);

mysqli_close($db);
?>
