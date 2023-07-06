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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

</head>
  <body style="background-color: #eceff1;">

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Home</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<div class="container">

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sopra margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Bentornato nel pannello admin!</b></h5>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sopra margine_sotto">
      <div class="row">
        <div class="col s12 m6 l6">
          <h6 class="spazietto_sotto spazietto_sopra"><b>Studenti</b></h6>
          <canvas id="SubscriptionChartsStudents" style="max-width:100%;max-height:100%;"></canvas>
          <canvas id="LoginChartsStudents" style="max-width:100%;max-height:100%;"></canvas>
        </div>
        <div class="col s12 m6 l6">
          <h6 class="spazietto_sotto spazietto_sopra"><b>Docenti</b></h6>
          <canvas id="SubscriptionChartsProfessors" style="max-width:100%;max-height:100%;"></canvas>
          <canvas id="LoginChartsProfessors" style="max-width:100%;max-height:100%;"></canvas>
        </div>
      </div>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="margine_sopra spazietto_sopra spazietto_sotto z-depth-1">
      <div class="row">
        <div class="col s12 center">
          <h5><b>Riassunto Totale:</b></h5>
        </div>
      </div>
      <div class="row">
        <div class="col s6 m4 l4 center">
          <h3 class="center">RIAS<br>SUN<br>TO</h3>
        </div>
        <div class="col s6 m4 l4 center">
          <ul>
            <li><b>N. <?php echo $set['set_nome_collettivi']; ?>/spazio: </b></li>
            <?php for ($j=1; $j<=$set['set_numero_spazi']; $j++) { ?>
              <li><?php echo $set['set_nome_spazio_'.$j].":";
              $sql = "SELECT COUNT(*) AS collettivi_totali FROM collettivi WHERE eliminato = 'NO' AND segnalato = 'NO' AND spazio = '".$j."' AND id > 0";
              $result = mysqli_query($link, $sql);
              $row = mysqli_fetch_assoc($result);
              ?>
            <?php echo $row['collettivi_totali']; ?></li>
            <?php } ?>
          </ul>
        </div>
        <div class="col s12 m4 l4">
          <div class="col s6 m12 l12 center">
            <p><b>N. <?php echo $set['set_nome_collettivi']; ?> totali proposti: </b>
              <?php
              $sql = "SELECT COUNT(*) AS collettivi_totali FROM collettivi WHERE eliminato = 'NO' AND segnalato = 'NO' AND id > 0";
              $result = mysqli_query($link, $sql);
              $row = mysqli_fetch_assoc($result);
              ?>
            <?php echo $row['collettivi_totali']; ?></p>
          </div>
          <div class="col s6 m12 l12 center">
            <p><b>N. posti disponibili totali: </b>
              <?php
              $posti = array();
              for ($i=1; $i <= $set['set_turni_totali']; $i++)
              {
              $sql = "SELECT SUM(total_t".$i.") AS posti_totali FROM collettivi WHERE NOT total_t".$i." = -100 AND eliminato = 'NO' AND segnalato = 'NO' AND id > 0";
              $result = mysqli_query($link, $sql);
              $row = mysqli_fetch_assoc($result);
              $posti[$i] = $row['posti_totali'];
              }
              $postitotali = array_sum($posti);
              echo $postitotali; ?><p>
          </div>
        </div>
        <div class="col s12 center">
          <p><b><?php echo ucfirst($set['set_nome_collettivi']); ?> con necessità particolari: </b> <a href="/admin/collettivi/admincollettivinecessita?turno=id">Clicca qui</a> </p>
        </div>
        <div class="col s12 center">
          <p><b><?php echo ucfirst($set['set_nome_collettivi']); ?> disposti a cambiare turno: </b> <a href="/admin/collettivi/admincollettivicambioturno?turno=id">Clicca qui</a> </p>
        </div>
      </div>
    </div>

