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

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Gestisci <?php echo ucfirst($set['set_nome_collettivi']); ?></title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<!--Container-->

<div id="container_total">
<div id="container_total" class="container" style:"margin-bottom: 4em;">

<div style="border-radius: 15px; background-color: #fff;" class="row margine_sopra z-depth-1 margine_sotto spazietto_sotto spazietto_sopra">
  <div class="col s12 m10 l10 offset-l1 offset-m1 center">
    <h6><b>Ciao, in questa pagina puoi vedere le informazioni di ogni <?php echo $set['set_nome_collettivo'] ?> e modificarle, ma anche eliminare o segnalare un <?php echo $set['set_nome_collettivo'] ?> oppure vederne gli iscritti.</b><hr><a href="javascript:scrolltosegnalati()">Vedi i collettivi segnalati.</a></h6>
  </div>
</div>

  <div style="border-radius: 15px;" class="z-depth-1">
    <nav style="border-radius: 15px;" >
        <div style="border-radius: 15px;" class="nav-wrapper <?php echo $set['set_colore_base']; ?> <?php echo $set['set_colore_base_scritte']; ?>-text">
          <form style="border-radius: 15px;" action="/admin/collettivi/admincollettivi" method="GET">
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

<!--Collettivi-->
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
  $sql = "SELECT * FROM collettivi WHERE (titolo_collettivo LIKE '%$search%' OR nome_referente LIKE '%$search%' OR cognome_referente LIKE '%$search%' OR descrizione_collettivo LIKE '%$search%' OR nome_esterno LIKE '%$search%' OR cognome_esterno LIKE '%$search%' OR turni LIKE '%,$search,%') AND ".$turno." != -100 AND segnalato='NO' AND eliminato='NO' AND id > 0 ORDER BY id DESC";
  $collettivi = mysqli_query($link, $sql);
  if($row = mysqli_fetch_assoc($collettivi)) {

  $counter = 0;

  $search = mysqli_real_escape_string($link, $_GET['search']);
  $sql = "SELECT * FROM collettivi WHERE (titolo_collettivo LIKE '%$search%' OR nome_referente LIKE '%$search%' OR cognome_referente LIKE '%$search%' OR descrizione_collettivo LIKE '%$search%' OR nome_esterno LIKE '%$search%' OR cognome_esterno LIKE '%$search%' OR turni LIKE '%,$search,%') AND ".$turno." != -100 AND segnalato='NO' AND eliminato='NO' AND id > 0 ORDER BY id DESC";
  $collettivi = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($collettivi)) {

    $counter++;

      DisplayCard($row, $turno, '', '', '', $set, 5, 0, 0);

          if (($counter % 3) == 0)
            {
              echo "</div><div class='row'>";
            }
          ?>
        <?php }} else { ?>
          <p class="center margine_sopra">Mi dispiace... Nessun risultato presente... ma prova a cambiare il parametro di ricerca subito sotto la barra di ricerca, magari sarai più fortunat*!</p>
          <?php }} ?>
        </div>
        <?php
      $sql = "SELECT * FROM collettivi WHERE segnalato='SI' AND eliminato='NO' AND id > 0";
      $collettivi = mysqli_query($link, $sql);
      if($row = mysqli_fetch_assoc($collettivi)) {

        $counter2 = 0;

        ?>
        <div class="row">
<div class="col s12">
  <p id="segnalati"></p>
  <h3 class="center"><?php echo ucfirst($set['set_nome_collettivi']); ?> segnalati:</h3>
</div>
<?php } ?>
        </div>
        <div class="row">
          <?php
        $sql = "SELECT * FROM collettivi WHERE segnalato='SI' AND eliminato='NO' AND id > 0";
        $collettivi = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($collettivi)) {

          $counter2++;

          DisplayCard($row, $turno, '', '', '', $set, 6, 0, 0);

                if (($counter2 % 3) == 0)
                  {
                    echo "</div><div class='row'>";
                  }
                ?>
                <?php } ?>
              </div>




</div>
</div>

<script>
$('#search').val('<?php echo $search; ?>');

function scrolltosegnalati() {
$('html, body').animate({
    scrollTop: $("#segnalati").offset().top
}, 3000);
}

function funzioneSegnala(id) {
var r = confirm("Se segnali un <?php echo $set['set_nome_collettivo'] ?> disiscriverai tutte le persone eventualmente iscritte, intendi procedere comunque?");
if (r == true) {
  Segnala(id);
}}

function Segnala(id){
  jQuery.ajax({
    type: "GET",
    url: "/admin/collettivi/segnalacollettivo.php",
    data: {"id" : id},
    cache: false,
    success: function(data){
      if (data == 'success') {
        $("#container_total").load("/admin/collettivi/admincollettivi.php #container_total");
      } else {
        alert('ERRORE: Si è verificato un errore');
      }
   },
 });
}

function AnnullaSegnala(id){
  jQuery.ajax({
    type: "GET",
    url: "/admin/collettivi/annullasegnalacollettivo",
    data: {"id" : id},
    cache: false,
    success: function(data){
      if (data == 'success') {
        $("#container_total").load("/admin/collettivi/admincollettivi.php #container_total");
      } else {
        alert('ERRORE: Si è verificato un errore');
      }
   },
 });
}

function funzioneElimina(id) {
var r = confirm("Se elimini un <?php echo $set['set_nome_collettivo'] ?> disiscriverai tutte le persone eventualmente iscritte, intendi procedere comunque?");
if (r == true) {
  Elimina(id);
}}

function Elimina(id){
  jQuery.ajax({
    type: "GET",
    url: "/admin/system/delete.php",
    data: { "eliminando" : "collettivo", "id" : id},
    cache: false,
    success: function(data){
      if (data == 'success') {
        $("#container_total").load("/admin/collettivi/admincollettivi.php #container_total");
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
