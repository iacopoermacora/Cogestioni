<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

include $_SERVER['DOCUMENT_ROOT'].'/card.php';

$id = mysqli_real_escape_string($link, $_GET['id']);

$sql = "SELECT * FROM users_cogestione WHERE id = '".$id."' AND id > 0";
$request = mysqli_query($link, $sql);
if ($row = mysqli_fetch_assoc($request)){
  $nomeutente = $row['username'];
  $iscritto = array();
  $collettivo = array();
  for ($i=1; $i <= $set['set_turni_totali']; $i++)
  {

  if ($row['t'.$i] == '0') {
    $iscritto[$i] = 'NO';
    $collettivo[$i] = '0';
  } else {
    $iscritto[$i] = 'SI';
    $collettivo[$i] = $row['t'.$i];
  }

  }
} else {
header('location: /admin/users/admin_users_coge');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body style="background-color: #eceff1;">
 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Iscrizioni Utente</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

  <div class="container" style:"margin-bottom: 4em;">

    <div class="row margine_sopra">
      <a href="/admin/users/admin_users_coge" style="border-radius: 15px; background-color: #fff; padding-right: 10px; padding-bottom: 10px;" class="left z-depth-1 black-text"><i style="position: relative; top: 8px;" class="material-icons small">chevron_left</i>Iscrizioni utenti</a>
    </div>

    <div class="spazietto_sotto center">
      <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra "><b>Ecco le iscrizioni dell'utente <?php echo $nomeutente; ?></b></h6>
    </div>

    <div class="row">

    <?php

      $counter = 0;

      foreach ($collettivo as $item) {

      if ($item == '0') {
        $counter++;
         ?>

        <div class="col s12 m12 l4">  <div style="border-radius: 15px; background-color: #eceff1;" class="card">
          <div style="border-radius: 15px; padding-top: 30%; padding-bottom: 30%;" class="card-image waves-block waves-light center valign-wrapper">
            <h1>T<?php echo $counter; ?></h1>
          </div>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4 center">NON ISCRITTO</span>
          </div>
        </div>
       </div>

        <?php } else {
      $sql = "SELECT * FROM users_cogestione WHERE id = '".$id."'";
      $collettivi = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($collettivi);
      $autosub = $row['autosub'];

      $sql = "SELECT * FROM collettivi WHERE id = '".$item."'";
      $collettivi = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($collettivi);
      $counter++;

      DisplayCard($row, '', '', $iscritto, $collettivo, $set, 4, $autosub, $counter);

            }

            if (($counter % 3) == 0)
              {
                echo "</div><div class='row'>";
              }

            } ?>
            </div>
          </div>
        </div>



  </div>

  <!--Footer inizio-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

    </body>
  </html>
