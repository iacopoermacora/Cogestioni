<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin_and_professore_and_professore_admin');


$idcollettivo = mysqli_real_escape_string($link, $_GET['id']);

$turni = array('t1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 't13', 't14', 't15', 't16', 't17', 't18', 'id');
if (in_array($_GET['turno'], $turni)) {
  $turno = mysqli_real_escape_string($link, $_GET['turno']);
} else {
  header("location: /403.shtml");
}

$id = mysqli_real_escape_string($link, $_SESSION['id_coge']);
$sql = "SELECT * FROM users_cogestione WHERE id = '".$id."'";
$users = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($users);

if ($_SESSION['ruolo_coge'] == 'professore' || $_SESSION['ruolo_coge'] == 'professore_admin') {
  for ($i=1; $i <= $set['set_turni_totali']; $i++) {
    if ($turno == 't'.$i) {
      if ($row['t'.$i] != $idcollettivo) {
        header("location: /main/docenti/appello.php");
        exit;
      }
    }
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

<title><?php echo $set['set_intestazione_sito']; ?> - Appello</title>

<?php if ($_SESSION['ruolo_coge'] == 'professore' || $_SESSION['ruolo_coge'] == 'professore_admin') { ?>

  <div class="navbar-fixed">
  <nav class="<?php echo $set['set_colore_base']; ?> z-depth-0">
    <div class="nav-wrapper">
      <div class="container">
      <a class="brand-logo center">Appello <?php echo ucwords($turno) ?></a>
      <a href="/main/docenti/appello.php" class="left">Torna indietro</a>
      </div>
    </div>
  </nav>
  </div>

  <?php
  include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/hero.php';

} else {

  include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php';

}
 ?>

  <div class="container" style:"margin-bottom: 4em;">
    <title><?php echo $set['set_intestazione_sito']; ?> - Appello</title>

    <?php if ($_SESSION['ruolo_coge'] == 'studente' || $_SESSION['ruolo_coge'] == 'studente_admin') { ?>
      <div class="row margine_sopra">
        <a href="/admin/collettivi/appello_admin" style="border-radius: 15px; background-color: #fff; padding-right: 10px; padding-bottom: 10px;" class="left z-depth-1 black-text"><i style="position: relative; top: 8px;" class="material-icons small">chevron_left</i>Home</a>
      </div>
    <?php } ?>

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 <?php if ($_SESSION['ruolo_coge'] == 'professore' || $_SESSION['ruolo_coge'] == 'professore_admin') { echo 'margine_sopra';}?> margine_sotto">
      <h6 class="col s12 spazietto_sotto spazietto_sopra"><b>In questa pagina puoi vedere tutti gli studenti iscritti a "<?php
      $sql = "SELECT * FROM collettivi WHERE id = '".$idcollettivo."' AND id > 0";
      $request = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($request);
      $titolo_collettivo = $row['titolo_collettivo'];
      echo $titolo_collettivo; ?>" nel turno <?php echo $turno; ?> e fare l'appello. Cliccando sul bottone corrispondente puoi decidere se lo studente è "presente" o "assente"</b></h6>
    </div>

    <?php
    $sql = "SELECT * FROM users_cogestione WHERE ".$turno." = '".$idcollettivo."' AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin' ORDER BY classe, username";
    $request = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_assoc($request)) { ?>

      <div style="border-radius: 15px; background-color: #fff;" class="row marginetto_sopra spazio_sotto z-depth-1">
            <h5 class="col s8 offset-s2 margine_sopra margine_sotto center"><b>Ecco gli utenti iscritti al <?php echo $set['set_nome_collettivo'] ?> "<?php echo $titolo_collettivo; ?>" al <?php echo ucwords($turno); ?></b></h5>
                        <table class="col l8 m8 s10 offset-l2 offset-m2 offset-s1 highlight striped">
                            <thead class="spazietto_sopra">
                                <tr>
                                    <th>Nome</th>
                                    <th>Presenza</th>
                                </tr>
                            </thead>
                            <tbody>
      <?php
      $sql = "SELECT * FROM users_cogestione WHERE ".$turno." = '".$idcollettivo."' AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin' ORDER BY classe, username";
      $request = mysqli_query($link, $sql);
      while ($row = mysqli_fetch_assoc($request)) { ?>

        <tr>
          <td id="<?php echo $row['id'] ?>"><?php echo $row['username']." ".$row['classe'] ?></td>
          <td id="presenza_<?php echo $row['id'] ?>"><?php
          for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {
          if ($turno == 't'.$i) {
            if ($row['presente_t'.$i] == 'NO') { ?>
            <button style="border-radius: 25px; display:block;" class="btn waves-effect waves-light center red" onClick="ChangeAppello('assente',<?php echo $idcollettivo ?>,'<?php echo $turno ?>',<?php echo $row['id']; ?>,'presente_t<?php echo $i; ?>');">Assente!</button>
      <?php } elseif ($row['presente_t'.$i] == 'SI') {  ?>
            <button style="border-radius: 25px; display:block;" class="btn waves-effect waves-light center green" onClick="ChangeAppello('presente',<?php echo $idcollettivo ?>,'<?php echo $turno ?>',<?php echo $row['id']; ?>,'presente_t<?php echo $i; ?>');">Presente!</button>
      <?php }}} ?>
          <td>
        <tr>

      <?php } ?>
        </tbody>
      </table>
    <h6 class="col s8 offset-s2 center margine_sopra"><b>Professori di sorveglianza:</b>
    <?php
    $sql = "SELECT * FROM users_cogestione WHERE ".$turno." LIKE '".$idcollettivo."' AND (ruolo = 'professore' OR ruolo = 'professore_admin')";
    $users = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($users)){?>
      <?php echo $row['username'].', '; ?>
    <?php } ?>
    </h6>
    </div>
    <?php } else { ?>
                    <div style="border-radius: 15px; background-color: #fff;" class="row marginetto_sopra margine_sotto spazio_sotto z-depth-1">
                          <p class="col s8 offset-s2 center margine_sopra">Non ci sono utenti iscritti a questo <?php echo $set['set_nome_collettivo'] ?>.</p>
                          <h6 class="col s8 offset-s2 center margine_sopra"><b>Professori di sorveglianza:</b>
                          <?php
                          $sql = "SELECT * FROM users_cogestione WHERE ".$turno." LIKE '".$idcollettivo."' AND (ruolo = 'professore' OR ruolo = 'professore_admin')";
                          $users = mysqli_query($link, $sql);
                          while ($row = mysqli_fetch_assoc($users)){?>
                            <?php echo $row['username'].', '; ?>
                          <?php } ?>
                          </h6>
                    </div>
                  <?php } ?>

    </div>

    <script>
    function ChangeAppello(status, idcollettivo, turno, id, presenza){
      jQuery.ajax({
        type: "GET",
        url: "/main/docenti/appello3",
        data: { "status" : status, "idcollettivo" : idcollettivo, "turno" : turno, "id" : id, "presenza" : presenza },
        cache: false,
        success: function(data){
          if (data != 'error') {
            var post_status = data.split(",");
            if (post_status[0] == "'assente'") {
              var color = 'red';
              post_status = 'assente'
            } else {
              var color = 'green';
              post_status = 'presente';
            }
            $("#presenza_"+id).html('<button style="border-radius: 25px; display:block;" id="presenza_' + id + '" class="btn waves-effect waves-light center ' + color + '" onClick="ChangeAppello(' + data + ');">' + post_status + '!</button>');
          } else {
            alert('Errore: riprova più tardi');
          }
       },
     });
    }
    </script>

<?php if ($_SESSION['ruolo_coge'] == 'professore' || $_SESSION['ruolo_coge'] == 'professore_admin') {
include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php';
} else {
  include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php';
} ?>

    </body>
  </html>
