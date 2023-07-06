<?php
if ($_SESSION['loggedin_coge'] != true) {
if(isset($_COOKIE['usrlgn'])) {

    $token_cookie = mysqli_real_escape_string($link, $_COOKIE["usrlgn"]);
    $sql = "SELECT * FROM token_login WHERE token = '$token_cookie'";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_assoc($result)) {

    $token_id = $row['id_user'];

    $sql = "DELETE FROM token_login WHERE id_user = $token_id";
    if (mysqli_query($link, $sql)) {

$sql = "SELECT * FROM users_cogestione WHERE id = $token_id";
  $result = mysqli_query($link, $sql);
  if ($row = mysqli_fetch_assoc($result)) {

  session_start();

  $_SESSION["loggedin_coge"] = true;
  $_SESSION["id_coge"] = $row['id'];
  $_SESSION["username_coge"] = $row['username'];;
  $_SESSION["ruolo_coge"] = $row['ruolo'];

  $id = $row['id'];

  $cookie_value = bin2hex(openssl_random_pseudo_bytes(50));

  $sql = "INSERT INTO token_login (id_user, token) VALUES ('$id', '$cookie_value')";
  if(mysqli_query($link, $sql)){
    setcookie('usrlgn', $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
  }

    }
    }
    }

}
}
 ?>
