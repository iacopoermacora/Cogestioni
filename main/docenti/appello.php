<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'professore_and_professore_admin');

$sql = "SELECT * FROM users_cogestione WHERE id=".$_SESSION['id_coge'];
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body style="background-color: #eceff1;">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <title><?php echo $set['set_intestazione_sito']; ?> - Appello</title>

    <!--Inizio Navbar-->
    <div class="navbar-fixed">
      <nav class="<?php echo $set['set_colore_base']; ?> z-depth-0">
        <div class="nav-wrapper">
          <div class="container">
            <a class="brand-logo center">Appello</a>
            <a href="/" class="left">Torna indietro</a>
          </div>
        </div>
      </nav>
    </div>

<!--Hero-->

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/hero.php'; ?>


  <div class="container" style:"margin-bottom: 4em;">

    <div class="spazietto_sotto spazietto_sopra center">
      <h6 style="border-radius: 15px; background-color: #fff;" class="z-depth-1 spazietto_sotto spazietto_sopra "><b>Salve prof. <?php echo $row['cognome']; ?> in questa pagina può effettuare gli appelli dei <?php echo $set['set_nome_collettivi']; ?> nei quali è di sorveglianza in <?php echo $set['set_nome_cogestione']; ?>.</b></h6>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="row z-depth-1 spazietto_sotto spazietto_sopra">
      <div class="col s12 m10 l10 offset-l1 offset-m1 center">
        <h6> <b>Innanzitutto selezioni il turno o il <?php echo $set['set_nome_collettivo'] ?> in cui si trova attualmente: </b> </h6>
      </div>
      <?php
      for ($i=1; $i <= $set['set_turni_totali'] ; $i++) {
        if ($row['t'.$i] > 0 && $row['t'.$i] != '0') {
          ${"t".$i} = $row['t'.$i];
        }
      }

      for ($i=1; $i <= $set['set_turni_totali'] ; $i++) {
        if (isset(${"t".$i})) {
          $sql = "SELECT * FROM collettivi WHERE id = ".${'t'.$i}." LIMIT 1";
          $request = mysqli_query($link, $sql);
          $row = mysqli_fetch_assoc($request);
          ?>
          <div class="col s10 offset-s1 marginetto_sopra">
            <p class="col s6"><b>Turno <?php echo $i ?></b>: "<?php echo $row['titolo_collettivo'] ?>"</p>
            <a style="border-radius: 25px;" href="/main/docenti/appello2?id=<?php echo $row['id']; ?>&turno=t<?php echo $i ?>" class="waves-effect waves-light btn center marginetto_sopra right <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">Appello T<?php echo $i ?>!</a>
          </div>
          <?php
        }
      }
      ?>
    </div>

  </div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php'; ?>

    </body>
  </html>
