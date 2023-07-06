<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'login');

include $_SERVER['DOCUMENT_ROOT'].'/main/system/cookies_set.php';

include $_SERVER['DOCUMENT_ROOT'].'/card.php';

if ($set['set_status_cogestione'] == 'cogestione_hidden' || $set['set_status_cogestione'] == 'cogestione_form' || $set['set_status_cogestione'] == 'cogestione_on_hold' || $set['set_status_cogestione'] == 'cogestione_questionario_gradimento') {
  header('location: /index');
}

$sql = "SELECT * FROM users_cogestione WHERE id=".$_SESSION['id_coge'];
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

  if ($row['ruolo'] == 'studente' || $row['ruolo'] == 'studente_admin') {
    $ruolo = '';
  } else {
    $ruolo = 'prof_';
  }

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

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body style="background-color: #eceff1;">

  <title><?php echo $set['set_intestazione_sito']; ?> - Iscrizioni</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/navbar_general.php'; ?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/hero.php'; ?>

<!--Container-->

<div class="container" style:"margin-bottom: 4em;">

  <div class="spazietto_sotto spazietto_sopra center">
    <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra"><b>Ecco le tue iscrizioni, ricordati di iscriverti a tutti i turni!</b></h6>
  </div>

<!--Collettivi-->

<div id="total">

  <div class="row">

  <?php

  $counter = 0;

  foreach ($collettivo as $item) {

  if ($item == 0) {
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
  $sql = "SELECT * FROM users_cogestione WHERE id = '".$_SESSION['id_coge']."'";
  $collettivi = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($collettivi);
  $autosub = $row['autosub'];

  $sql = "SELECT * FROM collettivi WHERE id = '".$item."'";
  $collettivi = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($collettivi);
  $counter++;

  DisplayCard($row, 'id', $ruolo, $iscritto, $collettivo, $set, 2, $autosub, $counter);

        }

        if (($counter % 3) == 0)
          {
            echo "</div><div class='row'>";
          }

        } ?>
        </div>
      </div>
    </div>

    <script>
    <?php
    $js_array = json_encode($collettivo);
    echo "var javascript_array = ". $js_array . ";\n";
    ?>

      function UnSubscribe(id, turno)
      {
          jQuery.ajax({
           type: "POST",
           url: "annullaiscrizionicogestione.php",
           data: 'id='+id +'&turno='+turno,
           cache: false,
           success: function(data)
           {
             if (data == 'disiscritto') {
                 $("#total").load("iscrizionipersonali.php #total");
             }
           }
         });
     }
    </script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>
</html>
