<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body>

  <title><?php echo $set['set_intestazione_sito']; ?> - Home</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/navbar_general.php'; ?>

<!--Hero inizio-->

<div class="hero_and_content">
    <section class="hero" style="background-color: white;">
            <div class="hero-inner">
              <div style="border-radius: 25px;" class="container z-depth-1">
                <h5 class="black-text spazio_sopra">Il form di registrazione dei <?php echo $set['set_nome_collettivi']; ?> verrà aperto il <?php echo $set['set_data_apertura_form']; ?>, alle <?php echo $set['set_ora_apertura_form']; ?></h1>
                <h6 class="black-text">Mancano solo:</h6>
                <h6 class="black-text spazio_sotto"><span id="days"></span> Giorni </li><span id="hours"></span> Ore </li><span id="minutes"></span> Minuti </li><span id="seconds"></span> Secondi</li></h6>
              </div>
            </div>
        </section>
  </div>

<script>
const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;

let countDown = new Date('<?php echo $set['set_data_apertura_form'].' '.$set['set_ora_apertura_form']; ?>').getTime(),
  x = setInterval(function() {

    let now = new Date().getTime(),
        distance = countDown - now;

      document.getElementById('days').innerText = Math.floor((distance / (day))),
      document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
      document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
      document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);

  }, second)
</script>

<!--Hero fine-->

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>
</html>
