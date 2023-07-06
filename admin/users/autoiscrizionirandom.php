<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php';
include $_SERVER['DOCUMENT_ROOT'].'/main/system/session_and_access.php';
AccessDoor('YES', 'studente_admin');

//Permette l'accesso solo tramite ajax
    if(!$_SERVER['HTTP_X_REQUESTED_WITH'])
    {
       header('location: /403.shtml');
       exit;
    }

$pre_collettivi = array();
$post_collettivi = array();

if ($_GET['data']) {
  foreach($_GET['data'] as $value) {
      if ($value['name']=='first[]') {
        array_push($pre_collettivi,$value['value']);
      } else {
        array_push($post_collettivi,$value['value']);
      }
  }
}

foreach ($post_collettivi as $collettivo) { //crea la condizione che i collettivi selezionati non includano i post_collettivi
  $var_mysql = $var_mysql." AND id != $collettivo";
}

//iscrizioni percentuali
for ($i=1; $i <= $set['set_turni_totali']; $i++) {
  unset($notsubusers);
  $notsubusers = array(); //crea un array per l'id di ogni studente che si deve iscrivere
  $m = 0;
  $sql = "SELECT * FROM users_cogestione WHERE t".$i." = 0 AND (ruolo = 'studente' || ruolo = 'studente_admin') AND id > 0 ORDER BY RAND(7)";
  $request = mysqli_query($link, $sql);
  while($row = mysqli_fetch_assoc($request)){
    $notsubusers[$m++] = $row['id']; //riempe l'array
  }

  $n = 0;
  $total = $m + 1; //numero totale utenti
  foreach ($pre_collettivi as $collettivo) { //autoiscrizioni dei pre-collettivi
    $sql = "SELECT * FROM collettivi WHERE id = $collettivo AND t".$i." != -100 AND t".$i." != 0";
    $request = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($request);

    if ($total < $row['t'.$i]) { // caso in cui il numero di posti disponibile > al numero di utenti
      $var_num = $total;
      $total = 0;
    } else { // caso in cui numero di posti disponibili è < numero di utenti
      $var_num = $row['t'.$i];
      $total = $total - $var_num;
    }
    for ($p=0; $p < $var_num; $p++) {
      $sql = "UPDATE collettivi SET t".$i." = t".$i." - 1 WHERE id = '".$collettivo."'";
      $request = mysqli_query($link, $sql);
      $sql = "UPDATE users_cogestione SET t".$i." = '".$collettivo."', autosub = CONCAT(autosub, ',".$i."') WHERE id = '".$notsubusers[$n++]."'";
      $request = mysqli_query($link, $sql);
    }
    if ($total == 0) {
      break;
    }
  }

  unset($collettivi);
  $collettivi = array(); //crea un array per tutti i collettivi con posti ancora disponibili
  $sql = "SELECT * FROM collettivi WHERE id > 0 AND total_t".$i." != -100 AND total_t".$i." != 0 AND t".$i." != 0 AND segnalato = 'NO' AND eliminato = 'NO' $var_mysql";
  $request = mysqli_query($link, $sql);
  $j = 0;
  while($row = mysqli_fetch_assoc($request)){
      $collettivi[$j++] = array("titolo" => $row['titolo_collettivo'], "id" => $row['id'], "t" => $row['t'.$i], "total" => $row['total_t'.$i], "percentage" => ($row['t'.$i] * 100 / $row['total_t'.$i]));
  }
  //sort dell'array in base alla percentuale in modo discendente (percentuale = percentuale di posti ancora disponibili)
  usort($collettivi, function($a, $b) {
    return $b['percentage'] <=> $a['percentage'];
  });
  $k = 0;
  while ($m > $n) { //finche n (conteggio degli autoiscritti correnti) è minore del totale degli utenti da autoiscrivere (CASO IN CUI SONO UGUALI?)
    while ($collettivi[0]["percentage"] > $collettivi[$j-1]["percentage"] && $m > $n) { //finchè la percentuale del più alto è maggiore di quello più basso e condizione precedente
      while ($k+1 < $j && $m > $n && $collettivi[0]["percentage"] > $collettivi[$j-1]["percentage"]) {
        while ($collettivi[$k]["percentage"] > $collettivi[$k+1]["percentage"] && $m > $n && $k+1 < $j && $collettivi[0]["percentage"] > $collettivi[$j-1]["percentage"]) { //aggiungere verifica se ha ancora posti e espulsione dall'array se li ha finiti
          $sql = "UPDATE collettivi SET t".$i." = t".$i." - 1 WHERE id = '".$collettivi[$k]['id']."'";
          $request = mysqli_query($link, $sql);
          $sql = "UPDATE users_cogestione SET t".$i." = '".$collettivi[$k]['id']."', autosub = CONCAT(autosub, ',".$i."') WHERE id = '".$notsubusers[$n++]."'";
          $request = mysqli_query($link, $sql);

          $collettivi[$k]['t'] = $collettivi[$k]['t'] - 1;
          $collettivi[$k]['percentage'] = $collettivi[$k]['t'] * 100 / $collettivi[$k]['total'];
        }
        $k++;
      }
      usort($collettivi, function($a, $b) {
        return $b['percentage'] <=> $a['percentage'];
      });
      $k = 0;
    }
    if ($m > $n) {
      for ($p=0; $p < $j; $p++) {

        if ($m > $n) {
          $sql = "UPDATE collettivi SET t".$i." = t".$i." - 1 WHERE id = '".$collettivi[$p]['id']."'";
          $request = mysqli_query($link, $sql);
          $sql = "UPDATE users_cogestione SET t".$i." = '".$collettivi[$p]['id']."', autosub = CONCAT(autosub, ',".$i."') WHERE id = '".$notsubusers[$n++]."'";
          $request = mysqli_query($link, $sql);

          $collettivi[$p]['t'] = $collettivi[$p]['t'] - 1;
          $collettivi[$p]['percentage'] = $collettivi[$p]['t'] * 100 / $collettivi[$p]['total'];
        } else {
          break; //se non ci sono più utenti da iscrivere esce dal loop
        }

      }

      usort($collettivi, function($a, $b) {
        return $b['percentage'] <=> $a['percentage'];
      });

    }
  }


  $total = $m - $n;
  foreach ($post_collettivi as $collettivo) {
    $sql = "SELECT * FROM collettivi WHERE id = $collettivo AND t".$i." != -100 AND t".$i." != 0";
    $request = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($request);

    if ($total < $row['t'.$i]) {
      $var_num = $total;
      $total = 0;
    } else {
      $var_num = $row['t'.$i];
      $total = $total - $var_num;
    }
    for ($p=0; $p < $var_num; $p++) {
      $sql = "UPDATE collettivi SET t".$i." = t".$i." - 1 WHERE id = '".$collettivo."'";
      $request = mysqli_query($link, $sql);
      $sql = "UPDATE users_cogestione SET t".$i." = '".$collettivo."', autosub = CONCAT(autosub, ',".$i."') WHERE id = '".$notsubusers[$n++]."'";
      $request = mysqli_query($link, $sql);
    }
    if ($total == 0) {
      break;
    }
  }
}
echo 'done';
  ?>
