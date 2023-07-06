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

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - STAFF</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<div class="container">

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Indica gli utenti parte dello STAFF!</b></h5>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="row center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Studenti</b></h5>
    </div>

    <div class="row margine_sopra">
      <div class="col s12 m6 l6 marginetto_sotto">
        <a href="/admin/users/rendi_ruolo?variabile=referente">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s12 m6 l6">
              <img src="/images/base/immagine_referente.jpg" alt="" class="responsive-img">
            </div>
            <div class="col s12 m6 l6">
              <h5>Referente</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col s12 m6 l6">
        <a href="/admin/users/rendi_ruolo?variabile=organizzatore">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s12 m6 l6">
              <img src="/images/base/immagine_organizzazione.jpg" alt="" class="responsive-img">
            </div>
            <div class="col s12 m6 l6">
              <h5>Organizzatore</h5>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="row margine_sotto">
      <div class="col s12 m6 l6 marginetto_sotto">
        <a href="/admin/users/rendi_ruolo?variabile=SDO">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s12 m6 l6">
              <img src="/images/base/immagine_SDO.jpg" alt="" class="responsive-img">
            </div>
            <div class="col s12 m6 l6">
              <h5>Servizio D'Ordine</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col s12 m6 l6 marginetto_sotto">
        <a href="/admin/users/rendi_ruolo?variabile=fuoriaula">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s12 m6 l6">
              <img src="/images/base/immagine_fuoriaula.jpg" alt="" class="responsive-img">
            </div>
            <div class="col s12 m6 l6">
              <h5>Presente Fuori Aula</h5>
            </div>
          </div>
        </a>
      </div>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="row center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Docenti</b></h5>
    </div>

    <div class="row margine_sopra margine_sotto">
      <div class="col s12 m6 l6 offset-m3 offset-l3 marginetto_sotto">
        <a href="/admin/users/rendifuoriservizio">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s12 m6 l6">
              <img src="/images/base/immagine_fuoriservizio.jpg" alt="" class="responsive-img">
            </div>
            <div class="col s12 m6 l6">
              <h5>Non In Servizio</h5>
            </div>
          </div>
        </a>
      </div>
    </div>

</div>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>
  </body>

</html>
