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

// Include config file
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";

$id = mysqli_real_escape_string($link, $_GET['id']);
$segnalatoda = $_SESSION['id_coge'];

$sql = "UPDATE collettivi SET segnalato = 'SI', segnalatoda = '".$segnalatoda."' WHERE id='".$id."'";

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
}}}}}}}}}}}}}}}}}}}

?>
