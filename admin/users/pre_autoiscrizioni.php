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

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Autoiscrizioni</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<div class="container">
 <div style="border-radius: 15px; background-color: #fff;" class="row margine_sopra spazio_sotto z-depth-1">
  <h5 class="col s12 margine_sopra margine_sotto center"><b>Autoiscrivi gli studenti che ancora non si sono iscritti</b></h5>
  <?php
  $enough = array();
  for ($i=1; $i <= $set['set_turni_totali']; $i++) {
    $sql = "SELECT SUM(total_t".$i.") AS posti_totali FROM collettivi WHERE NOT total_t".$i." = -100 AND eliminato = 'NO' AND segnalato = 'NO' AND id > 0";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $posti_totali = $row['posti_totali'];
    $sql = "SELECT COUNT(id) AS users_totali FROM users_cogestione WHERE id>0 AND ruolo != 'professore' AND ruolo != 'professore_admin' AND t".$i." >= 0";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['users_totali']>$posti_totali) {
      $enough[$i] = 0;
    } elseif ($row['users_totali']<=$posti_totali) {
      $enough[$i] = 1;
    }
  }

  $iscorrect = 1;
  for ($i=1; $i <= $set['set_turni_totali']; $i++) {
    if ($enough[$i] == 0) {
      if ($iscorrect == 1) {
        echo "<p class='center'>Si sono verificati dei problemi:<p>";
      }
      echo "<p class='center'>&#9654; Non disponi di abbastanza posti nel turno ".$i."<p>";
      $iscorrect = 0;
    }
  }

  if ($iscorrect == 0) {
    echo "<p class='center'>Puoi sistemare questo/i problemi verificando i numeri dalla <a href='/admin/admincogestione'>homepage</a> e sistemandoli di conseguenza. Una volta sistemato potrai procedere con l'autoiscrizione degli studenti<p>";
  } elseif ($iscorrect == 1 && $set['set_status_cogestione'] != 'cogestione_chiusa') {
    echo "<p class='center'>Non puoi effettuare le autoiscrizioni prima di chiudere definitivamente le iscrizioni<p>";
  } else {
?>
  <form>

  <p class="col s10 offset-s1"><i>Consigliamo vivamente di NON effettuare questa operazione da mobile (telefono, tablet) in quanto potrebbe richiedere tempo e stabilità di connessione.</i></p>
  <p class="col s10 offset-s1">Le autoiscrizioni avvengono in modo da riempire i <?php echo $set['set_nome_collettivi']; ?> con posti disponibili in percentuali uguali, in modo da non avere <?php echo $set['set_nome_collettivi']; ?> totalmente vuoti. Puoi scegliere di riempire prima determinati <?php echo $set['set_nome_collettivi']; ?> oppure di lasciarne alcuni da riempire solo se avanzano persone. Inoltre segnaliamo che in caso di <?php echo $set['set_nome_collettivi']; ?> con posti infiniti, essi non subiranno auto-iscrizioni e non rientreranno nei conteggi</p>
  <div class="input-field col s10 offset-s1">
    <p>&#9654; Riempi totalmente questi <?php echo $set['set_nome_collettivi']; ?> per primi, prima di riempire tutti gli altri</p>
    <select name="first[]" multiple required=required>
      <?php
        $sql = "SELECT id, titolo_collettivo FROM collettivi WHERE eliminato = 'NO' AND segnalato = 'NO' AND id > 0 ORDER BY titolo_collettivo";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)){
          ?>
      <option value="<?php echo $row['id'] ?>"><?php echo $row['titolo_collettivo'] ?></option>
          <?php
        };
       ?>
    </select>
  </div>
  <div class="input-field col s10 offset-s1">
    <p>&#9654; Riempi questi <?php echo $set['set_nome_collettivi']; ?> per ultimi, solo se rimangono persone</p>
    <select name="last[]" multiple required=required>
      <?php
        $sql = "SELECT id, titolo_collettivo FROM collettivi WHERE eliminato = 'NO' AND segnalato = 'NO' AND id > 0 ORDER BY titolo_collettivo";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)){
          ?>
      <option value="<?php echo $row['id'] ?>"><?php echo $row['titolo_collettivo'] ?></option>
          <?php
        };
       ?>
    </select>
  </div>

  <div id="bottone" class="col s10 offset-s1 center marginetto_sopra" style="display:block;">
    <button style="border-radius: 25px;" type="button" class="btn waves-effect waves-light center green" onClick="AutoIscrivi();">Autoiscrivi utenti</button>
  </div>
</form>
  <div class="col s10 offset-s1" id="response"></div>
  <div id="loading" class="col s6 offset-s3 marginetto_sopra" style="display:none;">
    <div class="progress">
      <div class="indeterminate"></div>
    </div>
  </div>
  <?php } ?>
 </div>
</div>


<script>
  function AutoIscrivi() {

        document.getElementById('loading').style.display = "block";
        document.getElementById('bottone').style.display = "none";
        jQuery.ajax({
          url:"/admin/users/autoiscrizionirandom.php",
          data: {"data" : $('form').serializeArray()},
          success: function(result){
            $("#response").html('<p class="col s10 offset-s1 margine_sopra">La procedura di auto-iscrizione è avvenuta</p>');
            document.getElementById('loading').style.display = "none";
            document.getElementById('bottone').style.display = "block";
         },
       });
   }

   $(document).ready(function(){
     $('select').formSelect();
   });
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>

</html>
