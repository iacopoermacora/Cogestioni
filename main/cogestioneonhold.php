<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';

include $_SERVER['DOCUMENT_ROOT'].'/main/system/cookies_set.php';

if ($set['set_status_cogestione'] != 'cogestione_on_hold') {
  header('location: /index');
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body>

  <title><?php echo $set['set_intestazione_sito']; ?> - Home</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/navbar_general.php'; ?>
<!--Fine Navbar-->

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/hero.php'; ?>


<!--Container-->

<div class="container" style:"margin-bottom: 4em;">

  <div class="spazietto_sotto spazietto_sopra center">
  <?php if (!isset($_SESSION["loggedin_coge"])) { ?>
    <h6 style="border-radius: 15px;" class="z-depth-1 spazietto_sotto spazietto_sopra "><b>Ciao, i <?php echo $set['set_nome_collettivi']; ?> stanno venendo rielaborati per le iscrizioni, ma se fai il <a href="/main/system/login">login</a> sarai avvantaggiato per quando le iscrizioni apriranno! La registrazione dei <?php echo $set['set_nome_collettivi']; ?> è terminata.</b></h6>
  <?php } elseif (isset($_SESSION["loggedin_coge"]) && $_SESSION["loggedin_coge"] == true) { ?>
    <h6 style="border-radius: 15px;" class="z-depth-1 spazietto_sotto spazietto_sopra "><b>Ciao <?php echo $_SESSION['username_coge'] ?>, i <?php echo $set['set_nome_collettivi']; ?> stanno venendo rielaborati, quindi non puoi ancora visualizzarli. La registrazione dei <?php echo $set['set_nome_collettivi']; ?> è terminata.</b></h6>
  <?php } ?>
  </div>

    </div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>
</html>
