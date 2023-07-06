<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

$id = mysqli_real_escape_string($link, $_POST['id']);
$turno = mysqli_real_escape_string($link, $_POST['turno']);

$sql = "SELECT * FROM users_cogestione WHERE id = ".$id;
$request = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($request);

if ($_POST['ruolo_servizio'] == 'referente' && $row['ruolo'] != 'professore' && $row['ruolo'] != 'professore_admin') {
  $funzione = '-10001';
  $ruolo = '';
} elseif ($_POST['ruolo_servizio'] == 'SDO' && $row['ruolo'] != 'professore' && $row['ruolo'] != 'professore_admin') {
  $funzione = '-10003';
  $ruolo = '';
} elseif ($_POST['ruolo_servizio'] == 'organizzatore' && $row['ruolo'] != 'professore' && $row['ruolo'] != 'professore_admin') {
  $funzione = '-10004';
  $ruolo = '';
} elseif ($_POST['ruolo_servizio'] == 'fuoriaula' && $row['ruolo'] != 'professore' && $row['ruolo'] != 'professore_admin') {
  $funzione = '-10002';
  $ruolo = '';
} elseif ($_POST['ruolo_servizio'] == 'inservizio' && ($row['ruolo'] == 'professore' || $row['ruolo'] == 'professore_admin')) {
  $funzione = '-10005';
  $ruolo = 'prof_';
} else {
  header('location: /admin/admincogestione');
}

for ($i=1; $i <= $set['set_turni_totali']; $i++)
{

if($turno == 't'.$i){
  if ($row['t'.$i] == '0') {
  $sql = "UPDATE users_cogestione SET t".$i." = '".$funzione."', presente_t".$i." = 'SI' WHERE id = '".$id."'";
  if (mysqli_query($link, $sql)) {
  echo 'success';
  }
} elseif ($row['t'.$i] != '0') {
  $sql = "UPDATE collettivi set ".$ruolo."t".$i." = ".$ruolo."t".$i." + 1 WHERE id = '".$row['t'.$i]."'";
    if (mysqli_query($link, $sql)) {
        $sql = "UPDATE users_cogestione SET t".$i." = '".$funzione."', presente_t".$i." = 'SI' WHERE id = '".$id."'";
        if (mysqli_query($link, $sql)) {
        echo 'success';
        }}}
}

}

?>
