<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

if (isset($_GET['variabile'])) {
if ($_GET['variabile'] == 'fuoriaula') {
  $variabile = 'fuoriaula';
  $numvar = -10002;
  $nomevar = 'Fuori Aula';
} elseif ($_GET['variabile'] == 'organizzatore') {
  $variabile = 'organizzatore';
  $numvar = -10004;
  $nomevar = 'Organizzatore';
} elseif ($_GET['variabile'] == 'referente') {
  $variabile = 'referente';
  $numvar = -10001;
  $nomevar = 'Referente';
} elseif ($_GET['variabile'] == 'SDO') {
  $variabile = 'SDO';
  $numvar = -10003;
  $nomevar = 'Servizio D\'Ordine';
} else {
  header('location: /admin/users/assegnaruoli');
}
} else {
  header('location: /admin/users/assegnaruoli');
}

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page = 50;
$offset = ($pageno-1) * $no_of_records_per_page;

$search = mysqli_real_escape_string($link, $_GET['search']);

$total_pages_sql = "SELECT COUNT(*) FROM users_cogestione WHERE username LIKE '%$search%' AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin' AND id > 0";
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

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Rendi <?php echo ucfirst($variabile); ?></title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

  <div class="container">

    <div class="row margine_sopra">
      <a href="/admin/users/assegnaruoli" style="border-radius: 15px; background-color: #fff; padding-right: 10px; padding-bottom: 10px;" class="left z-depth-1 black-text"><i style="position: relative; top: 8px;" class="material-icons small">chevron_left</i>Selezione ruoli</a>
    </div>

    <div style="border-radius: 15px; background-color: #fff;" class="row spazietto_sopra spazietto_sotto center z-depth-1 margine_sotto">
      <h5 class="col s12 spazietto_sotto spazietto_sopra"><b>
        <?php if ($_GET['variabile'] == 'fuoriaula') { ?>
          Segnala come presente fuori aula in un turno uno o più utenti!
        <?php } elseif ($_GET['variabile'] == 'organizzatore') { ?>
          Segnala come organizzatore in un turno uno o più utenti!
        <?php } elseif ($_GET['variabile'] == 'referente') { ?>
          Rendi utenti referenti durante un turno!
        <?php } elseif ($_GET['variabile'] == 'SDO') { ?>
          Segnala come parte del servizio d'ordine in un turno uno o più utenti!
        <?php } ?>
      </b></h5>
    </div>

    <div style="border-radius: 15px;" class="z-depth-1 margine_sopra">
      <nav style="border-radius: 15px;" >
          <div style="border-radius: 15px;" class="nav-wrapper <?php echo $set['set_colore_base']; ?> <?php echo $set['set_colore_base_scritte']; ?>-text">
            <form style="border-radius: 15px;" action="/admin/users/rendi_ruolo" method="GET">
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

<div style="border-radius: 15px; background-color: #fff;" class="margine_sopra margine_sotto spazietto_sopra z-depth-1">
  <div class="row">
    <div class="row center">
