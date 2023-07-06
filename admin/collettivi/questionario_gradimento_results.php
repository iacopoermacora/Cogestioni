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

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Risultati Questionario di Gradimento</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<div class="container spazio_sopra" style="margin-bottom: 4em;">
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Da 1 (per niente) a 5 (moltissimo) quanto è stato chiaro e di facile comprensione l'utilizzo del sito per le iscrizioni alla <?php echo $set['set_nome_cogestione']; ?>?</b></p>
      <table class="col s10 offset-s1 margine_sotto">
        <thead>
          <tr>
            <th>OPZIONI</th>
            <?php
              $sql = "SELECT facilita_sito, COUNT(*) AS `num` FROM risposte_questionario GROUP BY facilita_sito";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <th><?php echo $row['facilita_sito']; ?></th>
            <?php } ?>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>VOTI</td>
            <?php
              $sql = "SELECT facilita_sito, COUNT(*) AS `num` FROM risposte_questionario GROUP BY facilita_sito";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <td><?php echo $row['num']; ?></td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Hai riscontrato problemi con il sito? Se si, quali problemi hai riscontrato?</b></p>
      <div class="col s10 offset-s1 margine_sotto" style="height: 285px; overflow: scroll;">
        <table class="striped">
          <tbody>
            <?php
            $sql = "SELECT problemi_sito FROM risposte_questionario WHERE problemi_sito != ''";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($result)) {  ?>
              <tr>
                <td><?php echo $row['problemi_sito']; ?></td>
              </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Da 1 (per niente) a 5 (moltissimo) quanto quanto hai trovato ampia la scelta di <?php echo $set['set_nome_collettivi']; ?>?</b></p>
      <table class="col s10 offset-s1 margine_sotto">
        <thead>
          <tr>
            <th>OPZIONI</th>
            <?php
              $sql = "SELECT ampiezza_scelta, COUNT(*) AS `num` FROM risposte_questionario GROUP BY ampiezza_scelta";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <th><?php echo $row['ampiezza_scelta']; ?></th>
            <?php } ?>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>VOTI</td>
            <?php
              $sql = "SELECT ampiezza_scelta, COUNT(*) AS `num` FROM risposte_questionario GROUP BY ampiezza_scelta";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <td><?php echo $row['num']; ?></td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
        <p class="col s10 offset-s1 margine_sopra"><b>Hai trovato eccessivo il numero di <?php echo $set['set_nome_collettivi']; ?> presenti?</b></p>
      <table class="col s10 offset-s1 margine_sotto">
        <thead>
          <tr>
            <th>OPZIONI</th>
            <?php
              $sql = "SELECT quantita_eccessiva_collettivi, COUNT(*) AS `num` FROM risposte_questionario GROUP BY quantita_eccessiva_collettivi";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <th><?php echo $row['quantita_eccessiva_collettivi']; ?></th>
            <?php } ?>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>VOTI</td>
            <?php
              $sql = "SELECT quantita_eccessiva_collettivi, COUNT(*) AS `num` FROM risposte_questionario GROUP BY quantita_eccessiva_collettivi";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <td><?php echo $row['num']; ?></td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Da 1 (per niente) a 5 (moltissimo) quanto sei soddisfatto del lavoro del "Servizio d'ordine"? (Rispondi solo se hai avuto interazioni con il "servizio d'ordine")</b></p>
      <table class="col s10 offset-s1 margine_sotto">
        <thead>
          <tr>
            <th>OPZIONI</th>
            <?php
              $sql = "SELECT SDO, COUNT(*) AS `num` FROM risposte_questionario GROUP BY SDO";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <th><?php echo $row['SDO']; ?></th>
            <?php } ?>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>VOTI</td>
            <?php
              $sql = "SELECT SDO, COUNT(*) AS `num` FROM risposte_questionario GROUP BY SDO";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <td><?php echo $row['num']; ?></td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Da 1 (per niente) a 5 (moltissimo) quanto sei soddisfatto del lavoro del servizio di accoglienza? (Rispondi solo se hai invitato/collaborato con esperti esterni)</b></p>
      <table class="col s10 offset-s1 margine_sotto">
        <thead>
          <tr>
            <th>OPZIONI</th>
            <?php
              $sql = "SELECT accoglienza, COUNT(*) AS `num` FROM risposte_questionario GROUP BY accoglienza";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <th><?php echo $row['accoglienza']; ?></th>
            <?php } ?>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>VOTI</td>
            <?php
              $sql = "SELECT accoglienza, COUNT(*) AS `num` FROM risposte_questionario GROUP BY accoglienza";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <td><?php echo $row['num']; ?></td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Da 1 (per niente) a 5 (moltissimo) quanto sei soddisfatto del lavoro degli organizzatori? (Rispondi solo se hai avuto interazioni con gli organizzatori)</b></p>
      <table class="col s10 offset-s1 margine_sotto">
        <thead>
          <tr>
            <th>OPZIONI</th>
            <?php
              $sql = "SELECT organizzatori, COUNT(*) AS `num` FROM risposte_questionario GROUP BY organizzatori";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <th><?php echo $row['organizzatori']; ?></th>
            <?php } ?>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>VOTI</td>
            <?php
              $sql = "SELECT organizzatori, COUNT(*) AS `num` FROM risposte_questionario GROUP BY organizzatori";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <td><?php echo $row['num']; ?></td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Cosa ne pensi della durata della <?php echo $set['set_nome_cogestione']; ?>?</b></p>
      <table class="col s10 offset-s1 margine_sotto">
        <thead>
          <tr>
            <th>OPZIONI</th>
            <?php
              $sql = "SELECT durata, COUNT(*) AS `num` FROM risposte_questionario GROUP BY durata";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <th><?php echo $row['durata']; ?></th>
            <?php } ?>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>VOTI</td>
            <?php
              $sql = "SELECT durata, COUNT(*) AS `num` FROM risposte_questionario GROUP BY durata";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <td><?php echo $row['num']; ?></td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Da 1 (per niente) a 5 (moltissimo) quanto ti è piaciuto il modo in cui è stato organizzato l'intervallo?</b></p>
      <table class="col s10 offset-s1 margine_sotto">
        <thead>
          <tr>
            <th>OPZIONI</th>
            <?php
              $sql = "SELECT intervallo, COUNT(*) AS `num` FROM risposte_questionario GROUP BY intervallo";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <th><?php echo $row['intervallo']; ?></th>
            <?php } ?>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>VOTI</td>
            <?php
              $sql = "SELECT intervallo, COUNT(*) AS `num` FROM risposte_questionario GROUP BY intervallo";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_array($result)) {  ?>
            <td><?php echo $row['num']; ?></td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Hai idee per l'intervallo? Faccele sapere!</b></p>
      <div class="col s10 offset-s1 margine_sotto" style="height: 285px; overflow: scroll;">
        <table class="striped">
          <tbody>
            <?php
            $sql = "SELECT intervallo_idee FROM risposte_questionario WHERE intervallo_idee != ''";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($result)) {  ?>
              <tr>
                <td><?php echo $row['intervallo_idee']; ?></td>
              </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Hai suggerimenti/appunti/commenti aggiuntivi da fare? Scriviceli qui sotto!</b></p>
      <div class="col s10 offset-s1 margine_sotto" style="height: 285px; overflow: scroll;">
        <table class="striped">
          <tbody>
            <?php
            $sql = "SELECT suggerimenti FROM risposte_questionario WHERE suggerimenti != ''";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($result)) {  ?>
              <tr>
                <td><?php echo $row['suggerimenti']; ?></td>
              </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1">
      <p class="col s10 offset-s1 margine_sopra"><b>Votazioni per il singolo <?php echo $set['set_nome_collettivo'] ?></b></p>
      <div class="col s10 offset-s1 margine_sotto" style="height: 285px; overflow: scroll;">
        <table class="striped">
          <tbody>
            <tr>
              <th>Titolo <?php echo $set['set_nome_collettivo'] ?></th>
              <th>1</th>
              <th>2</th>
              <th>3</th>
              <th>4</th>
              <th>5</th>
              <th>Media</th>
            </tr>
            <?php
            $sql = "SELECT
                      titolo_collettivo,
                      V1,
                      V2,
                      V3,
                      V4,
                      V5
                      FROM collettivi WHERE segnalato = 'NO' AND eliminato = 'NO'";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_assoc($result)) {  ?>
              <tr>
                <th class="truncate"><?php echo $row['titolo_collettivo']; ?></th>
                <td><?php echo $row['V1']; ?></td>
                <td><?php echo $row['V2']; ?></td>
                <td><?php echo $row['V3']; ?></td>
                <td><?php echo $row['V4']; ?></td>
                <td><?php echo $row['V5']; ?></td>
                <td><?php $media = (($row['V1']*1)+($row['V2']*2)+($row['V3']*3)+($row['V4']*4)+($row['V5']*5))/($row['V1'] + $row['V2'] + $row['V3'] + $row['V4'] + $row['V5']);
                echo $media; ?></td>
              </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php' ?>

  </body>
</html>
