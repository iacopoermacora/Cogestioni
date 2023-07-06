<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';

include $_SERVER['DOCUMENT_ROOT'].'/main/system/cookies_set.php';

if ($set['set_status_cogestione'] == 'cogestione_hidden' || $set['set_status_cogestione'] == 'cogestione_form' || $set['set_status_cogestione'] == 'cogestione_on_hold' || $set['set_status_cogestione'] == 'cogestione_questionario_gradimento') {
  header('location: /index');
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body style="background-color: #eceff1;">

 <title><?php echo $set['set_intestazione_sito']; ?> - Info</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/navbar_general.php'; ?>
<!--Fine Navbar-->

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/hero.php'; ?>


<!--Container-->

<div class="container" style:"margin-bottom: 4em;">


  <div class="spazietto_sopra center">
    <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra "><b>Ciao <?php echo $_SESSION['username_coge']; ?>, ecco tutte le informazioni necessarie per la <?php echo $set['set_nome_cogestione']; ?>!</b></h6>
  </div>

  <div style="border-radius: 30px; background-color: #fff;" class="margine_sopra margine_sotto spazietto_sopra spazietto_sotto z-depth-1">
    <div class="row">
      <div class="col s11 offset-s1 center">
        <h5><b>Informazioni & orari:</b></h5>
      </div>
    </div>
    <div class="row">
      <div class="col l2 offset-l1 hide-on-med-and-down">
        <h3 class="center">COGE<br>STI<br>ONE</h3>
      </div>
      <div class="col l7 s12">
          <ul>
            <div class="col s12 center marginetto_sotto">
              <li><b>ORARI: </b></li>
            </div>
            <div class="row">
              <div class="col s6 right-align">
                <li>Appello:</li>
              </div>
              <div class="col s6 left-align">
                <li><?php echo $set['set_orario_appello']; ?></li>
              </div>
            </div>
            <div class="row">
              <div class="col s6 right-align">
                <li>Accoglienza esterni 1° turno:</li>
              </div>
              <div class="col s6 left-align">
                <li><?php echo $set['set_orario_accoglienza1']; ?></li>
              </div>
            </div>
            <div class="row">
              <div class="col s6 right-align">
                <li>Primo turno della mattina:</li>
              </div>
              <div class="col s6 left-align">
                <li><?php echo $set['set_orario_turno1']; ?></li>
              </div>
            </div>
            <?php if ($set['set_turni_per_giorno'] >= 2) { ?>
            <div class="row">
              <div class="col s6 right-align">
                <li>Intervallo:</li>
              </div>
              <div class="col s6 left-align">
                <li><?php echo $set['set_orario_intervallo']; ?></li>
              </div>
            </div>
            <div class="row">
              <div class="col s6 right-align">
                <li>Accoglienza esterni 2° turno:</li>
              </div>
              <div class="col s6 left-align">
                <li><?php echo $set['set_orario_accoglienza2']; ?></li>
              </div>
            </div>
            <div class="row">
              <div class="col s6 right-align">
                <li>Secondo turno della mattina:</li>
              </div>
              <div class="col s6 left-align">
                <li><?php echo $set['set_orario_turno2']; ?></li>
              </div>
            </div>
            <?php } ?>
            <?php if ($set['set_turni_per_giorno'] == 3) { ?>
            <div class="row">
              <div class="col s6 right-align">
                <li>Secondo intervallo:</li>
              </div>
              <div class="col s6 left-align">
                <li><?php echo $set['set_orario_intervallo2']; ?></li>
              </div>
            </div>
            <div class="row">
              <div class="col s6 right-align">
                <li>Accoglienza esterni 3° turno:</li>
              </div>
              <div class="col s6 left-align">
                <li><?php echo $set['set_orario_accoglienza3']; ?></li>
              </div>
            </div>
            <div class="row">
              <div class="col s6 right-align">
                <li>Terzo turno della mattina:</li>
              </div>
              <div class="col s6 left-align">
                <li><?php echo $set['set_orario_turno3']; ?></li>
              </div>
            </div>
            <?php } ?>
            <div class="row">
              <div class="col s6 right-align">
                <li>Contrappello:</li>
              </div>
              <div class="col s6 left-align">
                <li><?php echo $set['set_orario_contrappello']; ?></li>
              </div>
            </div>
          </ul>
      </div>
    </div>
  </div>

<?php if ($set['set_info_extra'] != '') { ?>
  <div style="border-radius: 30px; background-color: #fff;" class="margine_sopra margine_sotto spazietto_sopra spazietto_sotto z-depth-1">
    <div class="row">
      <div class="col s11 offset-s1 center">
        <h5><b>Altre informazioni utili:</b></h5>
      </div>
    </div>
  <div class="row">
    <div class="col l2 offset-l1 hide-on-med-and-down">
      <h3 class="center">ALTRE<br>INFO<br></h3>
    </div>
    <div class="col l7 s12 center">
        <p><?php echo $set['set_info_extra']; ?></p>
    </div>
  </div>
</div>
<?php } ?>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>
</html>
