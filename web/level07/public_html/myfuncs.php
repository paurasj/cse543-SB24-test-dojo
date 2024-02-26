<?php 

function myheader($title) 
{
  print "<html>\n";
  print "  <head>\n";
  print "    <link href=\"/bloggo.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
  print "    <title>bloggo::${title}</title>\n";
  print "  </head>\n";
  print "  <body>\n";
  print "    <div id=\"page\">\n";
  print "      <div id=\"header\">\n";
  print "        <h1>bloggo::${title}</h1>\n";
  print "      </div>\n";
  print "      <div id=\"navigation\">\n";
  print "        <ul>";
  print "          <li id=\"home\"><a href=\"index.php\">Home</a></li>\n";
  print "          <li id=\"login\"><a href=\"login.php\">Login</a></li>\n";
  print "          <li id=\"newuser\"><a href=\"createuser.php\">New user</a></li>\n";
  print "          <li id=\"newblog\"><a href=\"createblog.php\">New blog</a></li>\n";
  print "          <li id=\"newentry\"><a href=\"blogentry.php\">New entry</a></li>\n";
  print "          <li id=\"view\"><a href=\"view.php\">View blogs</a></li>\n";
  print "          <li id=\"search\"><a href=\"search.php\">Search blogs</a></li>\n";
  print "          <li id=\"logout\"><a href=\"logout.php\">Logout</a></li>\n";
  print "        </ul>\n";
  print "      </div>\n";
  print "      <div id=\"body\">\n"; 
}

function myfooter() {
  print "      </div>\n";
  print "      <div id=\"footer\">\n";
  print "        <hr />\n";
  print "        [<a href=\"index.php\">Home</a>]<br />\n";
  print "      </div>\n";
  print "    </div>\n";
  print "  </body>\n";
  print "</html>\n";
}


function diefooter($msg) {
  print "<p><b>An error occurred:</b></p>\n";
  print "<p>${msg}</p>\n";
  myfooter();
  die();
}

function checkcookie_old($db, $cookie) {
	$st = "SELECT username FROM users WHERE cookie = '$cookie'";
	$rs = mysql_query($st);
	if (mysql_num_rows($rs) != 1) {
 		diefooter("<p>Error in the credential verification process.</p>\n<p>Please login with username and password.</p>");
	}
	$username = $rs{'username'};
	mysql_free_result($rs);

	return $username;
}

function checkcookie($db, $cookie) {
  $debug = 0;
  
  if ($debug) {
    print "<p>DEBUG: cookie: ${cookie}</p>";
  }
  $st = mysqli_prepare($db, "SELECT username FROM users WHERE cookie=?"); 

  if ($st == false) {
    diefooter(mysqli_stmt_error($st));
  }

  $rs = mysqli_stmt_bind_param($st, "s", $cookie);

  if ($rs == false) {
    diefooter(mysqli_stmt_error($st));
  }
  
  $rs = mysqli_stmt_execute($st);
  
  if ($rs == false) {
    diefooter(mysqli_stmt_error($st));
  }

  mysqli_stmt_store_result($st);

  if (mysqli_stmt_num_rows($st) != 1) {
    diefooter("<p>Error in the credential verification process.</p>\n<p>Please login with username and password.</p>");
  }

  mysqli_stmt_bind_result($st, $username);
  
  mysqli_stmt_fetch($st);

  return $username;
}

?>
