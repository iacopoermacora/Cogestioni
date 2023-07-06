<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

include $_SERVER['DOCUMENT_ROOT'].'/card.php';

$turni = array('t1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 't13', 't14', 't15', 't16', 't17', 't18', 'id');
if (!in_array($_GET['turno'], $turni) && $_GET['turno'] != '') {
  header('location: /admin/admincogestione');
} else {
  $turno = mysqli_real_escape_string($link, $_GET['turno']);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

</head>
  <body style="background-color: #eceff1;">

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Collettivi con necessità particolari</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

  <div class="container">

    <div class="row margine_sopra">
      <a href="/admin/admincogestione" style="border-radius: 15px; background-color: #fff; padding-right: 10px; padding-bottom: 10px;" class="left z-depth-1 black-text"><i style="position: relative; top: 8px;" class="material-icons small">chevron_left</i>Home</a>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sotto spazietto_sopra center z-depth-1 margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Ecco i <?php echo $set['set_nome_collettivi']; ?> con necessità particolari<?php
      for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {

      if ($turno == 't'.$i) {
        print ' del Turno '.$i;
      }

      }

      if ($turno == 'id') {
        print ' di tutti i Turni';
      } ?></b></h5>
    </div>

  <div class="row">
  <?php


  $sql = "SELECT * FROM collettivi WHERE NOT ".$turno." = -100 AND NOT necessita_particolari = 'NO' AND NOT necessita_particolari = '' AND eliminato = 'NO' AND id > 0";
  $collettivi = mysqli_query($link, $sql);
  if($row = mysqli_fetch_assoc($collettivi)) {

    $counter = 0;

  $sql = "SELECT * FROM collettivi WHERE NOT ".$turno." = -100 AND NOT necessita_particolari = 'NO' AND NOT necessita_particolari = '' AND eliminato = 'NO' AND id > 0";
  $collettivi2 = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($collettivi2)) {
    $counter++;

     DisplayCard($row, 'id', '', '', '', $set, 3, 0, 0);

          if (($counter % 3) == 0)
            {
              echo "</div><div class='row'>";
            }
          ?>

        <?php }} else { ?>
          <p class="center margine_sopra">Evviva! Nessun <?php echo $set['set_nome_collettivo'] ?> con necessità particolari<?php
          for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {

          if ($turno == 't'.$i) {
            print ' del Turno '.$i;
          }

          }

          if ($turno == 'id') {
            print '!';
          } ?></p>
          <?php } ?>
      </div>
</div>

<!--Footer inizio-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>
</html>
