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

  <title><?php echo $set['set_intestazione_sito']; ?> - Questionario</title>

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
                <h5 class="black-text">Grazie per aver compilato il questionario di gradimento!</h1>
                <h6 class="black-text">Questo questionario aiuta a rendere la <?php echo $set['set_nome_cogestione']; ?> ogni anno migliore e a capire cosa ha funzionato e cosa no. Se hai altri commenti/suggerimenti/consigli rivolgiti ai rappresentanti di istituto!</h6>
              </div>
            </div>
        </section>
  </div>

<!--Hero fine-->

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>
</html>
