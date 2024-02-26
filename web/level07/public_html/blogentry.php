<?php 
require('myfuncs.php');
require('myvars.php');

myheader("Create Blog Entry");
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

<p>Post a new blog entry!</p>
<p>Fill in the blog name and the password 
you chose when the blog was first created.</p> 
<p>Then,  provide a title and some keywords that will help when other
users are searching for specific content.</p>
  <p>Finally, compose the entry and decide if this entry will be shared with the rest of the world or will be accessible to you only.</p>

<?php
if ($debug) {
  print "<form method=\"post\" action=\"${https_url}/process_blogentry.php?debug=1\">";
 } else {
  print "<form method=\"post\" action=\"${https_url}/process_blogentry.php\">";
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
<tr>
<td class="form-label">Title</td>
<td><input type="text" name="title" /></td>
</tr>
<tr>
<td class="form-label">Keywords</td>
<td><input type="text" name="keywords" /></td>
</tr>
<tr>
<td class="form-label">Shared</td>
<td><input type="radio" name="shared" value="yes" checked /> Yes<br/>
<input type="radio" name="shared" value="no"/> No</td>
</tr>
<tr>
<td class="form-label-noalign" colspan="2">Text<br/>
<textarea rows="10" cols="40" name="entry"></textarea>
</td>
</tr>
</table>
  <p><input type="submit" value="Create Entry" /></p>
  </form>
<?php
  myfooter();
?>
