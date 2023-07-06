<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

$variabile = 'inservizio';
$numvar = -10005;
$nomevar = 'Non in servizio';

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page = 50;
$offset = ($pageno-1) * $no_of_records_per_page;

$search = mysqli_real_escape_string($link, $_GET['search']);

$total_pages_sql = "SELECT COUNT(*) FROM users_cogestione WHERE username LIKE '%$search%' AND (ruolo = 'professore' OR ruolo = 'professore_admin') AND id > 0";
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

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Rendi Fuori Servizio</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

  <div class="container">

    <div class="row margine_sopra">
      <a href="/admin/users/assegnaruoli" style="border-radius: 15px; background-color: #fff; padding-right: 10px; padding-bottom: 10px;" class="left z-depth-1 black-text"><i style="position: relative; top: 8px;" class="material-icons small">chevron_left</i>Selezione ruoli</a>
    </div>

    <div style="border-radius: 15px; background-color: #fff;"  class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>Segnala i professori non in servizio!</b></h5>
    </div>

    <div style="border-radius: 15px;" class="z-depth-1 margine_sopra">
      <nav style="border-radius: 15px;" >
          <div style="border-radius: 15px;" class="nav-wrapper <?php echo $set['set_colore_base']; ?> <?php echo $set['set_colore_base_scritte']; ?>-text">
            <form style="border-radius: 15px;" action="/admin/users/rendifuoriservizio" method="GET">
              <div style="border-radius: 15px;" class="input-field">
                <input style="border-radius: 15px;" id="search" type="search" name="search">
                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
              </div>
              <input type="hidden" name="variabile" value="<?php echo $variabile; ?>" />
            </form>
          </div>
        </nav>
    </div>

<div style="border-radius: 15px; background-color: #fff;"  class="margine_sopra margine_sotto spazietto_sopra z-depth-1">
  <div class="row">
    <div class="row center">
          <h6 class="col s10 offset-s1 center"><b>Segnala i professori non in servizio!</b></h6>
              <p class="col s10 offset-s1">Compilando questo form potrai segnalare come non in servizio i docenti. Questo significa che loro in quel turno non potranno iscriversi a nessun <?php echo $set['set_nome_collettivo'] ?>. Fra la loro iscrizioni invece troveranno una indicazione che gli segnala il non essere in servizio in quel determinato turno.</p>
                <a id="redirectpaginazione"></a>
                <a class="col s10 offset-s1" href="/admin/users/iscrittiasingolo?id=-10005&funzione=fuoriservizio">Clicca qui per vedere tutti i professori non in servizio divisi per turno.</a>

                <?php
                  $sql = "SELECT * FROM users_cogestione WHERE (username LIKE '%$search%' OR classe LIKE '%$search%') AND id > 0 AND (ruolo = 'professore' OR ruolo = 'professore_admin') ORDER BY username LIMIT ".$offset.", ".$no_of_records_per_page."";
                  $request = mysqli_query($link, $sql);
                  if ($row = mysqli_fetch_assoc($request)) {
                ?>
              <div class="row center">
              </div>
              <div style="overflow:scroll;">
                <table class="col s12 highlight striped centred">
                    <thead class="spazietto_sopra">
                        <tr>
                            <th>Utente</th>
                            <?php for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {?>
                            <th>In servizio T<?php echo $i; ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                $sql = "SELECT * FROM users_cogestione WHERE (username LIKE '%$search%' OR classe LIKE '%$search%') AND id > 0 AND (ruolo = 'professore' OR ruolo = 'professore_admin') ORDER BY username LIMIT ".$offset.", ".$no_of_records_per_page."";
                $request = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($request)) {?>

                  <tr>
                      <td><?php echo $row['username']; ?></td>
                      <?php
                      for ($i=1; $i <= $set['set_turni_totali']; $i++)
                      {
                      ?>
                      <td>
                        <?php if ($row['t'.$i] == $numvar) { ?>
                          <button style="border-radius: 25px; display:block;" id="annullarendi_<?php echo $variabile; ?>_<?php echo $row['id']; ?>_t<?php echo $i; ?>" class="btn waves-effect waves-light center red" onClick="AnnullaRendi(<?php echo $row['id'] ?>, 't<?php echo $i; ?>', '<?php echo $variabile; ?>');">No</button>
                          <button style="border-radius: 25px; display:none;" id="rendi_<?php echo $variabile; ?>_<?php echo $row['id']; ?>_t<?php echo $i; ?>" class="btn waves-effect waves-light center green" onClick="Rendi(<?php echo $row['id'] ?>, 't<?php echo $i; ?>', '<?php echo $variabile; ?>');">Sì</button>
                        <?php } elseif ($row['t'.$i] != $numvar) { ?>
                          <button style="border-radius: 25px; display:none;" id="annullarendi_<?php echo $variabile; ?>_<?php echo $row['id']; ?>_t<?php echo $i; ?>" class="btn waves-effect waves-light center red" onClick="AnnullaRendi(<?php echo $row['id'] ?>, 't<?php echo $i; ?>', '<?php echo $variabile; ?>');">No</button>
                          <button style="border-radius: 25px; display:block;" id="rendi_<?php echo $variabile; ?>_<?php echo $row['id']; ?>_t<?php echo $i; ?>" class="btn waves-effect waves-light center green" onClick="Rendi(<?php echo $row['id'] ?>, 't<?php echo $i; ?>', '<?php echo $variabile; ?>');">Sì</button>
                        <?php } ?>
                      </td>

                      <?php } ?>
                  </tr>
                  <?php } ?>
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

        }
    ?>
</div>
</div>
</div>

</div>

<script>
$('#search').val('<?php echo $search; ?>');
function Rendi(id, turno, ruolo_servizio)
  {
      jQuery.ajax({
       type: "POST",
       url: "/admin/users/rendi.php",
       data: { "id" : id, "turno" : turno, "ruolo_servizio" : ruolo_servizio },
       cache: false,
       success: function(data)
       {
              if (data == 'success') {
                document.getElementById('rendi_' + ruolo_servizio + '_' + id + '_' + turno).style.display = "none";
                document.getElementById('annullarendi_' + ruolo_servizio + '_' + id + '_' + turno).style.display = "block";
              }
           }
     });
   }

function AnnullaRendi(id, turno, ruolo_servizio)
  {
      jQuery.ajax({
       type: "POST",
       url: "/admin/users/annullarendi.php",
       data: { "id" : id, "turno" : turno, "ruolo_servizio" : ruolo_servizio },
       cache: false,
       success: function(data)
       {
              if (data == 'success') {
                document.getElementById('rendi_' + ruolo_servizio + '_' + id + '_' + turno).style.display = "block";
                document.getElementById('annullarendi_' + ruolo_servizio + '_' + id + '_' + turno).style.display = "none";
              }
           }
     });
   }
</script>

<!--Footer inizio-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>
</html>
