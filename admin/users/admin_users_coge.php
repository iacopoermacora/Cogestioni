<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page = 25;
$offset = ($pageno-1) * $no_of_records_per_page;

$search = mysqli_real_escape_string($link, $_GET['search']);

$total_pages_sql = "SELECT COUNT(*) FROM users_cogestione WHERE username LIKE '%$search%'";
$result = mysqli_query($link, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

</head>
  <body style="background-color: #eceff1;">

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Gestisci utenti</title>

<?php
    if ($_GET['eliminato'] == 'done') {
        echo "<script>$(document).ready(function() { M.toast({html: 'Utente eliminato con successo'}) });</script>";
    } elseif ($_GET['eliminato'] == 'done_all') {
        echo "<script>$(document).ready(function() { M.toast({html: 'Tutti gli utenti sono stati eliminati'}) });</script>";
    }
?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

        <div class="container">


          <div style="border-radius: 15px;" class="z-depth-1 margine_sopra">
            <nav style="border-radius: 15px;" >
                <div style="border-radius: 15px;" class="nav-wrapper <?php echo $set['set_colore_base']; ?> <?php echo $set['set_colore_base_scritte']; ?>-text">
                  <form style="border-radius: 15px;" action="/admin/admincogestione" method="GET">
                    <div style="border-radius: 15px;" class="input-field">
                      <input style="border-radius: 15px;" id="search" type="search" name="search">
                      <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                      <i class="material-icons">close</i>
                    </div>
                  </form>
                </div>
              </nav>
          </div>

            <div id="table_users">
              <div style="border-radius: 15px; background-color: #fff;"  class="row marginetto_sopra z-depth-1">

                <a id="redirectpaginazione"></a>

                    <h5 class="col s8 offset-s2 margine_sopra margine_sotto center"><b>Gestisci i tuoi utenti</b></h5>
                    <?php
                    $sql = "SELECT * FROM users_cogestione WHERE (username LIKE '%$search%' OR classe LIKE '%$search%') ORDER BY classe, username LIMIT ".$offset.", ".$no_of_records_per_page."";
                    $users = mysqli_query($link, $sql);
                    if ($row = mysqli_fetch_assoc($users)) {   ?>
                              <div style="overflow: scroll;" class="col s12">
                                <table class="col s10 offset-s1 highlight striped">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Classe</th>
                                            <th>Iscrizioni</th>
                                            <th>Ruolo</th>
                                            <th>Elimina</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $search = mysqli_real_escape_string($link, $_GET['search']);
                                      $sql = "SELECT * FROM users_cogestione WHERE id>0 AND (username LIKE '%$search%' OR classe LIKE '%$search%') ORDER BY classe, username LIMIT ".$offset.", ".$no_of_records_per_page."";
                                      $users = mysqli_query($link, $sql);
                                      while ($row = mysqli_fetch_assoc($users)) { ?>
                                        <tr>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['classe']; ?></td>
                                            <td>
                                                <a style="border-radius: 25px;" href='/admin/users/iscrizioniutente2?id=<?php echo $row['id']; ?>' title='Update Record' data-toggle='tooltip' class='btn-small waves-effect waves-light center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text'>Visualizza</a>
                                            </td>
                                            <td>
                                              <select style="border-radius: 25px;" id="ruolo_utente_<?php echo $row['id']; ?>" name="ruolo_utente" class="browser-default" required="required" onchange="ChangeRuoloUtente(this.value, <?php echo $row['id']; ?>, '<?php echo $row['ruolo']; ?>')">
                                                <option value="" disabled>Seleziona</option>
                                                <option <?php if ($row['ruolo'] == 'studente') { print 'selected'; } ?> value="studente">Studente</option>
                                                <option <?php if ($row['ruolo'] == 'professore') { print 'selected'; } ?> value="professore">Professore</option>
                                                <option <?php if ($row['ruolo'] == 'studente_admin') { print 'selected'; } ?> value="studente_admin">Studente Admin</option>
                                                <option <?php if ($row['ruolo'] == 'professore_admin') { print 'selected'; } ?> value="professore_admin">Professore Admin</option>
                                              </select>
                                            </td>
                                            <td>
                                              <a style="border-radius: 25px;" href="javascript:funzioneElimina(<?php echo $row['id']; ?>)" title='Delete Record' data-toggle='tooltip' class='btn-small waves-effect waves-light center red <?php if ($row['id'] == $_SESSION['id_coge']) { ?>disabled<?php } ?>'>Elim.</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                    </tbody>
                                </table>
                              </div>


                                <ul class="pagination col s12 m10 l10 offset-m1 offset-l1 margine_sopra margine_sotto center">
                                  <li class="waves-effect <?php if($pageno <= 1){ echo 'disabled'; } ?>"><a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><i class="material-icons">chevron_left</i></a></li>
                                  <?php
                                  if ($pageno == 1 && $total_pages >= 5) {
                                    for ($i= $pageno; $i<= $pageno + 4; $i++)
                                    { ?>
                                    <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                                    <?php }
                                  } elseif ($pageno == 1 && $total_pages < 5) {
                                    for ($i= $pageno; $i<= $total_pages; $i++)
                                    { ?>
                                    <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                                    <?php }
                                  } elseif ($pageno == 2 && $total_pages >= 5) {
                                    for ($i= $pageno - 1; $i<= $pageno + 3; $i++)
                                    { ?>
                                    <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                                    <?php }
                                  } elseif ($pageno == 2 && $total_pages < 5) {
                                    for ($i= $pageno - 1; $i<= $total_pages; $i++)
                                    { ?>
                                    <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                                    <?php }
                                  } elseif ($pageno == $total_pages && $total_pages >= 5) {
                                    for ($i= $pageno - 4; $i<= $pageno; $i++)
                                    { ?>
                                    <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                                    <?php }
                                  } elseif ($pageno == $total_pages && $total_pages < 5) {
                                    for ($i= $pageno - ($total_pages - 1); $i<= $pageno; $i++)
                                    { ?>
                                    <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                                    <?php }
                                  } elseif ($pageno == $total_pages - 1 && $total_pages >= 5) {
                                    for ($i= $pageno - 3; $i<= $pageno + 1; $i++)
                                    { ?>
                                    <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                                    <?php }
                                  } elseif ($pageno == $total_pages - 1 && $total_pages < 5) {
                                    for ($i= $pageno - ($total_pages - 2); $i<= $pageno + 1; $i++)
                                    { ?>
                                    <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                                    <?php }
                                  } else {
                                    for ($i= $pageno - 2; $i<= $pageno + 2; $i++)
                                    { ?>
                                    <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                                    <?php }
                                  } ?>
                                  <li class="waves-effect <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>"><a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><i class="material-icons">chevron_right</i></a></li>
                                </ul>
                                <?php
                            } else {
                              echo "<script>$(document).ready(function() { M.toast({html: 'Non esistono utenti che corrispondono con la tua ricerca.'}) });</script>";
                            }
                        ?>
                  </div>
                </div>
                <div style="border-radius: 15px; background-color: #fff;" class="row marginetto_sopra margine_sotto z-depth-1">
                  <div class="col s12 m7 l7 offset-l1 offset-m1 center marginetto_sopra">
                    <h6> <b>Elimina TUTTI gli utenti in blocco</b> </h6>
                    <p>Solamente l'utente che esegue l'azione non viene eliminato</p>
                  </div>
                  <div class="col s12 m4 l4 center marginetto_sopra">

                    <a style="border-radius: 25px;" href="javascript:funzioneEliminaTutti(<?php echo $row['id']; ?>)" class="waves-effect waves-light btn center marginetto_sopra marginetto_sotto red"><i class="material-icons left">delete</i>Elimina</a>
                  </div>
                </div>

            </div>

            <script>
            function funzioneElimina(id) {
            var r = confirm("Clicca OK per confermare l'eliminazione dell'utente!");
            if (r == true) {
              Elimina(id, "utente");
            }}
            function funzioneEliminaTutti(id) {
            var r = confirm("Clicca OK per confermare l'eliminazione di TUTTI gli utenti!");
            if (r == true) {
              Elimina(-100, "all_users");
            }}

            function Elimina(id, eliminando){
              jQuery.ajax({
                type: "GET",
                url: "/admin/system/delete.php",
                data: { "eliminando" : eliminando, "id" : id},
                cache: false,
                success: function(data){
                  if (data == 'success') {
                    $("#table_users").load("/admin/users/admin_users_coge.php #table_users");
                  } else {
                    alert('Errore: qualcosa è andato storto');
                  }
               },
             });
            }

            $('#search').val('<?php echo $search; ?>');
            function ChangeRuoloUtente(ruolo, id, lastrole){
              jQuery.ajax({
                type: "POST",
                url: "/admin/users/changeruoloutente.php",
                data: { "id" : id, "ruolo" : ruolo },
                cache: false,
                success: function(data){
                  if (data == 'success') {
                    document.getElementById("ruolo_utente_" + id).value = ruolo;
                    alert("Il ruolo dell'utente è stato modificato, perchè abbia effetto lui dovrà fare il logout.");
                  } else if (data == 'change_role_error') {
                    alert("Non è possibile cambiare ruolo da studente a professore e viceversa");
                    document.getElementById("ruolo_utente_" + id).value = lastrole;
                  }
               },
             });
            }
            </script>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>

</html>
