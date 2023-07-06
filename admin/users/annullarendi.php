<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

$id =  mysqli_real_escape_string($link, $_POST['id']);
$turno =  mysqli_real_escape_string($link, $_POST['turno']);


$sql = "SELECT * FROM users_cogestione WHERE id = ".$id;
$request = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($request);

for ($i=1; $i <= $set['set_turni_totali']; $i++)
{

if($turno == 't'.$i){
  if ($row['t'.$i] == '0') {
  echo 'success';
} elseif ($row['t'.$i] != '0') {
        $sql = "UPDATE users_cogestione SET t".$i." = '0', presente_t".$i." = 'NO' WHERE id = '".$id."'";
        if (mysqli_query($link, $sql)) {
        echo 'success'; }}
}

}

?>
