<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

$var = mysqli_real_escape_string($link, $_GET['var']);

function clean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

if($var == 'STAFF'){

  $array_ruoli = array();

  array_push($array_ruoli, '-10005');
  array_push($array_ruoli, '-10004');
  array_push($array_ruoli, '-10003');
  array_push($array_ruoli, '-10002');
  array_push($array_ruoli, '-10001');


  $zipname = 'Fogli_firme_staff.zip';
  $zip = new ZipArchive;
  $zip->open($zipname, ZipArchive::CREATE);

for ($i=1; $i < 19; $i++) {

foreach ($array_ruoli as $ruolo) {

  $sql = "SELECT username, classe
  FROM users_cogestione
  WHERE t".$i." = '".$ruolo."' AND id > 0
  ORDER BY classe, username";
  $result = mysqli_query($link, $sql);

  if($result->num_rows > 0){
    $delimiter = ',';
    //create a download filename

    $f = fopen('php://memory', 'w');

    $headers = array('Username', 'Classe', 'Firma');
      fputcsv($f, $headers, $delimiter);

      while($row = mysqli_fetch_row($result)){
      $lines = array($row[0], $row[1], '');
          fputcsv($f, $lines, $delimiter);
      }

      $sql = 'SELECT * from collettivi WHERE id = "'.$ruolo.'"';
      $result = mysqli_query($link, $sql);
      $row = mysqli_fetch_assoc($result);

      $ruolo_testo = clean($row['titolo_collettivo']);

      rewind($f);
      $zip->addFromString('Firme_'.$ruolo_testo.'_T'.$i.'.csv', stream_get_contents($f) );
      fclose($f);
  }
}
}

  $zip->close();

  header('Content-Type: application/zip');
  header('Content-disposition: attachment; filename='.$zipname);
  header('Content-Length: ' . filesize($zipname));
  readfile($zipname);

  }


if($var == 'iscr_classe'){

  $array_classi=array();

  $sql = "SELECT * FROM users_cogestione WHERE classe != '' AND id > 0 ORDER BY classe";
  $result = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($result)){
    array_push($array_classi, $row['classe']);
  }

  $zipname = 'Iscrizioni_per_classe.zip';
  $zip = new ZipArchive;
  $zip->open($zipname, ZipArchive::CREATE);