<?php
    for ($i=1; $i <= $set['set_turni_totali']; $i++)
    {
  ?>
    <div style="border-radius: 15px; background-color: #fff;" class="margine_sopra margine_sotto spazietto_sopra spazietto_sotto z-depth-1">
      <div class="row">
        <div class="col s12 center">
          <h5><b>Riassunto T<?php echo $i; ?>:</b></h5>
        </div>
        <div class="col s10 offset-s1 center">
          <p>Attenzione! In tutti questi conteggi vengono conteggiati anche i <?php echo $set['set_nome_collettivi']; ?> segnalati. Non vengono invece contati quelli eliminati.</p>
        </div>
      </div>
      <div class="row">
        <div class="col s6 m4 l4 center">
          <h1>T<?php echo $i; ?></h1>
        </div>
        <div class="col s6 m4 l4 center">
          <ul>
          <li><b>N. <?php echo $set['set_nome_collettivi']; ?> per spazio: </b></li>
          <?php for ($j=1; $j<=$set['set_numero_spazi']; $j++) { ?>
            <li><?php echo $set['set_nome_spazio_'.$j].":";
            $sql = "SELECT COUNT(*) AS collettivi_totali FROM collettivi WHERE NOT t".$i." = -100 AND eliminato = 'NO' AND segnalato = 'NO' AND spazio = '".$j."' AND id > 0";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
          <?php echo $row['collettivi_totali']; ?></li>
          <?php } ?>
          </ul>
        </div>
          <div class="col s12 m4 l4">
            <div class="col s6 m12 l12 center">
              <p><b>N. collettivi totali: </b>
                <?php
                $sql = "SELECT COUNT(*) AS collettivi_totali FROM collettivi WHERE NOT t".$i." = -100 AND eliminato = 'NO' AND segnalato = 'NO' AND id > 0";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
              <?php echo $row['collettivi_totali']; ?></p>
            </div>
            <div class="col s6 m12 l12 center">
              <p><b>N. posti disponibili totali: </b>
              <?php
              $sql = "SELECT SUM(total_t".$i.") AS posti_totali FROM collettivi WHERE NOT total_t".$i." = -100 AND eliminato = 'NO' AND segnalato = 'NO' AND id > 0";
              $result = mysqli_query($link, $sql);
              $row = mysqli_fetch_assoc($result);
              ?>
              <?php echo $posti_totali = $row['posti_totali']; ?></p>
              <?php
              $sql = "SELECT COUNT(id) AS users_totali FROM users_cogestione WHERE id>0 AND ruolo != 'professore' AND ruolo != 'professore_admin' AND t".$i." >= 0";
              $result = mysqli_query($link, $sql);
              $row = mysqli_fetch_assoc($result);
              if ($row['users_totali']>$posti_totali) {
                ?>
                <p><b class="red-text">Attenzione!</b> I posti disponibili sono inferiori agli utenti che si devono iscrivere. Ti mancano <b><?php echo $row['users_totali'] - $posti_totali;?> posti</b> per andare in pari...</p>
                <?php
              } elseif ($row['users_totali']<$posti_totali) {
                ?>
                <p><b class="green-text">Attenzione!</b> Il numero di posti eccede di <b><?php echo $posti_totali - $row['users_totali'];?> posti</b> dal numero di utenti.</p>
                <?php
              } ?>
            </div>
          </div>
          <div class="col s12 center">
            <p><b><?php echo ucfirst($set['set_nome_collettivi']); ?> con necessità particolari: </b> <a href="/admin/collettivi/admincollettivinecessita?turno=t<?php echo $i;  ?>">Clicca qui</a> </p>
          </div>
          <div class="col s12 center">
            <p><b><?php echo ucfirst($set['set_nome_collettivi']); ?> disposti a cambiare turno: </b> <a href="/admin/collettivi/admincollettivicambioturno?turno=t<?php echo $i;  ?>">Clicca qui</a> </p>
          </div>
          <div class="col s12 center">
            <p><b>Ospiti esterni del T<?php echo $i; ?>: </b> <a href="/admin/collettivi/ospitiesterni?turno=t<?php echo $i;  ?>">Clicca qui</a> </p>
          </div>
      </div>
    </div>
    <?php
    }
      ?>

      <?php if ($_SESSION['id_coge'] == 0) { ?>
        <div style="border-radius: 15px; background-color: #fff;" class="row margine_sotto z-depth-1 spazietto_sotto spazietto_sopra">
          <div class="col s12 m7 l7 offset-l1 offset-m1 center">
            <h6> <b>Resetta la piattaforma per una nuova <?php echo $set['set_nome_cogestione']; ?>!</b> </h6>
            <p>Attenzione: Questa operazione NON è reversibile, ed eliminerà tutti i file e le informazioni presenti sulla piattaforma (<?php echo $set['set_nome_collettivi']; ?>, utenti, le risposte al questionario...). Non verranno modificate né cancellate le impostazioni del sito.</p>
          </div>
          <div class="col s12 m4 l4 center">
            <a href='javascript:funzioneElimina()' class="btn waves-effect waves-light btn center red">Elimina<i class="material-icons right">delete_forever</i></a>
            <div id="response"></div>
          </div>
        </div>
      <?php } ?>

      <script>
      function funzioneElimina(id) {
      var r = confirm("ATTENZIONE! Stai per eliminare tutti i dati presenti sul database. L'azione NON è reversibile");
      if (r == true) {
        EliminaTotale();
      }}

      function EliminaTotale(){
        jQuery.ajax({
          type: "GET",
          url: "/admin/system/delete.php",
          data: { "eliminando" : "total"},
          cache: false,
          success: function(data){
            if (data == 'success') {
              $("#response").html('<p class="col s10 offset-s1 green-text">Reset avvenuto</p>');
            } else {
              $("#response").html('<p class="col s10 offset-s1 red-text">Reset NON avvenuto</p>');
            }
         },
       });
      }

