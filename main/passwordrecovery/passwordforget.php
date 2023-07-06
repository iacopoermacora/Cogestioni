<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hai dimenticato la password?</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>

	<form class="login-form" action="/login/login.php" method="post" style="text-align: center;">
		<p>
			Abbiamo mandato una email a <b><?php echo $_GET['email'] ?></b> per aiutarti a recuperare il tuo account.
		</p>
	    <p>Corri alla tua casella di posta elettronica e clicca sul link che ti abbiamo inviato.</p>
	</form>

</body>
</html>
