<?php 
require('myfuncs.php');
require('myvars.php');

myheader("Login");
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

<p>Fill in the form below to log into the system.</p>
<p>After you log in, you will be able to see blog entries and to
create new ones!</p>
<?php
if ($debug) {
  print "<form method=\"post\" action=\"${https_url}/process_login.php?debug=1\">\n";
 }
 else {
  print "<form method=\"post\" action=\"${https_url}/process_login.php\">\n";
 }
?>
<table>
<tr>
<td class="form-label">Username</td>
<td><input type="text" name="username" /></td>
</tr>
<tr>
<td class="form-label">Password</td>
<td><input type="password" name="password" /></td>
</tr>
</table>
<p><input type="submit" value="Login" /></p>
</form>
<?
myfooter()
?>
