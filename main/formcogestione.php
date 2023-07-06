<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';

include $_SERVER['DOCUMENT_ROOT'].'/main/system/cookies_set.php';


if ($set['set_status_cogestione'] != 'cogestione_form') {
  header('location: /index');
}

function clean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

$titolo_collettivo = mysqli_real_escape_string($link, $_REQUEST['titolo_collettivo']);

function resizeImage($resourceType,$image_width,$image_height) {
    if ($image_width > $image_height) {
      $resizeHeight = 300;
      $resizeWidth = (300*$image_width)/$image_height;
    } else {
      $resizeWidth = 300;
      $resizeHeight = (300*$image_height)/$image_width;
    }
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

// File upload path
$targetDir = "/images/";
$temp = explode(".", $_FILES["immagine_collettivo"]["name"]);
$titolo_immagine_collettivo = clean($titolo_collettivo);
$fileName = $titolo_immagine_collettivo.date('d-m-Y_h-i-s').'.'.end($temp);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

// File upload path
$targetDir2 = "/curriculum/";
$temp = explode(".", $_FILES["cv_esterno"]["name"]);
$titolo_cv_collettivo = clean($titolo_collettivo);
$fileName2 = "CVesterno_collettivo_".$titolo_cv_collettivo.date('d-m-Y_h-i-s').'.'.end($temp);
$targetFilePath2 = $targetDir2 . $fileName2;
$fileType2 = pathinfo($targetFilePath2,PATHINFO_EXTENSION);

// Escape user inputs for security
$nome_proponente = mysqli_real_escape_string($link, ucwords($_REQUEST['nome_proponente']));
$cognome_proponente = mysqli_real_escape_string($link, ucwords($_REQUEST['cognome_proponente']));
$descrizione_collettivo = mysqli_real_escape_string($link, $_REQUEST['descrizione_collettivo']);
$email_proponente = mysqli_real_escape_string($link, $_REQUEST['email_proponente']);
$telefono_proponente = mysqli_real_escape_string($link, $_REQUEST['telefono_proponente']);
$ruolo_proponente = mysqli_real_escape_string($link, $_REQUEST['ruolo_proponente']);
$nome_referente = mysqli_real_escape_string($link, ucwords($_REQUEST['nome_referente']));
$cognome_referente = mysqli_real_escape_string($link, ucwords($_REQUEST['cognome_referente']));
$anno_referente = mysqli_real_escape_string($link, $_REQUEST['anno_referente']);
$sezione_referente = mysqli_real_escape_string($link, $_REQUEST['sezione_referente']);
$altri_referenti = mysqli_real_escape_string($link, ucwords($_REQUEST['altri_referenti']));

$t_first = array();
$turno = array();
$t = array();
$prof_t = array();
for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {

$t_first[$i] = mysqli_real_escape_string($link, $_REQUEST['t'.$i]);
if ($t_first[$i] == 'on') {
  $turno[$i] = $i.',';
  $t[$i] = $set['set_posti_spazio_'.$_REQUEST['spazio']];
  $prof_t[$i] = $set['set_posti_spazio_'.$_REQUEST['spazio'].'_prof'];
} else {
  $t[$i] = -100;
  $turno[$i] = '';
  $prof_t[$i] = -100;
}

}

for ($i = $set['set_turni_totali']+1; $i<=18; $i++) {
  $t[$i] = -100;
  $turno[$i] = '';
  $prof_t[$i] = -100;
}

$turni = ',';
foreach ($turno as $value) {
  $turni = $turni.$value;
}
$disponibile = mysqli_real_escape_string($link, $_REQUEST['disponibile_cambio_turno']);
if ($disponibile == 'on') {
  $disponibile_cambio_turno = 'SI';
} else {
  $disponibile_cambio_turno = 'NO';
}
$nome_esterno = mysqli_real_escape_string($link, ucwords($_REQUEST['nome_esterno']));
$cognome_esterno = mysqli_real_escape_string($link, ucwords($_REQUEST['cognome_esterno']));
$telefono_esterno = mysqli_real_escape_string($link, $_REQUEST['telefono_esterno']);
$professione_esterno = mysqli_real_escape_string($link, ucwords($_REQUEST['professione_esterno']));
$spazio = mysqli_real_escape_string($link, $_REQUEST['spazio']);
$necessita_particolari = mysqli_real_escape_string($link, $_REQUEST['necessita_particolari']);
$esterno2 = mysqli_real_escape_string($link, $_REQUEST['esterno2']);
$esterno3 = mysqli_real_escape_string($link, $_REQUEST['esterno3']);
$esterno4 = mysqli_real_escape_string($link, $_REQUEST['esterno4']);
$esterno5 = mysqli_real_escape_string($link, $_REQUEST['esterno5']);
$esterno6 = mysqli_real_escape_string($link, $_REQUEST['esterno6']);
$esterno7 = mysqli_real_escape_string($link, $_REQUEST['esterno7']);
$esterno8 = mysqli_real_escape_string($link, $_REQUEST['esterno8']);
$esterno9 = mysqli_real_escape_string($link, $_REQUEST['esterno9']);
$esterno10 = mysqli_real_escape_string($link, $_REQUEST['esterno10']);
$esterno11 = mysqli_real_escape_string($link, $_REQUEST['esterno11']);
if ($esterno2 == '') {
$array_esterni = array();
} elseif ($esterno3 == '') {
$array_esterni = array($esterno2);
} elseif ($esterno4 == '') {
$array_esterni = array($esterno2, $esterno3);
} elseif ($esterno5 == '') {
$array_esterni = array($esterno2, $esterno3, $esterno4);
} elseif ($esterno6 == '') {
$array_esterni = array($esterno2, $esterno3, $esterno4, $esterno5);
} elseif ($esterno7 == '') {
$array_esterni = array($esterno2, $esterno3, $esterno4, $esterno5, $esterno6);
} elseif ($esterno8 == '') {
$array_esterni = array($esterno2, $esterno3, $esterno4, $esterno5, $esterno6, $esterno7);
} elseif ($esterno9 == '') {
$array_esterni = array($esterno2, $esterno3, $esterno4, $esterno5, $esterno6, $esterno7, $esterno8);
} elseif ($esterno10 == '') {
$array_esterni = array($esterno2, $esterno3, $esterno4, $esterno5, $esterno6, $esterno7, $esterno8, $esterno9);
} elseif ($esterno11 == '') {
$array_esterni = array($esterno2, $esterno3, $esterno4, $esterno5, $esterno6, $esterno7, $esterno8, $esterno9, $esterno10);
} else {
$array_esterni = array($esterno2, $esterno3, $esterno4, $esterno5, $esterno6, $esterno7, $esterno8, $esterno9, $esterno10, $esterno11);
}
$altri_esterni = implode(", ",$array_esterni);


if(isset($_POST["submit"]) && !empty($_FILES["immagine_collettivo"]["name"])){

  if($turni != ''){

  if(!empty($_REQUEST['ruolo_proponente']) && !empty($_REQUEST['anno_referente']) && !empty($_REQUEST['sezione_referente'])){

    // Allow certain file formats
    $allowTypes = array('jpg','jpeg', 'JPG', 'JPEG');
    if(in_array($fileType, $allowTypes)){

      if(is_array($_FILES)) {
          $fileName3 = $_FILES['immagine_collettivo']['tmp_name'];
          $sourceProperties = getimagesize($fileName3);
          $uploadImageType = $sourceProperties[2];
          $sourceImageWidth = $sourceProperties[0];
          $sourceImageHeight = $sourceProperties[1];
          switch ($uploadImageType) {
              case IMAGETYPE_JPEG:
                  $resourceType = imagecreatefromjpeg($fileName3);
                  $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                  imagejpeg($imageLayer,$_SERVER['DOCUMENT_ROOT'].$targetDir."res_".$fileName);
                  break;
          }

        // Upload file to server
        if(move_uploaded_file($_FILES["immagine_collettivo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].$targetFilePath)){

          // Get dimensions of the original image
          list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT']."/images/"."res_".$fileName);
          $determinatore = min($width, $height);
          $targetx = ($determinatore/2 - $width/2);
          $targety = ($determinatore/2 - $height/2);

          // Resample the image 600 : x = 800 : y
          $canvas = imagecreatetruecolor($determinatore, $determinatore);
          $current_image = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'] . "/images/"."res_".$fileName);
          imagecopy($canvas, $current_image, $targetx, $targety, 0, 0, $width, $height);
          imagejpeg($canvas, $_SERVER['DOCUMENT_ROOT'] . "/images/Collettivo_".$fileName, 60);
          chmod($_SERVER['DOCUMENT_ROOT'] . "/images/Collettivo_".$fileName, 0644);
          unlink($_SERVER['DOCUMENT_ROOT'] . "/images/"."res_".$fileName);
          unlink($_SERVER['DOCUMENT_ROOT'] . "/images/".$fileName);

            if(!empty($_FILES["cv_esterno"]["name"]) || $set['set_curriculum_necessario'] == 0){
                // Allow certain file formats
                $allowTypes2 = array('jpg','png','jpeg','gif','pdf','JPG','JPEG','doc','docx','DOC','DOCX');
                if(in_array($fileType2, $allowTypes2) || $set['set_curriculum_necessario'] == 0){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["cv_esterno"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].$targetFilePath2) || $set['set_curriculum_necessario'] == 0){

          $strumenti = implode(", ",$_REQUEST['strumenti']);

          if ($set['set_curriculum_necessario'] == 0) {
            $fileName2 = '';
          }

          $sql = "INSERT INTO collettivi (titolo_collettivo, nome_proponente, cognome_proponente, descrizione_collettivo, immagine_collettivo, email_proponente, telefono_proponente, ruolo_proponente, nome_referente, cognome_referente, anno_referente, sezione_referente, altri_referenti, t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t13, t14, t15, t16, t17, t18, total_t1, total_t2, total_t3, total_t4, total_t5, total_t6, total_t7, total_t8, total_t9, total_t10, total_t11, total_t12, total_t13, total_t14, total_t15, total_t16, total_t17, total_t18, prof_t1, prof_t2, prof_t3, prof_t4, prof_t5, prof_t6, prof_t7, prof_t8, prof_t9, prof_t10, prof_t11, prof_t12, prof_t13, prof_t14, prof_t15, prof_t16, prof_t17, prof_t18, total_prof_t1, total_prof_t2, total_prof_t3, total_prof_t4, total_prof_t5, total_prof_t6, total_prof_t7, total_prof_t8, total_prof_t9, total_prof_t10, total_prof_t11, total_prof_t12, total_prof_t13, total_prof_t14, total_prof_t15, total_prof_t16, total_prof_t17, total_prof_t18, turni, disponibile_cambio_turno, nome_esterno, cognome_esterno, telefono_esterno, professione_esterno, altri_esterni, cv_esterno, spazio, strumenti, necessita_particolari) VALUES ('$titolo_collettivo', '$nome_proponente', '$cognome_proponente', '$descrizione_collettivo', 'Collettivo_".$fileName."', '$email_proponente', '$telefono_proponente', '$ruolo_proponente', '$nome_referente', '$cognome_referente', '$anno_referente', '$sezione_referente', '$altri_referenti', '$t[1]', '$t[2]', '$t[3]', '$t[4]', '$t[5]', '$t[6]', '$t[7]', '$t[8]', '$t[9]', '$t[10]', '$t[11]', '$t[12]', '$t[13]', '$t[14]', '$t[15]', '$t[16]', '$t[17]', '$t[18]', '$t[1]', '$t[2]', '$t[3]', '$t[4]', '$t[5]', '$t[6]', '$t[7]', '$t[8]', '$t[9]', '$t[10]', '$t[11]', '$t[12]', '$t[13]', '$t[14]', '$t[15]', '$t[16]', '$t[17]', '$t[18]', '$prof_t[1]', '$prof_t[2]', '$prof_t[3]', '$prof_t[4]', '$prof_t[5]', '$prof_t[6]', '$prof_t[7]', '$prof_t[8]', '$prof_t[9]', '$prof_t[10]', '$prof_t[11]', '$prof_t[12]', '$prof_t[13]', '$prof_t[14]', '$prof_t[15]', '$prof_t[16]', '$prof_t[17]', '$prof_t[18]', '$prof_t[1]', '$prof_t[2]', '$prof_t[3]', '$prof_t[4]', '$prof_t[5]', '$prof_t[6]', '$prof_t[7]', '$prof_t[8]', '$prof_t[9]', '$prof_t[10]', '$prof_t[11]', '$prof_t[12]', '$prof_t[13]', '$prof_t[14]', '$prof_t[15]', '$prof_t[16]', '$prof_t[17]', '$prof_t[18]', '$turni', '$disponibile_cambio_turno', '$nome_esterno', '$cognome_esterno', '$telefono_esterno', '$professione_esterno', '$altri_esterni', '$fileName2', '$spazio', '$strumenti', '$necessita_particolari')";

          if(mysqli_query($link, $sql)){
            header('location: /main/success_collettivo');
          } else{
            echo '<script language="javascript">';
            echo 'alert("ERRORE: errore nel caricamento: riprovare")';
            echo '</script>';
          }

        }else{
          echo '<script language="javascript">';
          echo 'alert("ERRORE: '.$set['set_nome_collettivo'].' non caricato: errore nel caricamento del curriculum.")';
          echo '</script>';
          }
        }else{
          echo '<script language="javascript">';
          echo 'alert("ERRORE: '.$set['set_nome_collettivo'].' non caricato: Il curriculum supporta solo file in formato jpg, png, PDF, doc, docx.")';
          echo '</script>';
        }
        }else{
        }

        }else{
          echo '<script language="javascript">';
          echo 'alert("ERRORE: '.$set['set_nome_collettivo'].' non caricato: errore nel caricamento della immagine.")';
          echo '</script>';
          }
      }else{
        echo '<script language="javascript">';
        echo 'alert("ERRORE: '.$set['set_nome_collettivo'].' non caricato: errore nel caricamento della immagine. Sono supportati solo file in formato jpg e jpeg.")';
        echo '</script>';
      }
  }else{
    echo '<script language="javascript">';
    echo 'alert("ERRORE: '.$set['set_nome_collettivo'].' non caricato: non hai compilato tutti i campi.")';
    echo '</script>';
  }
}else{
  echo '<script language="javascript">';
  echo 'alert("ERRORE: '.$set['set_nome_collettivo'].' non caricato: devi selezionare almeno un turno per il tuo '.$set['set_nome_collettivo'].'.")';
  echo '</script>';
}
}else{
}}





if(isset($_POST["submit2"]) && !empty($_FILES["immagine_collettivo"]["name"])){

  if($turni != ''){

  if(!empty($_REQUEST['ruolo_proponente']) && !empty($_REQUEST['anno_referente']) && !empty($_REQUEST['sezione_referente']) && !empty($_REQUEST['spazio'])){

    // Allow certain file formats
    $allowTypes = array('jpg','jpeg','JPG','JPEG');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server

        if(is_array($_FILES)) {
            $fileName3 = $_FILES['immagine_collettivo']['tmp_name'];
            $sourceProperties = getimagesize($fileName3);
            $uploadImageType = $sourceProperties[2];
            $sourceImageWidth = $sourceProperties[0];
            $sourceImageHeight = $sourceProperties[1];
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $resourceType = imagecreatefromjpeg($fileName3);
                    $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                    imagejpeg($imageLayer,$_SERVER['DOCUMENT_ROOT'].$targetDir."res_".$fileName);
                    break;
            }

        if(move_uploaded_file($_FILES['immagine_collettivo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$targetFilePath)){

          // Get dimensions of the coriginal image
          list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT']."/images/"."res_".$fileName);
          $determinatore = min($width, $height);
          $targetx = ($determinatore/2 - $width/2);
          $targety = ($determinatore/2 - $height/2);

          // Resample the image 600 : x = 800 : y
          $canvas = imagecreatetruecolor($determinatore, $determinatore);
          $current_image = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'] . "/images/"."res_".$fileName);
          imagecopy($canvas, $current_image, $targetx, $targety, 0, 0, $width, $height);
          imagejpeg($canvas, $_SERVER['DOCUMENT_ROOT'] . "/images/Collettivo_".$fileName, 60);
          chmod($_SERVER['DOCUMENT_ROOT'] . "/images/Collettivo_".$fileName, 0644);
          unlink($_SERVER['DOCUMENT_ROOT'] . "/images/"."res_".$fileName);
          unlink($_SERVER['DOCUMENT_ROOT'] . "/images/".$fileName);

          $strumenti = implode(", ",$_REQUEST['strumenti']);

          $sql = "INSERT INTO collettivi (titolo_collettivo, nome_proponente, cognome_proponente, descrizione_collettivo, immagine_collettivo, email_proponente, telefono_proponente, ruolo_proponente, nome_referente, cognome_referente, anno_referente, sezione_referente, altri_referenti, t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t13, t14, t15, t16, t17, t18, total_t1, total_t2, total_t3, total_t4, total_t5, total_t6, total_t7, total_t8, total_t9, total_t10, total_t11, total_t12, total_t13, total_t14, total_t15, total_t16, total_t17, total_t18, prof_t1, prof_t2, prof_t3, prof_t4, prof_t5, prof_t6, prof_t7, prof_t8, prof_t9, prof_t10, prof_t11, prof_t12, prof_t13, prof_t14, prof_t15, prof_t16, prof_t17, prof_t18, total_prof_t1, total_prof_t2, total_prof_t3, total_prof_t4, total_prof_t5, total_prof_t6, total_prof_t7, total_prof_t8, total_prof_t9, total_prof_t10, total_prof_t11, total_prof_t12, total_prof_t13, total_prof_t14, total_prof_t15, total_prof_t16, total_prof_t17, total_prof_t18, turni, disponibile_cambio_turno, spazio, strumenti, necessita_particolari) VALUES ('$titolo_collettivo', '$nome_proponente', '$cognome_proponente', '$descrizione_collettivo', 'Collettivo_".$fileName."', '$email_proponente', '$telefono_proponente', '$ruolo_proponente', '$nome_referente', '$cognome_referente', '$anno_referente', '$sezione_referente', '$altri_referenti', '$t[1]', '$t[2]', '$t[3]', '$t[4]', '$t[5]', '$t[6]', '$t[7]', '$t[8]', '$t[9]', '$t[10]', '$t[11]', '$t[12]', '$t[13]', '$t[14]', '$t[15]', '$t[16]', '$t[17]', '$t[18]', '$t[1]', '$t[2]', '$t[3]', '$t[4]', '$t[5]', '$t[6]', '$t[7]', '$t[8]', '$t[9]', '$t[10]', '$t[11]', '$t[12]', '$t[13]', '$t[14]', '$t[15]', '$t[16]', '$t[17]', '$t[18]', '$prof_t[1]', '$prof_t[2]', '$prof_t[3]', '$prof_t[4]', '$prof_t[5]', '$prof_t[6]', '$prof_t[7]', '$prof_t[8]', '$prof_t[9]', '$prof_t[10]', '$prof_t[11]', '$prof_t[12]', '$prof_t[13]', '$prof_t[14]', '$prof_t[15]', '$prof_t[16]', '$prof_t[17]', '$prof_t[18]', '$prof_t[1]', '$prof_t[2]', '$prof_t[3]', '$prof_t[4]', '$prof_t[5]', '$prof_t[6]', '$prof_t[7]', '$prof_t[8]', '$prof_t[9]', '$prof_t[10]', '$prof_t[11]', '$prof_t[12]', '$prof_t[13]', '$prof_t[14]', '$prof_t[15]', '$prof_t[16]', '$prof_t[17]', '$prof_t[18]', '$turni', '$disponibile_cambio_turno', '$spazio', '$strumenti', '$necessita_particolari')";

          if(mysqli_query($link, $sql)){
            header('location: /main/success_collettivo');
          } else{
            echo '<script language="javascript">';
            echo 'alert("ERRORE: errore nel caricamento: riprovare")';
            echo '</script>';
          }

        }else{
          echo '<script language="javascript">';
          echo 'alert("ERRORE: '.$set['set_nome_collettivo'].' non caricato: errore nel caricamento della immagine.")';
          echo '</script>';
          }
      }else{
        echo '<script language="javascript">';
        echo 'alert("ERRORE: '.$set['set_nome_collettivo'].' non caricato: errore nel caricamento della immagine. Sono supportati solo file in formato jpg e jpeg.")';
        echo '</script>';
      }
  }else{
    echo '<script language="javascript">';
    echo 'alert("ERRORE: '.$set['set_nome_collettivo'].' non caricato: non hai compilato tutti i campi.")';
    echo '</script>';
  }
}else{
  echo '<script language="javascript">';
  echo 'alert("ERRORE: '.$set['set_nome_collettivo'].' non caricato: devi selezionare almeno un turno per il tuo '.$set['set_nome_collettivo'].'.")';
  echo '</script>';
}
}else{
}}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/header.php'; ?>

  </head>
  <body>

  <title><?php echo $set['set_intestazione_sito']; ?> - Home</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/navbar_general.php'; ?>


<!--Hero-->

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/hero.php'; ?>


<!--Container-->

<div class="container">

  <div style="border-radius: 30px;" class="row margine_sopra spazio_sotto z-depth-1">
      <form onsubmit="loadingGIF()" class="col s12" action="" method="post" enctype="multipart/form-data">
            <h3 class="col s12 center margine_sotto"><b>Proponi un <?php echo $set['set_nome_collettivo'] ?> per la <?php echo $set['set_nome_cogestione']; ?>!</b></h5>
            <div style="border-radius:15px;" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">
              <p class="col s12 center">Con il modulo che segue, potrete proporre i vostri <?php echo $set['set_nome_collettivi']; ?> in maniera veloce e diretta! I dati che inserirete sono quelli che verranno inseriti nel sito in una fase successiva.</p>
            </div>
            <h5 class="col s12 center"><b><?php echo ucfirst($set['set_nome_collettivo']); ?>!</b></h5>
            <p class="col s12"> <b>Titolo del <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
          <div class="input-field col s12">
            <input placeholder="Titolo" type="text" class="input is-rounded browser-default" name="titolo_collettivo" required="required">
          </div>
          <p class="col s12"> <b>Nome di chi propone il <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
          <div class="input-field col s12">
            <input placeholder="Nome" type="text" class="input is-rounded browser-default" name="nome_proponente" required="required">
          </div>
          <p class="col s12"> <b>Cognome di chi propone il <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
          <div class="input-field col s12">
            <input placeholder="Cognome" type="text" class="input is-rounded browser-default" name="cognome_proponente" required="required">
          </div>
          <p class="col s12"> <b>Descrizione esaustiva del <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
          <div class="input-field col s12">
            <textarea placeolder="Descrizione" class="textarea browser-default" name="descrizione_collettivo" required="required"></textarea>
          </div>
          <p class="col s12"> <b>Immagine <?php echo $set['set_nome_collettivo'] ?> (jpg di forma quadrata, max 5mb):</b> </p>
          <div class="file-field input-field col s12">
            <div style="border-radius: 15px;" class="btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">
              <span>Immagine</span>
              <input type="file" id="file" name="immagine_collettivo" accept="image/jpg,image/jpeg,image/JPEG,image/JPG" required="required">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
          <p class="col s12"> <b>Email di chi propone il <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
          <div class="input-field col s12">
              <input placeholder="Email" type="email" class="input is-rounded browser-default" name="email_proponente" required="required">
          </div>
          <p class="col s12"> <b>Numero di chi propone il <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
          <div class="input-field col s12">
            <input placeholder="Numero di telefono" type="tel" class="input is-rounded browser-default" name="telefono_proponente" required="required">
          </div>
          <p class="col s12"><b>Ruolo all'interno della scuola: </b></p>
          <div class="input-field col s12">
              <select style="border-radius: 25px;" name="ruolo_proponente" class="browser-default">
                <option value="" disabled selected>Seleziona</option>
                <option value="studente">Studente</option>
                <option value="genitore">Genitore</option>
                <option value="professore">Professore</option>
                <option value="ex-studente">Ex-Studente</option>
              </select>
            </div>
            <h5 class="col s12 center"><b>Studente referente!</b></h5>
            <div style="border-radius:15px" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">
              <p class="col s12 center">E' necessario indicare il nominativo di uno studente referente del <?php echo $set['set_nome_collettivo'] ?>. Lo studente sarà considerato responsabile in tutto e per tutto della gestione del <?php echo $set['set_nome_collettivo'] ?> e dovrà essere presente. ATTENZIONE: per i docenti, i genitori o gli ex-studenti che non trovassero uno studente referente, registrare semplicemente il referente -> nome: "X", cognome "X", classe "1A". Gli organizzatori si occuperanno di trovare lo studente referente.</p>
            </div>
            <p class="col s12"> <b>Nome dello studente referente:</b> </p>
            <div class="input-field col s12">
              <input placeholder="Nome" type="text" class="input is-rounded browser-default" name="nome_referente" required="required">
            </div>
            <p class="col s12"> <b>Cognome dello studente referente:</b> </p>
            <div class="input-field col s12">
              <input placeholder="Cognome" type="text" class="input is-rounded browser-default" name="cognome_referente" required="required">
            </div>
            <p class="col s12"> <b>Anno scolastico dello studente referente:</b> </p>
            <div class="col s12 input-field form-group">
                <select style="border-radius: 25px;" class="browser-default form-control" name="anno_referente">
                  <option value="" disabled selected>Seleziona l'anno scolastico</option>
                  <option value="1">1 - Prima</option>
                  <option value="2">2 - Seconda</option>
                  <option value="3">3 - Terza</option>
                  <option value="4">4 - Quarta</option>
                  <option value="5">5 - Quinta</option>
                </select>
              </div>
              <p class="col s12"> <b>Sezione dello studente referente:</b> </p>
              <div class="col s12 input-field form-group">
                  <select style="border-radius: 25px;" class="browser-default form-control" name="sezione_referente">
                    <option value="" disabled selected>Seleziona la sezione</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="G">G</option>
                    <option value="H">H</option>
                    <option value="I">I</option>
                    <option value="L">L</option>
                    <option value="M">M</option>
                    <option value="N">N</option>
                  </select>
                </div>
                <p class="col s12"> <b>Altri studenti referenti:</b> </p>
                <div style="border-radius:15px" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">
                  <p style="margin-bottom:5px;" class="col s12 center">Se presenti, aggiungi altri studenti referenti secondo il seguente formato:</p>
                  <p style="margin-bottom:5px;margin-top:0px;" class="col s12 center">Mario Rossi 1A; Jhon Doe 3H;</p>
                  <p style="margin-bottom:20px;margin-top:0px;" class="col s12 center">(Se non presenti altri referenti lasciare vuoto)</p>
                </div>
                <div class="input-field col s12">
                  <input placeholder="Referenti" type="text" class="input is-rounded browser-default" name="altri_referenti">
                </div>
                <h5 class="col s12 center"><b>Turni del <?php echo $set['set_nome_collettivo'] ?>!</b></h5>
                <div style="border-radius:15px" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">
                  <p class="col s12 center">Segnate in questa sezione il/i turno/i in cui volete proporre il vostro <?php echo $set['set_nome_collettivo'] ?>, considerando che è possibile selezionare anche più di una risposta. ATTENZIONE: segnate solo i turni un cui avete intenzione di svolgere il <?php echo $set['set_nome_collettivo'] ?>, non i turni di vostra disponibilità.</p>
                </div>
                <p class="col s12"> <b>Turni in cui si svolgerà il <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
                <p class="col s12"> <b><?php echo $set['set_giorno1_cogestione']; ?>:</b> </p>
                <?php for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) { ?>
                <p class="col s12">
                  <label>
                    <input type="checkbox" name="t<?php echo $i ?>"/>
                    <span class="black-text">Turno <?php echo $i ?></span>
                  </label>
                </p>
                <?php } ?>
                <div style="border-radius:15px" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">
                  <p class="col s12 center">Seleziona la casella successiva se, nel caso di necessità organizzative, saresti disponibile a cambiare turno del tuo <?php echo $set['set_nome_collettivo'] ?>. Nel caso verrai contattato per tempo. La tua risposta non è vincolante ma puramente informativa.</p>
                </div>
                <p class="col s12">
                  <label>
                    <input type="checkbox" name="disponibile_cambio_turno"/>
                    <span class="black-text">Disponibilità a cambiare turno</span>
                  </label>
                </p>

          <p class="col s12"> <b>Il tuo <?php echo $set['set_nome_collettivo'] ?> avrà un ospite esterno presente?</b> </p>
            <div class="col s12">
              <p class="col s3">
                <label>
                  <input name="group1" type="radio" id="yes" name="yesOrNo" value="yes" onchange="displayQuestion(this.value)" />
                  <span class="black-text">SI</span>
                </label>
              </p>
              <p class="col s3">
                <label>
                  <input name="group1" type="radio" id="no" name="yesOrNo" value="no" onchange="displayQuestion(this.value)" />
                  <span class="black-text">NO</span>
                </label>
              </p>
            </div>

            <div id="yesQuestion" style="display:none;"><br/>
                <h5 class="col s12 center"><b>Esterno!</b></h5>
                <div style="border-radius:15px" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">
                  <p class="col s12 center">Se il vostro <?php echo $set['set_nome_collettivo']; ?> prevede la presenza di un esterno, segnalate qui di seguito i suoi dati ed allegate obbligatoriamente il suo curriculum. Nel caso in cui l'esterno non avesse un curriculum allegate un file word con nome, cognome, mail, indirizzo di residenza e occupazione attuale. Il numero di cellulare è necessario in caso di emergenze durante i giorni di <?php echo $set['set_nome_cogestione']; ?>. <span class="red-text">Attenzione! Aggiungete alla fine del curriculum la seguente dicitura:</span> "Autorizzo al trattamento dei dati personali sopra elencati"</p>
                </div>
                <p class="col s12"> <b>Nome dell'esterno</b> </p>
                <div class="input-field col s12">
                  <input placeholder="Nome" id="yesQuestionRequired1" type="text" class="input is-rounded browser-default" name="nome_esterno">
                </div>
                <p class="col s12"> <b>Cognome dell'esterno</b> </p>
                <div class="input-field col s12">
                  <input placeholder="Cognome" id="yesQuestionRequired2" type="text" class="input is-rounded browser-default" name="cognome_esterno">
                </div>
                <p class="col s12"> <b>Numero di telefono dell'esterno</b> </p>
                <div class="input-field col s12">
                  <input placeholder="Numero di telefono" id="yesQuestionRequired3" type="text" class="input is-rounded browser-default" name="telefono_esterno">
                </div>
                <p class="col s12"> <b>Professione dell'esterno</b> </p>
                <div class="input-field col s12">
                  <input placeholder="Professione" id="yesQuestionRequired4" type="text" class="input is-rounded browser-default" name="professione_esterno">
                </div>
                <p class="col s12"> <b>Altri ospiti esterni:</b> </p>
                <p class="col s12">Vuoi portare al tuo <?php echo $set['set_nome_collettivo'] ?> altri ospiti esterni? Nessun problema: indica quanti!</p>
                <div class="col s12 input-field form-group">
                    <select style="border-radius: 25px;" class="browser-default form-control" name="altri_esterni" id="altri_esterni" onchange="displayQuestion2(this.value)">
                      <option value="" disabled selected>Indica n. di altri ospiti</option>
                      <option id="0esterno" value="0">Nessun altro ospite</option>
                      <option id="1esterno" value="1">1 altro ospite</option>
                      <?php
                      for ($i=2; $i<=10; $i++)
                      {
                        ?>
                      <option id="<?php echo $i;?>" value="<?php echo $i;?>">Altri <?php echo $i;?> ospiti</option>
                      <?php
                      }
                        ?>
                    </select>
                  </div>
                  <?php
                  for ($i=2; $i<=11; $i++)
                  {
                    ?>
                  <div id="esterno<?php echo $i; ?>" class="col s12" style="display:none;">
                  <p class="col s12"> <b>Esterno n.<?php echo $i; ?></b> </p>
                  <div class="input-field col s12">
                    <input placeholder="Nome Cognome" id="esterno<?php echo $i; ?>Required" type="text" class="input is-rounded browser-default" name="esterno<?php echo $i; ?>">
                  </div>
                </div>
                  <?php
                  }
                    ?>
                <?php if ($set['set_curriculum_necessario'] == 1) { ?>
                <p class="col s12"><b>Curriculum vitae dell'esterno/degli esterni.</b></p>
                <p class="col s12">Carica un unico file con molteplici curricula se presenti più esterni.</p>
                <div class="file-field input-field col s12">
                  <div style="border-radius: 15px;" class="btn <?php echo $set['set_colore_bottoni']; ?>">
                    <span>Curriculum</span>
                    <input id="yesQuestionRequired5" type="file" accept="image/jpg,image/jpeg,image/JPEG,image/JPG,image/png,.gif,.pdf,.doc,.docx,.DOC,.DOCX" name="cv_esterno">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
                </div>
              <?php } ?>
              </div>

              <div id="part2" style="display:none;">
                <h5 class="col s12 center"><b>Necessità, spazi e strumenti!</b></h5>
                <div style="border-radius:15px" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">
                  <p class="col s12 center">In questa sezione potrete segnalare eventuali strumenti necessari allo svolgimento del <?php echo $set['set_nome_collettivo'] ?>, oppure l'assegnazione di aule particolari.</p>
                </div>
                <p class="col s12"> <b>Spazio necessario alla buona riuscita del <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
                <div class="col s12 input-field form-group">
                    <select style="border-radius: 25px;" class="browser-default form-control" name="spazio">
                      <option value="" disabled selected>Seleziona lo spazio necessario</option>
                      <?php for ($i=1; $i <=10; $i++) {
                        if ($set['set_active_spazio_'.$i] == 1) { ?>
                          <option value="<?php echo $i; ?>"><?php echo ucfirst($set['set_nome_spazio_'.$i]); ?></option>
                        <?php }
                       } ?>
                    </select>
                  </div>
                  <p class="col s12"> <b>Strumenti necessari alla buona riuscita del <?php echo $set['set_nome_collettivo'] ?>:</b> (La connessione si può avere solo tramite il computer della scuola)</p>
                  <?php $strumenti_necessari = explode(",", $set['set_strumenti_cogestione']); ?>
                  <div class="input-field col s12">
                    <select name="strumenti[]" multiple id="strumenti" required>
                      <option value="" disabled>Seleziona gli strumenti necessari:</option>
                      <?php foreach ($strumenti_necessari as $item) { ?>
                        <option value="<?php echo $item ?>"><?php echo ucwords($item) ?></option>
                      <?php } ?>
                      <option value="">Nessuno strumento necessario</option>
                    </select>
                  </div>
                  <p class="col s12"> <b>Indica qui sotto se hai necessità particolari (lascia vuoto se non ne hai):</b> </p>
                  <div class="input-field col s12">
                    <input placeholder="Necessità particolari" type="text" class="input is-rounded browser-default" name="necessita_particolari">
                  </div>
                  <h5 class="col s12 center"><b>Consenso al trattamento dei dati personali!</b></h5>
                  <p class="col s12">Si autorizza al trattamento dei dati necessari al l’espletamento delle azioni previste nel progetto ai sensi del GDPR (Regolamento UE 2016/679). Titolare del trattamento dei dati è <?php echo $set['set_nome_responsabile_privacy']; ?>.</p>
                  <p class="col s12">
                    <label>
                      <input type="checkbox" name="trattamento_dati" required="required"/>
                      <span class="black-text">Acconsento</span>
                    </label>
                  </p>
                </div>


        <div id="yesQuestionSend" style="display:none;" >
          <div class="col s12 center">
            <button style="border-radius: 20px;" class="btn waves-effect waves-light btn-large center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" type="submit" name="submit" value="Upload">Invia
              <i class="material-icons right">send</i>
            </button>
          </div>
        </div>

        <div id="noQuestionSend" style="display:none;" >
          <div class="col s12 center">
            <button style="border-radius: 20px;" class="btn waves-effect waves-light btn-large center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" type="submit" name="submit2" value="Upload">Invia
              <i class="material-icons right">send</i>
            </button>
          </div>
        </div>

      </form>
    </div>
  </div>

