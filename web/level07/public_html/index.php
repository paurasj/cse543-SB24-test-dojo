<?php
require('myfuncs.php');
require('myvars.php');

myheader("Home");
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

<p>Welcome to Bloggo, a web-based system to create and share your blog!</p>

<p>With Bloggo, users can finally have a space to let the world know 
about their interests, their personal lives, and the fascinating 
events that might be of interest to friends, family, and the rest 
of the world.</p>

<p>Start blogging right now! Join the million of bloggers that are
shaping the public opinion this very moment!</p>

<p>...and if you are lucky, you might find the secret password of the admin user!</p>

<?php
myfooter();
?>
