<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'login');

    //Permette l'accesso solo tramite ajax
    if(!$_SERVER['HTTP_X_REQUESTED_WITH'])
    {
       header('location: /403.shtml');
       exit;
    }


$id = mysqli_real_escape_string($link, $_POST['id']);
$turno = mysqli_real_escape_string($link, $_POST['turno']);
$iduser = mysqli_real_escape_string($link, $_SESSION['id_coge']);

$sql = "SELECT spazio FROM collettivi WHERE id = ".$id;
$request = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($request);

$spazio = mysqli_real_escape_string($link, $row['spazio']);

if ($set['set_status_cogestione'] == 'cogestione_open') {

$sql = "SELECT * FROM users_cogestione WHERE id = ".$iduser;
$request = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($request);

if ($row['ruolo'] == 'professore' || $row['ruolo'] == 'professore_admin') {
$ruolo = 'prof_';
} else {
$ruolo = ''; }

for ($i=1; $i <= $set['set_turni_totali']; $i++)
{
  if($turno == 't'.$i){
  if($row['t'.$i] == '0' && ($set['set_unlimited_spazio_'.$spazio] == 0 || $ruolo == 'prof_')){
    $sql = "UPDATE collettivi set ".$ruolo."t".$i." = ".$ruolo."t".$i." - 1 WHERE id = '".$id."' AND ".$ruolo."t".$i." > 0";
    mysqli_query($link, $sql);
    if (mysqli_affected_rows($link) > 0) {
        $sql = "UPDATE users_cogestione SET t".$i." = '".$id."' WHERE id = '".$iduser."'";
        if (mysqli_query($link, $sql)) {
          echo 'iscritto';
        exit; }} else {
          echo 'posti_finiti';
        }

  } elseif ($row['t'.$i] == '0' && $set['set_unlimited_spazio_'.$spazio] == 1 && $ruolo == '') {
    $sql = "UPDATE users_cogestione SET t".$i." = '".$id."' WHERE id = '".$iduser."'";
    if (mysqli_query($link, $sql)) {
      echo 'iscritto';
    exit; }
  } elseif ($row['t'.$i] != '0') {
    echo 'gia_iscritto';
  }}}
} else {
  echo 'closed';
}

?>
