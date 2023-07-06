<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

include $_SERVER['DOCUMENT_ROOT'].'/card.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

</head>
  <body style="background-color: #eceff1;">

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - <?php echo ucfirst($set['set_nome_collettivi']); ?> Eliminati</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<div id="container_total">
  <div class="container">

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sopra"><b>Ecco i <?php echo $set['set_nome_collettivi']; ?> eliminati.</b></h5>
      <p class="col s12 spazietto_sotto"> <b>Togliere l'eliminazione ad un <?php echo $set['set_nome_collettivo'] ?> NON andrà a ri-iscrivere le persone automaticamente disiscritte in fase di eliminazione</b> </p>
    </div>

    <p>Ricerca per titolo</p>

    <div style="border-radius: 15px;" class="z-depth-1">
      <nav style="border-radius: 15px;" >
          <div style="border-radius: 15px;" class="nav-wrapper <?php echo $set['set_colore_base']; ?> <?php echo $set['set_colore_base_scritte']; ?>-text">
            <form style="border-radius: 15px;" action="/admin/collettivi/admincollettivieliminati" method="GET">
              <div style="border-radius: 15px;" class="input-field">
                <input style="border-radius: 15px;" id="search" type="search" name="search">
                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
              </div>
            </form>
          </div>
        </nav>
    </div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/bottoniturni.php' ?>

<?php

$turni = array('t1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 't13', 't14', 't15', 't16', 't17', 't18');
if (!in_array($_GET['turno'], $turni) && $_GET['turno'] != '') {
  echo "<p class='center margine_sopra'>Cosa stai combinando? Basta giocare con l'URL! <a href='/index'>Clicca qui</a> invece di investigare...</p>";
} else {

  if (isset($_GET['turno'])) {
    $turno = mysqli_real_escape_string($link, $_GET['turno']);
  } else {
    $turno = 'id';
  }
      ?>
      <div class="row">
      <?php

  $search = mysqli_real_escape_string($link, $_GET['search']);
  $sql = "SELECT * FROM collettivi WHERE (titolo_collettivo LIKE '%$search%' OR nome_referente LIKE '%$search%' OR cognome_referente LIKE '%$search%' OR descrizione_collettivo LIKE '%$search%' OR nome_esterno LIKE '%$search%' OR cognome_esterno LIKE '%$search%' OR turni LIKE '%,$search,%') AND ".$turno." != -100  AND eliminato = 'SI' AND id > 0";
  $collettivi = mysqli_query($link, $sql);
  if($row = mysqli_fetch_assoc($collettivi)) {

    $counter = 0;

  $sql = "SELECT * FROM collettivi WHERE (titolo_collettivo LIKE '%$search%' OR nome_referente LIKE '%$search%' OR cognome_referente LIKE '%$search%' OR descrizione_collettivo LIKE '%$search%' OR nome_esterno LIKE '%$search%' OR cognome_esterno LIKE '%$search%' OR turni LIKE '%,$search,%') AND ".$turno." != -100  AND eliminato = 'SI' AND id > 0";
  $collettivi2 = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($collettivi2)) {

    $counter++;

    DisplayCard($row, $turno, '', '', '', $set, 9, 0, 0);

          if (($counter % 3) == 0)
            {
              echo "</div><div class='row'>";
            }
          ?>
        <?php }} else { ?>
          <p class="center margine_sopra">Evviva! Nessun <?php echo $set['set_nome_collettivo'] ?> è stato eliminato!</p>
          <?php }} ?>
      </div>
    </div>
  </div>

<script>
$('#search').val('<?php echo $search; ?>');

function Elimina(id){
  jQuery.ajax({
    type: "GET",
    url: "/admin/collettivi/annullaeliminacollettivo.php",
    data: {"id" : id},
    cache: false,
    success: function(data){
      if (data == 'success') {
        $("#container_total").load("/admin/collettivi/admincollettivieliminati.php #container_total");
      } else {
        alert('ERRORE: Si è verificato un errore');
      }
   },
 });
}
</script>

<!--Footer inizio-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>
</html>
