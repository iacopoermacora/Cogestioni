<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'login');

//Permette l'accesso solo tramite ajax
//if(!$_SERVER['HTTP_X_REQUESTED_WITH'])
//{
//  header('location: /403.shtml');
//  exit;
//}

$id_user = $_SESSION['id_coge'];
if ($_SESSION['ruolo_coge'] == 'professore' || $_SESSION['ruolo_coge'] == 'professore_admin') {
  $ruolo_user = 'prof_';
} else {
  $ruolo_user = '';
}

$sql = "SELECT * FROM users_cogestione WHERE id = ".$_SESSION['id_coge'];
$request = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($request);

for ($i=1; $i <= $set['set_turni_totali']; $i++) {
    ${'t'.$i.'_user'} = $row['t'.$i];
}


$array_total = array();

$sql = "SELECT * FROM collettivi WHERE segnalato='NO' AND eliminato='NO' AND id > 0";
$request = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($request)) {
  $array_collettivo = array();
  $posti_totali_collettivo = 0;
  for ($i=1; $i <= $set['set_turni_totali']; $i++) {
    if ($row['total_'.$ruolo_user.'t'.$i] != -100) {
      if (${'t'.$i.'_user'} == 0) {
        $var = 1; //iscriviti
      } elseif (${'t'.$i.'_user'} == $row['id']) {
        $var = 2; //disiscriviti
      } else {
        $var = 3; //iscritto ad altro
      }
      if ($row[$ruolo_user.'t'.$i] == 0 && ${'t'.$i.'_user'} != $row['id']) {
        $var = 4; //posti terminati
      }
        $array_turno = array('Posti'=>$row[$ruolo_user.'t'.$i], 'Posti_Totali'=>$row['total_'.$ruolo_user.'t'.$i], 'Status'=>$var);
        $array_collettivo[$i] = $array_turno;
        $posti_totali_collettivo += $row[$ruolo_user.'t'.$i];
    }
  }
  $array_collettivo["Posti_Totali_All"] = $posti_totali_collettivo;
  $array_collettivo["Spazio_unlimited"] = $set['set_unlimited_spazio_'.$row['spazio']];
  $array_total[$row['id']] = $array_collettivo;
}

echo json_encode($array_total, JSON_NUMERIC_CHECK);
 ?>
