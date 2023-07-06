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

$id = mysqli_real_escape_string($link, $_POST['id']);
$ruolo = mysqli_real_escape_string($link, $_POST['ruolo']);

$sql = "SELECT * FROM users_cogestione WHERE id = ".$id;
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

$ruolo_pre = explode("_",$row['ruolo']);
$ruolo_post = explode("_",$ruolo);

if ($ruolo_pre[0]!=$ruolo_post[0]) {
  echo 'change_role_error';
} else {
  $sql = "UPDATE users_cogestione SET ruolo = '".$ruolo."' WHERE id = ".$id;
  if (mysqli_query($link, $sql)) {
    $sql = "DELETE FROM token_login WHERE id_user = ".$id;
    if (mysqli_query($link, $sql)) {
    echo 'success';
    }
  }
}
?>
