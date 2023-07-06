<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body style="background-color: #eceff1;">

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Appello</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

  <div class="container" style:"margin-bottom: 4em;">

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Appelli</b></h5>
    </div>

    <div style="border-radius: 15px;" class="hoverable z-depth-1 margine_sotto">
      <nav style="border-radius: 15px;" class="<?php echo $set['set_colore_base']; ?>">
          <div style="border-radius: 15px;" class="nav-wrapper">
            <form action="/admin/collettivi/appello_admin" method="GET">
              <div style="border-radius: 15px;" class="input-field">
                <input style="border-radius: 15px;" id="search" type="search" name="search">
                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
              </div>
            </form>
          </div>
        </nav>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1 spazietto_sotto spazietto_sopra">
      <div class="col s12 m10 l10 offset-l1 offset-m1 center">
        <h6> <b>Innanzitutto seleziona il <?php echo $set['set_nome_collettivo'] ?> di cui desideri fare l'appello: </b> </h6>
      </div>
      <?php

          $search = mysqli_real_escape_string($link, $_GET['search']);

          $sql = "SELECT * FROM collettivi WHERE titolo_collettivo LIKE '%$search%' AND id > 0 ORDER BY titolo_collettivo ASC";
          $request = mysqli_query($link, $sql);
          while($row = mysqli_fetch_assoc($request)){
          ?>
          <div class="col s10 offset-s1 marginetto_sopra">
            <p class="col s6"><?php echo $row['titolo_collettivo'] ?></p>
            <a style="border-radius: 25px;"  href="javascript:RivelaTurni(<?php echo $row['id'] ?>);" class="waves-effect waves-light btn center marginetto_sopra right <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">Appello!</a>
            <div id="turni<?php echo $row['id'] ?>" style="border-radius: 15px; background-color: #eceff1; display: none;" class="col s12 marginetto_sopra rivelaturni">
              <?php for ($i=1; $i <= $set['set_turni_totali']; $i++) {
                if ($row['t'.$i] != '-100') { ?>
                  <div class="col s12 m3 l3 center">
                    <a style="border-radius: 25px;" href="/main/docenti/appello2?id=<?php echo $row['id']; ?>&turno=t<?php echo $i ?>" class="waves-effect waves-light btn center marginetto_sopra marginetto_sotto <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">Appello T<?php echo $i; ?>!</a>
                  </div>
                <?php  }
              } ?>

            </div>
          </div>
          <?php
        }
      ?>
    </div>

  </div>

  <script>
    function RivelaTurni(id){
      var slides = document.getElementsByClassName('rivelaturni');
      for (var i = 0; i < slides.length; i++) {
         slides.item(i).style.display = "none";
      }
      document.getElementById('turni' + id).style.display = "block";
    }
  </script>

  <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

    </body>
  </html>
