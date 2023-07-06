<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

include $_SERVER['DOCUMENT_ROOT']."/vendor/SimpleXLSX.php";

$message = '';

if (isset($_POST["import"]))
{

  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = '\images\credenziali.xlsx';
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $xlsx = SimpleXLSX::parse($targetPath);

        foreach ($xlsx->rows() as $Row) {

          $ruolo = "";
          $ruolo = mysqli_real_escape_string($link,$_REQUEST['user_role']);
          $ruolo = strtolower($ruolo);

          $classe = "";
          if(isset($Row[2])) {
            if ($ruolo == 'professore' || $ruolo == 'professore_admin') {
              $classe = 'prof';
            } else {
              $classe = mysqli_real_escape_string($link,$Row[2]);
              $classe = strtoupper($classe);
            }
          }

          $username = "";
          if(isset($Row[0]) && isset($Row[1])) {
              $name = mysqli_real_escape_string($link,$Row[0]);
              $name = str_replace(' ', '', $name);
              $surname = mysqli_real_escape_string($link,$Row[1]);
              $surname = str_replace(' ', '', $surname);
              if ($ruolo == 'studente' || $ruolo == 'studente_admin') {
                $username = $name.'.'.$surname.'.'.strtolower($classe);
              } else {
                $username = $name.'.'.$surname.'.prof';
              }

              $username = strtolower($username);
          }

          $password = "";
          if(isset($Row[3])) {
              $password = mysqli_real_escape_string($link,$Row[3]);
              $password = password_hash($password, PASSWORD_DEFAULT);
          }

          if (!empty($username) || !empty($classe) || !empty($password) || !empty($ruolo)) {
              $sql = "SELECT * FROM users_cogestione WHERE username = '".$username."'";
              $result = mysqli_query($link, $sql);
              if (mysqli_affected_rows($link) != 0) {
                $type = "error";
                $message = $message.$username.' esiste già, non è stato inserito<br>';
              } else {
                $sql = "INSERT INTO users_cogestione (username, classe, password, ruolo) VALUES ('".$username."','".$classe."','".$password."','".$ruolo."')";
                $results = mysqli_query($link, $sql);

                if (empty($results)) {
                  $type = "error";
                  $message = $message." ATTENZIONE! C'è stato un problema nel caricamento di ".$username." come ".$ruolo."<br>";
                }
              }

          }
       }
       if (file_exists('\images\credenziali.xlsx')) {
       unlink('\images\credenziali.xlsx');
       }
       if ($type != 'error') {
         $type = "success";
         $message = $message." Le credenziali sono state caricate con successo!";
       } else {
         $message = $message." Gli altri utenti sono stati caricati con successo!";
       }

   }
   else
   {
     $type = "error";
     $message = "ATTENZIONE: Il file che hai caricato non è un excel, i dati non sono stati dunque caricati!";
   }
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

</head>
  <body style="background-color: #eceff1;">

   <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Aggiungi Utenti</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<div class="container">
 <div style="border-radius: 15px; background-color: #fff;" class="row marginetto_sopra z-depth-1">
  <h5 class="col s10 offset-s1 margine_sopra margine_sotto center"><b>Carica le credenziali (username e password) di studenti e professori</b></h5>
  <p class="col s10 offset-s1 center"><b>LEGGI ATTENTAMENTE LE INFORMAZIONI QUI DI SEGUITO</b></p>
  <p class="col s10 offset-s1 center">Carica le credenziali dei tuoi utenti. Puoi farlo con un file excel con le seguenti caratteristiche:<br>Il file non deve avere intestazione e deve essere composto da 4 colonne: nome, cognome, classe, password. <a href="/images/base/esempio_credenziali.xlsx">Scarica il modello di esempio</a></p>
  <p class="col s10 offset-s1 center">Se non sai come generare password in automatico su excel, noi consigliamo l'utilizzo di questa formula</p>
  <p style="word-wrap: break-word;" class="col s10 offset-s1 center"><i>=CHAR(RANDBETWEEN(65,90))&CHAR(RANDBETWEEN(65,90))&RANDBETWEEN(100,999)&CHAR(RANDBETWEEN(65,90)&CHAR(RANDBETWEEN(65,90)&RANDBETWEEN(100,999)&CHAR(RANDBETWEEN(65,90)&RANDBETWEEN(100,999))</i></p>
  <p class="col s10 offset-s1 center">Alla fine gli utenti potranno fare il login usando come username, tutto minuscolo, "nome.cognome.classe", per i docenti "nome.cognome.prof" e password la password inserita, nel caso di più nomi o più cognomi, vengono uniti senza spazi (es. Mario Luigi Cecchi Rossi della 3B diventerà marioluigi.cecchirossi.3b). La password verrà chiesto di cambiarla da ogni utente al primo login</p>
  <p class="col s10 offset-s1 center"><b>QUALSIASI VARIAZIONE ALLE INDICAZIONI QUI SOPRA POTREBBE CAUSARE PROBLEMI All'ACCESSO DEGLI UTENTI.</b></p>

   <div class="col s10 offset-s1 center">

     <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
     <p class="col s12"><b>Seleziona il ruolo del blocco di utenti che stai caricando</b></p>
     <div class="input-field col s12">
       <select style="border-radius: 25px;" id="user_role" name="user_role" class="browser-default" required="required">
         <option value="" disabled selected>Seleziona</option>
         <option value="studente">Studente</option>
         <option value="studente_admin">Studente Admin</option>
         <option value="professore">Professore</option>
         <option value="professore_admin">Professore Admin</option>
       </select>
     </div>
     <p class="col s12"><b>Carica file excel password</b></p>
     <div class="file-field input-field col s12">
       <div style="border-radius: 25px;" class="<?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text btn">
         <span>Carica file</span>
         <input type="file" name="file" id="file" accept=".xls,.xlsx">
       </div>
       <div class="file-path-wrapper">
         <input class="file-path validate" type="text">
       </div>
     </div>

     <div class="col s12 center marginetto_sopra">
       <button onclick="loadingGIF()" style="border-radius: 25px;" class="btn waves-effect waves-light center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" type="submit" id="submit" name="import" value="Upload">Carica
         <i class="material-icons right">send</i>
       </button>
     </div>
   </form>

   <div class="col s12 margine_sopra" id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>

 </div>
</div>
</div>
<div id="loading_spinner" class="center" style="display:none;z-index:5; position: fixed;top: 0;left: 0;min-width: 100%;min-height: 100%; background-color: #f1f1f1;">
  <img class="responsive-img" style="margin-top:25%;position:static;height:100px; width: auto;" src="/images/base/load.gif">
  <p style="margin-bottom:30%;">LOADING...</p>
</div>

<script>
  $(document).ready(function(){
    $('.materialboxed').materialbox();
  });
  function loadingGIF(){
   $('#loading_spinner').show();
  }
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>

</html>