<?php
if ($_GET['variabile'] == 'fuoriaula') { ?>
        <h6 class="col s10 offset-s1 center"><b>Segnala come presente fuori aula in un turno uno o più utenti!</b></h6>
        <p class="col s10 offset-s1">Compilando questo form potrai segnalare come presenti fuori aula in un turno uno o più utenti. Questo significa che loro in quel turno sono presenti fuori aula e dunque non potranno iscriversi ad altro. Fra la loro iscrizioni invece troveranno una indicazione che gli segnala l'essere presenti fuori aula in quel determinato turno.</p>
        <p class="col s10 offset-s1"> <b>Ricerca nella barra sovrastante utenti che vuoi segnalare come presenti fuori aula:</b> </p>
        <a class="col s10 offset-s1" href="/admin/users/iscrittiasingolo?id=<?php echo $numvar; ?>&ruolo_servizio=<?php echo $variabile; ?>">Clicca qui per vedere tutti gli utenti presenti fuori aula</a>
<?php
} elseif ($_GET['variabile'] == 'organizzatore') {
?>
        <h6 class="col s10 offset-s1 center"><b>Segnala come organizzatore in un turno uno o più utenti!</b></h6>
        <p class="col s10 offset-s1">Compilando questo form potrai segnalare come organizzatore in un turno uno o più utenti. Questo significa che loro in quel turno sono impegnati nell'organizzazione e dunque non potranno iscriversi ad altro. Fra la loro iscrizioni invece troveranno una indicazione che gli segnala l'essere referenti in quel determinato turno.</p>
        <p class="col s10 offset-s1"> <b>Ricerca nella barra sovrastante utenti che vuoi segnalare come organizzatori:</b> </p>
        <a class="col s10 offset-s1" href="/admin/users/iscrittiasingolo?id=-10004&ruolo_servizio=organizzatori">Clicca qui per vedere tutti gli utenti organizzatori</a>
<?php
} elseif ($_GET['variabile'] == 'referente') {
?>
        <h6 class="col s10 offset-s1 center"><b>Rendi referente in un turno uno o più utenti!</b></h6>
        <p class="col s10 offset-s1">Compilando questo form potrai rendere referente in un turno uno o più utenti. Questo significa che loro in quel turno sono referenti di un <?php echo $set['set_nome_collettivo'] ?> e dunque non potranno iscriversi ad altro. Fra la loro iscrizioni invece troveranno una indicazione che gli segnala l'essere referenti in quel determinato turno.</p>
        <p class="col s10 offset-s1"> <b>Ricerca nella barra sovrastante utenti che vuoi rendere referenti:</b> </p>
        <a class="col s10 offset-s1" href="/admin/users/iscrittiasingolo?id=-10001&ruolo_servizio=referenti">Clicca qui per vedere tutti gli utenti referenti</a>
<?php
} elseif ($_GET['variabile'] == 'SDO') {
?>
        <h6 class="col s10 offset-s1 center"><b>Segnala come parte del servizio d'ordine in un turno uno o più utenti!</b></h6>
        <p class="col s10 offset-s1">Compilando questo form potrai segnalare come parte del servizio d'ordine in un turno uno o più utenti. Questo significa che loro in quel turno sono parte del servizio d'ordine e dunque non potranno iscriversi ad altro. Fra la loro iscrizioni invece troveranno una indicazione che gli segnala l'essere occupati a fare il servizio d'ordine in quel determinato turno.</p>
        <p class="col s10 offset-s1"> <b>Ricerca nella barra sovrastante utenti che vuoi segnalare come parte del servizio d'ordine:</b> </p>
        <a class="col s10 offset-s1" href="/admin/users/iscrittiasingolo?id=-10003&ruolo_servizio=SDO">Clicca qui per vedere tutti gli utenti facenti parte del servizio d'ordine</a>
<?php
}
?>
        </div>
        <div class="row center">
        <a id="redirectpaginazione"></a>
                <?php
                  $search = mysqli_real_escape_string($link, $search);
                  $sql = "SELECT * FROM users_cogestione WHERE (username LIKE '%$search%' OR classe LIKE '%$search%') AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin' AND id > 0 ORDER BY classe, username LIMIT ".$offset.", ".$no_of_records_per_page."";
                  $request = mysqli_query($link, $sql);
                  if ($row = mysqli_fetch_assoc($request)) {
                ?>
              <div style="overflow:scroll;">
                <table class="col s12 highlight striped centred">
                    <thead class="spazietto_sopra">
                        <tr>
                            <th>Utente</th>
                            <?php for ($i=1; $i <= $set['set_turni_totali'] ; $i++) { ?>
                            <th><?php echo $nomevar; ?> T<?php echo $i; ?></th>
                            <?php  }  ?>
                        </tr>
                    </thead>

                    <tbody>
                <?php
                $sql = "SELECT * FROM users_cogestione WHERE (username LIKE '%$search%' OR classe LIKE '%$search%') AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin' AND id > 0 ORDER BY classe, username LIMIT ".$offset.", ".$no_of_records_per_page."";
                $request = mysqli_query($link, $sql);
                while($row = mysqli_fetch_assoc($request)) {   ?>
                  <tr>
                      <td><?php echo $row['username']; ?> <?php echo $row['classe']; ?></td>

                      <?php
                      for ($i=1; $i <= $set['set_turni_totali']; $i++)
                      {
                      ?>

                      <td>
                        <?php if ($row['t'.$i] == $numvar) { ?>
                          <button style="border-radius: 25px; display:block;" id="annullarendi_<?php echo $variabile; ?>_<?php echo $row['id']; ?>_t<?php echo $i; ?>" class="btn waves-effect waves-light center green" onClick="AnnullaRendi(<?php echo $row['id'] ?>, 't<?php echo $i; ?>', '<?php echo $variabile; ?>');">SI</button>
                          <button style="border-radius: 25px; display:none;" id="rendi_<?php echo $variabile; ?>_<?php echo $row['id']; ?>_t<?php echo $i; ?>" class="btn waves-effect waves-light center red" onClick="Rendi(<?php echo $row['id'] ?>, 't<?php echo $i; ?>', '<?php echo $variabile; ?>');">NO</button>
                        <?php } elseif ($row['t'.$i] != $numvar) { ?>
                          <button style="border-radius: 25px; display:none;" id="annullarendi_<?php echo $variabile; ?>_<?php echo $row['id']; ?>_t<?php echo $i; ?>" class="btn waves-effect waves-light center green" onClick="AnnullaRendi(<?php echo $row['id'] ?>, 't<?php echo $i; ?>', '<?php echo $variabile; ?>');">SI</button>
                          <button style="border-radius: 25px; display:block;" id="rendi_<?php echo $variabile; ?>_<?php echo $row['id']; ?>_t<?php echo $i; ?>" class="btn waves-effect waves-light center red" onClick="Rendi(<?php echo $row['id'] ?>, 't<?php echo $i; ?>', '<?php echo $variabile; ?>');">NO</button>
                        <?php } ?>
                      </td>

                      <?php } ?>

                  </tr>
                  <?php } ?>
                </tbody>
            </table>
          </div>

            <ul class="pagination col s12 m10 l10 offset-m1 offset-l1 margine_sopra margine_sotto center">
              <li class="waves-effect <?php if($pageno <= 1){ echo 'disabled'; } ?>"><a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?variabile=".$variabile."&pageno=".($pageno - 1); } ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><i class="material-icons">chevron_left</i></a></li>
              <?php
              if ($pageno == 1 && $total_pages >= 5) {
                for ($i= $pageno; $i<= $pageno + 4; $i++)
                { ?>
                <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?variabile=<?php echo $variabile ?>&pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                <?php }
              } elseif ($pageno == 1 && $total_pages < 5) {
                for ($i= $pageno; $i<= $total_pages; $i++)
                { ?>
                <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?variabile=<?php echo $variabile ?>&pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                <?php }
              } elseif ($pageno == 2 && $total_pages >= 5) {
                for ($i= $pageno - 1; $i<= $pageno + 3; $i++)
                { ?>
                <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?variabile=<?php echo $variabile ?>&pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                <?php }
              } elseif ($pageno == 2 && $total_pages < 5) {
                for ($i= $pageno - 1; $i<= $total_pages; $i++)
                { ?>
                <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?variabile=<?php echo $variabile ?>&pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                <?php }
              } elseif ($pageno == $total_pages && $total_pages >= 5) {
                for ($i= $pageno - 4; $i<= $pageno; $i++)
                { ?>
                <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?variabile=<?php echo $variabile ?>&pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                <?php }
              } elseif ($pageno == $total_pages && $total_pages < 5) {
                for ($i= $pageno - ($total_pages - 1); $i<= $pageno; $i++)
                { ?>
                <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?variabile=<?php echo $variabile ?>&pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                <?php }
              } elseif ($pageno == $total_pages - 1 && $total_pages >= 5) {
                for ($i= $pageno - 3; $i<= $pageno + 1; $i++)
                { ?>
                <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?variabile=<?php echo $variabile ?>&pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                <?php }
              } elseif ($pageno == $total_pages - 1 && $total_pages < 5) {
                for ($i= $pageno - ($total_pages - 2); $i<= $pageno + 1; $i++)
                { ?>
                <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?variabile=<?php echo $variabile ?>&pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                <?php }
              } else {
                for ($i= $pageno - 2; $i<= $pageno + 2; $i++)
                { ?>
                <li style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text waves-effect <?php if($pageno == $i){ echo 'active'; } ?>"><a href="?variabile=<?php echo $variabile ?>&pageno=<?php echo $i; ?><?php echo $search ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><?php echo $i; ?></a></li>
                <?php }
              } ?>
              <li class="waves-effect <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>"><a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?variabile=".$variabile."&pageno=".($pageno + 1); } ?><?php if ($_GET['search']) { echo "&search=".$search; } ?>#redirectpaginazione"><i class="material-icons">chevron_right</i></a></li>
            </ul>
            <?php
        } else {
          print '<p class="col s10 offset-s1">Mi dispiace... La tua ricerca non ha prodotto risultati. Ricorda che puoi ricercare solo per nome e cognome o classe e non tutti e due insieme</p>';
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
