<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

$v = mysqli_real_escape_string($link, $_GET['v']);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

</head>
  <body>

<title><?php echo $set['set_intestazione_sito']; ?> - Admin - Modifica Avvenuta</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<!--Hero inizio-->

<div class="hero_and_content">
    <section class="hero" style="background-color: white;">
            <div class="hero-inner">
              <div class="container">
                <h5 class="black-text"><?php if ($v == 'collettivo') {
                  echo 'Il '.$set['set_nome_collettivo'].' è stato modificato con successo!';
                } elseif ($v == 'settings') {
                  echo 'Le impostazioni sono state modificate con successo!';
                } elseif ($v == 'posti_aggiornati') {
                  echo 'I posti sono stati aggiornati con successo!';
                } ?></h1>
                <h6 class="black-text">Le tue modifiche sono state registrate in modo corretto: torna al pannello Admin</h6>
                <a style="border-radius: 25px;" class="waves-effect waves-light btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="<?php if ($v == 'collettivo' || $v == 'posti_aggiornati') {
                  echo '/admin/collettivi/admincollettivi';
                } elseif ($v == 'settings') {
                  echo '/admin/settings/settingvariabili';
                } ?>">Pannello Admin</a>
              </div>
            </div>
        </section>
  </div>

<!--Hero fine-->

    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>
</html>
