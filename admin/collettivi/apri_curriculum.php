<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin_and_professore_admin');

    if( !empty( $_GET['name'] ) && $set['set_curriculum_necessario'] == 1)
    {
        $file_name = mysqli_real_escape_string($link, $_GET['name']);
        if ( file_exists($_SERVER['DOCUMENT_ROOT']."/curriculum/".$file_name) ){
          $parts = pathinfo("/curriculum/".$file_name);
          if ( $parts['extension'] == 'docx' || $parts['extension'] == 'DOCX' || $parts['extension'] == 'doc' || $parts['extension'] == 'DOC'){
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=/curriculum/".$file_name);
            if ( $parts['extension'] == 'docx' || $parts['extension'] == 'DOCX'){
              header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessing");
            } else {
              header("Content-Type: application/msword");
            }
            header("Content-Transfer-Encoding: binary");

            readfile($_SERVER['DOCUMENT_ROOT']."/curriculum/".$file_name);
          } elseif ( $parts['extension'] == 'pdf' ){
            ?>
            <object style="width:100%; height:100%;" type="application/pdf" data="/curriculum/<?php echo $file_name; ?>?#zoom=85&scrollbar=0&toolbar=0&navpanes=0">
              <p>Errore: il file è corrotto o il link è errato</p>
            </object>
            <?php
          } else {
            ?>
              <img style="width:100%; height:auto;" src="/curriculum/<?php echo $file_name?>" alt="Errore: il file è corrotto o il link è errato">
            <?php
          }
        } else {
          echo "File non disponibile";
        }
} else {
  echo "File non disponibile";
}

 ?>

 <title><?php echo $set['set_intestazione_sito']; ?> - Admin - Curriculum</title>
