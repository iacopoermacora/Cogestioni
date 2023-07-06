<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

$id = mysqli_real_escape_string($link, $_GET['id']);


$sql = "SELECT * FROM collettivi WHERE id = '".$id."'";
$request = mysqli_query($link, $sql);
if (!$row = mysqli_fetch_assoc($request)) {
  header("location: /403.shtml");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

</head>
  <body style="background-color: #eceff1;">

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Iscritti a Singolo <?php echo ucfirst($set['set_nome_collettivo']); ?></title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

    <?php
    $funzione = mysqli_real_escape_string($link, $_GET['funzione']);
    if ($funzione == 'referenti') {
      $funzione = 'referenti';
      $funzione2 = '"';
      $ruolo = 'gli studenti';
      $limitautenti = "AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin'";
    } elseif ($funzione == 'SDO') {
      $funzione = "facenti parte del servizio d'ordine";
      $funzione2 = '"';
      $ruolo = 'gli studenti';
      $limitautenti = "AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin'";
    } elseif ($funzione == 'organizzatori') {
      $funzione = "facenti parte dell'organizzazione";
      $funzione2 = '"';
      $ruolo = 'gli studenti';
      $limitautenti = "AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin'";
    } elseif ($funzione == 'fuoriaula') {
      $funzione = 'presenti fuori aula';
      $funzione2 = '"';
      $ruolo = 'gli studenti';
      $limitautenti = "AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin'";
    } elseif ($funzione == 'iscritti') {
      $funzione = 'iscritti';
      $ruolo = 'gli studenti';
      $funzione2 = 'iscritti al '.$set['set_nome_collettivo'].' "';
      $limitautenti = "AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin'";
    } elseif ($funzione == 'fuoriservizio') {
      $funzione = 'non in servizio';
      $funzione2 = '"';
      $ruolo = 'i docenti';
      $limitautenti = "AND (ruolo = 'professore' OR ruolo = 'professore_admin')";
    }else {
      $funzione = 'iscritti';
      $ruolo = 'gli studenti';
      $funzione2 = 'iscritti al '.$set['set_nome_collettivo'].' "';
      $limitautenti = "AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin'";
    }
    ?>


        <div class="container">

          <div class="row margine_sopra">
            <a href="/admin/collettivi/admincollettivi" style="border-radius: 15px; background-color: #fff; padding-right: 10px; padding-bottom: 10px;" class="left z-depth-1 black-text"><i style="position: relative; top: 8px;" class="material-icons small">chevron_left</i>Gestisci collettivi</a>
          </div>

          <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sotto">
            <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>In questa pagina puoi vedere tutti <?php
            echo $ruolo." ";
            $sql = "SELECT * FROM collettivi WHERE id = '".$id."'";
            $request = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($request);
            echo $funzione2.$row['titolo_collettivo']; ?>"</b></h5>
          </div>

          <?php
          $turni = array();
          for ($i=1; $i <= $set['set_turni_totali']; $i++) {
            if ($row['t'.$i] != -100) {
              $turni[$i] = 1;
            } else {
              $turni[$i] = 0;
            }
          } ?>

          <?php
          for ($i=1; $i <= $set['set_turni_totali']; $i++)
          {
          if ($turni[$i] == 1) {
          $sql = "SELECT * FROM users_cogestione WHERE t".$i." LIKE '".$id."' ".$limitautenti."";
          $users = mysqli_query($link, $sql);
          if ($row = mysqli_fetch_assoc($users)) {   ?>

            <div style="border-radius: 15px; background-color: #fff;" class="row marginetto_sopra spazio_sotto z-depth-1">
                  <h5 class="col s8 offset-s2 margine_sopra margine_sotto center"><b>Ecco <?php echo $ruolo; ?> <?php echo $funzione; ?> al T<?php echo $i; ?></b></h5>
                              <table class="col l8 m8 s10 offset-l2 offset-m2 offset-s1 highlight striped">
                                  <thead class="spazietto_sopra">
                                      <tr>
                                          <th>Username</th>
                                          <th>Classe</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $sql = "SELECT * FROM users_cogestione WHERE t".$i." LIKE '".$id."' ".$limitautenti."";
                                    $users = mysqli_query($link, $sql);
                                    while ($row = mysqli_fetch_assoc($users)) { ?>
                                      <tr>
                                          <td><?php echo $row['username']; ?></td>
                                          <td><?php echo $row['classe']; ?></td>
                                      </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>
                              <?php
                              if ($funzione != 'referenti' && $funzione != "facenti parte del servizio d'ordine" && $funzione != 'presenti fuori aula' && $funzione != "facenti parte dell'organizzazione" && $funzione != 'non in servizio') {
                              $sql = "SELECT * FROM users_cogestione WHERE t".$i." = '".$id."' AND (ruolo = 'professore' OR ruolo = 'professore_admin') LIMIT 1";
                              $users = mysqli_query($link, $sql);
                              if ($row = mysqli_fetch_assoc($users)){?>
                              <h6 class="col s8 offset-s2 center margine_sopra"><b>Professore di sorveglianza:</b> <?php echo $row['username']; ?></h6>
                              <?php } ?>
                            <?php } ?>
                            </div>
                            <?php
                        } else { ?>
                          <div style="border-radius: 15px; background-color: #fff;" class="row marginetto_sopra spazio_sotto z-depth-1">
                                <h5 class="col s8 offset-s2 margine_sopra margine_sotto center"><b>Ecco gli utenti <?php echo $funzione; ?> al T<?php echo $i; ?></b></h5>
                                <p class="col s8 offset-s2 center">Non ci sono utenti <?php echo $funzione; ?> al T<?php echo $i; ?></p>
                                <?php
                                if ($funzione != 'referenti' && $funzione != "facenti parte del servizio d'ordine" && $funzione != 'presenti fuori aula' && $funzione != "facenti parte dell'organizzazione" && $funzione != 'non in servizio') {
                                $sql = "SELECT * FROM users_cogestione WHERE t".$i." = '".$id."' AND (ruolo = 'professore' OR ruolo = 'professore_admin') LIMIT 1";
                                $users = mysqli_query($link, $sql);
                                if ($row = mysqli_fetch_assoc($users)){?>
                                <h6 class="col s8 offset-s2 center margine_sopra"><b>Professore di sorveglianza:</b> <?php echo $row['username']; ?></h6>
                                <?php }} ?>
                          </div>
                        <?php }}}
                        ?>
            </div>


            <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>

</html>
