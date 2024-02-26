<?php
session_start();

// polyfill the str_contains function
// src: https://www.php.net/manual/en/function.str-contains.php
if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && strpos($haystack, $needle) !== false;
    }
}

if (!isset($_SESSION['username'])) {
   if (!isset($_POST['username']) || !isset($_POST['password'])) {
     echo "<p>Missing parameters</p>";
     exit(0);
   }
   $_SESSION['username'] = $_POST['username'];
   $_SESSION['password'] = $_POST['password'];
   echo "<p>Welcome " . $_SESSION['username'] . "</p>";
   $nonce = rand();
   $_SESSION['nonce'] = $nonce;
?>
   <form action="/cgi-bin/it.php" method="post">
   <p>File: <input type="text" name="filename" /></p>
   <p>Data: <input type="text" name="data" /></p>
   <p><input type="submit" value="Submit"></p>
<?php
   echo "<p><input type=\"hidden\" name=\"nonce\" value=\"" . $nonce . "\" /></p>";
   echo "</form>";
   exit(0);
}
   if (isset($_POST['nonce']) && !isset($_POST['readmode'])) {
     if ($_POST['nonce'] != $_SESSION['nonce']) {
      	 echo "<p>Wrong nonce</p>";
	       exit(0);
       }
       $_SESSION['last_filename'] = basename($_POST['filename']);
       $f = fopen("/challenge/storage/" . basename($_POST['filename']), "a+");
       fwrite($f, $_POST['data']);
       fclose($f);
?>
<form action="/cgi-bin/it.php" method="post">
   <p><input type="text" name="filename" /></p>
   <p><input type="hidden" name="readmode" value="yes"/></p>
   <p><input type="submit" value="Read" /></p>

<?php
    echo "<p><input type=\"hidden\" name=\"nonce\" value=\"" . $_SESSION['nonce'] . "\" /></p\
>";
      echo "</form>";
	     exit(0);
    }
    if (isset($_POST['nonce']) && isset($_POST['readmode'])) {
      if ($_POST['nonce'] != $_SESSION['nonce']) {
         echo "<p>Wrong nonce</p>";
         exit(0);
       }
       $filename = realpath("/challenge/storage/" . $_POST['filename']);
       if (is_dir($filename)) {
           if (str_contains($filename, "storage")) {
               exit(0);
           }
           $files = array_diff(scandir($filename), array('.', '..'));
           foreach ($files as $key=>$item) {
               echo $item . "<br>";
           }
           exit(0);
       }
       $lines = implode('', file($filename));
       echo $lines;
       exit(0);
    }
    echo "<p>What?</p>"
?>

