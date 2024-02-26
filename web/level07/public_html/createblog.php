<?php 
require('myfuncs.php');
require('myvars.php');

myheader("Create Blog");
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
<p>Create a new blog!</p>
<p>A new blog allows you to share your thoughts with the whole
Internet!</p>

<p>Fill in the blog name, provide a password to limit access to the
  blog, and you're done!</p>
<?php
if ($debug) {
  print "<form method=\"post\" action=\"${https_url}/process_createblog.php?debug=1\">";
 } else {
  print "<form method=\"post\" action=\"${https_url}/process_createblog.php\">";
 }
?>
<table>
<tr>
<td class="form-label">Blog name</td>
<td><input type="text" name="blogname" /></td>
</tr>
<tr>
<td class="form-label">Password</td>
<td><input type="password" name="password" /></td>
</tr>
</table>
  <p><input type="submit" value="Create Blog" /></p>
  </form>
<?php
  myfooter();
?>
