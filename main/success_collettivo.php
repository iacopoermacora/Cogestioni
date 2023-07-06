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

  <title><?php echo $set['set_intestazione_sito']; ?> - Caricamento Avvenuto</title>

    <div class="navbar-fixed">
    <nav class="<?php echo $set['set_colore_base']; ?> z-depth-0">
      <div class="nav-wrapper">
        <a href="/index" class="brand-logo center <?php echo $set['set_colore_base_scritte']; ?>-text"><?php echo $set['set_intestazione_sito']; ?></a>
      </div>
    </nav>
    </div>

<!--Hero inizio-->

<div class="hero_and_content">
    <section class="hero" style="background-color: white;">
            <div class="hero-inner">
              <div class="container">
                <h5 class="black-text">Caricato con successo</h1>
                <h6 class="black-text">Complimenti, il <?php echo $set['set_nome_collettivo']; ?> è stato inserito nella piattaforma con successo.</h6>
                <h6 class="black-text"><a href="/index">Torna alla home</a></h6>
              </div>
            </div>
        </section>
  </div>

<!--Hero fine-->

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>
</html>
