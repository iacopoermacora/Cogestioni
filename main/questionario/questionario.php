<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';

if ($set['set_status_cogestione'] != 'cogestione_questionario_gradimento') {
  header('location: /index');
}

if(!isset($_SESSION["loggedin_coge"]) || $_SESSION["loggedin_coge"] != true || $_SESSION["ruolo_coge"] == 'professore' || $_SESSION["ruolo_coge"] == 'professore_admin'){
    header("location: /main/questionario/questionario_pending");
}

$sql = "SELECT * FROM risposte_questionario WHERE iduser = '".$_SESSION['id_coge']."'";
$result = mysqli_query($link, $sql);
if($result->num_rows > 0) {
    header("location: /main/questionario/questionario_pending");
}

// Escape user inputs for security
$facilita_sito = mysqli_real_escape_string($link, $_REQUEST['facilita_sito']);
$problemi_sito = mysqli_real_escape_string($link, $_REQUEST['problemi_sito']);
$ampiezza_scelta = mysqli_real_escape_string($link, $_REQUEST['ampiezza_scelta']);
$quantita_eccessiva_collettivi = mysqli_real_escape_string($link, $_REQUEST['quantita_eccessiva_collettivi']);
$SDO = mysqli_real_escape_string($link, $_REQUEST['SDO']);
$accoglienza = mysqli_real_escape_string($link, $_REQUEST['accoglienza']);
$organizzatori = mysqli_real_escape_string($link, $_REQUEST['organizzatori']);
$durata = mysqli_real_escape_string($link, $_REQUEST['durata']);
$intervallo = mysqli_real_escape_string($link, $_REQUEST['intervallo']);
$intervallo_idee = mysqli_real_escape_string($link, $_REQUEST['intervallo_idee']);
$suggerimenti = mysqli_real_escape_string($link, $_REQUEST['suggerimenti']);
$iduser = $_SESSION['id_coge'];

$sql = "SELECT * FROM users_cogestione WHERE id = '".$_SESSION['id_coge']."'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

for ($i=1; $i <= $set['set_turni_totali']; $i++) {
  ${"collettivo".$i} = $row['t'.$i];
}

for ($i=1; $i <= $set['set_turni_totali']; $i++) {
  ${"voto_collettivo".$i} = mysqli_real_escape_string($link, $_REQUEST['collettivo_t'.$i]);
  switch (${"voto_collettivo".$i}) {
    case 1:
      ${"voto".$i} = 'V1';
      break;
    case 2:
      ${"voto".$i} = 'V2';
      break;
    case 3:
      ${"voto".$i} = 'V3';
      break;
    case 4:
      ${"voto".$i} = 'V4';
      break;
    case 5:
      ${"voto".$i} = 'V5';
      break;
  }
}

if(isset($_POST["submit"])){

          $sql = "INSERT INTO risposte_questionario (iduser, facilita_sito, problemi_sito, ampiezza_scelta, quantita_eccessiva_collettivi, SDO, accoglienza, organizzatori, durata, intervallo, intervallo_idee, suggerimenti) VALUES ('$iduser', '$facilita_sito', '$problemi_sito', '$ampiezza_scelta', '$quantita_eccessiva_collettivi', '$SDO', '$accoglienza', '$organizzatori', '$durata', '$intervallo', '$intervallo_idee', '$suggerimenti')";

          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto1 = $voto1 + 1 WHERE id = '".$collettivo1."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto2 = $voto2 + 1 WHERE id = '".$collettivo2."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto3 = $voto3 + 1 WHERE id = '".$collettivo3."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto4 = $voto4 + 1 WHERE id = '".$collettivo4."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto5 = $voto5 + 1 WHERE id = '".$collettivo5."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            $sql = "UPDATE collettivi SET $voto6 = $voto6 + 1 WHERE id = '".$collettivo6."'";
          if(mysqli_query($link, $sql)){
            header('location: /main/questionario/questionario_end');
          }}}}}}}}}}}}}}}}}}
          } else{
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }

        }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body>

  <title><?php echo $set['set_intestazione_sito']; ?> - Questionario</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/navbar_general.php'; ?>


<!--Hero-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/hero.php'; ?>

<!--Container-->

