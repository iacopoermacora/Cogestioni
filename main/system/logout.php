<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';

$id = $_SESSION['id_coge'];

$sql = "DELETE FROM token_login WHERE id_user = '$id'";
if (mysqli_query($link, $sql)) {

// Destroy the cookie
setcookie("usrlgn", "", time() - 3600);

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: /index");
exit;
}
?>
