<?php // Include config file
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';

$errors = array();
	// ENTER A NEW PASSWORD
	if (isset($_POST['new_password'])) {
	  $new_pass = mysqli_real_escape_string($link, $_POST['new_pass']);
	  $new_pass_c = mysqli_real_escape_string($link, $_POST['new_pass_c']);

	  // Grab to token that came from the email link
	  $token = $_GET['token'];
	  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "La nuova password è richiesta");
	  if ($new_pass !== $new_pass_c) array_push($errors, "Le password non coincidono");
	  if (count($errors) == 0) {
	    // select email address of user from the password_reset table
	    $sql = "SELECT email FROM password_reset WHERE token='$token' LIMIT 1";
	    $results = mysqli_query($link, $sql);
	    $email = mysqli_fetch_assoc($results)['email'];

	    if ($email) {
	      $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
	      $sql = "UPDATE users SET password = '$new_pass' WHERE email='$email'";
	      $results = mysqli_query($link, $sql);
				$sql = "DELETE FROM password_reset WHERE token = '".$token."'";
				$results = mysqli_query($link, $sql);
	      header('location: /main/system/login.php');
	    } else {
			array_push($errors, "Ciao, o hai copiato male il link o sei finito qui per sbaglio, torna a controllare");
			}
	  }
	}
	?>
<html lang="en">
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>
	<meta charset="UTF-8">
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/navbar_general.php'; ?>

	<div class="container" style:"margin-bottom: 4em;">
	  <title><?php echo $set_intestazione_sito; ?> - Cambia Password</title>


	<div class="spazietto_sotto margine_sopra center">
	    <div class="wrapper">
	      <div style="border-radius: 15px;" class="z-depth-1 spazietto_sotto spazietto_sopra">
	        <div class="row">
	        <p class="col s10 offset-s1 spazietto_sotto">Inserisci la nuova password da usare sul sito.</p>
	      </div>
	        <form action="" method="post">
	          <div class="row spazietto_sotto">
							<div class="col s10 offset-s1 form-group marginetto_sotto">
								<label class="black-text">Nuova Password</label>
								<input class="browser-default input is-rounded" type="password" name="new_pass">
							</div>
							<div class="col s10 offset-s1 form-group">
								<label class="black-text">Conferma la nuova password</label>
								<input class="browser-default input is-rounded" type="password" name="new_pass_c">
							</div>
	          </div>
	            <div class="form-group">
	                <button style="border-radius: 25px;" type="submit" name="new_password" class="btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">Invia</button>
	            </div>
							<?php  if (count($errors) > 0) : ?>
							  	<?php foreach ($errors as $error) : ?>
							    <?php echo "<script>$(document).ready(function() { M.toast({html: '".$error."'}) });</script>"; ?>
							  	<?php endforeach ?>
							<?php  endif ?>
	        </form>
	        </div>
	    </div>
	    </div>

	</div>


	<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

	<!--JavaScript at end of body for optimized loading-->
	<script type="text/javascript" src="/js/materialize.min.js"></script>

	  </body>
	</html>