<div class="container">

  <div style="border-radius: 30px;" class="row margine_sopra spazio_sotto z-depth-1">
      <form class="col s12 container margine_sopra" action="" method="post" enctype="multipart/form-data">
            <h3 class="col s10 offset-s1 center"><b>Lasciaci un feedback su come è andata la <?php echo $set['set_nome_cogestione']; ?>!</b></h5>
            <p class="col s10 offset-s1">Innanzitutto grazie per aver partecipato alla <?php echo $set['set_nome_cogestione']; ?> anche quest'anno! Con il modulo che segue, potrete lasciare un feedback su come è andata e su come migliorarla, nonchè esprimere la vostra opinione sui <?php echo $set['set_nome_collettivi']; ?> a cui avete partecipato. La valutazione è completamente anonima.</p>
            <h6 class="col s10 offset-s1 center spazietto_sotto"><b>Attenzione! Tutti i campi sono obbligatori a meno che debitamente specificato.</b></h6>
            <h5 class="col s10 offset-s1 center"><b>Sito della <?php echo $set['set_nome_cogestione']; ?>!</b></h5>
            <p class="col s10 offset-s1"> <b>Da 1 (per niente) a 5 (moltissimo) quanto è stato chiaro e di facile comprensione l'utilizzo del sito per le iscrizioni alla <?php echo $set['set_nome_cogestione']; ?>?</b> </p>
            <div class="col s10 offset-s1 input-field form-group">
                <select style="border-radius: 25px;" class="browser-default form-control" name="facilita_sito" required="required">
                  <option value="" disabled selected>Seleziona</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
            </div>
            <p class="col s10 offset-s1"> <b>Hai riscontrato problemi con il sito?</b> </p>
              <div class="col s10 offset-s1">
                <p class="col s3">
                  <label>
                    <input name="group1" type="radio" id="yes" value="yes" onchange="displayQuestion(this.value)" />
                    <span>SI</span>
                  </label>
                </p>
                <p class="col s3">
                  <label>
                    <input name="group1" type="radio" id="no" value="no" onchange="displayQuestion(this.value)" />
                    <span>NO</span>
                  </label>
                </p>
              </div>
            <div id="yesQuestion" style="display:none;"><br/>
            <p class="col s10 offset-s1"> <b>Quali problemi hai riscontrato?</b> </p>
            <div class="input-field col s10 offset-s1">
              <input placeholder="Problemi Riscontrati" id="yesQuestionRequired" type="text" class="input is-rounded browser-default" name="problemi_sito">
            </div>
            </div>
            <h5 class="col s10 offset-s1 center"><b><?php echo ucfirst($set['set_nome_collettivi']); ?>!</b></h5>
            <p class="col s10 offset-s1"> <b>Da 1 (per niente) a 5 (moltissimo) quanto quanto hai trovato ampia la scelta di <?php echo $set['set_nome_collettivi']; ?>?</b> </p>
            <div class="col s10 offset-s1 input-field form-group">
                <select style="border-radius: 25px;" class="browser-default form-control" name="ampiezza_scelta" required="required">
                  <option value="" disabled selected>Seleziona</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
            </div>
            <p class="col s10 offset-s1"> <b>Hai trovato eccessivo il numero di <?php echo $set['set_nome_collettivi']; ?> presenti?</b> </p>
            <div class="col s10 offset-s1 input-field form-group">
                <select style="border-radius: 25px;" class="browser-default form-control" name="quantita_eccessiva_collettivi" required="required">
                  <option value="" disabled selected>Seleziona</option>
                  <option value="SI">SI</option>
                  <option value="NO">No</option>
                </select>
            </div>

            <?php
            $sql = "SELECT join1.titolo_collettivo as titolo_collettivo1, join2.titolo_collettivo as titolo_collettivo2, join3.titolo_collettivo as titolo_collettivo3, join4.titolo_collettivo as titolo_collettivo4, join5.titolo_collettivo as titolo_collettivo5, join6.titolo_collettivo as titolo_collettivo6, join7.titolo_collettivo as titolo_collettivo7, join8.titolo_collettivo as titolo_collettivo8, join9.titolo_collettivo as titolo_collettivo9,
            join10.titolo_collettivo as titolo_collettivo10, join11.titolo_collettivo as titolo_collettivo11, join12.titolo_collettivo as titolo_collettivo12, join13.titolo_collettivo as titolo_collettivo13, join14.titolo_collettivo as titolo_collettivo14, join15.titolo_collettivo as titolo_collettivo15, join16.titolo_collettivo as titolo_collettivo16, join17.titolo_collettivo as titolo_collettivo17, join18.titolo_collettivo as titolo_collettivo18
            FROM users_cogestione as u
            LEFT JOIN collettivi as join1 ON u.t1=join1.id
            LEFT JOIN collettivi as join2 ON u.t2=join2.id
            LEFT JOIN collettivi as join3 ON u.t3=join3.id
            LEFT JOIN collettivi as join4 ON u.t4=join4.id
            LEFT JOIN collettivi as join5 ON u.t5=join5.id
            LEFT JOIN collettivi as join6 ON u.t6=join6.id
            LEFT JOIN collettivi as join7 ON u.t7=join7.id
            LEFT JOIN collettivi as join8 ON u.t8=join8.id
            LEFT JOIN collettivi as join9 ON u.t9=join9.id
            LEFT JOIN collettivi as join10 ON u.t10=join10.id
            LEFT JOIN collettivi as join11 ON u.t11=join11.id
            LEFT JOIN collettivi as join12 ON u.t12=join12.id
            LEFT JOIN collettivi as join13 ON u.t13=join13.id
            LEFT JOIN collettivi as join14 ON u.t14=join14.id
            LEFT JOIN collettivi as join15 ON u.t15=join15.id
            LEFT JOIN collettivi as join16 ON u.t16=join16.id
            LEFT JOIN collettivi as join17 ON u.t17=join17.id
            LEFT JOIN collettivi as join18 ON u.t18=join18.id
            WHERE u.id = '".$_SESSION['id_coge']."'";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);

            for ($i=1; $i <= $set['set_turni_totali']; $i++) {
             ${"titolo_collettivo".$i} = $row['titolo_collettivo'.$i];
             ?>
            <p class="col s10 offset-s1"> <b>Da 1 (per niente) a 5 (moltissimo) quanto hai trovato adatto/interessante il <?php echo $set['set_nome_collettivo']; ?> "<?php echo ${"titolo_collettivo".$i}; ?>"?</b> </p>
            <div class="col s10 offset-s1 input-field form-group">
                <select style="border-radius: 25px;" class="browser-default form-control" name="collettivo_t<?php echo $i; ?>" required="required">
                  <option value="" disabled selected>Seleziona</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
            </div>
            <?php } ?>
            <h5 class="col s10 offset-s1 center"><b>Organizzazione!</b></h5>
            <p class="col s10 offset-s1"> <b>Da 1 (per niente) a 5 (moltissimo) quanto sei soddisfatto del lavoro del "Servizio d'ordine"? (Rispondi solo se hai avuto interazioni con il "servizio d'ordine")</b> </p>
            <div class="col s10 offset-s1 input-field form-group">
                <select style="border-radius: 25px;" class="browser-default form-control" name="SDO">
                  <option value="" disabled selected>Seleziona</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
            </div>
            <p class="col s10 offset-s1"> <b>Da 1 (per niente) a 5 (moltissimo) quanto sei soddisfatto del lavoro del servizio di accoglienza? (Rispondi solo se hai invitato/collaborato con esperti esterni)</b> </p>
            <div class="col s10 offset-s1 input-field form-group">
                <select style="border-radius: 25px;" class="browser-default form-control" name="accoglienza">
                  <option value="" disabled selected>Seleziona</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
            </div>
            <p class="col s10 offset-s1"> <b>Da 1 (per niente) a 5 (moltissimo) quanto sei soddisfatto del lavoro degli organizzatori? (Rispondi solo se hai avuto interazioni con gli organizzatori)</b> </p>
            <div class="col s10 offset-s1 input-field form-group">
                <select style="border-radius: 25px;" class="browser-default form-control" name="organizzatori">
                  <option value="" disabled selected>Seleziona</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
            </div>
            <h5 class="col s10 offset-s1 center"><b>Durata della <?php echo $set['set_nome_cogestione']; ?>!</b></h5>
            <p class="col s10 offset-s1"> <b>Cosa ne pensi della durata della <?php echo $set['set_nome_cogestione']; ?>?</b> </p>
            <div class="col s10 offset-s1 input-field form-group">
                <select style="border-radius: 25px;" class="browser-default form-control" name="durata" required="required">
                  <option value="" disabled selected>Seleziona</option>
                  <option value="troppo">Troppo lunga</option>
                  <option value="giusto">Lunga il giusto</option>
                  <option value="poco">Troppo corta</option>
                </select>
            </div>
            <h5 class="col s10 offset-s1 center"><b>Intervallo!</b></h5>
            <p class="col s10 offset-s1"> <b>Da 1 (per niente) a 5 (moltissimo) quanto ti è piaciuto il modo in cui è stato organizzato l'intervallo?</b> </p>
            <div class="col s10 offset-s1 input-field form-group">
                <select style="border-radius: 25px;" class="browser-default form-control" name="intervallo" required="required">
                  <option value="" disabled selected>Seleziona</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
            </div>
            <p class="col s10 offset-s1"> <b>Hai idee per l'intervallo? Faccele sapere!</b> </p>
            <div class="input-field col s10 offset-s1">
              <input placeholder="Idee" type="text" class="input is-rounded browser-default" name="intervallo_idee">
            </div>
            <h5 class="col s10 offset-s1 center"><b>Suggerimenti!</b></h5>
            <p class="col s10 offset-s1"> <b>Hai suggerimenti/appunti/commenti aggiuntivi da fare? Scriviceli qui sotto!</b> </p>
            <div class="input-field col s10 offset-s1">
              <input placeholder="suggerimenti" type="text" class="input is-rounded browser-default" name="suggerimenti">
            </div>


        <div>
          <div class="col s12 center">
            <button style="border-radius: 25px;" class="btn waves-effect waves-light btn-large center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" type="submit" name="submit" value="Upload">Invia
              <i class="material-icons right">send</i>
            </button>
          </div>
        </div>

      </form>
    </div>
  </div>

  <script>
  $(document).ready(function() {
    $('input#input_text').characterCounter();
  });

  $(document).ready(function(){
    $('select').formSelect();
  });

  function displayQuestion(answer) {

    if (answer == "yes") {

      document.getElementById('yesQuestion').style.display = "block";
      document.getElementById('yesQuestionRequired').setAttribute('required', 'required');

    } if (answer == "no") {

      document.getElementById('yesQuestion').style.display = "none";
      document.getElementById('yesQuestionRequired').removeAttribute("required");

    }

  }
  </script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>

</html>
