<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin_and_professore_admin');

//Permette l'accesso solo tramite ajax
    if(!$_SERVER['HTTP_X_REQUESTED_WITH'])
    {
       header('location: /403.shtml');
       exit;
    }

$id = mysqli_real_escape_string($link, $_GET['id']);

$sql = "UPDATE collettivi SET segnalato = 'NO', segnalatoda = '' WHERE id='".$id."'";

if (mysqli_query($link, $sql)) {
    echo 'success';
    exit;
}

?>
