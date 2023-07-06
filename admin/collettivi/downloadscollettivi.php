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

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Downloads <?php echo ucfirst($set['set_nome_collettivi']); ?></title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<div class="container">

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Scarica ciò che ti serve!</b></h5>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="row center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Users</b></h5>
    </div>

    <div class="row margine_sopra margine_sotto">
      <?php for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) { ?>
        <div class="col s6 m4 l4 marginetto_sotto">
          <a href="/admin/users/downloads_script?var=cartelli_t<?php echo $i; ?>">
            <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
              <div class="col s3">
                <i class="material-icons medium black-text">download_file</i>
              </div>
              <div class="col s9 center">
                <h5 class="black-text">Cartelli T<?php echo $i; ?></h5>
              </div>
            </div>
          </a>
        </div>
      <?php } ?>
      <div class="col s6 marginetto_sotto">
        <a href="/admin/users/downloads_script?var=collettivi_all">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s3">
              <i class="material-icons large black-text">download_file</i>
            </div>
            <div class="col s9 center">
              <h5 class="black-text">Tutti i <?php echo $set['set_nome_collettivi']; ?> proposti</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col s6 marginetto_sotto">
        <a href="/admin/users/downloads_script?var=collettivi_all_approved">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s3">
              <i class="material-icons large black-text">download_file</i>
            </div>
            <div class="col s9 center">
              <h5 class="black-text">Tutti i <?php echo $set['set_nome_collettivi']; ?> approvati</h5>
            </div>
          </div>
        </a>
      </div>
      <?php for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) { ?>
        <div class="col s6 m4 l4 marginetto_sotto">
          <a href="/admin/users/downloads_script?var=esterni_t<?php echo $i; ?>">
            <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
              <div class="col s4 left">
                <i class="material-icons medium black-text">download_file</i>
              </div>
              <div class="col s8 center">
                <h5 class="black-text">Foglio Firme Esterni T<?php echo $i; ?></h5>
              </div>
            </div>
          </a>
        </div>
      <?php } ?>
      <?php if ($set['set_curriculum_necessario'] == 1) { ?>
      <div class="col s12 marginetto_sotto">
        <a href="/admin/users/downloads_script?var=all_cv">
          <div style="border-radius: 15px; background-color: #fff;" class="valign-wrapper hoverable z-depth-1">
            <div class="col s3">
              <i class="material-icons large black-text">download_file</i>
            </div>
            <div class="col s9 center">
              <h5 class="black-text">Tutti i curriculum degli esterni</h5>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
    </div>

</div>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>

</html>
