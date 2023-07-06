<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';

include $_SERVER['DOCUMENT_ROOT'].'/main/system/cookies_set.php';

include $_SERVER['DOCUMENT_ROOT'].'/card.php';

$sql = "SELECT * FROM users_cogestione WHERE id = '".$_SESSION['id_coge']."'";
$request = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($request);

if ($row['passwordchanged'] == 'NO') {
  header('location: /main/system/changepassword');
  echo $row['passwordchanged'];
}

if ($set['set_status_cogestione'] == 'cogestione_hidden') {
  header('location: /main/waitingforcoge');
} elseif ($set['set_status_cogestione'] == 'cogestione_form') {
  header('location: /main/formcogestione');
} elseif ($set['set_status_cogestione'] == 'cogestione_on_hold') {
  header('location: /main/cogestioneonhold');
} elseif ($set['set_status_cogestione'] == 'cogestione_questionario_gradimento') {
  header('location: /main/questionario/questionario');
}

if ($row['ruolo'] == 'studente' || $row['ruolo'] == 'studente_admin') {
  $ruolo = '';
} else {
  $ruolo = 'prof_';
}

$iscritto = array();
$collettivo = array();
for ($i=1; $i <= $set['set_turni_totali']; $i++)
{

if ($row['t'.$i] == '0') {
  $iscritto[$i] = 'NO';
} else {
  $iscritto[$i] = 'SI';
  $collettivo[$i] = $row['t'.$i];
}

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body style="background-color: #eceff1;">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <title><?php echo $set['set_intestazione_sito']; ?> - Home</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/navbar_general.php'; ?>
<!--Fine Navbar-->

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/hero.php'; ?>

<!--Container-->

<div class="container" style="margin-bottom: 4em; position: relative;">


  <div class="spazietto_sotto spazietto_sopra center">
    <?php if($set['set_status_cogestione'] == 'cogestione_open' && isset($_SESSION["loggedin_coge"]) && $_SESSION["loggedin_coge"] == true) {  ?>
    <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra"><b>Ciao <?php echo $_SESSION['username_coge'] ?>, le iscrizioni sono aperte, iscriviti a tutti i turni!</b></h6>
  <?php } elseif ($set['set_status_cogestione'] == 'cogestione_open' && !isset($_SESSION["loggedin_coge"])) {  ?>
    <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra"><b>Ciao, le iscrizioni sono aperte, ma tu non ha ancora fatto il login! Fallo per iscriverti ai <?php echo $set['set_nome_collettivi'] ?>! <a href="/main/system/login">Clicca qui</a> </b></h6>
  <?php } elseif ($set['set_status_cogestione'] == 'cogestione_only_view' && isset($_SESSION["loggedin_coge"]) && $_SESSION["loggedin_coge"] == true) { ?>
    <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra"><b>Ciao <?php echo $_SESSION['username_coge'] ?>, le iscrizioni non sono ancora aperte, ma puoi cominciare a dare un'occhiata!</b></h6>
  <?php } elseif ($set['set_status_cogestione'] == 'cogestione_only_view' && !isset($_SESSION["loggedin_coge"])) { ?>
    <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra"><b>Ciao, le iscrizioni non sono ancora aperte, ma ti conviene comunque fare il login per non perderti il momento! <a href="/main/system/login">Clicca qui</a> </b></h6>
  <?php } elseif ($set['set_status_cogestione'] == 'cogestione_momentaneamente_chiusa' && isset($_SESSION["loggedin_coge"]) && $_SESSION["loggedin_coge"] == true) { ?>
    <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra"><b>Ciao <?php echo $_SESSION['username_coge'] ?>, le iscrizioni sono momentaneamente chiuse per dei problemi tecnici, ma puoi continuare a cercare fra tutti i <?php echo $set['set_nome_collettivi'] ?>!</b></h6>
  <?php } elseif ($set['set_status_cogestione'] == 'cogestione_momentaneamente_chiusa' && !isset($_SESSION["loggedin_coge"])) { ?>
    <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra"><b>Ciao, le iscrizioni sono momentaneamente chiuse per dei problemi tecnici, ma ti conviene comunque fare il login per non perderti tutti i <?php echo $set['set_nome_collettivi'] ?> migliori! <a href="/main/system/login">Clicca qui</a></b></h6>
  <?php } elseif ($set['set_status_cogestione'] == 'cogestione_chiusa' && isset($_SESSION["loggedin_coge"]) && $_SESSION["loggedin_coge"] == true) { ?>
    <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra"><b>Ciao <?php echo $_SESSION['username_coge'] ?>, le iscrizioni sono terminate, ma puoi continuare a vedere i <?php echo $set['set_nome_collettivi']; ?> presenti e le tue iscrizioni!</b></h6>
  <?php } elseif ($set['set_status_cogestione'] == 'cogestione_chiusa' && !isset($_SESSION["loggedin_coge"])) { ?>
    <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra"><b>Ciao, le iscrizioni sono terminate, ma se fai il login puoi continuare a vedere i <?php echo $set['set_nome_collettivi']; ?> presenti e le tue iscrizioni! <a href="/main/system/login">Clicca qui</a></b></h6>
  <?php } ?>
  </div>

  <div style="border-radius: 15px;" class="hoverable z-depth-1">
    <nav style="border-radius: 15px;" class="<?php echo $set['set_colore_base']; ?>">
        <div style="border-radius: 15px;" class="nav-wrapper">
          <form action="/index" method="GET">
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
<div id="collettivi">
  <div class="row lastblock">

<?php

  $rand = rand();
  $search = mysqli_real_escape_string($link, $_GET['search']);
  $sql = "SELECT * FROM collettivi WHERE (titolo_collettivo LIKE '%$search%' OR nome_referente LIKE '%$search%' OR cognome_referente LIKE '%$search%' OR descrizione_collettivo LIKE '%$search%' OR nome_esterno LIKE '%$search%' OR cognome_esterno LIKE '%$search%' OR turni LIKE '%,$search,%') AND ".$turno." != -100 AND segnalato='NO' AND eliminato='NO' AND id > 0 ORDER BY RAND(".$rand.")";
  $collettivi = mysqli_query($link, $sql);
  $counter = 0;
  $idcollettivi = array();
  while($row = mysqli_fetch_assoc($collettivi)) {
  $counter++;
  $idcollettivi[] = $row['id'];

      DisplayCard($row, $turno, $ruolo, $iscritto, $collettivo, $set, 1, 0, 0);

        if (($counter % 3) == 0)
          {
            echo "</div><div class='row'>";
          }
        }
        if($counter==0) { ?>
          <p class="center margine_sopra">Mi dispiace... Nessun risultato presente... ma prova a cambiare il parametro di ricerca subito sotto la barra di ricerca, magari sarai più fortunat*!</p>
          <?php }} ?>
        </div>
       </div>
      </div>

