<?php

if (!isset($_POST['factor'])) {
	?>
	<form action="2factor.php" method="post">
	<p>2FA: <input type="text" name="factor" size=12 /></p>
	<p><input type="submit" value="Submit"/></p>
	</form>
	<?php
	die();
}
else {
	if ($_POST['factor'] != "999999999") {
		header('Location: begin.html');
	}
}
$data = base64_encode(file_get_contents("/challenge/auth"));
print $data;
?>
