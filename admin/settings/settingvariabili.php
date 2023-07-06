<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');


if(isset($_POST["submit"])){
  $set_intestazione_sito = mysqli_real_escape_string($link, $_REQUEST['set_intestazione_sito']);
  $set_nome_scuola = mysqli_real_escape_string($link, $_REQUEST['set_nome_scuola']);
  $set_colore_base = mysqli_real_escape_string($link, $_REQUEST['set_colore_base']);
  $set_colore_base_scritte = mysqli_real_escape_string($link, $_REQUEST['set_colore_base_scritte']);
  $set_colore_bottoni = mysqli_real_escape_string($link, $_REQUEST['set_colore_bottoni']);
  $set_colore_bottoni_scritte = mysqli_real_escape_string($link, $_REQUEST['set_colore_bottoni_scritte']);
  $set_status_cogestione = mysqli_real_escape_string($link, $_REQUEST['set_status_cogestione']);
  $set_data_apertura_form = mysqli_real_escape_string($link, $_REQUEST['set_data_apertura_form']);
  $set_ora_apertura_form = mysqli_real_escape_string($link, $_REQUEST['set_ora_apertura_form']);
  $set_numero_giorni = $_REQUEST['set_numero_giorni'];
  $set_turni_per_giorno = $_REQUEST['set_turni_per_giorno'];
  $set_turni_totali = ($set_turni_per_giorno * $set_numero_giorni);
  $set_nome_collettivi = mysqli_real_escape_string($link, $_REQUEST['set_nome_collettivi']);
  $set_nome_collettivo = mysqli_real_escape_string($link, $_REQUEST['set_nome_collettivo']);
  $set_nome_cogestione = mysqli_real_escape_string($link, $_REQUEST['set_nome_cogestione']);
  $set_giorno1_cogestione = mysqli_real_escape_string($link, $_REQUEST['set_giorno1_cogestione']);
  $set_giorno2_cogestione = mysqli_real_escape_string($link, $_REQUEST['set_giorno2_cogestione']);
  $set_giorno3_cogestione = mysqli_real_escape_string($link, $_REQUEST['set_giorno3_cogestione']);
  $set_giorno4_cogestione = mysqli_real_escape_string($link, $_REQUEST['set_giorno4_cogestione']);
  $set_giorno5_cogestione = mysqli_real_escape_string($link, $_REQUEST['set_giorno5_cogestione']);
  $set_giorno6_cogestione = mysqli_real_escape_string($link, $_REQUEST['set_giorno6_cogestione']);
  $set_orario_appello_open = mysqli_real_escape_string($link, $_REQUEST['set_orario_appello_open']);
  $set_orario_appello_close = mysqli_real_escape_string($link, $_REQUEST['set_orario_appello_close']);
  $set_orario_accoglienza1_open = mysqli_real_escape_string($link, $_REQUEST['set_orario_accoglienza1_open']);
  $set_orario_accoglienza1_close = mysqli_real_escape_string($link, $_REQUEST['set_orario_accoglienza1_close']);
  $set_orario_turno1_open = mysqli_real_escape_string($link, $_REQUEST['set_orario_turno1_open']);
  $set_orario_turno1_close = mysqli_real_escape_string($link, $_REQUEST['set_orario_turno1_close']);
  $set_orario_intervallo_open = mysqli_real_escape_string($link, $_REQUEST['set_orario_intervallo_open']);
  $set_orario_intervallo_close = mysqli_real_escape_string($link, $_REQUEST['set_orario_intervallo_close']);
  $set_orario_accoglienza2_open = mysqli_real_escape_string($link, $_REQUEST['set_orario_accoglienza2_open']);
  $set_orario_accoglienza2_close = mysqli_real_escape_string($link, $_REQUEST['set_orario_accoglienza2_close']);
  $set_orario_turno2_open = mysqli_real_escape_string($link, $_REQUEST['set_orario_turno2_open']);
  $set_orario_turno2_close = mysqli_real_escape_string($link, $_REQUEST['set_orario_turno2_close']);
  $set_orario_intervallo2_open = mysqli_real_escape_string($link, $_REQUEST['set_orario_intervallo2_open']);
  $set_orario_intervallo2_close = mysqli_real_escape_string($link, $_REQUEST['set_orario_intervallo2_close']);
  $set_orario_accoglienza3_open = mysqli_real_escape_string($link, $_REQUEST['set_orario_accoglienza3_open']);
  $set_orario_accoglienza3_close = mysqli_real_escape_string($link, $_REQUEST['set_orario_accoglienza3_close']);
  $set_orario_turno3_open = mysqli_real_escape_string($link, $_REQUEST['set_orario_turno3_open']);
  $set_orario_turno3_close = mysqli_real_escape_string($link, $_REQUEST['set_orario_turno3_close']);
  $set_orario_contrappello_open = mysqli_real_escape_string($link, $_REQUEST['set_orario_contrappello_open']);
  $set_orario_contrappello_close = mysqli_real_escape_string($link, $_REQUEST['set_orario_contrappello_close']);
  $set_info_extra = mysqli_real_escape_string($link, $_REQUEST['set_info_extra']);
  $set_numero_spazi = mysqli_real_escape_string($link, $_REQUEST['set_numero_spazi']);
  for ($i=1; $i <=10 ; $i++) {
    ${"set_nome_spazio_".$i} = mysqli_real_escape_string($link, $_REQUEST['set_nome_spazio_'.$i]);
    ${"set_nome_spazio_".$i} = ucfirst(${"set_nome_spazio_".$i});
    ${"set_posti_spazio_".$i} = mysqli_real_escape_string($link, $_REQUEST['set_posti_spazio_'.$i]);
    ${"set_posti_spazio_".$i."_prof"} = mysqli_real_escape_string($link, $_REQUEST['set_posti_spazio_'.$i.'_prof']);
    ${"set_active_spazio_".$i} = mysqli_real_escape_string($link, $_REQUEST['set_active_spazio_'.$i]);
    if (${"set_posti_spazio_".$i} == '0') {
      ${"set_posti_spazio_".$i} = 0;
      ${"set_unlimited_spazio_".$i} = '1';
    } else {
      ${"set_unlimited_spazio_".$i} = 0;
    }
  }
  $set_strumenti_cogestione = mysqli_real_escape_string($link, $_REQUEST['set_strumenti_cogestione']);
  $set_curriculum_necessario = mysqli_real_escape_string($link, $_REQUEST['set_curriculum_necessario']);
  $set_nome_responsabile_privacy = mysqli_real_escape_string($link, $_REQUEST['set_nome_responsabile_privacy']);

          $sql = "UPDATE settings_cogestione SET set_intestazione_sito = '".$set_intestazione_sito."', set_nome_scuola = '".$set_nome_scuola."', set_colore_base = '".$set_colore_base."', set_colore_base_scritte = '".$set_colore_base_scritte."', set_colore_bottoni = '".$set_colore_bottoni."', set_colore_bottoni_scritte = '".$set_colore_bottoni_scritte."', set_status_cogestione = '".$set_status_cogestione."', set_data_apertura_form = '".$set_data_apertura_form."', set_ora_apertura_form = '".$set_ora_apertura_form."', set_numero_giorni = '".$set_numero_giorni."', set_turni_per_giorno = '".$set_turni_per_giorno."', set_turni_totali = '".$set_turni_totali."', set_nome_collettivi = '".$set_nome_collettivi."', set_nome_collettivo = '".$set_nome_collettivo."', set_nome_cogestione = '".$set_nome_cogestione."', set_giorno1_cogestione = '".$set_giorno1_cogestione."', set_giorno2_cogestione = '".$set_giorno2_cogestione."', set_giorno3_cogestione = '".$set_giorno3_cogestione."', set_giorno4_cogestione = '".$set_giorno4_cogestione."', set_giorno5_cogestione = '".$set_giorno5_cogestione."', set_giorno6_cogestione = '".$set_giorno6_cogestione."', set_orario_appello_open = '".$set_orario_appello_open."', set_orario_appello_close = '".$set_orario_appello_close."', set_orario_accoglienza1_open = '".$set_orario_accoglienza1_open."', set_orario_accoglienza1_close = '".$set_orario_accoglienza1_close."', set_orario_turno1_open = '".$set_orario_turno1_open."', set_orario_turno1_close = '".$set_orario_turno1_close."', set_orario_intervallo_open = '".$set_orario_intervallo_open."', set_orario_intervallo_close = '".$set_orario_intervallo_close."', set_orario_accoglienza2_open = '".$set_orario_accoglienza2_open."', set_orario_accoglienza2_close = '".$set_orario_accoglienza2_close."', set_orario_turno2_open = '".$set_orario_turno2_open."', set_orario_turno2_close = '".$set_orario_turno2_close."', set_orario_intervallo2_open = '".$set_orario_intervallo2_open."', set_orario_intervallo2_close = '".$set_orario_intervallo2_close."', set_orario_accoglienza3_open = '".$set_orario_accoglienza3_open."', set_orario_accoglienza3_close = '".$set_orario_accoglienza3_close."', set_orario_turno3_open = '".$set_orario_turno3_open."', set_orario_turno3_close = '".$set_orario_turno3_close."', set_orario_contrappello_open = '".$set_orario_contrappello_open."', set_orario_contrappello_close = '".$set_orario_contrappello_close."', set_info_extra = '".$set_info_extra."', set_numero_spazi = '".$set_numero_spazi."', set_nome_spazio_1 = '".$set_nome_spazio_1."', set_posti_spazio_1 = '".$set_posti_spazio_1."', set_posti_spazio_1_prof = '".$set_posti_spazio_1_prof."', set_active_spazio_1 = '".$set_active_spazio_1."', set_unlimited_spazio_1 = '".$set_unlimited_spazio_1."', set_nome_spazio_2 = '".$set_nome_spazio_2."', set_posti_spazio_2 = '".$set_posti_spazio_2."', set_posti_spazio_2_prof = '".$set_posti_spazio_2_prof."', set_active_spazio_2 = '".$set_active_spazio_2."', set_unlimited_spazio_2 = '".$set_unlimited_spazio_2."', set_nome_spazio_3 = '".ucfirst($set_nome_spazio_3)."', set_posti_spazio_3 = '".$set_posti_spazio_3."', set_posti_spazio_3_prof = '".$set_posti_spazio_3_prof."', set_active_spazio_3 = '".$set_active_spazio_3."', set_unlimited_spazio_3 = '".$set_unlimited_spazio_3."', set_nome_spazio_4 = '".ucfirst($set_nome_spazio_4)."', set_posti_spazio_4 = '".$set_posti_spazio_4."', set_posti_spazio_4_prof = '".$set_posti_spazio_4_prof."', set_active_spazio_4 = '".$set_active_spazio_4."', set_unlimited_spazio_4 = '".$set_unlimited_spazio_4."', set_nome_spazio_5 = '".ucfirst($set_nome_spazio_5)."', set_posti_spazio_5 = '".$set_posti_spazio_5."', set_posti_spazio_5_prof = '".$set_posti_spazio_5_prof."', set_active_spazio_5 = '".$set_active_spazio_5."', set_unlimited_spazio_5 = '".$set_unlimited_spazio_5."', set_nome_spazio_6 = '".ucfirst($set_nome_spazio_6)."', set_posti_spazio_6 = '".$set_posti_spazio_6."', set_posti_spazio_6_prof = '".$set_posti_spazio_6_prof."', set_active_spazio_6 = '".$set_active_spazio_6."', set_unlimited_spazio_6 = '".$set_unlimited_spazio_6."', set_nome_spazio_7 = '".ucfirst($set_nome_spazio_7)."', set_posti_spazio_7 = '".$set_posti_spazio_7."', set_posti_spazio_7_prof = '".$set_posti_spazio_7_prof."', set_active_spazio_7 = '".$set_active_spazio_7."', set_unlimited_spazio_7 = '".$set_unlimited_spazio_7."', set_nome_spazio_8 = '".ucfirst($set_nome_spazio_8)."', set_posti_spazio_8 = '".$set_posti_spazio_8."', set_posti_spazio_8_prof = '".$set_posti_spazio_8_prof."', set_active_spazio_8 = '".$set_active_spazio_8."', set_unlimited_spazio_8 = '".$set_unlimited_spazio_8."', set_nome_spazio_9 = '".ucfirst($set_nome_spazio_9)."', set_posti_spazio_9 = '".$set_posti_spazio_9."', set_posti_spazio_9_prof = '".$set_posti_spazio_9_prof."', set_active_spazio_9 = '".$set_active_spazio_9."', set_unlimited_spazio_9 = '".$set_unlimited_spazio_9."', set_nome_spazio_10 = '".ucfirst($set_nome_spazio_10)."', set_posti_spazio_10 = '".$set_posti_spazio_10."', set_posti_spazio_10_prof = '".$set_posti_spazio_10_prof."', set_active_spazio_10 = '".$set_active_spazio_10."', set_unlimited_spazio_10 = '".$set_unlimited_spazio_10."', set_strumenti_cogestione = '".$set_strumenti_cogestione."', set_curriculum_necessario = '".$set_curriculum_necessario."', set_nome_responsabile_privacy = '".$set_nome_responsabile_privacy."'";

          if(mysqli_query($link, $sql)){
            header('location: /admin/system/modificato?v=settings');
          } else{
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }

}

