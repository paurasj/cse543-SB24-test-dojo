<?php 
require('myfuncs.php');
require('myvars.php');

myheader("Search Blog Entries");
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
<p>Search the existing blogs for entries that contain a specific keyword.</p>
<?php
if ($debug) {
  print "<form method=\"post\" action=\"${https_url}/process_search.php?debug=1\">";
 } else {
  print "<form method=\"post\" action=\"${https_url}/process_search.php\">";
 }
?>
<table>
<tr>
<td class="form-label">Keyword</td>
<td><input type="text" name="keyword" /></td>
</tr>
</table>
<p><input type="submit" value="Search" /></p>
  </form>
<?php
  myfooter();
?>
