<?php 
require('myfuncs.php');
require('myvars.php');

myheader("Create User");

$cookie = $_COOKIE['auth'];

if ($debug) {
  print "<p>DEBUG: MySQL host: ${mysql_host}</p>\n";
  print "<p>DEBUG: HTTPS url: ${https_url}</p>\n";
  print "<p>DEBUG: Cookie: ${cookie}</p>\n";
 }

if (($mysql_host == "") ||
    ($https_url == "")) {
  diefooter("Environment variables have not been set");
 }

?>
  <p>New to bloggo? No problem!</p>
  <p>Create a new account by filling the form below!</p>
  <p>After creating a new account, please use the login page to 
  log into the system.</p>

<?php
if ($debug) {
  print "<form method=\"post\" action=\"${https_url}/process_createuser.php?debug=1\">";
 } else {
  print "<form method=\"post\" action=\"${https_url}/process_createuser.php\">";
 }
?>

<table>
<tr>
<td class="form-label">First Name</td><td><input type="text" name="firstname" /></td>
</tr>
<tr>
<td class="form-label">Last Name</td><td><input type="text" name="lastname" /></td>
</tr>
<tr>
<td class="form-label">Email</td><td><input type="text" name="email" /></td>
</tr>
<tr>
<td class="form-label">Username</td><td><input type="text" name="username" /></td>
</tr>
<tr>
<td class="form-label">Password</td><td><input type="password" name="password" /></td>
</tr>
</table>
<p><input type="submit" value="Create User" /></p>
  </form>
<?php
  myfooter();
?>
