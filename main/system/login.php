<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin_coge"]) && $_SESSION["loggedin_coge"] === true){
    header("location: /index");
    exit;
}


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Inserisci username";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Inserisci password";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, ruolo FROM users_cogestione WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $ruolo);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            if(!isset($_SESSION))
                              {
                                session_start();
                              }

                            // Store data in session variables
                            $_SESSION["loggedin_coge"] = true;
                            $_SESSION["id_coge"] = $id;
                            $_SESSION["username_coge"] = $username;
                            $_SESSION["ruolo_coge"] = $ruolo;

                            if($_POST["remember_me"] == true){

                            $sql = "DELETE FROM token_login WHERE id_user = $id";
                            if (mysqli_query($link, $sql)) {

                              $cookie_value = bin2hex(openssl_random_pseudo_bytes(50));

                              $sql = "INSERT INTO token_login (id_user, token) VALUES ($id, '$cookie_value')";
                              if(mysqli_query($link, $sql)){
                                setcookie('usrlgn', $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                                header('location: /main/system/changepassword');
                              }
                              }

                            } else {

                            $sql = "DELETE FROM token_login WHERE id_user = $id";
                            mysqli_query($link, $sql);

                            header('location: /main/system/changepassword');
                          }

                        } else {
                            // Display an error message if password is not valid
                            $password_err = "La password che hai inserito non è valida.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "Errore: non esiste un account con quell'username";
                }
            } else{
                echo "Oops! Qualcosa è andato storto, riprova più tardi!";
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

  <title><?php echo $set['set_intestazione_sito']; ?> - Login</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/navbar_general.php'; ?>

<div class="container" style:"margin-bottom: 4em;">

<div class="spazietto_sotto margine_sopra center">
    <div class="wrapper">
      <div style="border-radius: 30px;" class="z-depth-1 spazietto_sotto spazietto_sopra">
        <div class="row">
        <p class="col s10 offset-s1 spazietto_sotto"><?php if ($_GET['m'] == 'yes') { ?>
        Inserisci la password che hai scelto per accedere alla piattaforma della <?php echo $set['set_nome_cogestione']; ?>!
      <?php } else { ?>
        Inserisci le credenziali per la <?php echo $set['set_nome_cogestione']; ?> che ti sono state fornite per poterti iscrivere!
        <?php } ?></p>
      </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="row spazietto_sotto">
            <div class="marginetto_sotto col s10 offset-s1 form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input placeholder="Username" type="text" name="username" class="form-control browser-default input is-rounded" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="col s10 offset-s1 form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input placeholder="Password" type="password" name="password" class="form-control browser-default input is-rounded">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <p class="col s10 offset-s1 form-group">
              <label>
                <input name="remember_me" type="checkbox" checked="checked" />
                <span>Ricordami</span>
              </label>
            </p>
          </div>
            <div class="form-group">
                <input style="border-radius: 20px;" type="submit" class="btn btn-primary <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" value="Login">
            </div>
        </form>
        <p>Hai dimenticato la password? <a href="/main/passwordrecovery/enter_email.php">Clicca qui!</a></p>
        </div>
    </div>
    </div>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>
</html>
