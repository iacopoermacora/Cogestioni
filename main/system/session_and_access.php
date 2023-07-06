<?php

if(!isset($_SESSION))
    {
        session_start();
    }

function AccessDoor($login, $user_admit){
  if ($login == 'YES') {
    if(isset($_SESSION["loggedin_coge"]) || $_SESSION["loggedin_coge"] == true){
      if ($user_admit == 'studente_admin') {
        if(!isset($_SESSION['ruolo_coge']) || $_SESSION['ruolo_coge'] != 'studente_admin'){
            header("location: /403.shtml");
            exit;
        }
      } elseif ($user_admit == 'professore_admin') {
        if(!isset($_SESSION['ruolo_coge']) || $_SESSION["ruolo_coge"] != 'professore_admin') {
          header("location: /403.shtml");
          exit;
        }
      } elseif ($user_admit == 'studente_admin_and_professore_admin') {
        if(!isset($_SESSION['ruolo_coge']) || ($_SESSION["ruolo_coge"] != 'studente_admin' && $_SESSION["ruolo_coge"] != 'professore_admin')) {
          header("location: /403.shtml");
          exit;
        }
      } elseif ($user_admit == 'studente_admin_and_professore_and_professore_admin') {
        if(!isset($_SESSION['ruolo_coge']) || ($_SESSION["ruolo_coge"] != 'professore' && $_SESSION["ruolo_coge"] != 'professore_admin' && $_SESSION["ruolo_coge"] != 'studente_admin')) {
          header("location: /403.shtml");
          exit;
        }
      } elseif ($user_admit == 'professore_and_professore_admin') {
        if(!isset($_SESSION['ruolo_coge']) || ($_SESSION["ruolo_coge"] != 'professore' && $_SESSION["ruolo_coge"] != 'professore_admin')) {
          header("location: /403.shtml");
          exit;
        }
      } elseif ($user_admit == 'login') {
      } else {
        header("location: /403.shtml");
      }
    } else {
      header("location: /403.shtml");
    }
  } elseif ($login == 'NO'){
    if(isset($_SESSION["loggedin_coge"]) || $_SESSION["loggedin_coge"] == true){
        header("location: /403.shtml");
    }
  }
}
?>