foreach ($array_classi as $classe) {

  $sql = "SELECT
    u.username,
    join1.titolo_collettivo,
    join2.titolo_collettivo,
    join3.titolo_collettivo,
    join4.titolo_collettivo,
    join5.titolo_collettivo,
    join6.titolo_collettivo,
    join7.titolo_collettivo,
    join8.titolo_collettivo,
    join9.titolo_collettivo,
    join10.titolo_collettivo,
    join11.titolo_collettivo,
    join12.titolo_collettivo,
    join13.titolo_collettivo,
    join14.titolo_collettivo,
    join15.titolo_collettivo,
    join16.titolo_collettivo,
    join17.titolo_collettivo,
    join18.titolo_collettivo
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
  WHERE classe = '".$classe."' AND u.id > 0 AND ruolo != 'professore' AND ruolo != 'professore_admin'
  ORDER BY u.username";
  $result = mysqli_query($link, $sql);

  if($result->num_rows > 0){
    $delimiter = ',';
    //create a download filename

    $f = fopen('php://memory', 'w');

    $headers = array('Username');
    for ($i=1; $i <= $set['set_turni_totali']; $i++) {
      array_push($headers,"T".$i);
    }
      fputcsv($f, $headers, $delimiter);

      while($row = mysqli_fetch_row($result)){
      $lines = array($row[0]);
      for ($i=1; $i <= $set['set_turni_totali']; $i++) {
        array_push($lines, $row[$i]);
      }
          fputcsv($f, $lines, $delimiter);
      }

      rewind($f);
      $zip->addFromString('Iscrizioni_'.$classe.'.csv', stream_get_contents($f) );
      fclose($f);
  }
}


  $sql = "SELECT
    u.username,
    join1.titolo_collettivo,
    join2.titolo_collettivo,
    join3.titolo_collettivo,
    join4.titolo_collettivo,
    join5.titolo_collettivo,
    join6.titolo_collettivo,
    join7.titolo_collettivo,
    join8.titolo_collettivo,
    join9.titolo_collettivo,
    join10.titolo_collettivo,
    join11.titolo_collettivo,
    join12.titolo_collettivo,
    join13.titolo_collettivo,
    join14.titolo_collettivo,
    join15.titolo_collettivo,
    join16.titolo_collettivo,
    join17.titolo_collettivo,
    join18.titolo_collettivo
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
  WHERE ruolo = 'professore' OR ruolo = 'professore_admin'
  ORDER BY u.username";
  $result = mysqli_query($link, $sql);

  if($result->num_rows > 0){
    $delimiter = ',';
    //create a download filename

    $f = fopen('php://memory', 'w');

    $headers = array('Username');
    for ($i=1; $i <= $set['set_turni_totali']; $i++) {
      array_push($headers,"T".$i);
    }
      fputcsv($f, $headers, $delimiter);

      while($row = mysqli_fetch_row($result)){
      $lines = array($row[0]);
      for ($i=1; $i <= $set['set_turni_totali']; $i++) {
        array_push($lines, $row[$i]);
      }
          fputcsv($f, $lines, $delimiter);
      }

      rewind($f);
      $zip->addFromString('Iscrizioni_DOCENTI.csv', stream_get_contents($f) );
      fclose($f);
  }

  $zip->close();

  header('Content-Type: application/zip');
  header('Content-disposition: attachment; filename='.$zipname);
  header('Content-Length: ' . filesize($zipname));
  readfile($zipname);

  }


if($var == 'iscr_users'){

$sql = "SELECT
  u.username,
  u.classe,
  join1.titolo_collettivo,
  join2.titolo_collettivo,
  join3.titolo_collettivo,
  join4.titolo_collettivo,
  join5.titolo_collettivo,
  join6.titolo_collettivo,
  join7.titolo_collettivo,
  join8.titolo_collettivo,
  join9.titolo_collettivo,
  join10.titolo_collettivo,
  join11.titolo_collettivo,
  join12.titolo_collettivo,
  join13.titolo_collettivo,
  join14.titolo_collettivo,
  join15.titolo_collettivo,
  join16.titolo_collettivo,
  join17.titolo_collettivo,
  join18.titolo_collettivo
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
WHERE u.id > 0 AND NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin'
ORDER BY u.classe, u.username";
$result = mysqli_query($link, $sql);

if($result->num_rows > 0){
  $delimiter = ',';
  //create a download filename
  $filename = 'Iscrizioni_utenti-'.date('d-m-Y').'.csv';

  $f = fopen('php://memory', 'w');

  $headers = array('Username', 'Classe');
  for ($i=1; $i <= $set['set_turni_totali']; $i++) {
    array_push($headers,"T".$i);
  }
    fputcsv($f, $headers, $delimiter);

    while($row = mysqli_fetch_row($result)){
      $lines = array($row[0], $row[1]);
      for ($i=1; $i <= $set['set_turni_totali']; $i++) {
        if ($row[$i+1] == 'Non iscritto in questo turno') {
          $value = '/';
        } else {
          $value = $row[$i+1];
        }
        array_push($lines,$value);
      }
        fputcsv($f, $lines, $delimiter);
    }



    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
    exit;
}

}


