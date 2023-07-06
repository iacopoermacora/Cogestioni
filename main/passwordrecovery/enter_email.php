<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';

$errors = [];
$user_id = "";

/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($link, $_POST['email']);
  // ensure that the user exists on our system
  $query = "SELECT email FROM users_cogestione WHERE email='$email'";
  $results = mysqli_query($link, $query);

  if (empty($email)) {
    array_push($errors, "La tua email è richiesta.");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sei sicuro di essere registrato al sito? Non risulta alcun utente con questa email.");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_reset(email, token) VALUES ('$email', '$token')";
    $results = mysqli_query($link, $sql);

    // Send email to user with the token in a link they can click on
    $to = $email;
    $subject = "Resetta la tua password di ".$set['set_intestazione_sito'];
    $msg = '<html>
      <head>
        <meta charset="utf-8">
        <title>Resetta la tua password di '.$set['set_intestazione_sito'].'</title>
      </head>
      <body>
      <p>Ciao, clicca sul seguente link per cambiare la tua password di accesso alla piattaforma!</p>
      </br>
      <a href="https://'.$_SERVER['SERVER_NAME'].'/main/passwordrecovery/new_password.php?token=' . $token . '">CLICCA QUI</a>
      </br>
      <p><b>Cerca di non dimenticarla più!</b><p>
      </br>
      <p>Hai ricevuto questa email e non hai richiesto tu di reimpostare la password? Non ti preoccupare, la tua password è al sicuro, solo tu puoi cambiarla, quindi ignora semplicemente questa email!</p>
      </br>
      </body>
    </html>';
    $msg = wordwrap($msg,11000);
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: support@".$_SERVER['SERVER_NAME'];
    mail($to, $subject, $msg, $headers);
    header('location: /main/passwordrecovery/passwordforget.php?email=' . $email);
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
	  <title><?php echo $set['set_intestazione_sito']; ?> - Cambia Password</title>

		<div class="spazietto_sotto margine_sopra center">
		    <div class="wrapper">
		      <div style="border-radius: 30px;" class="z-depth-1 spazietto_sotto spazietto_sopra">
		        <div class="row">
		            <p class="col s10 offset-s1 spazietto_sotto">Inserisci la mail che ci hai fornito per il recupero, ti manderemo un link dal quale potrai resettare la tua password. Se non ci hai fornito la mail o ci hai fornito un indirizzo errato non esiste modo per recuperare il tuo account.</p>
		        </div>
		        <form action="" method="post">
		          <div class="row spazietto_sotto">
                <?php  if (count($errors) > 0) : ?>
                  	<?php foreach ($errors as $error) : ?>
                    <?php echo "<script>alert('".$error."');</script>"; ?>
                  	<?php endforeach ?>
                <?php  endif ?>
          		<div class="col s10 offset-s1 form-group marginetto_sotto">
          			<input placeholder="E mail" class="form-control browser-default input is-rounded" type="email" name="email">
          		</div>
          		<div class="form-group col s12">
          			<button style="border-radius: 20px;" type="submit" name="reset-password" class="btn btn-primary <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">Invia</button>
          		</div>
          	</div>
          </form>
        </div>
      </div>
    </div>
  </div>


<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

	</body>
</html>