$posti = array();
for ($i=1; $i <= $set['set_turni_totali']; $i++)
{
$sql = "SELECT SUM(total_t".$i.") AS posti_totali FROM collettivi WHERE NOT total_t".$i." = -100 AND eliminato = 'NO' AND segnalato = 'NO' AND id > 0";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$posti[$i] = $row['posti_totali'];
}
$postitotali = array_sum($posti);

$sql = "SELECT COUNT(id) as userstotali FROM users_cogestione WHERE (ruolo = 'studente' || ruolo = 'studente_admin') AND id > 0";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$userstotali = $row['userstotali'];

if ($postitotali < $userstotali) {
  $alarm_open_subs = 1;
} else {
  $alarm_open_subs = 0;
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

</head>
  <body style="background-color: #eceff1;">

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Impostazioni</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

    <?php
    $sql = 'SELECT * FROM settings_cogestione WHERE id = 1 LIMIT 1';
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

<div class="container">

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sopra"><b>Benvenuto nella pagina di impostazione generale del sito!</b></h5>
      <p class="col s12 spazietto_sotto">Tramite questa pagina puoi impostare alcuni parametri generali del sito della <?php echo $set['set_nome_cogestione']; ?>.</p>
    </div>

  <form action="" method="post" enctype="multipart/form-data">
    <div style="border-radius: 15px; background-color: #fff;" class="row margine_sopra z-depth-1 spazietto_sotto spazietto_sopra">
      <div class="col s12 center">
        <h5> <b>Impostazioni generali:</b> </h5>
      </div>
      <div class="col s10 offset-s1 center">
        <p> <b>Inserisci il nome/intestazione del sito:</b> </p>
        <div class="input-field">
          <input onchange="ShowFloatingButton()" id="set_intestazione_sito" type="text" placeholder="Intestazione Sito" class="browser-default input is-rounded" name="set_intestazione_sito" required="required">
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center">
        <p> <b>Di cosa si tratta? Cogestione o Autogestione?</b> </p>
        <div class="input-field">
          <select onchange="ShowFloatingButton()" style="border-radius: 25px;" id="set_nome_cogestione" name="set_nome_cogestione" class="browser-default" required="required">
            <option disabled selected>Seleziona</option>
            <option value="Cogestione">Cogestione</option>
            <option value="Autogestione">Autogestione</option>
          </select>
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center">
        <p> <b>Inserisci il nome completo della tua scuola (max 21 caratteri):</b> </p>
        <div class="input-field">
          <input onchange="ShowFloatingButton()" id="set_nome_scuola" type="text" placeholder="Nome scuola" class="browser-default input is-rounded" name="set_nome_scuola" required="required" maxlength="21">
        </div>
      </div>
      <hr class="col s12">
      <?php $array_colori = array('red_lighten05', 'red_lighten04', 'red_lighten03', 'red_lighten02', 'red_lighten01', 'red', 'red_darken01', 'red_darken02', 'red_darken03', 'red_darken04', 'red_accent01', 'red_accent02', 'red_accent03', 'red_accent04', 'pink_lighten05', 'pink_lighten04', 'pink_lighten03', 'pink_lighten02', 'pink_lighten01', 'pink', 'pink_darken01', 'pink_darken02', 'pink_darken03', 'pink_darken04', 'pink_accent01', 'pink_accent02', 'pink_accent03', 'pink_accent04', 'purple_lighten05', 'purple_lighten04', 'purple_lighten03', 'purple_lighten02', 'purple_lighten01', 'purple', 'purple_darken01', 'purple_darken02', 'purple_darken03', 'purple_darken04', 'purple_accent01', 'purple_accent02', 'purple_accent03', 'purple_accent04', 'deep0purple_lighten05', 'deep0purple_lighten04', 'deep0purple_lighten03', 'deep0purple_lighten02', 'deep0purple_lighten01', 'deep0purple', 'deep0purple_darken01', 'deep0purple_darken02', 'deep0purple_darken03', 'deep0purple_darken04', 'deep0purple_accent01', 'deep0purple_accent02', 'deep0purple_accent03', 'deep0purple_accent04', 'indigo_lighten05', 'indigo_lighten04', 'indigo_lighten03', 'indigo_lighten02', 'indigo_lighten01', 'indigo', 'indigo_darken01', 'indigo_darken02', 'indigo_darken03', 'indigo_darken04', 'indigo_accent01', 'indigo_accent02', 'indigo_accent03', 'indigo_accent04', 'blue_lighten05', 'blue_lighten04', 'blue_lighten03', 'blue_lighten02', 'blue_lighten01', 'blue', 'blue_darken01', 'blue_darken02', 'blue_darken03', 'blue_darken04', 'blue_accent01', 'blue_accent02', 'blue_accent03', 'blue_accent04', 'light0blue_lighten05', 'light0blue_lighten04', 'light0blue_lighten03', 'light0blue_lighten02', 'light0blue_lighten01', 'light0blue', 'light0blue_darken01', 'light0blue_darken02', 'light0blue_darken03', 'light0blue_darken04', 'light0blue_accent01', 'light0blue_accent02', 'light0blue_accent03', 'light0blue_accent04', 'cyan_lighten05', 'cyan_lighten04', 'cyan_lighten03', 'cyan_lighten02', 'cyan_lighten01', 'cyan', 'cyan_darken01', 'cyan_darken02', 'cyan_darken03', 'cyan_darken04', 'cyan_accent01', 'cyan_accent02', 'cyan_accent03', 'cyan_accent04', 'teal_lighten05', 'teal_lighten04', 'teal_lighten03', 'teal_lighten02', 'teal_lighten01', 'teal', 'teal_darken01', 'teal_darken02', 'teal_darken03', 'teal_darken04', 'teal_accent01', 'teal_accent02', 'teal_accent03', 'teal_accent04', 'green_lighten05', 'green_lighten04', 'green_lighten03', 'green_lighten02', 'green_lighten01', 'green', 'green_darken01', 'green_darken02', 'green_darken03', 'green_darken04', 'green_accent01', 'green_accent02', 'green_accent03', 'green_accent04', 'light0green_lighten05', 'light0green_lighten04', 'light0green_lighten03', 'light0green_lighten02', 'light0green_lighten01', 'light0green', 'light0green_darken01', 'light0green_darken02', 'light0green_darken03', 'light0green_darken04', 'light0green_accent01', 'light0green_accent02', 'light0green_accent03', 'light0green_accent04', 'lime_lighten05', 'lime_lighten04', 'lime_lighten03', 'lime_lighten02', 'lime_lighten01', 'lime', 'lime_darken01', 'lime_darken02', 'lime_darken03', 'lime_darken04', 'lime_accent01', 'lime_accent02', 'lime_accent03', 'lime_accent04', 'yellow_lighten05', 'yellow_lighten04', 'yellow_lighten03', 'yellow_lighten02', 'yellow_lighten01', 'yellow', 'yellow_darken01', 'yellow_darken02', 'yellow_darken03', 'yellow_darken04', 'yellow_accent01', 'yellow_accent02', 'yellow_accent03', 'yellow_accent04', 'amber_lighten05', 'amber_lighten04', 'amber_lighten03', 'amber_lighten02', 'amber_lighten01', 'amber', 'amber_darken01', 'amber_darken02', 'amber_darken03', 'amber_darken04', 'amber_accent01', 'amber_accent02', 'amber_accent03', 'amber_accent04', 'orange_lighten05', 'orange_lighten04', 'orange_lighten03', 'orange_lighten02', 'orange_lighten01', 'orange', 'orange_darken01', 'orange_darken02', 'orange_darken03', 'orange_darken04', 'orange_accent01', 'orange_accent02', 'orange_accent03', 'orange_accent04', 'deep0orange_lighten05', 'deep0orange_lighten04', 'deep0orange_lighten03', 'deep0orange_lighten02', 'deep0orange_lighten01', 'deep0orange', 'deep0orange_darken01', 'deep0orange_darken02', 'deep0orange_darken03', 'deep0orange_darken04', 'deep0orange_accent02', 'deep0orange_accent03', 'deep0orange_accent04', 'brown_lighten05', 'brown_lighten04', 'brown_lighten03', 'brown_lighten02', 'brown_lighten01', 'brown', 'brown_darken01', 'brown_darken02', 'brown_darken03', 'brown_darken04', 'grey_lighten05', 'lighten04', 'grey_lighten03', 'grey_lighten02', 'grey_lighten01', 'grey', 'grey_darken01', 'grey_darken02', 'grey_darken03', 'grey_darken04', 'blue0grey_lighten05', 'blue0grey_lighten04', 'blue0grey_lighten03', 'blue0grey_lighten02', 'blue0grey_lighten01', 'blue0grey', 'blue0grey_darken01', 'blue0grey_darken02', 'blue0grey_darken03', 'blue0grey_darken04', 'black', 'white', 'transparent');

      $array_colori2 = array('red', 'pink', 'purple', 'deep0purple', 'indigo', 'blue', 'light0blue', 'cyan', 'teal', 'green', 'light0green', 'lime', 'yellow', 'amber', 'orange', 'deep0orange', 'brown', 'grey', 'blue0grey', 'black', 'white', 'transparent'); ?>
      <div class="col s10 offset-s1 center spazio_sopra">
        <p> <b>Seleziona il colore che verrà usato come colore base per il sito:</b> </p>
        <div class="input-field">
          <select onchange="ShowFloatingButton()" onchange="ShowFloatingButton()" style="border-radius: 25px;" id="set_colore_base" name="set_colore_base" class="browser-default" required="required">
            <option disabled selected>Seleziona</option>
            <?php foreach ($array_colori as $item) {
            $item1 = str_replace('_', ' ', $item);
            $item2 = str_replace('0', '-', $item1); ?>
            <option value="<?php echo $item2; ?>"><?php echo $item2; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center spazio_sopra">
        <p> <b>Seleziona il colore che verrà usato come colore base per le scritte della barra superiore ed inferiore:</b> </p>
        <div class="input-field">
          <select onchange="ShowFloatingButton()" style="border-radius: 25px;" id="set_colore_base_scritte" name="set_colore_base_scritte" class="browser-default" required="required">
            <option disabled selected>Seleziona</option>
            <?php foreach ($array_colori2 as $item) {
            $item1 = str_replace('_', ' ', $item);
            $item2 = str_replace('0', '-', $item1); ?>
            <option value="<?php echo $item2; ?>"><?php echo $item; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center spazio_sopra">
        <p> <b>Seleziona il colore che verrà usato come colore base per i bottoni del sito:</b> </p>
        <div class="input-field">
          <select onchange="ShowFloatingButton()" style="border-radius: 25px;" id="set_colore_bottoni" name="set_colore_bottoni" class="browser-default" required="required">
            <option disabled selected>Seleziona</option>
            <?php foreach ($array_colori as $item) {
            $item1 = str_replace('_', ' ', $item);
            $item2 = str_replace('0', '-', $item1); ?>
            <option value="<?php echo $item2; ?>"><?php echo $item; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center spazio_sopra">
        <p> <b>Seleziona il colore che verrà usato come colore base per le scritte dei bottoni del sito:</b> </p>
        <div class="input-field">
          <select onchange="ShowFloatingButton()" style="border-radius: 25px;" id="set_colore_bottoni_scritte" name="set_colore_bottoni_scritte" class="browser-default" required="required">
            <option disabled selected>Seleziona</option>
            <?php foreach ($array_colori2 as $item) {
            $item1 = str_replace('_', ' ', $item);
            $item2 = str_replace('0', '-', $item1); ?>
            <option value="<?php echo $item2; ?>"><?php echo $item; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="row margine_sopra z-depth-1 spazietto_sotto spazietto_sopra">
      <div class="col s12 center">
        <h5> <b>Impostazioni <?php echo $set['set_nome_cogestione']; ?>:</b> </h5>
      </div>
      <div class="col s10 offset-s1 center spazio_sopra">
        <p> <b>Seleziona lo status del sito della <?php echo $set['set_nome_cogestione']; ?>:</b> </p>
        <ul class="collapsible z-depth-0">
          <li>
            <div class="collapsible-header"><i class="material-icons">warning</i>Leggi attentamente (clicca qui)</div>
            <div class="collapsible-body"><p><b>LEGGI ATTENTAMENTE:</b> Per la gestione della <?php echo $set['set_nome_cogestione']; ?> sono presenti 5 diversi status. <br> - Il primo, quello predefinito è <b>"Pre-<?php echo $set['set_nome_cogestione']; ?>"</b>, ovvero gli utenti possono solamente vedere un countdown all'apertura del sito. Durante questa fase puoi impostare tutti i parametri sottostanti necessari. <br> - Il secondo status è <b>"Apri il form di registrazione dei <?php echo $set['set_nome_collettivi']; ?>"</b>, in questa fase sulla pagina della <?php echo $set['set_nome_cogestione']; ?> viene mostrato il form di registrazione dei <?php echo $set['set_nome_collettivi']; ?> aperto e accessibile a tutti, utenti loggati e non. <br> - Il terzo status è <b>"Pagina di pausa"</b>. Quando selezionato questo status mostra agli utenti una pagina che spiega che i <?php echo $set['set_nome_collettivi']; ?> stanno venendo rielaborati e indica la data di apertura delle iscrizioni. <br> - Il quarto status è <b>"<?php echo ucfirst($set['set_nome_collettivi']); ?> solo in visualizzazione (iscrizioni chiuse)"</b>, durante questo gli utenti potranno visualizzare i <?php echo $set['set_nome_collettivi']; ?> che hanno passato la selezione ma non iscriversi ancora. <br> - Il quinto status è <b>"Iscrizioni aperte"</b>, in questo status gli utenti possono iscriversi ai <?php echo $set['set_nome_collettivi']; ?> proposti. Dopo l'apertura delle iscrizioni effettuare determinate modifiche ai <?php echo $set['set_nome_collettivi']; ?> potrebbe causare problemi con le iscrizioni. Viene segnalato tutto nelle apposite pagine dunque segui le indicazioni <br> - Il sesto status è <b>"Iscrizioni momentaneamente chiuse"</b>, durante questo status viene segnalato che le iscrizioni sono state momentaneamente chiuse ma gli utenti possono continuare a visualizzare i <?php echo $set['set_nome_collettivi']; ?> e le loro iscrizioni. Questo status può servire a te per effettuare determinate modifiche non effettuabili a iscrizioni aperte. <br> - L'ultimo status è <b>"Iscrizioni chiuse (fine)"</b>, viene segnalata la chiusura definitiva delle iscrizioni agli utenti che non possono più modificare le proprie iscrizioni ma possono continuare a visualizzarle tramite l'apposita pagina.<br> - Abbiamo infine <b>"Questionario di gradimento della <?php echo $set['set_nome_cogestione']; ?>"</b> che permette agli utenti registrati di valutare la cogestione ed i collettivi ai quali hanno partecipato.</p></div>
          </li>
        </ul>
        <div class="input-field">
          <select onchange="SetStatusCogeChange()" style="border-radius: 25px;" id="set_status_cogestione" name="set_status_cogestione" class="browser-default" required="required">
            <option disabled selected>Seleziona</option>
            <option value="cogestione_hidden">Pre-<?php echo $set['set_nome_cogestione']; ?></option>
            <option value="cogestione_form">Apri il form di registrazione dei <?php echo $set['set_nome_collettivi']; ?></option>
            <option value="cogestione_on_hold">Pagina di pausa</option>
            <option value="cogestione_only_view"><?php echo ucfirst($set['set_nome_collettivi']); ?> solo in visualizzazione (iscrizioni chiuse)</option>
            <option value="cogestione_open">Iscrizioni aperte</option>
            <option value="cogestione_momentaneamente_chiusa">Iscrizioni momentaneamente chiuse</option>
            <option value="cogestione_chiusa">Iscrizioni chiuse (fine)</option>
            <option value="cogestione_questionario_gradimento">Questionario di gradimento della <?php echo $set['set_nome_cogestione']; ?></option>
          </select>
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center spazio_sopra">
        <p> <b>Seleziona la data e l'ora dalla quale accetterai la registrazione dei <?php echo $set['set_nome_collettivi']; ?></b> </p>
        <p class="col s6 center">Data</p>
        <p class="col s6 center">Ora</p>
        <input onchange="ShowFloatingButton()" id="set_data_apertura_form" name="set_data_apertura_form" type="text" class="col s5 datepicker_form browser-default input is-rounded">
        <input onchange="ShowFloatingButton()" id="set_ora_apertura_form" name="set_ora_apertura_form" type="text" class="col s5 offset-s2 timepicker_form browser-default input is-rounded">
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center spazio_sopra">
        <p> <b>Seleziona il numero di giorni di <?php echo $set['set_nome_cogestione']; ?>:</b> </p>
        <div class="input-field">
          <select onchange="ShowDays(this.value)" style="border-radius: 25px;" id="set_numero_giorni" name="set_numero_giorni" class="browser-default" required="required">
            <option disabled selected>Seleziona</option>
            <option value="1">1 giorno</option>
            <option value="2">2 giorni</option>
            <option value="3">3 giorni</option>
            <option value="4">4 giorni</option>
            <option value="5">5 giorni</option>
            <option value="6">6 giorni</option>
          </select>
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center">
        <p> <b>Seleziona i giorni in cui si svolgerà la <?php echo $set['set_nome_cogestione']; ?>:</b> </p>
        <?php for ($i=1; $i <= 6; $i++) { ?>
          <div id="div_giorno_<?php echo $i; ?>" style="display: none;">
              <p for="set_giorno<?php echo $i; ?>_cogestione">Giorno <?php echo $i; ?></p>
              <input onchange="ShowFloatingButton()" id="set_giorno<?php echo $i; ?>_cogestione" type="text" class="browser-default input is-rounded datepicker" name="set_giorno<?php echo $i; ?>_cogestione">
          </div>
        <?php } ?>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center spazio_sopra">
        <p> <b>Seleziona il numero di turni per ogni giorno di <?php echo $set['set_nome_cogestione']; ?>:</b> </p>
        <div class="input-field">
          <select onchange="ShowTurni(this.value)" style="border-radius: 25px;" id="set_turni_per_giorno" name="set_turni_per_giorno" class="browser-default" required="required">
            <option disabled selected>Seleziona</option>
            <option value="1">1 turno al giorno</option>
            <option value="2">2 turni al giorno</option>
            <option value="3">3 turni al giorno</option>
          </select>
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center">
        <p> <b>Seleziona gli orari che scandiranno la <?php echo $set['set_nome_cogestione']; ?>:</b> </p>
        <p>Indica solo gli orari necessari allo svolgimento della <?php echo $set['set_nome_cogestione']; ?>.</p>
        <div class="row">
            <p>Appello:</p>
            <input onchange="ShowFloatingButton()" id="set_orario_appello_open" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_appello_open">
            <p class="col s2">-</p>
            <input onchange="ShowFloatingButton()" id="set_orario_appello_close" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_appello_close">
        </div>
        <div class="row">
            <p>Accoglienza esterni del primo turno della mattina</p>
            <input onchange="ShowFloatingButton()" id="set_orario_accoglienza1_open" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_accoglienza1_open">
            <p class="col s2">-</p>
            <input onchange="ShowFloatingButton()" id="set_orario_accoglienza1_close" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_accoglienza1_close">
        </div>
        <div class="row">
            <p>Primo turno della mattina:</p>
            <input onchange="ShowFloatingButton()" id="set_orario_turno1_open" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_turno1_open">
            <p class="col s2">-</p>
            <input onchange="ShowFloatingButton()" id="set_orario_turno1_close" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_turno1_close">
        </div>
        <div style="display: none" id="secondo_turno">
        <div class="row">
            <p>Intervallo:</p>
            <input onchange="ShowFloatingButton()" id="set_orario_intervallo_open" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_intervallo_open">
            <p class="col s2">-</p>
            <input onchange="ShowFloatingButton()" id="set_orario_intervallo_close" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_intervallo_close">
        </div>
        <div class="row">
            <p>Accoglienza esterni del secondo turno della mattina</p>
            <input onchange="ShowFloatingButton()" id="set_orario_accoglienza2_open" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_accoglienza2_open">
            <p class="col s2">-</p>
            <input onchange="ShowFloatingButton()" id="set_orario_accoglienza2_close" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_accoglienza2_close">
        </div>
        <div class="row">
            <p>Secondo turno della mattina:</p>
            <input onchange="ShowFloatingButton()" id="set_orario_turno2_open" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_turno2_open">
            <p class="col s2">-</p>
            <input onchange="ShowFloatingButton()" id="set_orario_turno2_close" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_turno2_close">
        </div>
        </div>
        <div style="display: none" id="terzo_turno">
        <div class="row">
            <p>Secondo intervallo:</p>
            <input onchange="ShowFloatingButton()" id="set_orario_intervallo2_open" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_intervallo2_open">
            <p class="col s2">-</p>
            <input onchange="ShowFloatingButton()" id="set_orario_intervallo2_close" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_intervallo2_close">
        </div>
        <div class="row">
            <p>Accoglienza esterni del terzo turno della mattina</p>
            <input onchange="ShowFloatingButton()" id="set_orario_accoglienza3_open" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_accoglienza3_open">
            <p class="col s2">-</p>
            <input onchange="ShowFloatingButton()" id="set_orario_accoglienza3_close" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_accoglienza3_close">
        </div>
        <div class="row">
            <p>Terzo turno della mattina:</p>
            <input onchange="ShowFloatingButton()" id="set_orario_turno3_open" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_turno3_open">
            <p class="col s2">-</p>
            <input onchange="ShowFloatingButton()" id="set_orario_turno3_close" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_turno3_close">
        </div>
        </div>
        <div class="row">
            <p>Contrappello:</p>
            <input onchange="ShowFloatingButton()" id="set_orario_contrappello_open" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_contrappello_open">
            <p class="col s2">-</p>
            <input onchange="ShowFloatingButton()" id="set_orario_contrappello_close" type="text" class="browser-default input is-rounded timepicker col s5" name="set_orario_contrappello_close">
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center">
        <p> <b>Io li chiamo collettivi, altri corsi, tu come li chiami?:</b> </p>
        <div class="input-field">
          <input onchange="ShowFloatingButton()" placeholder="Come li chiami?" id="set_nome_collettivi" type="text" class="browser-default input is-rounded" name="set_nome_collettivi" required="required">
        </div>
      </div>
      <div class="col s10 offset-s1 center">
        <p> <b>Ridimmelo al singolare:</b> </p>
        <div class="input-field">
          <input onchange="ShowFloatingButton()" placeholder="Come lo chiami?" id="set_nome_collettivo" type="text" class="browser-default input is-rounded" name="set_nome_collettivo" required="required">
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center">
      <p> <b>Indica, se lo ritieni necessarie, delle informazioni aggiuntive per la pagina "Info" visibile agli studenti.</b> </p>
      <div class="input-field col s12">
        <input onchange="ShowFloatingButton()" placeholder="Info Extra" id="set_info_extra" type="text" class="browser-default input is-rounded" name="set_info_extra">
      </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center spazio_sopra">
        <p> <b>Seleziona il numero di spazi differenti che utilizzerai in <?php echo $set['set_nome_cogestione']; ?>:</b> </p>
        <div class="input-field">
          <select onchange="ShowSpaces(this.value, <?php echo $set['set_numero_spazi']; ?>)" style="border-radius: 25px;" id="set_numero_spazi" name="set_numero_spazi" class="browser-default" required="required">
            <option disabled selected>Seleziona</option>
            <option value="1">1 spazio</option>
            <?php for ($i=2; $i <=10 ; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?> spazi</option>
            <?php } ?>
          </select>
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center">
        <p> <b>Per ogni spazio indica il nome che preferisci, il numero di studenti che può ospitare e il numero di professori necessari alla sorveglianza.</b> </p>
        <p><b class="red-text">Attenzione!</b> cambiare i posti degli spazi dopo aver aperto la registrazione dei <?php echo $set['set_nome_collettivi']; ?> non cambia i numeri di posti nei <?php echo $set['set_nome_collettivi']; ?> già presenti, ma cambia solo il numero di posti per spazio nei <?php echo $set['set_nome_collettivi']; ?> nei quali si aggiunge un turno o nei <?php echo $set['set_nome_collettivi']; ?> proposti successivamente alla modifica. Per modificare i posti dei collettivi già presenti modificali da <a href="/admin/collettivi/admincollettivi">"Gestione collettivi"</a>. Infine, togliendo uno spazio, tutti i <?php echo $set['set_nome_collettivi']; ?> proposti relativi a quello spazio rimarranno innominati e potrebbero anche perdere tutti i loro posti causando problemi con le iscrizioni.</p>
        <?php for ($j=1; $j <= 10; $j++) { ?>
        <div id="div_spazio_<?php echo $j; ?>" style="display: <?php if ($set['set_numero_spazi'] >= $j) {echo 'block';} else {echo 'none';} ?>;">
          <p class="col s12">Spazio <?php echo $j; ?>:</p>
          <div class="input-field col s4" style="display: none;">
            <select style="border-radius: 25px;" id="set_active_spazio_<?php echo $j; ?>" name="set_active_spazio_<?php echo $j; ?>" class="browser-default" required="required">
              <option disabled selected>Seleziona</option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          <div class="input-field col s4">
            <input onchange="ShowFloatingButton()" placeholder="Nome" type="text" id="set_nome_spazio_<?php echo $j; ?>" class="browser-default input is-rounded" name="set_nome_spazio_<?php echo $j; ?>" <?php if ($set['set_active_spazio_'.$j] == 1) {echo 'required="required"';} ?>>
          </div>
          <div class="input-field col s4">
            <select onchange="ShowFloatingButton()" style="border-radius: 25px;" id="set_posti_spazio_<?php echo $j; ?>" name="set_posti_spazio_<?php echo $j; ?>" class="browser-default" required="required">
              <option disabled selected>Seleziona</option>
              <option value="0">Illimitati studenti</option>
              <option value="1">1 studente</option>
              <?php
              for ($i=2; $i<=2000; $i++)
              {
                ?>
              <option value="<?php echo $i;?>"><?php echo $i;?> studenti</option>
              <?php
              }
                ?>
            </select>
          </div>
          <div class="input-field col s4">
            <select onchange="ShowFloatingButton()" style="border-radius: 25px;" id="set_posti_spazio_<?php echo $j; ?>_prof" name="set_posti_spazio_<?php echo $j; ?>_prof" class="browser-default" <?php if ($set['set_active_spazio_'.$j] == 1) {echo 'required="required"';} ?>>
              <option disabled selected>Seleziona</option>
              <option value="0">0 professori</option>
              <option value="1">1 professore</option>
              <?php
              for ($i=2; $i<=2000; $i++)
              {
                ?>
              <option value="<?php echo $i;?>"><?php echo $i;?> professori</option>
              <?php
              }
                ?>
            </select>
          </div>
        </div>
        <?php } ?>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center">
        <p> <b>Inserisci tutti gli strumenti che gli utenti possono selezionare come necessità di base per il loro <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
        <p>Inserisci gli strumenti alternandoli con una virgola e uno spazio successivo. Es. computer della scuola, connessione ad internet, lim</p>
        <div class="input-field">
          <input onchange="ShowFloatingButton()" placeholder="Strumenti" id="set_strumenti_cogestione" type="text" class="input is-rounded browser-default" name="set_strumenti_cogestione" required="required">
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center spazio_sopra">
        <p> <b>Hai bisogno del curriculum degli esterni che verranno in cogestione?</b> </p>
        <div class="input-field">
          <select style="border-radius: 25px;" id="set_curriculum_necessario" name="set_curriculum_necessario" class="browser-default" required="required">
            <option disabled selected>Seleziona</option>
            <option value="1">Sì, richiedi i curriculum</option>
            <option value="0">No, non richiedere i curriculum</option>
          </select>
        </div>
      </div>
      <hr class="col s12">
      <div class="col s10 offset-s1 center">
        <p> <b>Inserisci Nome e Cognome del responsabile del trattamento dei dati</b> </p>
        <p>La persona in questione sarà la responsabile della gestione e del trattamento dei dati raccolti attraverso la piattaforma. La persona in questione <b>DEVE</b> essere maggiorenne e <b>DEVE</b> seguire le norme ai sensi del GDPR (Regolamento UE 2016/679).</p>
        <div class="input-field">
          <input onchange="ShowFloatingButton()" placeholder="Responsabile trattamento dati" id="set_nome_responsabile_privacy" type="text" class="input is-rounded browser-default" name="set_nome_responsabile_privacy" required="required">
        </div>
      </div>

    <div class="row center margine_sopra">
      <button style="border-radius: 25px;" class="btn waves-effect waves-light btn-large center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" type="submit" name="submit" value="Upload">Salva Modifiche
        <i class="material-icons right">send</i>
      </button>
    </div>
  </div>


  <div id="FloatingButton" style="display:none;" class="fixed-action-btn">
    <button style="border-radius: 25px;" class="btn waves-effect waves-light btn-large center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" type="submit" name="submit" value="Upload">Salva
      <i class="material-icons right">send</i>
    </button>
  </div>
  </form>
</div>


<script>
$('#set_intestazione_sito').val('<?php echo addslashes($row["set_intestazione_sito"]); ?>');
$('#set_nome_scuola').val('<?php echo addslashes($row["set_nome_scuola"]); ?>');
$('#set_colore_base').val('<?php echo addslashes($row["set_colore_base"]); ?>');
$('#set_colore_base_scritte').val('<?php echo addslashes($row["set_colore_base_scritte"]); ?>');
$('#set_colore_bottoni').val('<?php echo addslashes($row["set_colore_bottoni"]); ?>');
$('#set_colore_bottoni_scritte').val('<?php echo addslashes($row["set_colore_bottoni_scritte"]); ?>');
$('#set_status_cogestione').val('<?php echo addslashes($row["set_status_cogestione"]); ?>');
$('#set_data_apertura_form').val('<?php echo addslashes($row["set_data_apertura_form"]); ?>');
$('#set_ora_apertura_form').val('<?php echo addslashes($row["set_ora_apertura_form"]); ?>');
$('#set_numero_giorni').val('<?php echo addslashes($row["set_numero_giorni"]); ?>');
$('#set_turni_per_giorno').val('<?php echo addslashes($row["set_turni_per_giorno"]); ?>');
$('#set_nome_collettivi').val('<?php echo addslashes($row["set_nome_collettivi"]); ?>');
$('#set_nome_collettivo').val('<?php echo addslashes($row["set_nome_collettivo"]); ?>');
$('#set_nome_cogestione').val('<?php echo addslashes($row["set_nome_cogestione"]); ?>');
$('#set_giorno1_cogestione').val('<?php echo addslashes($row["set_giorno1_cogestione"]); ?>');
$('#set_giorno2_cogestione').val('<?php echo addslashes($row["set_giorno2_cogestione"]); ?>');
$('#set_giorno3_cogestione').val('<?php echo addslashes($row["set_giorno3_cogestione"]); ?>');
$('#set_giorno4_cogestione').val('<?php echo addslashes($row["set_giorno4_cogestione"]); ?>');
$('#set_giorno5_cogestione').val('<?php echo addslashes($row["set_giorno5_cogestione"]); ?>');
$('#set_giorno6_cogestione').val('<?php echo addslashes($row["set_giorno6_cogestione"]); ?>');
$('#set_orario_appello_open').val('<?php echo addslashes($row["set_orario_appello_open"]); ?>');
$('#set_orario_appello_close').val('<?php echo addslashes($row["set_orario_appello_close"]); ?>');
$('#set_orario_accoglienza1_open').val('<?php echo addslashes($row["set_orario_accoglienza1_open"]); ?>');
$('#set_orario_accoglienza1_close').val('<?php echo addslashes($row["set_orario_accoglienza1_close"]); ?>');
$('#set_orario_turno1_open').val('<?php echo addslashes($row["set_orario_turno1_open"]); ?>');
$('#set_orario_turno1_close').val('<?php echo addslashes($row["set_orario_turno1_close"]); ?>');
$('#set_orario_intervallo_open').val('<?php echo addslashes($row["set_orario_intervallo_open"]); ?>');
$('#set_orario_intervallo_close').val('<?php echo addslashes($row["set_orario_intervallo_close"]); ?>');
$('#set_orario_accoglienza2_open').val('<?php echo addslashes($row["set_orario_accoglienza2_open"]); ?>');
$('#set_orario_accoglienza2_close').val('<?php echo addslashes($row["set_orario_accoglienza2_close"]); ?>');
$('#set_orario_turno2_open').val('<?php echo addslashes($row["set_orario_turno2_open"]); ?>');
$('#set_orario_turno2_close').val('<?php echo addslashes($row["set_orario_turno2_close"]); ?>');
$('#set_orario_intervallo2_open').val('<?php echo addslashes($row["set_orario_intervallo2_open"]); ?>');
$('#set_orario_intervallo2_close').val('<?php echo addslashes($row["set_orario_intervallo2_close"]); ?>');
$('#set_orario_accoglienza3_open').val('<?php echo addslashes($row["set_orario_accoglienza3_open"]); ?>');
$('#set_orario_accoglienza3_close').val('<?php echo addslashes($row["set_orario_accoglienza3_close"]); ?>');
$('#set_orario_turno3_open').val('<?php echo addslashes($row["set_orario_turno3_open"]); ?>');
$('#set_orario_turno3_close').val('<?php echo addslashes($row["set_orario_turno3_close"]); ?>');
$('#set_orario_contrappello_open').val('<?php echo addslashes($row["set_orario_contrappello_open"]); ?>');
$('#set_orario_contrappello_close').val('<?php echo addslashes($row["set_orario_contrappello_close"]); ?>');
$('#set_info_extra').val('<?php echo addslashes($row["set_info_extra"]); ?>');
$('#set_numero_spazi').val('<?php echo addslashes($row["set_numero_spazi"]); ?>');
$('#set_nome_spazio_1').val('<?php echo addslashes($row["set_nome_spazio_1"]); ?>');
$('#set_posti_spazio_1').val('<?php echo addslashes($row["set_posti_spazio_1"]); ?>');
$('#set_posti_spazio_1_prof').val('<?php echo addslashes($row["set_posti_spazio_1_prof"]); ?>');
$('#set_active_spazio_1').val('<?php echo addslashes($row["set_active_spazio_1"]); ?>');
$('#set_nome_spazio_2').val('<?php echo addslashes($row["set_nome_spazio_2"]); ?>');
$('#set_posti_spazio_2').val('<?php echo addslashes($row["set_posti_spazio_2"]); ?>');
$('#set_posti_spazio_2_prof').val('<?php echo addslashes($row["set_posti_spazio_2_prof"]); ?>');
$('#set_active_spazio_2').val('<?php echo addslashes($row["set_active_spazio_2"]); ?>');
$('#set_nome_spazio_3').val('<?php echo addslashes($row["set_nome_spazio_3"]); ?>');
$('#set_posti_spazio_3').val('<?php echo addslashes($row["set_posti_spazio_3"]); ?>');
$('#set_posti_spazio_3_prof').val('<?php echo addslashes($row["set_posti_spazio_3_prof"]); ?>');
$('#set_active_spazio_3').val('<?php echo addslashes($row["set_active_spazio_3"]); ?>');
$('#set_nome_spazio_4').val('<?php echo addslashes($row["set_nome_spazio_4"]); ?>');
$('#set_posti_spazio_4').val('<?php echo addslashes($row["set_posti_spazio_4"]); ?>');
$('#set_posti_spazio_4_prof').val('<?php echo addslashes($row["set_posti_spazio_4_prof"]); ?>');
$('#set_active_spazio_4').val('<?php echo addslashes($row["set_active_spazio_4"]); ?>');
$('#set_nome_spazio_5').val('<?php echo addslashes($row["set_nome_spazio_5"]); ?>');
$('#set_posti_spazio_5').val('<?php echo addslashes($row["set_posti_spazio_5"]); ?>');
$('#set_posti_spazio_5_prof').val('<?php echo addslashes($row["set_posti_spazio_5_prof"]); ?>');
$('#set_active_spazio_5').val('<?php echo addslashes($row["set_active_spazio_5"]); ?>');
$('#set_nome_spazio_6').val('<?php echo addslashes($row["set_nome_spazio_6"]); ?>');
$('#set_posti_spazio_6').val('<?php echo addslashes($row["set_posti_spazio_6"]); ?>');
$('#set_posti_spazio_6_prof').val('<?php echo addslashes($row["set_posti_spazio_6_prof"]); ?>');
$('#set_active_spazio_6').val('<?php echo addslashes($row["set_active_spazio_6"]); ?>');
$('#set_nome_spazio_7').val('<?php echo addslashes($row["set_nome_spazio_7"]); ?>');
$('#set_posti_spazio_7').val('<?php echo addslashes($row["set_posti_spazio_7"]); ?>');
$('#set_posti_spazio_7_prof').val('<?php echo addslashes($row["set_posti_spazio_7_prof"]); ?>');
$('#set_active_spazio_7').val('<?php echo addslashes($row["set_active_spazio_7"]); ?>');
$('#set_nome_spazio_8').val('<?php echo addslashes($row["set_nome_spazio_8"]); ?>');
$('#set_posti_spazio_8').val('<?php echo addslashes($row["set_posti_spazio_8"]); ?>');
$('#set_posti_spazio_8_prof').val('<?php echo addslashes($row["set_posti_spazio_8_prof"]); ?>');
$('#set_active_spazio_8').val('<?php echo addslashes($row["set_active_spazio_8"]); ?>');
$('#set_nome_spazio_9').val('<?php echo addslashes($row["set_nome_spazio_9"]); ?>');
$('#set_posti_spazio_9').val('<?php echo addslashes($row["set_posti_spazio_9"]); ?>');
$('#set_posti_spazio_9_prof').val('<?php echo addslashes($row["set_posti_spazio_9_prof"]); ?>');
$('#set_active_spazio_9').val('<?php echo addslashes($row["set_active_spazio_9"]); ?>');
$('#set_nome_spazio_10').val('<?php echo addslashes($row["set_nome_spazio_10"]); ?>');
$('#set_posti_spazio_10').val('<?php echo addslashes($row["set_posti_spazio_10"]); ?>');
$('#set_posti_spazio_10_prof').val('<?php echo addslashes($row["set_posti_spazio_10_prof"]); ?>');
$('#set_active_spazio_10').val('<?php echo addslashes($row["set_active_spazio_10"]); ?>');
$('#set_strumenti_cogestione').val('<?php echo addslashes($row["set_strumenti_cogestione"]); ?>');
$('#set_curriculum_necessario').val('<?php echo addslashes($row["set_curriculum_necessario"]); ?>');
$('#set_nome_responsabile_privacy').val('<?php echo addslashes($row["set_nome_responsabile_privacy"]); ?>');

$(document).ready(function(){
  $('.datepicker_form').datepicker({format: 'mmm dd, yyyy'}); //datepicker apertura form
  $('.timepicker_form').timepicker({twelveHour: false});
  $('.datepicker').datepicker({format: 'dd-mm'}); //tutti gli altri
  $('.timepicker').timepicker({twelveHour: false});
  $('.collapsible').collapsible();
  for (var i = 1; i <= <?php echo $row["set_numero_giorni"]; ?>; i++) {
    document.getElementById('div_giorno_' + i).style.display = "block";
  }
  document.getElementById('div_giorno_' + <?php echo $row["set_numero_giorni"]; ?>).className = "spazietto_sotto";
  if (<?php echo $row["set_turni_per_giorno"]; ?> == 1) {
    document.getElementById('secondo_turno').style.display = "none";
    document.getElementById('terzo_turno').style.display = "none";
  }
  if (<?php echo $row["set_turni_per_giorno"]; ?> == 2) {
    document.getElementById('secondo_turno').style.display = "block";
    document.getElementById('terzo_turno').style.display = "none";
  }
  if (<?php echo $row["set_turni_per_giorno"]; ?> == 3) {
    document.getElementById('secondo_turno').style.display = "block";
    document.getElementById('terzo_turno').style.display = "block";
  }
});


  function ShowFloatingButton(){
    document.getElementById('FloatingButton').style.display = "block";
  }

  function ShowDays(day_n){
    ShowFloatingButton();
    for (var i = 1; i <= day_n; i++) {
      document.getElementById('div_giorno_' + i).style.display = "block";
    }
    document.getElementById('div_giorno_' + day_n).className = "spazietto_sotto";
    for (var j = (+day_n + 1); j <= 6; j++) {
      document.getElementById('div_giorno_' + j).style.display = "none";
      document.getElementById('div_giorno_' + j).value = '0';
    }
  }
  function ShowTurni(turni_n){
    ShowFloatingButton();
    if (turni_n == 1) {
      document.getElementById('secondo_turno').style.display = "none";
      document.getElementById('terzo_turno').style.display = "none";
    }
    if (turni_n == 2) {
      document.getElementById('secondo_turno').style.display = "block";
      document.getElementById('terzo_turno').style.display = "none";
    }
    if (turni_n == 3) {
      document.getElementById('secondo_turno').style.display = "block";
      document.getElementById('terzo_turno').style.display = "block";
    }
  }
  function ShowSpaces(spaces_n, spaces_now){
    ShowFloatingButton();
    if (spaces_now > spaces_n) {
      if (window.confirm('Sei sicuro di voler togliere uno spazio? Hai letto i possibili rischi legati a questa azione?'))
        {
          procedi = 1;
        }
        else
        {
          procedi = 0;
        }
    } else {
      procedi = 1;
    }
    if (procedi == 1) {
      for (var i = 1; i <= spaces_n; i++) {
        document.getElementById('div_spazio_' + i).style.display = "block";
        document.getElementById('set_active_spazio_' + i).value = '1';
        document.getElementById('set_nome_spazio_' + i).required = true;
        document.getElementById('div_spazio_' + i).classList.remove("spazietto_sotto");
      }
      document.getElementById('div_spazio_' + spaces_n).className = "spazietto_sotto";
      for (var j = (+spaces_n + 1); j <= 10; j++) {
        document.getElementById('div_spazio_' + j).style.display = "none";
        document.getElementById('set_nome_spazio_' + j).value = '';
        document.getElementById('set_nome_spazio_' + j).required = false;
        document.getElementById('set_posti_spazio_' + j).value = '0';
        document.getElementById('set_posti_spazio_' + j + '_prof').value = '0';
        document.getElementById('set_active_spazio_' + j).value = '0';
        document.getElementById('div_spazio_' + i).classList.remove("spazietto_sotto");
      }
    } else if (procedi == 0) {
      document.getElementById('set_numero_spazi').value = spaces_now;
      document.getElementById('div_spazio_' + spaces_now).className = "spazietto_sotto";
      for (var j = (+spaces_now + 1); j <= 10; j++) {
        document.getElementById('div_spazio_' + j).style.display = "none";
        document.getElementById('set_nome_spazio_' + j).value = '';
        document.getElementById('set_nome_spazio_' + j).required = false;
        document.getElementById('set_posti_spazio_' + j).value = '0';
        document.getElementById('set_posti_spazio_' + j + '_prof').value = '0';
        document.getElementById('set_active_spazio_' + j).value = '0';
        document.getElementById('div_spazio_' + i).classList.remove("spazietto_sotto");
      }
    }
  }

  function SetStatusCogeChange() {
    var x = document.getElementById("set_status_cogestione").value;
    if (x == 'cogestione_open') {
      if (<?php echo $alarm_open_subs ?> == 1) {
        alert('ATTENZIONE: Stai aprendo le iscrizioni avendo meno posti (<?php echo $postitotali; ?>) che utenti (<?php echo $userstotali; ?>)')
      }
    }
    ShowFloatingButton();
  }

</script>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>

</html>
