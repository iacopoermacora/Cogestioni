<?php
$sql = "SELECT * FROM settings_cogestione";
$resultvariabili = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($resultvariabili);
$set = array();

$set['set_intestazione_sito'] = $row['set_intestazione_sito'];
$set['set_nome_scuola'] = $row['set_nome_scuola'];
$set['set_colore_base'] = $row['set_colore_base'];
$set['set_colore_base_scritte'] = $row['set_colore_base_scritte'];
$set['set_colore_bottoni'] = $row['set_colore_bottoni'];
$set['set_colore_bottoni_scritte'] = $row['set_colore_bottoni_scritte'];
$set['set_status_cogestione'] = $row['set_status_cogestione'];
$set['set_data_apertura_form'] = $row['set_data_apertura_form'];
$set['set_ora_apertura_form'] = $row['set_ora_apertura_form'];
$set['set_numero_giorni'] = $row['set_numero_giorni'];
$set['set_turni_per_giorno'] = $row['set_turni_per_giorno'];
$set['set_turni_totali'] = $row['set_turni_totali'];
$set['set_nome_collettivi'] = strtolower($row['set_nome_collettivi']);
$set['set_nome_collettivo'] = strtolower($row['set_nome_collettivo']);
$set['set_nome_cogestione'] = strtolower($row['set_nome_cogestione']);
$set['set_giorno1_cogestione'] = $row['set_giorno1_cogestione'];
$set['set_giorno2_cogestione'] = $row['set_giorno2_cogestione'];
$set['set_giorno3_cogestione'] = $row['set_giorno3_cogestione'];
$set['set_giorno4_cogestione'] = $row['set_giorno4_cogestione'];
$set['set_giorno5_cogestione'] = $row['set_giorno5_cogestione'];
$set['set_giorno6_cogestione'] = $row['set_giorno6_cogestione'];
$set['set_orario_appello'] = $row['set_orario_appello_open']."-".$row['set_orario_appello_close'];
$set['set_orario_accoglienza1'] = $row['set_orario_accoglienza1_open']."-".$row['set_orario_accoglienza1_close'];
$set['set_orario_turno1'] = $row['set_orario_turno1_open']."-".$row['set_orario_turno1_close'];
$set['set_orario_intervallo'] = $row['set_orario_intervallo_open']."-".$row['set_orario_intervallo_close'];
$set['set_orario_accoglienza2'] = $row['set_orario_accoglienza2_open']."-".$row['set_orario_accoglienza2_close'];
$set['set_orario_turno2'] = $row['set_orario_turno2_open']."-".$row['set_orario_turno2_close'];
$set['set_orario_intervallo2'] = $row['set_orario_intervallo2_open']."-".$row['set_orario_intervallo2_close'];
$set['set_orario_accoglienza3'] = $row['set_orario_accoglienza3_open']."-".$row['set_orario_accoglienza3_close'];
$set['set_orario_turno3'] = $row['set_orario_turno3_open']."-".$row['set_orario_turno3_close'];
$set['set_orario_contrappello'] = $row['set_orario_contrappello_open']."-".$row['set_orario_contrappello_close'];
$set['set_info_extra'] = $row['set_info_extra'];
$set['set_numero_spazi'] = $row['set_numero_spazi'];

for ($i=1; $i <= 10; $i++) {
  //$set['set_nome_spazio_'.$i]
  $set['set_nome_spazio_'.$i] = $row['set_nome_spazio_'.$i];
  //$set['set_posti_spazio_'.$i]
  $set['set_posti_spazio_'.$i] = $row['set_posti_spazio_'.$i];
  //$set['set_posti_spazio_'.$i.'_prof']
  $set['set_posti_spazio_'.$i.'_prof'] = $row['set_posti_spazio_'.$i.'_prof'];
  //$set['set_active_spazio_'.$i]
  $set['set_active_spazio_'.$i] = $row['set_active_spazio_'.$i];
  //$set['set_unlimited_spazio_'.$i]
  $set['set_unlimited_spazio_'.$i] = $row['set_unlimited_spazio_'.$i];
}

$set['set_strumenti_cogestione'] = $row['set_strumenti_cogestione'];
$set['set_curriculum_necessario'] = $row['set_curriculum_necessario'];
$set['set_nome_responsabile_privacy'] = $row['set_nome_responsabile_privacy'];

 ?>
