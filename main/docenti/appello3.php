<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin_and_professore_and_professore_admin');

$id = mysqli_real_escape_string($link, $_GET['id']);
$presenza = mysqli_real_escape_string($link, $_GET['presenza']);
$idcollettivo = mysqli_real_escape_string($link, $_GET['idcollettivo']);
$turno = mysqli_real_escape_string($link, $_GET['turno']);
$status = mysqli_real_escape_string($link, $_GET['status']);

if ($status == 'assente') {

$sql = "UPDATE users_cogestione SET ".$presenza." = 'SI' WHERE id = '".$id."'";

if (mysqli_query($link, $sql)) {
    mysqli_close($link);
    echo "'presente',".$idcollettivo.",'".$turno."',".$id.",'".$presenza."'";
    exit;
}

} elseif ($status == 'presente') {

  $sql = "UPDATE users_cogestione SET ".$presenza." = 'NO' WHERE id = '".$id."'";

  if (mysqli_query($link, $sql)) {
      mysqli_close($link);
      echo "'assente',".$idcollettivo.",'".$turno."',".$id.",'".$presenza."'";
      exit;
  }

} else {
  echo 'error';
}
?>
