<?php
//$pagetype (1 = index) (2 = view subscriptions) (3 = all info, no action) (4 = all info, no actions, subscription indicator) (5 = all info, all actions) (6 = all info, all actions - annulla segnala) (7 = all info, professors admin) (8 = all info, professors admin, annulla segnala) (9 = all info, annulla delete)
function DisplayCard($row, $turno, $ruolo, $iscritto, $collettivo, $set, $pagetype, $autosub, $counter){ //autosub e counter servono solo per la pagina iscrizioni personali?>
<div id="collettivo<?php echo $row['id'] ?>" class="col s12 m12 l4">  <div style="border-radius: 15px;" class="hoverable card">
      <div style="border-radius: 15px;" class="card-image waves-effect waves-block waves-light">
        <?php $imageURL = '/images/'.$row["immagine_collettivo"]; ?>
        <img class="activator" src="<?php echo $imageURL; ?>">
      </div>
      <?php if ($pagetype == 2 || $pagetype == 4) {
        $autosubbe = explode(",",$autosub);
        foreach ($autosubbe as $value) {
          if ($value == $counter) {
            ?>
              <span class="badge <?php echo $set['set_colore_bottoni']." ".$set['set_colore_bottoni_scritte']."-text" ?>" style="border-radius: 15px; margin-top: 5px; margin-right: 5px;">Autoiscritto</span>
            <?php
          }
        }
      ?>
      <?php } ?>
      <div class="card-content">
        <span style="font-size:25px; font-weight: 600; overflow-wrap: break-word;" class="card-title activator grey-text text-darken-4"><?php echo $row["titolo_collettivo"]; ?><i class="material-icons right">more_vert</i></span>
        <?php if ($pagetype == 1 || $pagetype == 2) { ?>
        <div id="iscrizioniover<?php echo $row['id'] ?>">
          <?php
          $t = array();
          for ($i=1; $i <= $set['set_turni_totali']; $i++)
          {
          if ($row[$ruolo.'t'.$i] != -100) {
            $t[$i] = $row[$ruolo.'t'.$i];
          } else {
            $t[$i] = 0;
          }
          }
          $postitotali = array_sum($t);
          for ($i=1; $i <= $set['set_turni_totali']; $i++)
          {
          if ($turno != 'id' && $turno == 't'.$i) {
            if ($set['set_unlimited_spazio_'.$row['spazio']] == 1 && $ruolo != 'prof_') {
              echo "<p class='green-text'>Posti illimitati al ".ucfirst($turno)."</p>";
            } elseif ($t[$i] == 0) {
              echo "<p class='red-text'>".$t[$i]." posti disponibili al ".ucfirst($turno)."</p>";
            } else {
              echo "<p class='green-text'>".$t[$i]." posti disponibili al ".ucfirst($turno)."</p>";
            }
          }
          }
          if ($turno == 'id') {
            if ($set['set_unlimited_spazio_'.$row['spazio']] == 1 && $ruolo != 'prof_') {
              echo "<p class='green-text'>Posti illimitati</p>";
            } elseif ($postitotali == 0) {
              echo "<p class='red-text'>".$postitotali." posti disponibili</p>";
            } else {
              echo "<p class='green-text'>".$postitotali." posti disponibili</p>";
            }
          }
          ?>
        </div>
        <?php }
        if ($pagetype == 4) {
          for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {

          if ($row['id'] == $collettivo[$i]) {
            print "<p>Iscritto al T".$i."</p>";
          }

          }
        }?>
      </div>
      <div style="border-radius: 15px;" class="card-reveal">
        <span style="font-size:25px; font-weight: 600;" class="card-title grey-text text-darken-4"><?php echo $row["titolo_collettivo"]; ?><i class="material-icons right">close</i></span>
        <p><?php echo $row["descrizione_collettivo"]; ?></p>
        <?php if ($row['nome_esterno'] != '') { ?>
        <p><b>Ospite: </b></p>
        <p><?php echo $row["nome_esterno"]." ".$row["cognome_esterno"]; ?></p>
        <?php } ?>
        <?php if ($row['altri_esterni'] != '') { ?>
        <p><b>Altri ospiti: </b></p>
        <p><?php echo $row["altri_esterni"]; ?></p>
        <?php } ?>
        <?php if ($row['cv_esterno'] != '' && $set['set_curriculum_necessario'] == 1 && $pagetype != 1 && $pagetype != 2) { ?>
        <p><b>CV ospite/i: </b></p>
        <?php $curriculumURL = '/admin/collettivi/apri_curriculum?name='.$row["cv_esterno"]; ?>
        <a target="_blank" href="<?php echo $curriculumURL; ?>">Clicca qui</a>
        <?php } ?>
        <p><b>Referente: </b></p>
        <p><?php echo $row["nome_referente"]." ".$row["cognome_referente"]." ".$row["anno_referente"].$row["sezione_referente"]."; ".$row['altri_referenti'] ?></p>
        <?php if ($pagetype != 1 && $pagetype != 2) { ?>
        <p><b>Persona che ha proposto il <?php echo $set['set_nome_collettivo'] ?>: </b></p>
        <p><?php echo $row["nome_proponente"]." ".$row["cognome_proponente"]." (".$row["ruolo_proponente"].")"; ?></p>
        <p><?php echo $row["email_proponente"]; ?></p>
        <p><?php echo $row["telefono_proponente"]; ?></p>
        <p><b>Spazio richiesto: </b></p>
        <p><?php echo $set['set_nome_spazio_'.$row['spazio']]; ?></p>
        <p><b>Strumenti richiesti: </b></p>
        <p><?php echo $row["strumenti"]; ?></p>
        <p><b>Necessità particolari: </b></p>
        <p><?php echo $row["necessita_particolari"]; ?></p>
        <?php } ?>
        <?php if ($row['link_videochiamata'] != '0'){ ?>
        <p><b>Link Videochiamata: </b></p>
        <?php if ($pagetype == 1) { ?>
        <p><i>Il link sarà disponibile non appena effettuata l'iscrizione</i></p>
        <?php } else { ?>
        <a href="https://<?php echo $row['link_videochiamata'] ?>">Clicca qui per accedere alla videochiamata</a>
      <?php }} else if ($row['link_videochiamata'] == '0' && $pagetype != 1 && $pagetype != 2) { ?>
        <p><b>Link Videochiamata: </b></p>
        <p><i>Il link non è stato ancora inserito</i></p>
        <?php } ?>
        <p><b>Turni disponibili: </b></p>

        <div>
          <?php if ($pagetype != 1 && $pagetype != 2 && $pagetype != 4) {
            for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {

            if ($row["t".$i] != -100) {
              if ($set['set_unlimited_spazio_'.$row['spazio']] == 1 && $ruolo != 'prof_') {
                print "<p>T".$i.": Illimitati posti disponibili</p>";
              } else {
                print "<p>T".$i.": ".$row["t".$i]."/".$row["total_t".$i]." posti disponibili</p>";
              }
              print "<p>T".$i." prof: ".$row["prof_t".$i]."/".$row["total_prof_t".$i]." posti disponibili</p>";
              }

            }
          } elseif ($pagetype == 4) {
            for ($i=1; $i  <= $set['set_turni_totali'] ; $i++) {

            if ($row['id'] == $collettivo[$i]) {
              print "<p>Iscritto al T".$i."</p>";
            }

            }
          } else {

          if($set['set_status_cogestione'] == 'cogestione_open' && isset($_SESSION["loggedin_coge"]) && $_SESSION["loggedin_coge"] == true) {

            if ($pagetype == 2) { $disable = 'disabled'; } else { $disable = ''; }

            for ($i=1; $i <= $set['set_turni_totali']; $i++)
            {
            if ($row[$ruolo.'t'.$i] == -100) {
            } elseif ($row[$ruolo.'t'.$i] > 0) {
              print "<div id='IscrizioniIn_t".$i."_".$row['id']."' ><p>T".$i.": ".$row[$ruolo.'t'.$i]."/".$row['total_'.$ruolo.'t'.$i]." posti disponibili</p></div>";
              if ($iscritto[$i] == 'NO') {
              print '<div id="Bottone_t'.$i.'_'.$row['id'].'" ><button type="button" class="btn waves-effect waves-light center '.$disable.' green" onClick="Subscribe('.$row['id'].', \'t'.$i.'\');" style="display:block; border-radius: 25px;">Iscriviti T'.$i.'</button></div>';
              } elseif ($iscritto[$i] == 'SI') {
              if ($row['id'] == $collettivo[$i]) {
                print '<div id="Bottone_t'.$i.'_'.$row['id'].'" ><button type="button" class="btn waves-effect waves-light center red" onClick="UnSubscribe('.$row['id'].', \'t'.$i.'\');" style="display:block; border-radius: 25px;">Disiscriviti T'.$i.'</button></div>';
              } else {
                print '<div id="Bottone_t'.$i.'_'.$row['id'].'" ><button type="button" class="btn waves-effect waves-light center disabled" style="display:block; border-radius: 25px;">Iscritto ad altro T'.$i.'</button></div>';
              }

              }
            } elseif ($row[$ruolo.'t'.$i] < 1) {
              if ($set['set_unlimited_spazio_'.$row['spazio']] == 1 && $ruolo != 'prof_') {
                print "<div id='IscrizioniIn_t".$i."_".$row['id']."' ><p>T".$i.": i posti sono illimitati.</p></div>";
              } else {
                print "<div id='IscrizioniIn_t".$i."_".$row['id']."' ><p>T".$i.": i posti sono terminati.</p></div>";
              }
              if ($row['id'] == $collettivo[$i]) {
                print '<div id="Bottone_t'.$i.'_'.$row['id'].'" ><button type="button" class="btn waves-effect waves-light center red" onClick="UnSubscribe('.$row['id'].', \'t'.$i.'\');" style="display:block; border-radius: 25px;">Disiscriviti T'.$i.'</button></div>';
              } else {
                if ($set['set_unlimited_spazio_'.$row['spazio']] == 1 && $ruolo != 'prof_') {
                  if ($iscritto[$i] == 'NO') {
                    print '<div id="Bottone_t'.$i.'_'.$row['id'].'" ><button type="button" class="btn waves-effect waves-light center '.$disable.' green" onClick="Subscribe('.$row['id'].', \'t'.$i.'\');" style="display:block; border-radius: 25px;">Iscriviti T'.$i.'</button></div>';
                  } elseif ($iscritto[$i] == 'SI') {
                    print '<div id="Bottone_t'.$i.'_'.$row['id'].'" ><button type="button" class="btn waves-effect waves-light center disabled" style="display:block; border-radius: 25px;">Iscritto ad altro T'.$i.'</button></div>';
                  }
                } else {
                  print '<div id="Bottone_t'.$i.'_'.$row['id'].'" ><button type="button" class="btn waves-effect waves-light center disabled" style="display:block; border-radius: 25px;">Posti terminati</button></div>';
                }
              }}

              }

          } else {

            for ($i=1; $i <= $set['set_turni_totali']; $i++)
            {

              if ($row[$ruolo."t".$i] == -100) {
              } elseif ($row[$ruolo."t".$i] > 0) {
                print "<div><p id='IscrizioniIn_t".$i."_".$row['id']."'>T".$i.": ".$row[$ruolo.'t'.$i]."/".$row['total_'.$ruolo.'t'.$i]." posti disponibili</p></div>";
                print '<div id="Bottone_t'.$i.'_'.$row['id'].'" ></div>';
              } elseif ($row[$ruolo."t".$i] < 1) {
                if ($set['set_unlimited_spazio_'.$row['spazio']] == 1 && $ruolo != 'prof_') {
                  print "<div id='IscrizioniIn_t".$i."_".$row['id']."' ><p>T".$i.": i posti sono illimitati.</p></div>";
                } else {
                  print "<div id='IscrizioniIn_t".$i."_".$row['id']."' ><p>T".$i.": i posti sono terminati.</p></div>";
                }
                print '<div id="Bottone_t'.$i.'_'.$row['id'].'" ></div>';
                }
            }


          }
        }
          $GLOBALS['lastID'] = $row['id'];
        ?>
        </div>
        <?php if ($pagetype != 1 && $pagetype != 2) { ?>
        <p><b>Disponibile a cambiare turno: </b></p>
        <p><?php echo $row["disponibile_cambio_turno"]; ?></p>
        <?php }
        if ($pagetype == 5 || $pagetype == 6) { ?>
        <p><b>Segnala questo <?php echo $set['set_nome_collettivo'] ?> come non adatto:</b></p>
        <?php if ($pagetype == 5) { ?>
        <a style="border-radius: 25px;" href="javascript:funzioneSegnala(<?php echo $row["id"]; ?>)" class="btn waves-effect waves-light btn center orange">Segnala</a>
      <?php } else { ?>
        <a style="border-radius: 25px;" href="javascript:AnnullaSegnala(<?php echo $row["id"]; ?>)" class="btn waves-effect waves-light btn center orange">Annulla</a>
        <p>Questo <?php echo $set['set_nome_collettivo'] ?> è già stato segnalato in precedenza da <?php if ($row["segnalatoda"] == $_SESSION["id_coge"]) {
        ?> te.<?php
        } else {
          $segnalatore = $row['segnalatoda'];
          $sql = "SELECT * FROM users_cogestione WHERE id = '".$segnalatore."'";
          $users = mysqli_query($link, $sql);
          $row = mysqli_fetch_assoc($users);
          print '<b>'.$row['username'].'</b>';
        }} ?></p>

        <p><b>Modifica <?php echo $set['set_nome_collettivo'] ?>: </b> </p>
        <a style="border-radius: 25px;" href="/admin/collettivi/modificacollettivo?id=<?php echo $row["id"]; ?>" class="btn waves-effect waves-light btn center">Modifica</a>
        <p> <b>Elimina <?php echo $set['set_nome_collettivo'] ?>: </b> </p>
        <p>Eliminando un <?php echo $set['set_nome_collettivo'] ?> lo andrai ad eliminare per tutti i turni in cui è stato proposto.</p>
        <a style="border-radius: 25px;" href="javascript:funzioneElimina(<?php echo $row['id']; ?>)" class="btn waves-effect waves-light btn center red">Elimina</a>
        <p><b>Visualizza iscritti a questo <?php echo $set['set_nome_collettivo'] ?>: </b> </p>
        <a style="border-radius: 25px;" href="/admin/users/iscrittiasingolo?id=<?php echo $row["id"]; ?>" class="btn waves-effect waves-light btn center yellow black-text">Iscritti</a>
        <?php } ?>
        <?php
        if ($pagetype == 7) {
        if ($row["segnalato"] == 'NO') { ?>
          <p><b>Segnala questo <?php echo $set['set_nome_collettivo'] ?> come non adatto:</b></p>
          <a style="border-radius: 25px;" href="javascript:Segnala(<?php echo $row["id"]; ?>)" class="btn waves-effect waves-light btn center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">Segnala</a>
        <?php }} ?>
        <?php if ($pagetype == 8) { ?>
        <p><b>Segnala questo <?php echo $set['set_nome_collettivo'] ?> come non adatto:</b></p>
        <p>Questo <?php echo $set['set_nome_collettivo'] ?> è già stato segnalato in precedenza da <?php if ($row["segnalatoda"] == $_SESSION["id_coge"]) {
        ?> te.</p>
        <a style="border-radius: 25px;" href="javascript:AnnullaSegnala(<?php echo $row["id"]; ?>)" class="btn waves-effect waves-light btn center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">Annulla segnalazione</a>
        <?php
        } else { ?> un altro moderatore.</p>
        <p><i>Non puoi togliere la segnalazione da un <?php echo $set['set_nome_collettivo'] ?> non segnalato da te.</i></p>
        <?php }} ?>
        <?php if ($pagetype == 9) { ?>
        <p><b>Annulla eliminazione <?php echo $set['set_nome_collettivo'] ?></b></p>
        <a style="border-radius: 25px;" href="javascript:Elimina(<?php echo $row['id']; ?>)" class="btn waves-effect waves-light btn center <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text">Annulla</a>
        <?php } ?>
      </div>
    </div></div>
<?php } ?>
