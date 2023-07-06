<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'professore_and_professore_admin');

include $_SERVER['DOCUMENT_ROOT'].'/card.php';

if ($set['set_status_cogestione'] != 'cogestione_form' && $set['set_status_cogestione'] != 'cogestione_on_hold') {
 header('location: /index');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body style="background-color: #eceff1;">

  <title><?php echo $set['set_intestazione_sito']; ?> - Approvazione Cogestione</title>
    <!--Inizio Navbar-->
    <div class="navbar-fixed">
    <nav class="<?php echo $set['set_colore_base']; ?> z-depth-0">
      <div class="nav-wrapper container">
        <a class="brand-logo center">Approvazione</a>
        <ul class="right">
          <li><a style="border-radius: 20px;" class="waves-effect waves-light btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="/">Torna al sito</a></li>
        </ul>
      </div>
    </nav>
    </div>

<!--Hero-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/hero.php'; ?>

<div id="container_total">
  <div class="container" style:"margin-bottom: 4em;">

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sotto spazietto_sopra margine_sopra center z-depth-1">
      <h6 class="col s10 offset-s1"><b>Ciao, questa è una pagina di approvazione dei <?php echo $set['set_nome_collettivi']; ?>. Segnala i <?php echo $set['set_nome_collettivi']; ?> che non ritieni adatti con l'apposito bottone alla fine delle informazioni di ogni <?php echo $set['set_nome_collettivo'] ?>. In fondo alla pagina troverai i <?php echo $set['set_nome_collettivi']; ?> segnalati da te o da altri moderatori per poterli revisionare ulteriormente.</b><hr><a href="javascript:scrolltosegnalati()">Vedi i collettivi segnalati.</a></h6>
    </div>

    <div style="border-radius: 15px;" class="hoverable z-depth-1">
      <nav style="border-radius: 15px;" class="<?php echo $set['set_colore_base']; ?>">
          <div style="border-radius: 15px;" class="nav-wrapper">
            <form action="/main/docenti/approvazione_cogestione" method="GET">
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
  <div id="collettivi">
      <?php
      $turni = array('t1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 't13', 't14', 't15', 't16', 't17', 't18');
      if (!in_array($_GET['turno'], $turni) && $_GET['turno'] != '') {
        echo "<p class='center margine_sopra'>Cosa stai combinando? Basta giocare con l'URL! <a href='/index'>Clicca qui</a> invece di investigare...</p>";
      } else {

        if (isset($_GET['turno'])) {
          $turno = mysqli_real_escape_string($link, $_GET['turno']);
        } else {
          $turno = 'id';
        } ?>
        <div class="row lastblock">
        <?php
        $search = mysqli_real_escape_string($link, $_GET['search']);
        $sql = "SELECT * FROM collettivi WHERE (titolo_collettivo LIKE '%$search%' OR nome_referente LIKE '%$search%' OR cognome_referente LIKE '%$search%' OR descrizione_collettivo LIKE '%$search%' OR nome_esterno LIKE '%$search%' OR cognome_esterno LIKE '%$search%' OR turni LIKE '%,$search,%') AND ".$turno." != -100 AND segnalato='NO' AND eliminato='NO' AND id > 0 ORDER BY titolo_collettivo LIMIT 12";
        $result = mysqli_query($link, $sql);
        if(mysqli_num_rows($result) > 0){
        $counter = 0;
        while($row = mysqli_fetch_assoc($result)) {
        $counter++;

        DisplayCard($row, $turno, $ruolo, $iscritto, $collettivo, $set, 7, 0, 0);

        if (($counter % 3) == 0)
          {
            echo "</div><div class='row'>";
          }

        }} else { ?>
          <p class="center margine_sopra">Mi dispiace... Nessun risultato presente... ma prova a cambiare il parametro di ricerca subito sotto la barra di ricerca, magari sarai più fortunat*!</p>
        <?php } ?>
        </div>
      </div>
          <?php
        $sql = "SELECT * FROM collettivi WHERE (titolo_collettivo LIKE '%$search%' OR nome_referente LIKE '%$search%' OR cognome_referente LIKE '%$search%' OR descrizione_collettivo LIKE '%$search%' OR nome_esterno LIKE '%$search%' OR cognome_esterno LIKE '%$search%' OR turni LIKE '%,$search,%') AND ".$turno." != -100 AND segnalato='SI' AND eliminato='NO' AND id > 0 ORDER BY titolo_collettivo";
        $result = mysqli_query($link, $sql);
        if(mysqli_num_rows($result) > 0){
        $counter2 = 0;
        ?>
        <div class="row">
          <div class="col s12">
            <p id="segnalati"></p>
            <h3 class="center"><?php echo ucfirst($set['set_nome_collettivi']); ?> segnalati:</h3>
          </div>
        </div>
        <div class="row">
        <?php
        while($row = mysqli_fetch_assoc($result)) {
        $counter2++;

        DisplayCard($row, $turno, $ruolo, $iscritto, $collettivo, $set, 8, 0, 0);

        if (($counter2 % 3) == 0)
          {
            echo "</div><div class='row'>";
          }

        }} else {
        ?>
        <div class="row">
          <div class="col s12">
            <h3 class="center"><?php echo ucfirst($set['set_nome_collettivi']); ?> segnalati:</h3>
          </div>
          <div class="col s12">
            <p class="center margine_sopra">Mi dispiace... Nessun <?php echo $set['set_nome_collettivo']; ?> segnalato presente... ma prova a cambiare il parametro di ricerca subito sotto la barra di ricerca, magari sarai più fortunat*!</p>
          </div>
        </div>
        <div class="row">
        <?php }} ?>
      </div>
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
  function Segnala(id){
    jQuery.ajax({
      type: "GET",
      url: "/admin/collettivi/segnalacollettivo.php",
      data: {"id" : id},
      cache: false,
      success: function(data){
        if (data == 'success') {
          $("#container_total").load("/main/docenti/approvazione_cogestione.php #container_total");
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
          $("#container_total").load("/main/docenti/approvazione_cogestione.php #container_total");
        } else {
          alert('ERRORE: Si è verificato un errore');
        }
     },
   });
  }
  </script>

  <!--Footer inizio-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

    </body>
  </html>