if($var == 'pres_ass'){

  $sql = "SELECT * FROM users_cogestione WHERE NOT ruolo = 'professore' AND NOT ruolo = 'professore_admin' AND id > 0";
  $result = mysqli_query($link, $sql);

  if($result->num_rows > 0){
    $delimiter = ',';
    //create a download filename
    $filename = 'Presenze_utenti-'.date('d-m-Y').'.csv';

    $f = fopen('php://memory', 'w');

    $headers = array('Username', 'Classe');
    for ($i=1; $i <= $set['set_turni_totali']; $i++) {
      array_push($headers,"Presente T".$i);
    }
      fputcsv($f, $headers, $delimiter);

      while($row = mysqli_fetch_assoc($result)){
      $lines = array($row['username'], $row['classe']);
      for ($i=1; $i <= $set['set_turni_totali']; $i++) {
        array_push($lines, $row['presente_t'.$i]);
      }
          fputcsv($f, $lines, $delimiter);
      }



      fseek($f, 0);
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="' . $filename . '";');
      fpassthru($f);
      exit;
  }

  }


  if($var == 'appelli_carta'){

    $zipname = 'Appelli_cartacei.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);

    $sql = "SELECT id, titolo_collettivo FROM collettivi WHERE segnalato = 'NO' AND eliminato = 'NO' AND id > 0";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)){

      for ($i=1; $i <= $set['set_turni_totali']; $i++) {

      $sql = "SELECT username, classe FROM users_cogestione WHERE id > 0 AND (ruolo = 'studente_admin' || ruolo = 'studente') AND t".$i." = ".$row['id'];
      $results = mysqli_query($link, $sql);

        if($results->num_rows > 0){
          $delimiter = ',';
          //create a download filename

          $f = fopen('php://memory', 'w');

          $headers = array('Username', 'Classe', 'Presenza');
            fputcsv($f, $headers, $delimiter);

            while($riga = mysqli_fetch_row($results)){
            $lines = array($riga[0], $riga[1]);
                fputcsv($f, $lines, $delimiter);
            }

            rewind($f);
            $zip->addFromString($row['titolo_collettivo'].' - T'.$i.'.csv', stream_get_contents($f) );
            fclose($f);
        }
      }

    }

    $zip->close();

    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename='.$zipname);
    header('Content-Length: ' . filesize($zipname));
    readfile($zipname);
    }

