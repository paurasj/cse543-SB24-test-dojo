#!/usr/bin/php-cgi
<?php 
require('myfuncs.php');

myheader("Debug");

print "<p>Connecting to database...</p>\n";

$db = mysqli_connect("localhost", "root", "blah23", "bloggo");
if ($db == false) {
  diefooter(mysqli_connect_error());
}

print "<h2>Users</h2>";

$rs = mysqli_query($db, "SELECT * FROM users");

print "<table border=\"1\">";
print "<thead>";
print "<tr><td>username</td>";
print "<td>password</td>";
print "<td>firstname</td>";
print "<td>lastname</td>";
print "<td>email</td>";
print "<td>cookie</td></tr>";
print "</thead>";
print "<tbody>";
while ($row = mysqli_fetch_assoc($rs)) {

    print "<tr><td><tt>${row['username']}</tt></td>";
    print "<td><tt>${row['password']}</tt></td>";
    print "<td><tt>${row['firstname']}</tt></td>";
    print "<td><tt>${row['lastname']}</tt></td>";
    print "<td><tt>${row['email']}</tt></td>";
    print "<td><tt>${row['cookie']}</tt></td></tr>";
} 
print "</tbody>";
print "</table>";
mysqli_free_result($rs);


print "<h2>Blogs</h2>";

$rs = mysqli_query($db, "SELECT * FROM blogs");

print "<table border=\"1\">";
print "<thead>";
print "<tr>";
print "<td>owner</td>";
print "<td>blogname</td>";
print "<td>password</td>";
print "</thead>";
print "<tbody>";

while ($row = mysqli_fetch_assoc($rs)) {
     print "<td><tt>${row['owner']}</tt></td>";
     print "<td><tt>${row['blogname']}</tt></td>";
     print "<td><tt>${row['password']}</tt></td></tr>";
 } 
print "</tbody>";
print "</table>";
mysqli_free_result($rs);

print "<h2>Entries</h2>";

$rs = mysqli_query($db, "SELECT * FROM entries");

print "<table border=\"1\">";
print "<thead>";
print "<tr><td>id</td>";
print "<td>author</td>";
print "<td>blogname</td>";
print "<td>title</td>";
print "<td>keywords</td>";
print "<td>entry</td>";
print "<td>shared</td></tr>";
print "</thead>";
print "<tbody>";
while ($row = $rs->fetch_assoc()) {
    print "<tr><td><tt>${row['id']}</tt></td>";
    print "<td><tt>${row['author']}</tt></td>";
    print "<td><tt>${row['blogname']}</tt></td>";
    print "<td><tt>${row['title']}</tt></td>";
    print "<td><tt>${row['keywords']}</tt></td>";
    print "<td><tt>${row['entry']}</tt></td>";
    print "<td><tt>${row['shared']}</tt></td></tr>";
} 
print "</tbody>";
print "</table>";
mysqli_free_result($rs);

mysqli_close($db);

myfooter();
?>