<?php $sql = "SELECT COUNT(id) as iscritti_uno
              FROM users_cogestione
              WHERE (t1 != 0 || t2 != 0 || t3 != 0 || t4 != 0 || t5 != 0 || t6 != 0 || t7 != 0 || t8 != 0 || t9 != 0 || t10 != 0
                || t11 != 0 || t12 != 0 || t13 != 0 || t14 != 0 || t15 != 0 || t16 != 0 || t17 != 0 || t18 != 0)
                AND id > 0 AND (ruolo = 'studente' || ruolo = 'studente_admin')";
      $result = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($result);
      $iscritti_uno = $row['iscritti_uno'];

      $sql = "SELECT COUNT(id) as iscritti_zero
              FROM users_cogestione
              WHERE t1 = 0 AND t2 = 0 AND t3 = 0 AND t4 = 0 AND t5 = 0 AND t6 = 0 AND t7 = 0 AND t8 = 0 AND t9 = 0 AND t10 = 0
                AND t11 = 0 AND t12 = 0 AND t13 = 0 AND t14 = 0 AND t15 = 0 AND t16 = 0 AND t17 = 0 AND t18 = 0
                AND id > 0 AND (ruolo = 'studente' || ruolo = 'studente_admin')";
      $result = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($result);
      $iscritti_zero = $row['iscritti_zero'];

      $sql = "SELECT * FROM users_cogestione WHERE id > 0 AND (ruolo = 'studente' || ruolo = 'studente_admin')";
      $result = mysqli_query($link, $sql);
      $all_subbed = 0;
      while($row = mysqli_fetch_assoc($result)){
        $user_not_subbed = 0;
        for ($i=0; $i <= $set['set_turni_totali']; $i++) {
          if ($row['t'.$i] == 0) {
            $user_not_subbed = 1;
          }
        }
        if ($user_not_subbed == 0) {
          $all_subbed += 1;
        }
      }

      $sql = "SELECT COUNT(id) as no_login FROM users_cogestione WHERE passwordchanged = 'NO' AND id > 0 AND (ruolo = 'studente' || ruolo = 'studente_admin')";
      $result = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($result);
      $no_login = $row['no_login'];
 ?>

