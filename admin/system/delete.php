<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

//Permette l'accesso solo tramite ajax
    if(!$_SERVER['HTTP_X_REQUESTED_WITH'])
    {
       header('location: /403.shtml');
       exit;
    }

$id = mysqli_real_escape_string($link, $_GET['id']);
$eliminando = mysqli_real_escape_string($link, $_GET['eliminando']);
$variabile = mysqli_real_escape_string($link, $_GET['variabile']);

if($eliminando == 'collettivo'){
$sql = "UPDATE collettivi SET eliminato='SI' WHERE id = $id";

if (mysqli_query($link, $sql)) {
    $sql = "UPDATE users_cogestione SET t1 = 0 WHERE t1 = $id";
    if (mysqli_query($link, $sql)) {
        $sql = "UPDATE users_cogestione SET t2 = 0 WHERE t2 = $id";
        if (mysqli_query($link, $sql)) {
            $sql = "UPDATE users_cogestione SET t3 = 0 WHERE t3 = $id";
            if (mysqli_query($link, $sql)) {
                $sql = "UPDATE users_cogestione SET t4 = 0 WHERE t4 = $id";
                if (mysqli_query($link, $sql)) {
                    $sql = "UPDATE users_cogestione SET t5 = 0 WHERE t5 = $id";
                    if (mysqli_query($link, $sql)) {
                        $sql = "UPDATE users_cogestione SET t6 = 0 WHERE t6 = $id";
                        if (mysqli_query($link, $sql)) {
                            $sql = "UPDATE users_cogestione SET t7 = 0 WHERE t7 = $id";
                            if (mysqli_query($link, $sql)) {
                                $sql = "UPDATE users_cogestione SET t8 = 0 WHERE t8 = $id";
                                if (mysqli_query($link, $sql)) {
                                    $sql = "UPDATE users_cogestione SET t9 = 0 WHERE t9 = $id";
                                    if (mysqli_query($link, $sql)) {
                                        $sql = "UPDATE users_cogestione SET t10 = 0 WHERE t10 = $id";
                                        if (mysqli_query($link, $sql)) {
                                            $sql = "UPDATE users_cogestione SET t11 = 0 WHERE t11 = $id";
                                            if (mysqli_query($link, $sql)) {
                                                $sql = "UPDATE users_cogestione SET t12 = 0 WHERE t12 = $id";
                                                if (mysqli_query($link, $sql)) {
                                                    $sql = "UPDATE users_cogestione SET t13 = 0 WHERE t13 = $id";
                                                    if (mysqli_query($link, $sql)) {
                                                        $sql = "UPDATE users_cogestione SET t14 = 0 WHERE t14 = $id";
                                                        if (mysqli_query($link, $sql)) {
                                                            $sql = "UPDATE users_cogestione SET t15 = 0 WHERE t15 = $id";
                                                            if (mysqli_query($link, $sql)) {
                                                                $sql = "UPDATE users_cogestione SET t16 = 0 WHERE t16 = $id";
                                                                if (mysqli_query($link, $sql)) {
                                                                    $sql = "UPDATE users_cogestione SET t17 = 0 WHERE t17 = $id";
                                                                    if (mysqli_query($link, $sql)) {
                                                                        $sql = "UPDATE users_cogestione SET t18 = 0 WHERE t18 = $id";
                        if (mysqli_query($link, $sql)) {
                        mysqli_close($link);
                        echo 'success';
                        exit;
}}}}}}}}}}}}}}}}}}}}

if($eliminando == 'utente'){
$sql = "DELETE FROM users_cogestione WHERE id = $id AND id != 0";

if (mysqli_query($link, $sql)) {
    mysqli_close($link);
    echo 'success';
    exit;
}}

if($eliminando == 'all_users'){
$sql = "DELETE FROM users_cogestione WHERE id > 0";

if (mysqli_query($link, $sql)) {
    mysqli_close($link);
    echo 'success';
    exit;
}}

function clean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

if($eliminando == 'total'){
$sql = "DELETE FROM users_cogestione WHERE id > 0";
  if (mysqli_query($link, $sql)) {
    $arr_titoli = [];

    $sql = "SELECT * FROM collettivi WHERE id > 0";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
      if(file_exists($_SERVER['DOCUMENT_ROOT'].'/images/'.$row['immagine_collettivo'])){
          unlink($_SERVER['DOCUMENT_ROOT'].'/images/'.$row['immagine_collettivo']);
        }
    }
    if (mysqli_query($link, $sql)) {
    $sql = "DELETE FROM collettivi WHERE id > 0";
      if (mysqli_query($link, $sql)) {
        $sql = "DELETE FROM risposte_questionario WHERE id > 0";
          if (mysqli_query($link, $sql)) {
            $sql = "DELETE FROM token_login WHERE id > 0";
              if (mysqli_query($link, $sql)) {
              mysqli_close($link);
              echo 'success';
              exit;
}}}}}}
?>
