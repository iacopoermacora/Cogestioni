<?php
if(!empty($_POST["id"])){

require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';

include $_SERVER['DOCUMENT_ROOT'].'/card.php';

//Get last ID
$lastID = $_POST['id'];
$rand = $_POST['rand'];
$quantity_loaded = $_POST['quantity_loaded'];
$search = $_POST['search'];
$turno = $_POST['turno'];
$ruolo = $_POST['ruolo'];
$type = $_POST['type'];
$allNumRows = $_POST['allNumRows'];

//Limit on data display
$showLimit = 12;

$sql = "SELECT * FROM users_cogestione WHERE id = '".$_SESSION['id_coge']."'";
$request = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($request);

$iscritto = array();
$collettivo = array();
for ($i=1; $i <= $set['set_turni_totali']; $i++)
{

if ($row['t'.$i] == '0') {
  $iscritto[$i] = 'NO';
} else {
  $iscritto[$i] = 'SI';
  $collettivo[$i] = $row['t'.$i];
}

}
  //index
  if ($type == 1) {
    $sql = "SELECT * FROM collettivi WHERE (titolo_collettivo LIKE '%$search%' OR nome_referente LIKE '%$search%' OR cognome_referente LIKE '%$search%' OR descrizione_collettivo LIKE '%$search%' OR nome_esterno LIKE '%$search%' OR cognome_esterno LIKE '%$search%' OR turni LIKE '%,$search,%') AND segnalato='NO' AND ".$turno." != -100 AND eliminato='NO' AND id > 0 ORDER BY RAND(".$rand.") LIMIT ".$showLimit." OFFSET ".$quantity_loaded."";
  }
  //approvazione_cogestione
  if ($type == 2) {
    $sql = "SELECT * FROM collettivi WHERE (titolo_collettivo LIKE '%$search%' OR nome_referente LIKE '%$search%' OR cognome_referente LIKE '%$search%' OR descrizione_collettivo LIKE '%$search%' OR nome_esterno LIKE '%$search%' OR cognome_esterno LIKE '%$search%' OR turni LIKE '%,$search,%') AND ".$turno." != -100 AND segnalato='NO' AND eliminato='NO' AND id > 0 ORDER BY titolo_collettivo LIMIT ".$showLimit." OFFSET ".$quantity_loaded."";
  }
  $result = mysqli_query($link, $sql);
  $counter = 0;
  if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
      $counter++;
      $lastID = $row["id"];
      ?>
      <?php if ($counter == 1) { ?>
        <div class='row lastblock'>
      <?php }

      if ($type == 1) {
        DisplayCard($row, $turno, $ruolo, $iscritto, $collettivo, $set, 1, 0, 0);
      }
      //approvazione_cogestione
      if ($type == 2) {
        DisplayCard($row, $turno, $ruolo, $iscritto, $collettivo, $set, 7, 0, 0);
      }


        if (($counter % 3) == 0)
          {
            echo "</div><div class='row'>";
          }

   } ?>
  <?php if($allNumRows > $showLimit){ ?>
      <div class="load-more center" lastID="<?php echo $lastID; ?>" style="display: none;">
          <img style="height:50px;width:auto;" src="/images/base/loading.gif"/>
      </div>
  <?php }
  }
}
?>
