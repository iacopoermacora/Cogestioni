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

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - DownloadUsers</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<div class="container">

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Scarica ciò che ti serve!</b></h5>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="row center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Users</b></h5>
    </div>

    <div class="row margine_sopra margine_sotto">
      <div class="col s12 m6 l6 marginetto_sotto">
        <a href="/admin/users/downloads_script?var=STAFF">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s3">
              <i class="material-icons large black-text">download_file</i>
            </div>
            <div class="col s9 center">
              <h5 class="black-text">Fogli firme STAFF</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col s12 m6 l6 marginetto_sotto">
        <a href="/admin/users/downloads_script?var=iscr_classe">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s3">
              <i class="material-icons large black-text">download_file</i>
            </div>
            <div class="col s9 center">
              <h5 class="black-text">Iscrizioni divise per classe</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col s12 m6 l6 marginetto_sotto">
        <a href="/admin/users/downloads_script?var=iscr_users">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s3">
              <i class="material-icons large black-text">download_file</i>
            </div>
            <div class="col s9 center">
              <h5 class="black-text">Iscrizioni divise per utente</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col s12 m6 l6 marginetto_sotto">
        <a href="/admin/users/downloads_script?var=pres_ass">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s3">
              <i class="material-icons large black-text">download_file</i>
            </div>
            <div class="col s9 center">
              <h5 class="black-text">Presenze e Assenze</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col s12 m12 l12 marginetto_sotto">
        <a href="/admin/users/downloads_script?var=appelli_carta">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s3">
              <i class="material-icons large black-text">download_file</i>
            </div>
            <div class="col s9 center">
              <h5 class="black-text">Appelli Cartacei</h5>
            </div>
          </div>
        </a>
      </div>
    </div>

</div>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>

</html>
