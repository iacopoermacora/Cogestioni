<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

$id = mysqli_real_escape_string($link, $_GET['id']);
$sql = "SELECT * FROM collettivi WHERE id = '".$id."' AND id > 0 LIMIT 1";
$request = mysqli_query($link, $sql);
if (!$row = mysqli_fetch_assoc($request)) {
  header('location: /403.shtml');
  }


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


    if(isset($_POST["submit"])){

      // Escape user inputs for security
      $titolo_collettivo = mysqli_real_escape_string($link, ucwords($_REQUEST['titolo_collettivo']));
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
      if ($set['set_status_cogestione'] == 'cogestione_open' || $set['set_status_cogestione'] == 'cogestione_momentaneamente_chiusa' || $set['set_status_cogestione'] == 'cogestione_chiusa') {
      $spazio = $row['spazio'];
      } else {
      $spazio = mysqli_real_escape_string($link, $_REQUEST['spazio']);
      }
      $t_first = array();
      $t = array();
      $turno = array();
      for ($j=0; $j <= $set['set_turni_totali']; $j++) {
        if (($row['t'.$j] != $row['total_t'.$j]) || ($row['prof_t'.$j] != $row['total_prof_t'.$j])) {
          $invalidchangespace = 1;
          $spazio = $row['spazio'];
        }
      }
      for ($i=0; $i <= $set['set_turni_totali'] ; $i++) {

      $t_first[$i] = mysqli_real_escape_string($link, $_REQUEST['t'.$i]);

      if ($t_first[$i] == 'on') {
        $turno[$i] = $i.',';
        if ($invalidchangespace == 1) {
          $t[$i] = '';
        } else {
          if ($row['t'.$i] == -100 || $spazio != $row['spazio']) {
            $t[$i] = " t".$i." = '".$set['set_posti_spazio_'.$spazio]."', total_t".$i." = '".$set['set_posti_spazio_'.$spazio]."', prof_t".$i." = '".$set['set_posti_spazio_'.$spazio.'_prof']."', total_prof_t".$i." = '".$set['set_posti_spazio_'.$spazio.'_prof']."', ";
          }
        }
      } else {

        $sql = "UPDATE users_cogestione SET t".$i." = 0 WHERE t".$i." = '".$id."'";
        if (mysqli_query($link, $sql)) {
            $t[$i] = " t".$i." = -100, total_t".$i." = -100, prof_t".$i." = -100, total_prof_t".$i." = -100, ";
            $turno[$i] = '';
      }
      }

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
      $altri_esterni = mysqli_real_escape_string($link, ucwords($_REQUEST['altri_esterni']));
      $necessita_particolari = mysqli_real_escape_string($link, $_REQUEST['necessita_particolari']);
      $link_videochiamata = mysqli_real_escape_string($link, $_REQUEST['link_videochiamata']);
      if ($link_videochiamata=='') {
        $link_videochiamata = '0';
      }
      if (strpos($link_videochiamata, 'http://') === 0) {
        $link_videochiamata = substr($link_videochiamata, 7);
      } else if (strpos($link_videochiamata, 'https://') === 0){
        $link_videochiamata = substr($link_videochiamata, 8);
      }
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

        $strumenti = implode(", ", $_REQUEST['strumenti']);


              $sql = "UPDATE collettivi SET titolo_collettivo = '".$titolo_collettivo."', nome_proponente = '".$nome_proponente."', cognome_proponente = '".$cognome_proponente."', descrizione_collettivo = '".$descrizione_collettivo."', email_proponente = '".$email_proponente."', telefono_proponente = '".$telefono_proponente."', ruolo_proponente = '".$ruolo_proponente."', nome_referente = '".$nome_referente."', cognome_referente = '".$cognome_referente."', anno_referente = '".$anno_referente."', sezione_referente = '".$sezione_referente."', altri_referenti = '".$altri_referenti."',".$t[1]."".$t[2]."".$t[3]."".$t[4]."".$t[5]."".$t[6]."".$t[7]."".$t[8]."".$t[9]."".$t[10]."".$t[11]."".$t[12]."".$t[13]."".$t[14]."".$t[15]."".$t[16]."".$t[17]."".$t[18]."turni = '".$turni."', disponibile_cambio_turno = '".$disponibile_cambio_turno."', nome_esterno = '".$nome_esterno."', cognome_esterno = '".$cognome_esterno."', telefono_esterno = '".$telefono_esterno."', professione_esterno = '".$professione_esterno."', altri_esterni = '".$altri_esterni."', spazio = '".$spazio."', strumenti = '".$strumenti."', necessita_particolari = '".$necessita_particolari."', link_videochiamata = '".$link_videochiamata."' WHERE id=$id LIMIT 1";

              if(mysqli_query($link, $sql)){
                header('location: /admin/system/modificato?v=collettivo');
              } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
              }
    }else{
    }

    function clean($string) {
       $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
       $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

       return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

    $sql = "SELECT * FROM collettivi WHERE id = '".$id."' LIMIT 1";
    $userz = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($userz);

    $myFile1 = "/images/".$row['immagine_collettivo'];
    $myFile2 = "/curriculum/".$row['cv_esterno'];

    // File upload path
    $targetDir = "/images/";
    $temp = explode(".", $_FILES["immagine_collettivo"]["name"]);
    $titolo_immagine_collettivo = clean($row['titolo_collettivo']);
    $fileName = $titolo_immagine_collettivo.'_'.date('d-m-Y_h-i-s').'.'.end($temp);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    // File upload path
    $targetDir2 = "/curriculum/";
    $temp2 = explode(".", $_FILES["cv_esterno"]["name"]);
    $titolo_cv_collettivo = clean($row['titolo_collettivo']);
    $fileName2 = "CVesterno_collettivo_".$titolo_cv_collettivo.'_'.date('d-m-Y_h-i-s').".".end($temp2);
    $targetFilePath2 = $targetDir2 . $fileName2;
    $fileType2 = pathinfo($targetFilePath2,PATHINFO_EXTENSION);




              if(isset($_POST["submit2"]) && !empty($_FILES["immagine_collettivo"]["name"])){

                  // Allow certain file formats
                  $allowTypes = array('jpg','jpeg', 'JPG', 'JPEG');
                  if(in_array($fileType, $allowTypes)){
                      unlink($_SERVER['DOCUMENT_ROOT'].$myFile1) or die("Couldn't delete file");
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

                      if(move_uploaded_file($_FILES["immagine_collettivo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].$targetFilePath)){

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


                                    $sql = "UPDATE collettivi SET immagine_collettivo = 'Collettivo_".$fileName."' WHERE id= '".$id."' LIMIT 1";

                                    if(mysqli_query($link, $sql)){
                                      header('location: /admin/system/modificato?v=collettivo');
                                    } else{
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                    }


                                  }else{
                                    echo "<script>$(document).ready(function() { M.toast({html: 'Si è verificato un errore nel caricamento del file, riprova più tardi (p.s. prova ad abbassare la definizione della immagine)'}) });</script>";
                                    }
                                }else{
                                  echo "<script>$(document).ready(function() { M.toast({html: 'Puoi caricare solo file JPG, JPEG, PNG, GIF, & PDF.'}) });</script>";
                                }
                              }else{
                              }}

                            if(isset($_POST["submit3"]) && !empty($_FILES["cv_esterno"]["name"])){
                                // Allow certain file formats
                                $allowTypes2 = array('jpg','png','jpeg','gif','pdf','JPG','JPEG','doc','docx','DOC','DOCX');
                                if(in_array($fileType2, $allowTypes2)){
                                  if($myFile2 != "/curriculum/"){
                                    unlink($_SERVER['DOCUMENT_ROOT'].$myFile2) or die("Couldn't delete file");
                                  }
                                    // Upload file to server
                                    if(move_uploaded_file($_FILES["cv_esterno"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $targetFilePath2)){


                                      $sql = "UPDATE collettivi SET cv_esterno = '".$fileName2."' WHERE id= '".$id."' LIMIT 1";

                                      if(mysqli_query($link, $sql)){
                                        header('location: /admin/system/modificato?v=collettivo');
                                      } else{
                                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                      }


                                    }else{
                                      echo "<script>$(document).ready(function() { M.toast({html: 'Si è verificato un errore nel caricamento del file, riprova più tardi (p.s. prova ad abbassare la definizione della immagine)'}) });</script>";
                                      }
                                    }else{
                                    echo "<script>$(document).ready(function() { M.toast({html: 'Puoi caricare solo file JPG, JPEG, PNG, GIF, & PDF.'}) });</script>";
                                    }
                                    }else{
                                    }



                                    $sql = "SELECT * FROM collettivi WHERE id = '".$id."' LIMIT 1";
                                    $userz = mysqli_query($link, $sql);
                                    $row = mysqli_fetch_assoc($userz);

                                    $operatore = mysqli_real_escape_string($link, $_REQUEST['operatore']);
                                    $posti = mysqli_real_escape_string($link, $_REQUEST['posti']);
                                    $turno = mysqli_real_escape_string($link, $_REQUEST['turno']);
                                    $usertype = mysqli_real_escape_string($link, $_REQUEST['usertype']);
                                    $postifinali = array();
                                    $total_postifinali = array();

                                    if(isset($_POST["submit5"])){

                                      if ($usertype == 'studente') {
                                        $usertype = "";
                                      } elseif ($usertype == 'docente') {
                                        $usertype = "prof_";
                                      }

                                      if ($turno != 'all' && $operatore == '+') {
                                        $postifinali[0] = $row[$usertype.'t'.$turno] + $posti;
                                        $total_postifinali[0] = $row['total_'.$usertype.'t'.$turno] + $posti;
                                      } elseif ($turno != 'all' && $operatore == '-') {
                                        $postifinali[0] = $row[$usertype.'t'.$turno] - $posti;
                                        $total_postifinali[0] = $row['total_'.$usertype.'t'.$turno] - $posti;
                                      }

                                      if ($turno == 'all' && $operatore == '+') {
                                        for ($i=1; $i <= $set['set_turni_totali'] ; $i++) {
                                          if ($row[$usertype.'t'.$i] != -100) {
                                            $postifinali[$i] = $row[$usertype.'t'.$i] + $posti;
                                            $total_postifinali[$i] = $row['total_'.$usertype.'t'.$i] + $posti;
                                          } else {
                                            $postifinali[$i] = -100;
                                            $total_postifinali[$i] = -100;
                                          }
                                        }
                                        for ($i=$set['set_turni_totali']+1; $i<=18; $i++) {
                                          $postifinali[$i] = -100;
                                          $total_postifinali[$i] = -100;
                                        }
                                      } elseif ($turno == 'all' && $operatore == '-') {
                                        for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {
                                          if ($row[$usertype.'t'.$i] != -100) {
                                            $postifinali[$i] = $row[$usertype.'t'.$i] - $posti;
                                            $total_postifinali[$i] = $row['total_'.$usertype.'t'.$i] - $posti;
                                          } else {
                                            $postifinali[$i] = -100;
                                            $total_postifinali[$i] = -100;
                                          }
                                        }
                                        for ($i=$set['set_turni_totali']+1; $i <=18; $i++) {
                                          $postifinali[$i] = -100;
                                          $total_postifinali[$i] = -100;
                                        }
                                      }

                                      if ($turno != 'all') {
                                      if ($postifinali[0] >= 0) {
                                      $sql = "UPDATE collettivi SET ".$usertype."t".$turno." = '".$postifinali[0]."', total_".$usertype."t".$turno." = '$total_postifinali[0]' WHERE id = '".$id."' LIMIT 1";

                                      if(mysqli_query($link, $sql)){
                                        header('location: /admin/system/modificato?v=posti_aggiornati');
                                      } else {
                                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                      }

                                      } elseif ($postifinali[0] < 0) {
                                        echo "<script>$(document).ready(function() { M.toast({html: 'Errore: stai rimuovendo più posti di quelli disponibili.'}) });</script>";
                                      }
                                    } else {
                                      $error = 0;
                                      for ($i=1; $i <= 18; $i++) {
                                        if ($postifinali[$i] < 0 && $postifinali[$i] != -100) {
                                          $error = $i;
                                        }
                                      }
                                      if ($error == 0) {

                                      $sql = "UPDATE collettivi SET total_".$usertype."t1 = $total_postifinali[1], total_".$usertype."t2 = $total_postifinali[2], total_".$usertype."t3 = $total_postifinali[3], total_".$usertype."t4 = $total_postifinali[4], total_".$usertype."t5 = $total_postifinali[5], total_".$usertype."t6 = $total_postifinali[6], total_".$usertype."t7 = $total_postifinali[7], total_".$usertype."t8 = $total_postifinali[8], total_".$usertype."t9 = $total_postifinali[9], total_".$usertype."t10 = $total_postifinali[10], total_".$usertype."t11 = $total_postifinali[11], total_".$usertype."t12 = $total_postifinali[12], total_".$usertype."t13 = $total_postifinali[13], total_".$usertype."t14 = $total_postifinali[14], total_".$usertype."t15 = $total_postifinali[15], total_".$usertype."t16 = $total_postifinali[16], total_".$usertype."t17 = $total_postifinali[17], total_".$usertype."t18 = $total_postifinali[18], ".$usertype."t1 = '".$postifinali[1]."', ".$usertype."t2 = '".$postifinali[2]."', ".$usertype."t3 = '".$postifinali[3]."', ".$usertype."t4 = '".$postifinali[4]."', ".$usertype."t5 = '".$postifinali[5]."', ".$usertype."t6 = '".$postifinali[6]."', ".$usertype."t7 = '".$postifinali[7]."', ".$usertype."t8 = '".$postifinali[8]."', ".$usertype."t9 = '".$postifinali[9]."', ".$usertype."t10 = '".$postifinali[10]."', ".$usertype."t11 = '".$postifinali[11]."', ".$usertype."t12 = '".$postifinali[12]."', ".$usertype."t13 = '".$postifinali[13]."', ".$usertype."t14 = '".$postifinali[14]."', ".$usertype."t15 = '".$postifinali[15]."', ".$usertype."t16 = '".$postifinali[16]."', ".$usertype."t17 = '".$postifinali[17]."', ".$usertype."t18 = '".$postifinali[18]."' WHERE id = '".$id."' LIMIT 1";

                                      if(mysqli_query($link, $sql)){
                                        header('location: /admin/system/modificato?v=posti_aggiornati');
                                      } else {
                                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                      }

                                    } else {
                                        echo "<script>alert('Errore: stai rimuovendo più posti di quelli disponibili. Controlla che tutti i turni abbiano abbastanza posti che puoi rimuovere.');</script>";
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

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Modifica Collettivo</title>

<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/navbar_admin.php' ?>

<!--Container-->

<div class="container" style:"margin-bottom: 4em;">

  <?php
  //Remove LIMIT 1 to show/do this to all results.
$sql = "SELECT * FROM collettivi WHERE id = '".$id."' LIMIT 1";
$userz = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($userz);
?>

<div class="row margine_sopra">
  <a href="/admin/collettivi/admincollettivi" style="border-radius: 15px; background-color: #fff; padding-right: 10px; padding-bottom: 10px;" class="left z-depth-1 black-text"><i style="position: relative; top: 8px;" class="material-icons small">chevron_left</i>Gestisci <?php echo $set['set_nome_collettivi']; ?></a>
</div>

  <div style="border-radius: 15px; background-color: #fff;" class="row spazio_sotto z-depth-1">
      <form class="col s12 margine_sopra" action="" method="post" enctype="multipart/form-data">
            <h3 class="col s12 center"><b>Modifica questo <?php echo $set['set_nome_collettivo'] ?>!</b></h5>
            <p style="border-radius:15px" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">In questa pagina puoi modificare un <?php echo $set['set_nome_collettivo'] ?> registrato sul sito. In fondo alla pagina trovi anche la possibilità di ri-caricare l'immagine del <?php echo $set['set_nome_collettivo'] ?> e il CV dell'esterno.</p>
            <h5 class="col s12 center"><b><?php echo ucfirst($set['set_nome_collettivo']); ?>!</b></h5>
            <p class="col s12"> <b>Titolo del <?php echo $set['set_nome_collettivo']; ?>:</b> </p>
          <div class="input-field col s12">
            <input placeholder="Titolo" id="titolo_collettivo" type="text" class="input is-rounded browser-default" name="titolo_collettivo" required="required">
          </div>
          <p class="col s12"> <b>Nome di chi propone il <?php echo $set['set_nome_collettivo']; ?>:</b> </p>
          <div class="input-field col s12">
            <input placeholder="Nome" id="nome_proponente" type="text" class="input is-rounded browser-default" name="nome_proponente" required="required">
          </div>
          <p class="col s12"> <b>Cognome di chi propone il <?php echo $set['set_nome_collettivo']; ?>:</b> </p>
          <div class="input-field col s12">
            <input placeholder="Cognome" id="cognome_proponente" type="text" class="input is-rounded browser-default" name="cognome_proponente" required="required">
          </div>
          <p class="col s12"> <b>Descrizione esaustiva del <?php echo $set['set_nome_collettivo']; ?>:</b> </p>
          <div class="input-field col s12">
            <textarea placeholder="Descrizione" id="descrizione_collettivo" class="textarea is-rounded browser-default" name="descrizione_collettivo" required="required"></textarea>
          </div>
          <p class="col s12"> <b>Email di chi propone il <?php echo $set['set_nome_collettivo']; ?>:</b> </p>
          <div class="input-field col s12">
              <input placeholder="Email" id="email_proponente" type="email" class="input is-rounded browser-default" name="email_proponente" required="required">
          </div>
          <p class="col s12"> <b>Numero di chi propone il <?php echo $set['set_nome_collettivo']; ?>:</b> </p>
          <div class="input-field col s12">
            <input placeholder="Numero" id="telefono_proponente" type="text" class="input is-rounded browser-default" name="telefono_proponente" required="required">
          </div>
          <p class="col s12"><b>Ruolo all'interno della scuola: </b></p>
          <div class="input-field col s12">
              <select style="border-radius: 25px;" id="ruolo_proponente" name="ruolo_proponente" class="browser-default" required="required">
                <option value="" disabled selected>Seleziona</option>
                <option value="studente">Studente</option>
                <option value="genitore">Genitore</option>
                <option value="professore">Professore</option>
                <option value="ex-studente">Ex Studente</option>
              </select>
            </div>
            <h5 class="col s12 center"><b>Studente referente!</b></h5>
            <p class="col s12"> <b>Nome dello studente referente:</b> </p>
            <div class="input-field col s12">
              <input placeholder="Nome" id="nome_referente" type="text" class="input is-rounded browser-default" name="nome_referente" required="required">
            </div>
            <p class="col s12"> <b>Cognome dello studente referente:</b> </p>
            <div class="input-field col s12">
              <input placeholder="Cognome" id="cognome_referente" type="text" class="input is-rounded browser-default" name="cognome_referente" required="required">
            </div>
            <p class="col s12"> <b>Anno scolastico dello studente referente:</b> </p>
            <div class="col s12 input-field form-group">
                <select style="border-radius: 25px;" id="anno_referente" class="browser-default form-control" name="anno_referente" required="required">
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
                  <select style="border-radius: 25px;" id="sezione_referente" class="browser-default form-control" name="sezione_referente" required="required">
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
                <p class="col s12">Se presenti aggiungi altri studenti referenti secondo il seguente formato: Nome Cognome 1A; Nome2 Cognome2 3B; SE NON PRESENTI LASCIARE VUOTO.</p>
                <div class="input-field col s12">
                  <input placeholder="Altri Referenti" id="altri_referenti" type="text" class="input is-rounded browser-default" name="altri_referenti">
                </div>
                <h5 class="col s12 center"><b>Turni del <?php echo $set['set_nome_collettivo'] ?>!</b></h5>
                <p class="col s12"> <b>Turni in cui si svolgerà il <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
                <?php if ($set['set_status_cogestione'] == 'cogestione_open' || $set['set_status_cogestione'] == 'cogestione_momentaneamente_chiusa' || $set['set_status_cogestione'] == 'cogestione_chiusa') { ?>
                <p style="border-radius:15px" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text"><i><b>ATTENZIONE:</b> Se vai a deselezionare un turno, tutti gli utenti iscritti a quel turno verranno automaticamente disiscritti.</i></p>
                <?php } ?>
                <p class="col s12">Per aggiungere o togliere un turno del <?php echo $set['set_nome_collettivo'] ?> selezionare o deselezionare le caselle qui sotto. Per aggiungere o togliere posti ad un turno vedi in fondo alla pagina.</p>
                <p class="col s12"> <b><?php echo $set['set_giorno1_cogestione']; ?>:</b> </p>
                <?php for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) { ?>
                <p class="col s12">
                  <label>
                    <input value='on' <?php if ($row['t'.$i] != -100) { ?> checked <?php } ?> type="checkbox" name="t<?php echo $i; ?>"/>
                    <span class="black-text">Turno <?php echo $i; ?></span>
                  </label>
                </p>
                <?php } ?>
                <p class="col s12">Seleziona la casella successiva se l'utente è disponibile a cambiare turno, deselezionala se non è più disponibile.</p>
                <p class="col s12">
                  <label>
                    <input <?php if ($row['disponibile_cambio_turno'] != -100) { ?> checked <?php } else {} ?> type="checkbox" name="disponibile_cambio_turno"/>
                    <span>Disponibilità a cambiare turno</span>
                  </label>
                <h5 class="col s12 center"><b>Esterno!</b></h5>
                <p class="col s12"> <b>Nome dell'esterno (se presente)</b> </p>
                <div class="input-field col s12">
                  <input placeholder="Nome" id="nome_esterno" type="text" class="input is-rounded browser-default" name="nome_esterno">
                </div>
                <p class="col s12"> <b>Cognome dell'esterno (se presente)</b> </p>
                <div class="input-field col s12">
                  <input placeholder="Cognome" id="cognome_esterno" type="text" class="input is-rounded browser-default" name="cognome_esterno">
                </div>
                <p class="col s12"> <b>Numero di telefono dell'esterno (se presente)</b> </p>
                <div class="input-field col s12">
                  <input placeholder="Numero" id="telefono_esterno" type="text" class="input is-rounded browser-default" name="telefono_esterno">
                </div>
                <p class="col s12"> <b>Professione dell'esterno (se presente)</b> </p>
                <div class="input-field col s12">
                  <input placeholder="Professione" id="professione_esterno" type="text" class="input is-rounded browser-default" name="professione_esterno">
                </div>
                <p class="col s12"> <b>Altri ospiti esterni:</b> </p>
                <p class="col s12">Seleziona quanti altri ospiti avrà questo <?php echo $set['set_nome_collettivo'] ?> (Ri-seleziona per effettuare un cambiamento)</p>
                <div class="col s6 offset-s3 input-field form-group">
                    <?php
                    $array_esterni = explode(", ", $row['altri_esterni']);
                     ?>
                    <select style="border-radius: 25px;" class="browser-default form-control" name="altri_esterni" id="altri_esterni" onchange="displayQuestion2(this.value)">
                      <option value="" disabled>Indica n. di altri ospiti</option>
                      <option <?php if (count($array_esterni) == 0) { print 'selected'; } ?> id="0esterno" value="0">Nessun altro ospite</option>
                      <option <?php if (count($array_esterni) == 1) { print 'selected'; } ?> id="1esterno" value="1">1 altro ospite</option>
                      <?php
                      for ($i=2; $i<=10; $i++)
                      {
                        ?>
                      <option <?php if (count($array_esterni) == $i) { print 'selected'; } ?> id="<?php echo $i;?>" value="<?php echo $i;?>">Altri <?php echo $i;?> ospiti</option>
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

                <h5 class="col s12 center"><b>Necessità, spazi e strumenti!</b></h5>
                <p class="col s12"> <b>Spazio necessario alla buona riuscita del <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
                <?php if ($set['set_status_cogestione'] == 'cogestione_open' || $set['set_status_cogestione'] == 'cogestione_momentaneamente_chiusa' || $set['set_status_cogestione'] == 'cogestione_chiusa') { ?>
                <p  style="border-radius:15px" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text"><i>Da questo status della <?php echo $set['set_nome_cogestione']; ?> in poi non è più possibile cambiare lo spazio perchè andrebbe a disiscrivere degli studenti iscritti. Piuttosto varia i posti in un turno utilizzando il tool in fondo a questa pagina!</i></p>
                <?php } else { ?>
                <p class="col s12">Se cambi lo spazio necessario, verranno cambiati i posti disponibili per studenti e docenti, e verranno impostati quelli predefiniti per lo spazio selezionato.</p>
                <div class="col s12 input-field form-group">
                    <select style="border-radius: 25px;" id="spazio" class="browser-default form-control" name="spazio" required="required">
                      <option value="" disabled selected>Seleziona lo spazio necessario</option>
                      <?php for ($i=1; $i <=10; $i++) {
                        if ($set['set_active_spazio_'.$i] == 1) { ?>
                          <option value="<?php echo $i; ?>"><?php echo ucfirst($set['set_nome_spazio_'.$i]); ?></option>
                        <?php }
                       } ?>
                    </select>
                  </div>
                  <?php } ?>
                  <p class="col s12"> <b>Strumenti necessari alla buona riuscita del <?php echo $set['set_nome_collettivo'] ?>:</b> </p>
                  <div class="input-field col s12">
                      <?php $array_strumenti = explode(", ", $row['strumenti']); ?>
                      <?php $strumenti_necessari = explode(",", $set['set_strumenti_cogestione']); ?>
                    <select style="border-radius: 25px;" name="strumenti[]" multiple id="strumenti" required>
                      <option value="" disabled>Seleziona gli strumenti necessari:</option>
                      <?php foreach ($strumenti_necessari as $item) { ?>
                        <option <?php if(in_array($item, $array_strumenti)) { echo 'selected'; }?> value="<?php echo $item ?>"><?php echo ucwords($item) ?></option>
                      <?php } ?>
                      <option <?php if(in_array('', $array_strumenti)) { echo 'selected'; }?> value="">Nessuno strumento necessario</option>
                    </select>
                  </div>
                  <p class="col s12"> <b>Indica qui sotto se ha necessità particolari (lascia vuoto se non ne ha):</b> </p>
                  <div class="input-field col s12">
                    <input placeholder="Necessità particolari" id="necessita_particolari" type="text" class="input is-rounded browser-default" name="necessita_particolari">
                  </div>
                  <p class="col s12"> <b>Inserisci qui sotto il link della videochiamata per seguire il <?php echo $set['set_nome_collettivo'] ?> a distanza, se necessario, oppure lascia libero:</b> </p>
                  <div class="input-field col s12">
                    <input placeholder="Link videochiamata" id="link_videochiamata" type="text" class="input is-rounded browser-default" name="link_videochiamata">
                  </div>
                  <h5 class="col s12 center"><b>Consenso al trattamento dei dati personali!</b></h5>
                  <p class="col s12">Si autorizza al trattamento dei dati necessari al l’espletamento delle azioni previste nel progetto ai sensi del GDPR (Regolamento UE 2016/679). Titolare del trattamento dei dati è <?php echo $set['set_nome_responsabile_privacy']; ?></p>
                  <p class="col s12">
                    <label>
                      <input type="checkbox" name="trattamento_dati" required="required" checked/>
                      <span>Acconsento</span>
                    </label>
                  </p>
          <div class="col s12 center">
            <button style="border-radius: 20px;" class="btn waves-effect waves-light btn-large center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" type="submit" name="submit" value="Upload">Invia
              <i class="material-icons right">send</i>
            </button>
          </div>

          <h5 class="col s12 center margine_sopra margine_sotto"><b>Modifica immagine<?php if ($set['set_curriculum_necessario'] == 1) { ?> e curriculum<?php } ?>!</b></h5>

          <p class="col s12"> <b>Immagine <?php echo $set['set_nome_collettivo'] ?> (di forma quadrata e max 5mb):</b> </p>
          <div class="file-field input-field col s5 offset-s1">
            <div style="border-radius: 15px;" class="btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">
              <span>Immagine</span>
              <input type="file" id="file_immagine_collettivo" accept="image/jpg,image/jpeg,image/JPEG,image/JPG" name="immagine_collettivo">
            </div>
            <div class="file-path-wrapper">
              <input id="immagine_collettivo" class="file-path validate" type="text">
            </div>
          </div>

          <div class="col s5 center marginetto_sopra">
            <button onclick="loadingGIF()" style="border-radius: 15px;" class="btn waves-effect waves-light center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" type="submit" name="submit2" value="Upload">Invia
              <i class="material-icons right">send</i>
            </button>
          </div>

          <?php if ($set['set_curriculum_necessario'] == 1) { ?>
          <p class="col s12"> <b>Curriculum vitae dell'esterno/degli esterni.</b><br>Carica un unico file con molteplici curricula se presenti più esterni.</p>
          <div class="file-field input-field col s5 offset-s1">
            <div  style="border-radius: 15px;" class="btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">
              <span>CV</span>
              <input type="file" accept="image/jpg,image/jpeg,image/JPEG,image/JPG,image/png,.gif,.pdf,.doc,.docx,.DOC,.DOCX" name="cv_esterno">
            </div>
            <div class="file-path-wrapper">
              <input id="cv_esterno" class="file-path validate" type="text">
            </div>
          </div>

          <div class="col s5 center marginetto_sopra">
            <button onclick="loadingGIF()" style="border-radius: 15px;" class="btn waves-effect waves-light center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" type="submit" name="submit3" value="Upload">Invia
              <i class="material-icons right">send</i>
            </button>
          </div>
          <?php } ?>

          <script>
          $('#titolo_collettivo').val('<?php echo addslashes($row["titolo_collettivo"]); ?>');
          $('#nome_proponente').val('<?php echo addslashes($row["nome_proponente"]); ?>');
          $('#cognome_proponente').val('<?php echo addslashes($row["cognome_proponente"]); ?>');
          $('#descrizione_collettivo').val('<?php echo addslashes($row["descrizione_collettivo"]); ?>');
          $('#email_proponente').val('<?php echo addslashes($row["email_proponente"]); ?>');
          $('#telefono_proponente').val('<?php echo addslashes($row["telefono_proponente"]); ?>');
          $('#ruolo_proponente').val('<?php echo addslashes($row["ruolo_proponente"]); ?>');
          $('#nome_referente').val('<?php echo addslashes($row["nome_referente"]); ?>');
          $('#cognome_referente').val('<?php echo addslashes($row["cognome_referente"]); ?>');
          $('#anno_referente').val('<?php echo addslashes($row["anno_referente"]); ?>');
          $('#sezione_referente').val('<?php echo addslashes($row["sezione_referente"]); ?>');
          $('#altri_referenti').val('<?php echo addslashes($row["altri_referenti"]); ?>');
          <?php for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) { ?>
          $('#t<?php echo $i; ?>').val('<?php echo addslashes($row["t".$i]); ?>');
          <?php } ?>
          $('#nome_esterno').val('<?php echo addslashes($row["nome_esterno"]); ?>');
          $('#cognome_esterno').val('<?php echo addslashes($row["cognome_esterno"]); ?>');
          $('#telefono_esterno').val('<?php echo addslashes($row["telefono_esterno"]); ?>');
          $('#professione_esterno').val('<?php echo addslashes($row["professione_esterno"]); ?>');
          <?php
          $array_esterni = explode(", ", $row['altri_esterni']);
           ?>
           <?php
           for ($i=2; $i<=11; $i++)
           {
             ?>
          $('#esterno<?php echo $i; ?>Required').val('<?php echo $array_esterni[$i - 2]; ?>');
          <?php
          }
            ?>
          $('#spazio').val('<?php echo addslashes($row["spazio"]); ?>');
          $('#necessita_particolari').val('<?php echo addslashes($row["necessita_particolari"]); ?>');
          $('#link_videochiamata').val('<?php if(addslashes($row["link_videochiamata"]) != '0') { echo addslashes($row["link_videochiamata"]); } ?>');
          $('#immagine_collettivo').val('<?php echo addslashes($row["immagine_collettivo"]); ?>');
          $('#cv_esterno').val('<?php echo addslashes($row["cv_esterno"]); ?>');
          $(document).ready(function() {
            $('input#input_text, textarea#descrizione_collettivo').characterCounter();
            $('select').formSelect();
          });
          </script>

      </form>

      <h5 class="col s12 center margine_sopra marginetto_sotto"><b>Aggiungi o togli posti ad un turno di questo <?php echo $set['set_nome_collettivo'] ?>!</b></h5>
      <?php

      if ($set['set_status_cogestione'] == 'cogestione_open') { ?>
      <p style="border-radius:15px;" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text"> <i>In questo status della <?php echo $set['set_nome_cogestione']; ?> non è possibile modificare i posti di un turno, cambia status e entra nello status <b>"Iscrizioni momentaneamente chiuse"</b> per farlo.</i> </p>
    <?php } elseif ($set['set_unlimited_spazio_'.$row['spazio']] == 1) { ?>
      <p style="border-radius:15px;" class="col s12 z-depth-1 <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text"> <i>Non puoi cambiare i posti in un <?php echo $set['set_nome_collettivo']; ?> a posti infiniti. Cambia lo spazio per poterlo fare.</i> </p>
    <?php } else {

    $sql = "SELECT * FROM collettivi WHERE id = '".$id."' LIMIT 1 ";
    $results = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($results); ?>
      <div style="overflow: scroll;" class="col s12 spazio_sopra spazio_sotto marginetto_sotto">
        <p class="col s12"><b>Situazione attuale: </b></p>
        <table class="highlight">
                <thead>
                  <tr>

                      <?php
                      for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {
                       if ($row["t".$i] != -100) {
                        print "<th>T".$i."</th>";}
                      }
                        ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><b>Studenti</b></td>
                    <?php
                    for ($i=2; $i  <= $set['set_turni_totali'] ; $i++) {
                     if ($row["t".$i] != -100) {
                      print "<td></td>";
                     }
                    }
                    ?>
                  </tr>
                  <tr>
                    <?php
                    for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {
                     if ($row["t".$i] != -100) {
                      print "<td>".$row["t".$i]." posti</td>";
                    }
                    }
                    ?>
                  </tr>
                  <tr>
                    <td><b>Docenti</b></td>
                    <?php
                    for ($i=2; $i  <= $set['set_turni_totali'] ; $i++) {
                     if ($row["t".$i] != -100) {
                      print "<td></td>";
                     }
                    }
                    ?>
                  </tr>
                  <tr>
                    <?php
                    for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {
                     if ($row["t".$i] != -100) {
                      print "<td>".$row["prof_t".$i]." posti</td>";
                    }
                    }
                    ?>
                  </tr>
                </tbody>
              </table>
      </div>

      <p class="col s12 spazio_sopra"><b>Varia posti del <?php echo $set['set_nome_collettivo'] ?> "<?php echo $row['titolo_collettivo'] ?>": </b></p>

      <form class="col s12 container marginetto_sotto" action="" method="post" enctype="multipart/form-data">
        <div class="col s5 offset-s1 input-field form-group">
            <select style="border-radius: 25px;" id="operatore" class="browser-default form-control" name="operatore" required>
              <option value="" disabled selected>+ o -?</option>
              <option value="+">Aggiungi</option>
              <option value="-">Togli</option>
            </select>
          </div>
          <div class="col s5 input-field form-group">
              <select style="border-radius: 25px;" id="posti" class="browser-default form-control" name="posti" required>
                <option value="" disabled selected>Quanti posti?</option>
                <option value="1">1 posto</option>
                <?php
                for ($i=2; $i<=100; $i++)
                {
                  ?>
                <option value="<?php echo $i;?>"><?php echo $i;?> posti</option>
                <?php
                }
                  ?>
              </select>
          </div>
          <div class="col s5 offset-s1 input-field form-group">
              <select style="border-radius: 25px;" id="turno" class="browser-default form-control" name="turno" required>
                <option value="" disabled selected>Quale turno?</option>
                <?php
                for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {
                if ($row['t'.$i] != -100) {?>
                <option value="<?php echo $i; ?>">nel <?php echo $i; ?>° turno (T<?php echo $i; ?>)</option>
                <?php }} ?>
                <option value="all">in tutti i turni disponibili</option>
              </select>
            </div>
            <div class="col s5 input-field form-group">
                <select style="border-radius: 25px;" id="usertype" class="browser-default form-control" name="usertype" required>
                  <option value="" disabled selected>Studenti o Docenti?</option>
                  <option <?php if ($set['set_unlimited_spazio_'.$row['spazio']] == 1) { echo 'disabled'; } ?> value="studente">Studenti <?php if ($set['set_unlimited_spazio_'.$row['spazio']] == 1) { echo '- Posti illimitati'; } ?></option>
                  <option value="docente">Docenti</option>
                </select>
              </div>
          <div class="col s12 center marginetto_sopra">
            <button style="border-radius: 20px;" class="btn waves-effect waves-light center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" type="submit" name="submit5" value="Upload">Esegui
              <i class="material-icons right">send</i>
            </button>
          </div>
      </form>
    <?php } ?>
    </div>
</div>

<div id="loading_spinner" class="center" style="display:none;z-index:5; position: fixed;top: 0;left: 0;min-width: 100%;min-height: 100%; background-color: #f1f1f1;">
  <img class="responsive-img" style="margin-top:25%;position:static;height:100px; width: auto;" src="/images/base/load.gif">
  <p style="margin-bottom:30%;">LOADING...</p>
</div>

<script>

function loadingGIF(){
 $('#loading_spinner').show();
}

var uploadField = document.getElementById("file_immagine_collettivo");

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

    <?php include $_SERVER['DOCUMENT_ROOT'].'/admin/basicpage/footer_admin.php'; ?>

  </body>

</html>
