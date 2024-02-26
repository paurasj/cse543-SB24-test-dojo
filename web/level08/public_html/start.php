<?php
	$username = $_POST['username'];
	$password = $_POST['password'];

	if ($username == 'admin') {
		header('Location: 2factor.php');
		die();
	}
	$authenticated = false;
	$fh = fopen("/tmp/level09/auth", "r");
	while (($line = fgets($fh)) != false) {
        $res = explode(":", $line);
        $auth_user = trim($res[0]);
        $auth_pass = trim($res[1]);
        if ($auth_user == $username) {
        	if ($auth_pass == $password) {
        		$authenticated = true;
        	}
        	else {
        		print "Wrong password!";
        		die();
        	}
        	break;
        }
    }
    fclose($fh);
    if ($authenticated) {
    	print "Successfully authenticated!";
    	die();
    }
    else {
    	$fh = fopen("/tmp/level09/auth", "a");
    	fwrite($fh, $username . ":" . $password . "\n");
 		fclose($fh);
    	print "User database updated";
    	die();
    }

?>