<div id="loading_spinner" class="center" style="display:none;z-index:5; position: fixed;top: 0;left: 0;min-width: 100%;min-height: 100%; background-color: #f1f1f1;">
  <img class="responsive-img" style="margin-top:25%;position:static;height:100px; width: auto;" src="/images/base/load.gif">
  <p style="margin-bottom:30%;">LOADING...</p>
</div>

  <script>

  var uploadField = document.getElementById("file");

  uploadField.onchange = function() {
      if(this.files[0].size > 5242880){
         alert("L'immagine è troppo grossa: max 5mb!");
         this.value = "";
      };
  };

  $("textarea").keydown(function(event) {
    if (event.keyCode == 13) {
      event.preventDefault();
    }
  });

  function loadingGIF(){
   $('#loading_spinner').show();
  }

  $(document).ready(function() {
    $('input#input_text, textarea#textarea2').characterCounter();
  });

  $(document).ready(function(){
    $('select').formSelect();
  });

  function displayQuestion(answer) {

    if (answer == "yes") {

      document.getElementById('yesQuestion').style.display = "block";
      document.getElementById('noQuestionSend').style.display = "none";
      document.getElementById('yesQuestionSend').style.display = "block";
      document.getElementById('yesQuestionRequired1').setAttribute('required', 'required');
      document.getElementById('yesQuestionRequired2').setAttribute('required', 'required');
      document.getElementById('yesQuestionRequired3').setAttribute('required', 'required');
      document.getElementById('yesQuestionRequired4').setAttribute('required', 'required');
      <?php if ($set['set_curriculum_necessario'] == 1) { ?>
      document.getElementById('yesQuestionRequired5').setAttribute('required', 'required');
      <?php } ?>
      document.getElementById('part2').style.display = "block";

    } else if (answer == "no") {

      document.getElementById('yesQuestion').style.display = "none";
      document.getElementById('yesQuestionSend').style.display = "none";
      document.getElementById('noQuestionSend').style.display = "block";
      document.getElementById('yesQuestionRequired1').removeAttribute("required");
      document.getElementById('yesQuestionRequired2').removeAttribute("required");
      document.getElementById('yesQuestionRequired3').removeAttribute("required");
      document.getElementById('yesQuestionRequired4').removeAttribute("required");
      <?php if ($set['set_curriculum_necessario'] == 1) { ?>
      document.getElementById('yesQuestionRequired5').removeAttribute("required");
      <?php } ?>
      document.getElementById('part2').style.display = "block";

    }

  }

  function displayQuestion2(answer) {

    if (answer == "0") {

      document.getElementById('esterno2').style.display = "none";
      document.getElementById('esterno3').style.display = "none";
      document.getElementById('esterno4').style.display = "none";
      document.getElementById('esterno5').style.display = "none";
      document.getElementById('esterno6').style.display = "none";
      document.getElementById('esterno7').style.display = "none";
      document.getElementById('esterno8').style.display = "none";
      document.getElementById('esterno9').style.display = "none";
      document.getElementById('esterno10').style.display = "none";
      document.getElementById('esterno11').style.display = "none";

      document.getElementById('esterno2Required').removeAttribute("required");
      document.getElementById('esterno3Required').removeAttribute("required");
      document.getElementById('esterno4Required').removeAttribute("required");
      document.getElementById('esterno5Required').removeAttribute("required");
      document.getElementById('esterno6Required').removeAttribute("required");
      document.getElementById('esterno7Required').removeAttribute("required");
      document.getElementById('esterno8Required').removeAttribute("required");
      document.getElementById('esterno9Required').removeAttribute("required");
      document.getElementById('esterno10Required').removeAttribute("required");
      document.getElementById('esterno11Required').removeAttribute("required");

    } else if (answer == "1") {

      document.getElementById('esterno2').style.display = "block";
      document.getElementById('esterno3').style.display = "none";
      document.getElementById('esterno4').style.display = "none";
      document.getElementById('esterno5').style.display = "none";
      document.getElementById('esterno6').style.display = "none";
      document.getElementById('esterno7').style.display = "none";
      document.getElementById('esterno8').style.display = "none";
      document.getElementById('esterno9').style.display = "none";
      document.getElementById('esterno10').style.display = "none";
      document.getElementById('esterno11').style.display = "none";

      document.getElementById('esterno2Required').setAttribute('required', 'required');
      document.getElementById('esterno3Required').removeAttribute("required");
      document.getElementById('esterno4Required').removeAttribute("required");
      document.getElementById('esterno5Required').removeAttribute("required");
      document.getElementById('esterno6Required').removeAttribute("required");
      document.getElementById('esterno7Required').removeAttribute("required");
      document.getElementById('esterno8Required').removeAttribute("required");
      document.getElementById('esterno9Required').removeAttribute("required");
      document.getElementById('esterno10Required').removeAttribute("required");
      document.getElementById('esterno11Required').removeAttribute("required");

    } else if (answer == "2") {

      document.getElementById('esterno2').style.display = "block";
      document.getElementById('esterno3').style.display = "block";
      document.getElementById('esterno4').style.display = "none";
      document.getElementById('esterno5').style.display = "none";
      document.getElementById('esterno6').style.display = "none";
      document.getElementById('esterno7').style.display = "none";
      document.getElementById('esterno8').style.display = "none";
      document.getElementById('esterno9').style.display = "none";
      document.getElementById('esterno10').style.display = "none";
      document.getElementById('esterno11').style.display = "none";

      document.getElementById('esterno2Required').setAttribute('required', 'required');
      document.getElementById('esterno3Required').setAttribute('required', 'required');
      document.getElementById('esterno4Required').removeAttribute("required");
      document.getElementById('esterno5Required').removeAttribute("required");
      document.getElementById('esterno6Required').removeAttribute("required");
      document.getElementById('esterno7Required').removeAttribute("required");
      document.getElementById('esterno8Required').removeAttribute("required");
      document.getElementById('esterno9Required').removeAttribute("required");
      document.getElementById('esterno10Required').removeAttribute("required");
      document.getElementById('esterno11Required').removeAttribute("required");

    } else if (answer == "3") {

      document.getElementById('esterno2').style.display = "block";
      document.getElementById('esterno3').style.display = "block";
      document.getElementById('esterno4').style.display = "block";
      document.getElementById('esterno5').style.display = "none";
      document.getElementById('esterno6').style.display = "none";
      document.getElementById('esterno7').style.display = "none";
      document.getElementById('esterno8').style.display = "none";
      document.getElementById('esterno9').style.display = "none";
      document.getElementById('esterno10').style.display = "none";
      document.getElementById('esterno11').style.display = "none";

      document.getElementById('esterno2Required').setAttribute('required', 'required');
      document.getElementById('esterno3Required').setAttribute('required', 'required');
      document.getElementById('esterno4Required').setAttribute('required', 'required');
      document.getElementById('esterno5Required').removeAttribute("required");
      document.getElementById('esterno6Required').removeAttribute("required");
      document.getElementById('esterno7Required').removeAttribute("required");
      document.getElementById('esterno8Required').removeAttribute("required");
      document.getElementById('esterno9Required').removeAttribute("required");
      document.getElementById('esterno10Required').removeAttribute("required");
      document.getElementById('esterno11Required').removeAttribute("required");

    } else if (answer == "4") {

      document.getElementById('esterno2').style.display = "block";
      document.getElementById('esterno3').style.display = "block";
      document.getElementById('esterno4').style.display = "block";
      document.getElementById('esterno5').style.display = "block";
      document.getElementById('esterno6').style.display = "none";
      document.getElementById('esterno7').style.display = "none";
      document.getElementById('esterno8').style.display = "none";
      document.getElementById('esterno9').style.display = "none";
      document.getElementById('esterno10').style.display = "none";
      document.getElementById('esterno11').style.display = "none";

      document.getElementById('esterno2Required').setAttribute('required', 'required');
      document.getElementById('esterno3Required').setAttribute('required', 'required');
      document.getElementById('esterno4Required').setAttribute('required', 'required');
      document.getElementById('esterno5Required').setAttribute('required', 'required');
      document.getElementById('esterno6Required').removeAttribute("required");
      document.getElementById('esterno7Required').removeAttribute("required");
      document.getElementById('esterno8Required').removeAttribute("required");
      document.getElementById('esterno9Required').removeAttribute("required");
      document.getElementById('esterno10Required').removeAttribute("required");
      document.getElementById('esterno11Required').removeAttribute("required");

    } else if (answer == "5") {

      document.getElementById('esterno2').style.display = "block";
      document.getElementById('esterno3').style.display = "block";
      document.getElementById('esterno4').style.display = "block";
      document.getElementById('esterno5').style.display = "block";
      document.getElementById('esterno6').style.display = "block";
      document.getElementById('esterno7').style.display = "none";
      document.getElementById('esterno8').style.display = "none";
      document.getElementById('esterno9').style.display = "none";
      document.getElementById('esterno10').style.display = "none";
      document.getElementById('esterno11').style.display = "none";

      document.getElementById('esterno2Required').setAttribute('required', 'required');
      document.getElementById('esterno3Required').setAttribute('required', 'required');
      document.getElementById('esterno4Required').setAttribute('required', 'required');
      document.getElementById('esterno5Required').setAttribute('required', 'required');
      document.getElementById('esterno6Required').setAttribute('required', 'required');
      document.getElementById('esterno7Required').removeAttribute("required");
      document.getElementById('esterno8Required').removeAttribute("required");
      document.getElementById('esterno9Required').removeAttribute("required");
      document.getElementById('esterno10Required').removeAttribute("required");
      document.getElementById('esterno11Required').removeAttribute("required");

    } else if (answer == "6") {

      document.getElementById('esterno2').style.display = "block";
      document.getElementById('esterno3').style.display = "block";
      document.getElementById('esterno4').style.display = "block";
      document.getElementById('esterno5').style.display = "block";
      document.getElementById('esterno6').style.display = "block";
      document.getElementById('esterno7').style.display = "block";
      document.getElementById('esterno8').style.display = "none";
      document.getElementById('esterno9').style.display = "none";
      document.getElementById('esterno10').style.display = "none";
      document.getElementById('esterno11').style.display = "none";

      document.getElementById('esterno2Required').setAttribute('required', 'required');
      document.getElementById('esterno3Required').setAttribute('required', 'required');
      document.getElementById('esterno4Required').setAttribute('required', 'required');
      document.getElementById('esterno5Required').setAttribute('required', 'required');
      document.getElementById('esterno6Required').setAttribute('required', 'required');
      document.getElementById('esterno7Required').setAttribute('required', 'required');
      document.getElementById('esterno8Required').removeAttribute("required");
      document.getElementById('esterno9Required').removeAttribute("required");
      document.getElementById('esterno10Required').removeAttribute("required");
      document.getElementById('esterno11Required').removeAttribute("required");

    } else if (answer == "7") {

      document.getElementById('esterno2').style.display = "block";
      document.getElementById('esterno3').style.display = "block";
      document.getElementById('esterno4').style.display = "block";
      document.getElementById('esterno5').style.display = "block";
      document.getElementById('esterno6').style.display = "block";
      document.getElementById('esterno7').style.display = "block";
      document.getElementById('esterno8').style.display = "block";
      document.getElementById('esterno9').style.display = "none";
      document.getElementById('esterno10').style.display = "none";
      document.getElementById('esterno11').style.display = "none";

      document.getElementById('esterno2Required').setAttribute('required', 'required');
      document.getElementById('esterno3Required').setAttribute('required', 'required');
      document.getElementById('esterno4Required').setAttribute('required', 'required');
      document.getElementById('esterno5Required').setAttribute('required', 'required');
      document.getElementById('esterno6Required').setAttribute('required', 'required');
      document.getElementById('esterno7Required').setAttribute('required', 'required');
      document.getElementById('esterno8Required').setAttribute('required', 'required');
      document.getElementById('esterno9Required').removeAttribute("required");
      document.getElementById('esterno10Required').removeAttribute("required");
      document.getElementById('esterno11Required').removeAttribute("required");

    } else if (answer == "8") {

      document.getElementById('esterno2').style.display = "block";
      document.getElementById('esterno3').style.display = "block";
      document.getElementById('esterno4').style.display = "block";
      document.getElementById('esterno5').style.display = "block";
      document.getElementById('esterno6').style.display = "block";
      document.getElementById('esterno7').style.display = "block";
      document.getElementById('esterno8').style.display = "block";
      document.getElementById('esterno9').style.display = "block";
      document.getElementById('esterno10').style.display = "none";
      document.getElementById('esterno11').style.display = "none";

      document.getElementById('esterno2Required').setAttribute('required', 'required');
      document.getElementById('esterno3Required').setAttribute('required', 'required');
      document.getElementById('esterno4Required').setAttribute('required', 'required');
      document.getElementById('esterno5Required').setAttribute('required', 'required');
      document.getElementById('esterno6Required').setAttribute('required', 'required');
      document.getElementById('esterno7Required').setAttribute('required', 'required');
      document.getElementById('esterno8Required').setAttribute('required', 'required');
      document.getElementById('esterno9Required').setAttribute('required', 'required');
      document.getElementById('esterno10Required').removeAttribute("required");
      document.getElementById('esterno11Required').removeAttribute("required");

    } else if (answer == "9") {

      document.getElementById('esterno2').style.display = "block";
      document.getElementById('esterno3').style.display = "block";
      document.getElementById('esterno4').style.display = "block";
      document.getElementById('esterno5').style.display = "block";
      document.getElementById('esterno6').style.display = "block";
      document.getElementById('esterno7').style.display = "block";
      document.getElementById('esterno8').style.display = "block";
      document.getElementById('esterno9').style.display = "block";
      document.getElementById('esterno10').style.display = "block";
      document.getElementById('esterno11').style.display = "none";

      document.getElementById('esterno2Required').setAttribute('required', 'required');
      document.getElementById('esterno3Required').setAttribute('required', 'required');
      document.getElementById('esterno4Required').setAttribute('required', 'required');
      document.getElementById('esterno5Required').setAttribute('required', 'required');
      document.getElementById('esterno6Required').setAttribute('required', 'required');
      document.getElementById('esterno7Required').setAttribute('required', 'required');
      document.getElementById('esterno8Required').setAttribute('required', 'required');
      document.getElementById('esterno9Required').setAttribute('required', 'required');
      document.getElementById('esterno10Required').setAttribute('required', 'required');
      document.getElementById('esterno11Required').removeAttribute("required");

    } else if (answer == "10") {

      document.getElementById('esterno2').style.display = "block";
      document.getElementById('esterno3').style.display = "block";
      document.getElementById('esterno4').style.display = "block";
      document.getElementById('esterno5').style.display = "block";
      document.getElementById('esterno6').style.display = "block";
      document.getElementById('esterno7').style.display = "block";
      document.getElementById('esterno8').style.display = "block";
      document.getElementById('esterno9').style.display = "block";
      document.getElementById('esterno10').style.display = "block";
      document.getElementById('esterno11').style.display = "block";

      document.getElementById('esterno2Required').setAttribute('required', 'required');
      document.getElementById('esterno3Required').setAttribute('required', 'required');
      document.getElementById('esterno4Required').setAttribute('required', 'required');
      document.getElementById('esterno5Required').setAttribute('required', 'required');
      document.getElementById('esterno6Required').setAttribute('required', 'required');
      document.getElementById('esterno7Required').setAttribute('required', 'required');
      document.getElementById('esterno8Required').setAttribute('required', 'required');
      document.getElementById('esterno9Required').setAttribute('required', 'required');
      document.getElementById('esterno10Required').setAttribute('required', 'required');
      document.getElementById('esterno11Required').setAttribute('required', 'required');

    }

  }
  </script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/main/basicpage/footer_general.php' ?>

  </body>

</html>
