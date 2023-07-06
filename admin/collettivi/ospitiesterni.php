<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

$turni = array('t1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 't13', 't14', 't15', 't16', 't17', 't18', 'id');
if (!in_array($_GET['turno'], $turni)) {
  header('location: /admin/admincogestione');
} else {
  $turno = mysqli_real_escape_string($link, $_GET['turno']);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

</head>
<body style="background-color: #eceff1;">

   <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Ospiti Esterni</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

    <div class="container">

      <div class="row margine_sopra">
        <a href="/admin/admincogestione" style="border-radius: 15px; background-color: #fff; padding-right: 10px; padding-bottom: 10px;" class="left z-depth-1 black-text"><i style="position: relative; top: 8px;" class="material-icons small">chevron_left</i>Home</a>
      </div>

      <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sotto">
        <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>In questa pagina puoi vedere tutti gli ospiti esterni del <?php echo ucwords($turno); ?></b></h5>
      </div>

      <?php
      $sql = "SELECT * FROM collettivi WHERE ".$turno." != -100 AND nome_esterno != '' AND id > 0 AND eliminato = 'NO' AND segnalato = 'NO'";
      $users = mysqli_query($link, $sql);
      if ($row = mysqli_fetch_assoc($users)) {   ?>

        <div style="border-radius: 15px; background-color: #fff;" class="row marginetto_sopra spazio_sotto z-depth-1">
              <h5 class="col s8 offset-s2 margine_sopra margine_sotto center"><b>Ecco gli ospiti esterni al <?php echo ucwords($turno); ?></b></h5>
                          <table class="col l8 m8 s10 offset-l2 offset-m2 offset-s1 highlight striped">
                              <thead class="spazietto_sopra">
                                  <tr>
                                      <th><?php echo $set['set_nome_collettivo'] ?></th>
                                      <th>Esterno</th>
                                      <?php if ($set['set_curriculum_necessario'] == 1) { ?>
                                      <th>Curriculum/a</th>
                                      <?php } ?>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                $sql = "SELECT * FROM collettivi WHERE ".$turno." != -100 AND nome_esterno != '' AND id > 0 AND eliminato = 'NO' AND segnalato = 'NO'";
                                $users = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_assoc($users)) { ?>
                                  <tr>
                                      <td><?php echo $row['titolo_collettivo']; ?></td>
                                      <td><?php echo $row['nome_esterno']; ?> <?php echo $row['cognome_esterno']; ?> (<?php echo $row['professione_esterno']; ?>)</td>
                                      <?php if ($set['set_curriculum_necessario'] == 1) {
                                      $curriculumURL = '/admin/collettivi/apri_curriculum?name='.$row["cv_esterno"]; ?>
                                      <td><a href="<?php echo $curriculumURL; ?>">Clicca qui</a></td>
                                      <?php } ?>
                                  </tr>
                                  <?php if ($row['altri_esterni'] != '') {
                                  $array_esterni = explode(", ", $row['altri_esterni']);
                                   foreach ($array_esterni as $item) { ?>
                                    <tr>
                                        <td><?php echo $row['titolo_collettivo']; ?></td>
                                        <td><?php echo $item; ?></td>
                                        <?php if ($set['set_curriculum_necessario'] == 1) {
                                        $curriculumURL = '/admin/collettivi/apri_curriculum?name='.$row["cv_esterno"]; ?>
                                        <td><a href="<?php echo $curriculumURL; ?>">Clicca qui</a></td>
                                        <?php } ?>
                                    </tr>
                                  <?php }}} ?>
                              </tbody>
                          </table>
                        </div>
                        <?php
                    } else { ?>
                      <div class="row marginetto_sopra spazio_sotto z-depth-1">
                            <h5 class="col s8 offset-s2 margine_sopra margine_sotto center"><b>Ecco gli ospiti esterni al <?php echo ucwords($turno); ?></b></h5>
                            <p class="col s8 offset-s2 center">Non ci sono ospiti esterni al <?php echo ucwords($turno); ?></p>
                      </div>
                    <?php } ?>

                    <?php
                    $sql = "SELECT * FROM collettivi WHERE ".$turno." != -100 AND nome_esterno != '' AND id > 0 AND eliminato = 'NO' AND segnalato = 'NO'";
                    $users = mysqli_query($link, $sql);
                    if ($row = mysqli_fetch_assoc($users)) {   ?>
                    <div style="border-radius: 15px; background-color: #fff;" class="row margine_sopra margine_sotto z-depth-1 spazietto_sotto spazietto_sopra">
                      <div class="col s12 m7 l7 offset-l1 offset-m1 center">
                        <h6> <b>Scarica il foglio firme per gli esterni del <?php echo $turno; ?>!</b> </h6>
                      </div>
                      <div class="col s12 m4 l4 center">
                        <a style="border-radius: 25px;" class="btn waves-effect waves-light <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="/admin/users/downloads_script?var=esterni_<?php echo $turno; ?>">Scarica<i class="material-icons right">get_app</i></a>
                      </div>
                    </div>
                    <?php } ?>
        </div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

</body>

</html>