var xValues = ["Iscritti almeno ad un turno", "Non Iscritti a nulla", "Iscritti in tutti i turni"];
var yValues = [<?php echo $iscritti_uno - $all_subbed; ?>, <?php echo $iscritti_zero; ?>, <?php echo $all_subbed; ?>];
var barColors = [
  "#ffa600",
  "#7a5195",
  "#ef5675",
  "#003f5c",
];

new Chart("SubscriptionChartsStudents", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Iscrizioni studenti"
    }
  }
});

var xValues = ["Non hanno mai fatto login", "Hanno fatto login almeno una volta"];
var yValues = [<?php echo $no_login; ?>, <?php echo ($iscritti_uno + $iscritti_zero) - $no_login; ?>];
var barColors = [
  "#ffa600",
  "#7a5195",
];

new Chart("LoginChartsStudents", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Login studenti"
    }
  }
});

<?php $sql = "SELECT COUNT(id) as iscritti_uno
              FROM users_cogestione
              WHERE (t1 != 0 || t2 != 0 || t3 != 0 || t4 != 0 || t5 != 0 || t6 != 0 || t7 != 0 || t8 != 0 || t9 != 0 || t10 != 0
                || t11 != 0 || t12 != 0 || t13 != 0 || t14 != 0 || t15 != 0 || t16 != 0 || t17 != 0 || t18 != 0)
                AND id > 0 AND (ruolo = 'professore' || ruolo = 'professore_admin')";
      $result = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($result);
      $iscritti_uno = $row['iscritti_uno'];

      $sql = "SELECT COUNT(id) as iscritti_zero
              FROM users_cogestione
              WHERE t1 = 0 AND t2 = 0 AND t3 = 0 AND t4 = 0 AND t5 = 0 AND t6 = 0 AND t7 = 0 AND t8 = 0 AND t9 = 0 AND t10 = 0
                AND t11 = 0 AND t12 = 0 AND t13 = 0 AND t14 = 0 AND t15 = 0 AND t16 = 0 AND t17 = 0 AND t18 = 0
                AND id > 0 AND (ruolo = 'professore' || ruolo = 'professore_admin')";
      $result = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($result);
      $iscritti_zero = $row['iscritti_zero'];

      $sql = "SELECT * FROM users_cogestione WHERE id > 0 AND (ruolo = 'professore' || ruolo = 'professore_admin')";
      $result = mysqli_query($link, $sql);
      $all_subbed = 0;
      while($row = mysqli_fetch_assoc($result)){
        $user_not_subbed = 0;
        for ($i=0; $i <= $set['set_turni_totali']; $i++) {
          if ($row['t'.$i] == 0) {
            $user_not_subbed = 1;
          }
        }
        if ($user_not_subbed == 0) {
          $all_subbed += 1;
        }
      }

      $sql = "SELECT COUNT(id) as no_login FROM users_cogestione WHERE passwordchanged = 'NO' AND id > 0 AND (ruolo = 'professore' || ruolo = 'professore_admin')";
      $result = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($result);
      $no_login = $row['no_login'];
 ?>

 var xValues = ["Iscritti almeno ad un turno", "Non Iscritti a nulla", "Iscritti in tutti i turni"];
 var yValues = [<?php echo $iscritti_uno - $all_subbed; ?>, <?php echo $iscritti_zero; ?>, <?php echo $all_subbed; ?>];
 var barColors = [
   "#ffa600",
   "#7a5195",
   "#ef5675",
   "#003f5c",
 ];

new Chart("SubscriptionChartsProfessors", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Iscrizioni docenti"
    }
  }
});

var xValues = ["Non hanno mai fatto login", "Hanno fatto login almeno una volta"];
var yValues = [<?php echo $no_login; ?>, <?php echo ($iscritti_uno + $iscritti_zero) - $no_login; ?>];
var barColors = [
  "#ffa600",
  "#7a5195",
];

new Chart("LoginChartsProfessors", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Login Professori"
    }
  }
});
</script>

</div>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>

</html>
