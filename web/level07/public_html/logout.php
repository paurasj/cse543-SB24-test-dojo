<?php 
require('myfuncs.php');
require('myvars.php');

myheader("Logout");

if (($mysql_host == "") ||
    ($https_url == "")) {
  diefooter("Environment variables have not been set");
 }

if ($debug) {
  print "<p>DEBUG: MySQL host: ${mysql_host}</p>\n";
  print "<p>DEBUG: HTTPS url: ${https_url}</p>\n";
 }
?>

<p>Press the logout button to log out from bloggo.</p>

<p>After you log out, you will need to login again using
the "Login" page in order to acces your blogs.</p>

<?php
if ($debug) {
  print "<form method=\"get\" action=\"${https_url}/process_logout.php?debug=1\">\n";
 }
 else {
   print "<form method=\"get\" action=\"${https_url}/process_logout.php\">\n";
 }
?>

<p><input type="submit" value="Logout" /></p>
</form>
<?php
myfooter();
?>
