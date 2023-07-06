<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'login');

$sql = "SELECT * FROM users_cogestione WHERE id = '".$_SESSION['id_coge']."'";
$request = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($request);
  if ($row['passwordchanged'] == 'SI') {
    header('location: /index');
  }

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
$email = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = mysqli_real_escape_string($link, $_POST["email"]);
    $sql = "SELECT * FROM users_cogestione WHERE email = '".$email."'";
    $result = mysqli_query($link, $sql);
    $email_already = mysqli_num_rows($result);

    if(empty(trim($_POST["email"]))){
        $email_err = "<script>alert('Inserisci la email');</script>";
    }
    if($email_already != 0){
        $email_err = "<script>alert('La email che hai inserito è già presente nel database: scegline un altra.');</script>";
    }

    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "<script>alert('Inserisci la nuova password');</script>";
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "<script>alert('La Password deve avere almeno 6 caratteri.');</script>";
    } else{
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "<script>alert('Ricordati di confermare la password!');</script>";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "<script>alert('Uh, oh, le Password non coincidono');</script>";
        }
    }

    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err) && empty($email_err)){
        // Prepare an update statement
        $sql = "UPDATE users_cogestione SET email = '".$email."', password = ?, passwordchanged = 'SI' WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id_coge"];

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: /main/system/login?m=yes");
                exit();
            } else{
                echo "<script>alert('Oops! Qualcosa è andato storto, riprova più tardi!')</script>";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body>

  <title><?php echo $set['set_intestazione_sito']; ?> - Cambia Password</title>

    <div class="navbar-fixed">
    <nav class="<?php echo $set['set_colore_base']; ?> z-depth-0">
      <div class="nav-wrapper">
        <a href="/index" class="brand-logo center <?php echo $set['set_colore_base_scritte']; ?>-text"><?php echo $set['set_intestazione_sito']; ?></a>
      </div>
    </nav>
    </div>

<!--Hero inizio-->

<div class="hero_and_content">
    <section class="hero" style="background-color: white;">
            <div class="hero-inner">
              <div class="container">
                <h5 class="black-text">Cambia la password, <?php echo $_SESSION['username_coge']; ?>!</h1>
                <h6 class="black-text">Quando effettui per la prima volta il login, ti viene chiesto di inserire una password scelta da te, che sostituirà quella che ti è stata consegnata.</h6>
                <h6 class="black-text">Ti verrà anche richiesto di inserire una mail, servirà nel caso dovessi recuperare la password. <b>Se la inserisci errata non ci sarà altro modo per recuperare la password.</b></h6>
                <h6 class="black-text">Una volta effettuato il cambio password ti verrà chiesto di effettuare nuovamente il login con la nuova password da te scelta</h6>
                <h6 class="black-text">Scorri in fondo alla pagina per cambiare password.</h6>
              </div>
            </div>
        </section>
  </div>
  <div class="container spazietto_sotto center">
  <div class="wrapper">
    <div style="border-radius: 15px;" class="z-depth-1 spazietto_sotto spazietto_sopra">
      <div class="row">
  <p class="col s10 offset-s1 spazietto_sotto">Compila questo modulo per cambiare la tua password e impostare la mail di recupero.</p>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row spazietto_sotto">
          <div class="col s6 offset-s3 form-group marginetto_sotto <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
              <label class="black-text">Nuova Password (min 6 caratteri)</label>
              <input type="password" name="new_password" class="browser-default input is-rounded" value="<?php echo $new_password; ?>">
              <span class="help-block"><?php echo $new_password_err; ?></span>
          </div>
          <div class="col s6 offset-s3 form-group marginetto_sotto <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
              <label class="black-text">Conferma Password (min 6 caratteri)</label>
              <input type="password" name="confirm_password" class="browser-default input is-rounded">
              <span class="help-block"><?php echo $confirm_password_err; ?></span>
          </div>
          <div class="col s6 offset-s3 form-group">
              <label class="black-text">Email di recupero</label>
              <input type="email" name="email" class="browser-default input is-rounded">
              <span class="help-block"><?php echo $email_err; ?></span>
          </div>
        </div>
          <div class="form-group">
              <input style="border-radius: 25px;" type="submit" class="btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" value="Cambia Password">
          </div>
      </form>
    </div>
  </div>
</div>
</div>

<!--Hero fine-->

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>
</html>
