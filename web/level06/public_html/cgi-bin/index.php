<html>
  <head>
    <title>Browsers</title></head>
  <body>
  <h1>Personality test</h1>

<?php
if (strlen(stristr($_SERVER['HTTP_USER_AGENT'], "safari")) > 0) {
	include("safari.php");
} else if (strlen(stristr($_SERVER['HTTP_USER_AGENT'], "firefox")) > 0) {
	include("firefox.php");
} else if (strlen(stristr($_SERVER['HTTP_USER_AGENT'], "chrome")) > 0) {
	include("chrome.php");
} else {
	try {
		$filename = $_SERVER['HTTP_USER_AGENT'] . ".php";
		$code = file_get_contents($filename);
		if ($code === FALSE) {
			echo "I cannot figure out your personality: file $filename has no code";
		} else {
			eval($code);
		}
	} catch (Exception $e) {
		echo "I cannot figure out your personality: $e";
	}
}
?>

  </body>
</html>