for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {

  if($var == 'cartelli_t'.$i){

    require($_SERVER['DOCUMENT_ROOT'].'/fpdf.php');

    $pdf = new FPDF('L','mm','A4');
    $pdf->SetTitle('Cartelli T1');

    $sql = "SELECT titolo_collettivo FROM collettivi WHERE id > 0 AND NOT t".$i." = -100 AND NOT eliminato = 'SI'";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $pdf->SetFont('Arial','B',70);
        $pdf->AddPage();
        $pdf->SetY(60);
        $pdf->MultiCell(280,20,$row['titolo_collettivo'],0,'C');
        $pdf->Cell(280,40,'',0,1,'C');
        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(280,10,'(Turno '.$i.')',0,1,'C');
    }
    $pdf->Output();

    }
}

  if($var == 'collettivi_all'){

  $sql = "SELECT * FROM collettivi WHERE id > 0";
  $result = mysqli_query($link, $sql);

  if($result->num_rows > 0){
    $delimiter = ',';
    //create a download filename
    $filename = ucfirst($set['set_nome_collettivi']).'_proposti-'.date('d-m-Y').'.csv';

    $f = fopen('php://memory', 'w');

    $headers = array('Titolo '.$set['set_nome_collettivo'], 'Nome proponente', 'Cognome proponente', 'descrizione_'.$set['set_nome_collettivo'], 'Immagine '.$set['set_nome_collettivo'], 'Email proponente', 'Telefono proponente', 'Ruolo proponente', 'Nome referente', 'Cognome referente', 'Anno referente', 'Sezione referente', 'Altri referenti', 'T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12', 'T13', 'T14', 'T15', 'T16', 'T17', 'T18', 'Total T1', 'Total T2', 'Total T3', 'Total T4', 'Total T5', 'Total T6', 'Total T7', 'Total T8', 'Total T9', 'Total T10', 'Total T11', 'Total T12', 'Total T13', 'Total T14', 'Total T15', 'Total T16', 'Total T17', 'Total T18', 'Prof T1', 'Prof T2', 'Prof T3', 'Prof T4', 'Prof T5', 'Prof T6', 'Prof T7', 'Prof T8', 'Prof T9', 'Prof T10', 'Prof T11', 'Prof T12', 'Prof T13', 'Prof T14', 'Prof T15', 'Prof T16', 'Prof T17', 'Prof T18', 'Prof Total T1', 'Prof Total T2', 'Prof Total T3', 'Prof Total T4', 'Prof Total T5', 'Prof Total T6', 'Prof Total T7', 'Prof Total T8', 'Prof Total T9', 'Prof Total T10', 'Prof Total T11', 'Prof Total T12', 'Prof Total T13', 'Prof Total T14', 'Prof Total T15', 'Prof Total T16', 'Prof Total T17', 'Prof Total T18', 'Turni', 'Disponibile Cambio Turno', 'Nome Esterno', 'Cognome Esterno', 'Telefono Esterno', 'Professione Esterno', 'Altri Esterni', 'CV Esterno', 'Spazio', 'Strumenti', 'Necessità Particolari', 'Segnalato', 'Segnalato da', 'Eliminato');
      fputcsv($f, $headers, $delimiter);

      while($row = mysqli_fetch_assoc($result)){
      $lines = array($row['titolo_collettivo'], $row['nome_proponente'], $row['cognome_proponente'], $row['descrizione_collettivo'], $row['immagine_collettivo'], $row['email_proponente'], $row['telefono_proponente'], $row['ruolo_proponente'], $row['nome_referente'], $row['cognome_referente'], $row['anno_referente'], $row['sezione_referente'], $row['altri_referenti'], $row['t1'], $row['t2'], $row['t3'], $row['t4'], $row['t5'], $row['t6'], $row['t7'], $row['t8'], $row['t9'], $row['t10'], $row['t11'], $row['t12'], $row['t13'], $row['t14'], $row['t15'], $row['t16'], $row['t17'], $row['t18'], $row['total_t1'], $row['total_t2'], $row['total_t3'], $row['total_t4'], $row['total_t5'], $row['total_t6'], $row['total_t7'], $row['total_t8'], $row['total_t9'], $row['total_t10'], $row['total_t11'], $row['total_t12'], $row['total_t13'], $row['total_t14'], $row['total_t15'], $row['total_t16'], $row['total_t17'], $row['total_t18'], $row['prof_t1'], $row['prof_t2'], $row['prof_t3'], $row['prof_t4'], $row['prof_t5'], $row['prof_t6'], $row['prof_t7'], $row['prof_t8'], $row['prof_t9'], $row['prof_t10'], $row['prof_t11'], $row['prof_t12'], $row['prof_t13'], $row['prof_t14'], $row['prof_t15'], $row['prof_t16'], $row['prof_t17'], $row['prof_t18'], $row['total_prof_t1'], $row['total_prof_t2'], $row['total_prof_t3'], $row['total_prof_t4'], $row['total_prof_t5'], $row['total_prof_t6'], $row['total_prof_t7'], $row['total_prof_t8'], $row['total_prof_t9'], $row['total_prof_t10'], $row['total_prof_t11'], $row['total_prof_t12'], $row['total_prof_t13'], $row['total_prof_t14'], $row['total_prof_t15'], $row['total_prof_t16'], $row['total_prof_t17'], $row['total_prof_t18'], $row['turni'], $row['disponibile_cambio_turno'], $row['nome_esterno'], $row['cognome_esterno'], $row['telefono_esterno'], $row['professione_esterno'], $row['altri_esterni'], $row['cv_esterno'], ${'set_nome_spazio_'.$row['spazio']}, $row['strumenti'], $row['necessita_particolari'], $row['segnalato'], $row['segnalatoda'], $row['eliminato']);
          fputcsv($f, $lines, $delimiter);
      }



      fseek($f, 0);
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="' . $filename . '";');
      fpassthru($f);
      exit;
  }

  }

  if($var == 'collettivi_all_approved'){

  $sql = "SELECT * FROM collettivi WHERE id > 0 AND segnalato = 'NO' AND eliminato = 'NO'";
  $result = mysqli_query($link, $sql);

  if($result->num_rows > 0){
    $delimiter = ',';
    //create a download filename
    $filename = ucfirst($set['set_nome_collettivi']).'_approvati-'.date('d-m-Y').'.csv';

    $f = fopen('php://memory', 'w');

    $headers = array('Titolo '.$set['set_nome_collettivo'], 'Nome proponente', 'Cognome proponente', 'descrizione_'.$set['set_nome_collettivo'], 'Immagine '.$set['set_nome_collettivo'], 'Email proponente', 'Telefono proponente', 'Ruolo proponente', 'Nome referente', 'Cognome referente', 'Anno referente', 'Sezione referente', 'Altri referenti', 'T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12', 'T13', 'T14', 'T15', 'T16', 'T17', 'T18', 'Total T1', 'Total T2', 'Total T3', 'Total T4', 'Total T5', 'Total T6', 'Total T7', 'Total T8', 'Total T9', 'Total T10', 'Total T11', 'Total T12', 'Total T13', 'Total T14', 'Total T15', 'Total T16', 'Total T17', 'Total T18', 'Prof T1', 'Prof T2', 'Prof T3', 'Prof T4', 'Prof T5', 'Prof T6', 'Prof T7', 'Prof T8', 'Prof T9', 'Prof T10', 'Prof T11', 'Prof T12', 'Prof T13', 'Prof T14', 'Prof T15', 'Prof T16', 'Prof T17', 'Prof T18', 'Prof Total T1', 'Prof Total T2', 'Prof Total T3', 'Prof Total T4', 'Prof Total T5', 'Prof Total T6', 'Prof Total T7', 'Prof Total T8', 'Prof Total T9', 'Prof Total T10', 'Prof Total T11', 'Prof Total T12', 'Prof Total T13', 'Prof Total T14', 'Prof Total T15', 'Prof Total T16', 'Prof Total T17', 'Prof Total T18', 'Turni', 'Disponibile Cambio Turno', 'Nome Esterno', 'Cognome Esterno', 'Telefono Esterno', 'Professione Esterno', 'Altri Esterni', 'CV Esterno', 'Spazio', 'Strumenti', 'Necessità Particolari', 'Segnalato', 'Segnalato da', 'Eliminato');
      fputcsv($f, $headers, $delimiter);

      while($row = mysqli_fetch_assoc($result)){
      $lines = array($row['titolo_collettivo'], $row['nome_proponente'], $row['cognome_proponente'], $row['descrizione_collettivo'], $row['immagine_collettivo'], $row['email_proponente'], $row['telefono_proponente'], $row['ruolo_proponente'], $row['nome_referente'], $row['cognome_referente'], $row['anno_referente'], $row['sezione_referente'], $row['altri_referenti'], $row['t1'], $row['t2'], $row['t3'], $row['t4'], $row['t5'], $row['t6'], $row['t7'], $row['t8'], $row['t9'], $row['t10'], $row['t11'], $row['t12'], $row['t13'], $row['t14'], $row['t15'], $row['t16'], $row['t17'], $row['t18'], $row['total_t1'], $row['total_t2'], $row['total_t3'], $row['total_t4'], $row['total_t5'], $row['total_t6'], $row['total_t7'], $row['total_t8'], $row['total_t9'], $row['total_t10'], $row['total_t11'], $row['total_t12'], $row['total_t13'], $row['total_t14'], $row['total_t15'], $row['total_t16'], $row['total_t17'], $row['total_t18'], $row['prof_t1'], $row['prof_t2'], $row['prof_t3'], $row['prof_t4'], $row['prof_t5'], $row['prof_t6'], $row['prof_t7'], $row['prof_t8'], $row['prof_t9'], $row['prof_t10'], $row['prof_t11'], $row['prof_t12'], $row['prof_t13'], $row['prof_t14'], $row['prof_t15'], $row['prof_t16'], $row['prof_t17'], $row['prof_t18'], $row['total_prof_t1'], $row['total_prof_t2'], $row['total_prof_t3'], $row['total_prof_t4'], $row['total_prof_t5'], $row['total_prof_t6'], $row['total_prof_t7'], $row['total_prof_t8'], $row['total_prof_t9'], $row['total_prof_t10'], $row['total_prof_t11'], $row['total_prof_t12'], $row['total_prof_t13'], $row['total_prof_t14'], $row['total_prof_t15'], $row['total_prof_t16'], $row['total_prof_t17'], $row['total_prof_t18'], $row['turni'], $row['disponibile_cambio_turno'], $row['nome_esterno'], $row['cognome_esterno'], $row['telefono_esterno'], $row['professione_esterno'], $row['altri_esterni'], $row['cv_esterno'], ${'set_nome_spazio_'.$row['spazio']}, $row['strumenti'], $row['necessita_particolari'], $row['segnalato'], $row['segnalatoda'], $row['eliminato']);
          fputcsv($f, $lines, $delimiter);
      }



      fseek($f, 0);
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="' . $filename . '";');
      fpassthru($f);
      exit;
  }

  }

  for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {

    if($var == 'esterni_t'.$i){

      $sql = "SELECT * FROM collettivi WHERE t".$i." != -100 AND nome_esterno != '' AND id > 0 AND eliminato = 'NO' AND segnalato = 'NO' ORDER BY cognome_esterno, nome_esterno";
    	$query = $link->query($sql);

    	if($query->num_rows > 0){
    		$delimiter = ',';
    		//create a download filename
    		$filename = 'Ospiti_Esterni_'.ucwords('t'.$i).'-'.date('d-m-Y').'.csv';

    		$f = fopen('php://memory', 'w');

    		$headers = array($set['set_nome_collettivo'], 'Nome ospite', 'Professione', 'Firma in entrata', 'Firma in uscita');
        	fputcsv($f, $headers, $delimiter);

        	while($row = $query->fetch_array()){
    	        $lines = array($row['titolo_collettivo'], $row['nome_esterno'].' '.$row['cognome_esterno'], $row['professione_esterno']);
              fputcsv($f, $lines, $delimiter);
              if ($row['altri_esterni'] != '') {
              $array_esterni = explode(", ", $row['altri_esterni']);
               foreach ($array_esterni as $item) {
              $lines2 = array($row['titolo_collettivo'], $item, 'N/A');
              fputcsv($f, $lines2, $delimiter);
              }}
    	    }


    	    fseek($f, 0);
    	    header('Content-Type: text/csv');
    	    header('Content-Disposition: attachment; filename="' . $filename . '";');
    	    fpassthru($f);
    	    exit;
    	}

      }
  }


if ($var == 'all_cv') {
  $dir = $_SERVER['DOCUMENT_ROOT'].'/curriculum';
  $zip_file = 'curriculum.zip';

  // Initialize archive object
  $zip = new ZipArchive();
  $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

  // Create recursive directory iterator
  /** @var SplFileInfo[] $files */
  $files = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($dir),
      RecursiveIteratorIterator::LEAVES_ONLY
  );

  foreach ($files as $name => $file)
  {
      // Skip directories (they would be added automatically)
      if (!$file->isDir())
      {
        if ($file != '.htaccess') {
          // Get real and relative path for current file
          $filePath = $file->getRealPath();
          $relativePath = substr($filePath, strlen($dir) + 1);

          // Add current file to archive
          $zip->addFile($filePath, $relativePath);
        }
      }
  }

  // Zip archive will be created only after closing object
  $zip->close();


  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename='.basename($zip_file));
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($zip_file));
  readfile($zip_file);
}
?>