<script>
$('#search').val('<?php echo $search; ?>');

<?php
$js_array = json_encode($idcollettivi);
echo "var array_ids = ".$js_array.";\n";
 ?>

  function UpdateCollettivi(){
    jQuery.ajax({
     type: "POST",
     url: "updatecollettivi.php",
     dataType: 'json',
     cache: false,
     success: function(data)
     {
       var obj = data;
       var i = 0;
       while (i< <?php echo $counter; ?>) {
         //JSON.stringify()
         if (<?php if($turno != 'id'){ echo 1; } else { echo 0; } ?>){
           if (obj[array_ids[i]][<?php echo substr($turno,1,1); ?>]['Posti']>0) {
             document.getElementById("iscrizioniover" + array_ids[i]).innerHTML = "<p class='green-text'>" + JSON.stringify(obj[array_ids[i]][<?php echo substr($turno,1,1); ?>]['Posti']) + " posti disponibili al <?php echo ucfirst($turno); ?></p>";
           } else {
             if (obj[array_ids[i]]['Spazio_unlimited'] == 1 && 1 == <?php if ($ruolo != 'prof_') { echo 1; } else { echo 0; } ?>) {
               document.getElementById("iscrizioniover" + array_ids[i]).innerHTML = "<p class='green-text'>Posti illimitati al <?php echo ucfirst($turno); ?></p>";
             } else {
               document.getElementById("iscrizioniover" + array_ids[i]).innerHTML = "<p class='red-text'>" + JSON.stringify(obj[array_ids[i]][<?php echo substr($turno,1,1); ?>]['Posti']) + " posti disponibili al <?php echo ucfirst($turno); ?></p>";
             }
           }
         } else if (obj[array_ids[i]]['Posti_Totali_All']>0) {
           document.getElementById("iscrizioniover" + array_ids[i]).innerHTML = "<p class='green-text'>" + JSON.stringify(obj[array_ids[i]]['Posti_Totali_All']) + " posti disponibili</p>";
         } else {
           if (obj[array_ids[i]]['Spazio_unlimited'] == 1 && 1 == <?php if ($ruolo != 'prof_') { echo 1; } else { echo 0; } ?>) {
             document.getElementById("iscrizioniover" + array_ids[i]).innerHTML = "<p class='green-text'>Posti illimitati</p>";
           } else {
             document.getElementById("iscrizioniover" + array_ids[i]).innerHTML = "<p class='red-text'>" + JSON.stringify(obj[array_ids[i]]['Posti_Totali_All']) + " posti disponibili</p>";
           }

         }

        for (var j = 1; j <= <?php echo $set['set_turni_totali']; ?>; j++) {
          if (obj[array_ids[i]][j]!=undefined) {
            if (obj[array_ids[i]][j]['Posti']>0) {
              document.getElementById("IscrizioniIn_t" + j + "_" + array_ids[i]).innerHTML = "<p>T" + j +": " + JSON.stringify(obj[array_ids[i]][j]['Posti']) + "/" + JSON.stringify(obj[array_ids[i]][j]['Posti_Totali']) + " posti disponibili</p>";
            } else {
              if (obj[array_ids[i]]['Spazio_unlimited'] == 1 && 1 == <?php if ($ruolo != 'prof_') { echo 1; } else { echo 0; } ?>) {
                document.getElementById("IscrizioniIn_t" + j + "_" + array_ids[i]).innerHTML = "<p>T" + j +": Illimitati posti disponibili</p>";
              } else {
                document.getElementById("IscrizioniIn_t" + j + "_" + array_ids[i]).innerHTML = "<p>T" + j +": i posti sono terminati</p>";
              }
            }
            if (obj[array_ids[i]][j]['Status']==1) {
              document.getElementById("Bottone_t" + j + "_" + array_ids[i]).innerHTML = '<button type="button" class="btn waves-effect waves-light center green" onClick="Subscribe(' + array_ids[i] + ', \'t' + j + '\');" style="display:block; border-radius: 25px;">Iscriviti T' + j + '</button>';
            } else if (obj[array_ids[i]][j]['Status']==2) {
              document.getElementById("Bottone_t" + j + "_" + array_ids[i]).innerHTML = '<button type="button" class="btn waves-effect waves-light center red" onClick="UnSubscribe(' + array_ids[i] + ', \'t' + j + '\');" style="display:block; border-radius: 25px;">Disiscriviti T' + j + '</button>';
            } else if (obj[array_ids[i]][j]['Status']==3) {
              document.getElementById("Bottone_t" + j + "_" + array_ids[i]).innerHTML = '<button type="button" class="btn waves-effect waves-light center disabled" style="display:block; border-radius: 25px;">Iscritto ad altro T' + j + '</button>';
            } else if (obj[array_ids[i]][j]['Status']==4) {
              document.getElementById("Bottone_t" + j + "_" + array_ids[i]).innerHTML = '<button type="button" class="btn waves-effect waves-light center disabled" style="display:block; border-radius: 25px;">Posti terminati</button>';
            }
          }
        }
         i++;
       }
     }
   });
  }

  function Subscribe(id, turno)
  {
      jQuery.ajax({
       type: "POST",
       url: "iscrizionicogestione.php",
       data: { "id" : id, "turno" : turno },
       cache: false,
       success: function(data)
       {
         if (data == 'iscritto') {
           UpdateCollettivi();
         } else if (data == 'posti_finiti') {
           alert('Non sei stato iscritto: i posti erano appena terminati');
           UpdateCollettivi();
         } else if (data == 'gia_iscritto') {
           alert('Sei già iscritto ad un <?php echo $set['set_nome_collettivo'] ?> in questo turno!');
           UpdateCollettivi();
         } else if (data == 'closed') {
           if (window.confirm('Le iscrizioni sono chiuse: dunque non sei stato iscritto'))
              {
                  window.location.href = "/";
              }
              else
              {
                  window.location.href = "/";
              }
         }
       }
     });

 }

  function UnSubscribe(id, turno)
  {
      jQuery.ajax({
       type: "POST",
       url: "annullaiscrizionicogestione.php",
       data: { "id" : id, "turno" : turno },
       cache: false,
       success: function(data)
       {
         if (data == 'disiscritto') {
           UpdateCollettivi();
         } else if (data == 'closed') {
           if (window.confirm('Le iscrizioni sono chiuse: dunque non sei stato disiscritto'))
              {
                  window.location.href = "/";
              }
              else
              {
                  window.location.href = "/";
              }
         }
       }

     });
 }

</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>
</html>
