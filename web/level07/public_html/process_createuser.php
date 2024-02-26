<?php 
require('myfuncs.php');
require('myvars.php');
myheader("Create User");
if (($mysql_host == "") ||
    ($https_url == "")) {
  diefooter("Environment variables have not been set");
 }
$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
if ($debug) {
  print "<p>DEBUG: HTTPS url: [${https_url}]</p>\n";
  print "<p>DEBUG: username: [${username}]</p>\n";
  print "<p>DEBUG: password: [${password}]</p>\n";
  print "<p>DEBUG: firstname: [${firstname}]</p>\n";
  print "<p>DEBUG: lastname: [${lastname}]</p>\n";
  print "<p>DEBUG: email: [${email}]</p>\n";
}
if (($username == "") || 
    ($password == "") ||
    ($firstname == "") || 
    ($lastname == "") || 
    ($email == "")) {
  diefooter("Empty parameter. Aborting...");
}
$db = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
if ($db == false) {
  diefooter(mysqli_connect_error());
 }

/* Checks if a user exists */
$query = "SELECT * FROM users WHERE username='" . $username . "'";

/* print "<p>Executing query [$query]</p>"; */

$rs = mysqli_query($db, $query); 
if ($rs == false) {
   diefooter("Failed to execute query: " . $query);
}
/* print "I received " . mysqli_num_rows($rs) . " results"; */

if (mysqli_num_rows($rs) > 0) {
   print "<p>We found users already registerd with this name</p>";
   while ($db_field = mysqli_fetch_assoc($rs) ) {
   	 print "<p>Username: " . $db_field['username'] . "</p>";   
   	 print "<p>First: " . $db_field['firstname'] . "</p>";   
   	 print "<p>Last: " . $db_field['lastname'] . "</p>";
   }   
   diefooter("<p>A user with the specified name already exists.</p>");
}


$st = mysqli_stmt_init($db);

/* $st = mysqli_prepare($db, "SELECT * FROM users WHERE username=?");
if ($st == false) {
  diefooter("Failed to prepare statement");
}

$rs = mysqli_stmt_bind_param($st, "s", $username);
if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
}

$rs = mysqli_stmt_execute($st);
if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
}

mysqli_stmt_store_result($st);
if (mysqli_stmt_num_rows($st) != 0) {
  diefooter("<p>A user with the specified name already exists.</p>");
}
*/

/* Inserts the user */
$st = mysqli_prepare($db, "INSERT INTO users (username, password, firstname, lastname, email) VALUES (?, ?, ?, ?, ?)");

if ($st == false) {
  diefooter(mysqli_stmt_error($db));
}

$rs = mysqli_stmt_bind_param($st, "sssss", $username, $password, $firstname, $lastname, $email);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
}

$rs = mysqli_stmt_execute($st);

if ($rs == false) {
  diefooter(mysqli_stmt_error($st));
}

print "<p>User successfully created!</p>";

mysqli_stmt_close($st);
mysqli_close($db);

myfooter();

?>
