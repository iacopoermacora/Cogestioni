<!--Bottoni turni mobile-->
  <div class="row spazietto_sopra">
    <?php if ($set['set_numero_giorni'] > 0) { ?>
    <div class="row hide-on-large-only">
    <p class=" col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> right-align"><b><?php echo $set['set_giorno1_cogestione']; ?>:</b></p>
    <div class="col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> center"><a href="?turno=t1" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T1</a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t2" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T2</a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] <= 2) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t3" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T3</a></div>
    </div>
    <?php } ?>
    <?php if ($set['set_numero_giorni'] > 1) { ?>
    <div class="row hide-on-large-only">
    <p class=" col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> right-align"><b><?php echo $set['set_giorno2_cogestione']; ?>:</b></p>
    <div class="col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> center"><a href="?turno=t<?php if ($set['set_turni_per_giorno'] == 1) { $inizio_2riga = 2; } elseif ($set['set_turni_per_giorno'] == 2) { $inizio_2riga = 3; } elseif ($set['set_turni_per_giorno'] == 3) { $inizio_2riga = 4; } echo $inizio_2riga; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga; ?></a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t<?php echo $inizio_2riga+1; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga+1; ?></a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] <= 2) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t<?php echo $inizio_2riga+2; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga+2; ?></a></div>
    </div>
    <?php } ?>
    <?php if ($set['set_numero_giorni'] > 2) { ?>
    <div class="row hide-on-large-only">
    <p class=" col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> right-align"><b><?php echo $set['set_giorno3_cogestione']; ?>:</b></p>
    <div class="col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> center"><a href="?turno=t<?php if ($set['set_turni_per_giorno'] == 1) { $inizio_3riga = 3; } elseif ($set['set_turni_per_giorno'] == 2) { $inizio_3riga = 5; } elseif ($set['set_turni_per_giorno'] == 3) { $inizio_3riga = 7; } echo $inizio_3riga; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_3riga; ?></a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t<?php echo $inizio_3riga+1; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_3riga+1; ?></a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] <= 2) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t<?php echo $inizio_3riga+2; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_3riga+2; ?></a></div>
    </div>
    <?php } ?>
    <?php if ($set['set_numero_giorni'] > 3) { ?>
    <div class="row hide-on-large-only">
    <p class=" col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> right-align"><b><?php echo $set['set_giorno4_cogestione']; ?>:</b></p>
    <div class="col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> center"><a href="?turno=t<?php if ($set['set_turni_per_giorno'] == 1) { $inizio_4riga = 4; } elseif ($set['set_turni_per_giorno'] == 2) { $inizio_4riga = 7; } elseif ($set['set_turni_per_giorno'] == 3) { $inizio_4riga = 10; } echo $inizio_4riga; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_4riga; ?></a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t<?php echo $inizio_4riga+1; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_4riga+1; ?></a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] <= 2) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t<?php echo $inizio_4riga+2; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_4riga+2; ?></a></div>
    </div>
    <?php } ?>
    <?php if ($set['set_numero_giorni'] > 4) { ?>
    <div class="row hide-on-large-only">
    <p class=" col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> right-align"><b><?php echo $set['set_giorno5_cogestione']; ?>:</b></p>
    <div class="col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> center"><a href="?turno=t<?php if ($set['set_turni_per_giorno'] == 1) { $inizio_5riga = 5; } elseif ($set['set_turni_per_giorno'] == 2) { $inizio_5riga = 9; } elseif ($set['set_turni_per_giorno'] == 3) { $inizio_5riga = 13; } echo $inizio_5riga; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_5riga; ?></a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t<?php echo $inizio_5riga+1; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_5riga+1; ?></a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] <= 2) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t<?php echo $inizio_5riga+2; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_5riga+2; ?></a></div>
    </div>
    <?php } ?>
    <?php if ($set['set_numero_giorni'] > 5) { ?>
    <div class="row hide-on-large-only">
    <p class=" col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> right-align"><b><?php echo $set['set_giorno6_cogestione']; ?>:</b></p>
    <div class="col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> center"><a href="?turno=t<?php if ($set['set_turni_per_giorno'] == 1) { $inizio_6riga = 6; } elseif ($set['set_turni_per_giorno'] == 2) { $inizio_6riga = 11; } elseif ($set['set_turni_per_giorno'] == 3) { $inizio_6riga = 16; } echo $inizio_6riga; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_6riga; ?></a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t<?php echo $inizio_6riga+1; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_6riga+1; ?></a></div>
    <div class="<?php if ($set['set_turni_per_giorno'] <= 2) { ?>hide<?php } ?> col <?php if ($set['set_turni_per_giorno'] == 1) { ?>s6<?php } elseif ($set['set_turni_per_giorno'] == 2) { ?>s4<?php } elseif ($set['set_turni_per_giorno'] == 3) { ?>s3<?php } ?> left-align"><a href="?turno=t<?php echo $inizio_6riga+2; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_6riga+2; ?></a></div>
    </div>
    <?php } ?>
  </div>


<!--Bottoni turni desktop-->
<div class="row hide-on-med-and-down">
  <?php if ($set['set_numero_giorni'] >= 1) { ?><p class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>l12<?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>l6<?php } ?>
  <?php if ($set['set_numero_giorni'] == 3 || $set['set_numero_giorni'] >= 4) { ?>l4<?php } ?>
   center"><b><?php echo $set['set_giorno1_cogestione']; ?>:</b></p><?php } ?>
  <?php if ($set['set_numero_giorni'] >= 2) { ?><p class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>l12<?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>l6<?php } ?>
  <?php if ($set['set_numero_giorni'] == 3 || $set['set_numero_giorni'] >= 4) { ?>l4<?php } ?>
   center"><b><?php echo $set['set_giorno2_cogestione']; ?>:</b></p><?php } ?>
  <?php if ($set['set_numero_giorni'] >= 3) { ?><p class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>l12<?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>l6<?php } ?>
  <?php if ($set['set_numero_giorni'] == 3 || $set['set_numero_giorni'] >= 4) { ?>l4<?php } ?>
   center"><b><?php echo $set['set_giorno3_cogestione']; ?>:</b></p><?php } ?>
</div>
<div class="row hide-on-med-and-down">

  <div class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l12 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l6 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l4 right-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l6 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l3 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 right-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] >= 3) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l4 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 right-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t1" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T1</a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l6 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l4 center<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l6 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l3 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 center<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] >= 3) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l4 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 center<?php } ?>
  <?php } ?>
  "><a href="?turno=t2" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T2</a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l4 left-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l3 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 left-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] >= 3) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l4 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 left-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t3" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T3</a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l3 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 right-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] >= 3) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 right-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t4" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T4</a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 center<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] >= 3) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 center<?php } ?>
  <?php } ?>
  "><a href="?turno=t5" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T5</a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 left-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] >= 3) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 left-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t6" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T6</a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] >= 3) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 right-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t7" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T7</a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] >= 3) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 center<?php } ?>
  <?php } ?>
  "><a href="?turno=t8" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T8</a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 1) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 2) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] >= 3) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 left-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t9" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T9</a></div>
</div>

<!--Bottoni turni desktop-->
<div class="row <?php if ($set['set_numero_giorni'] < 4) { ?>hide<?php } ?> hide-on-med-and-down">
  <?php if ($set['set_numero_giorni'] >= 4) { ?><p class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>l12<?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>l6<?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>l4<?php } ?>
   center"><b><?php echo $set['set_giorno4_cogestione']; ?>:</b></p><?php } ?>
  <?php if ($set['set_numero_giorni'] >= 5) { ?><p class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>l12<?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>l6<?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>l4<?php } ?>
   center"><b><?php echo $set['set_giorno5_cogestione']; ?>:</b></p><?php } ?>
  <?php if ($set['set_numero_giorni'] >= 6) { ?><p class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>l12<?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>l6<?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>l4<?php } ?>
   center"><b><?php echo $set['set_giorno6_cogestione']; ?>:</b></p><?php } ?>
</div>
<div class="row <?php if ($set['set_numero_giorni'] < 4) { ?>hide<?php } ?> hide-on-med-and-down">

  <div class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l12 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l6 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l4 right-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l6 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l3 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 right-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l4 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 right-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t<?php if ($set['set_turni_per_giorno'] == 1) { $inizio_2riga = 4; } elseif ($set['set_turni_per_giorno'] == 2) { $inizio_2riga = 7; } elseif ($set['set_turni_per_giorno'] == 3) { $inizio_2riga = 10; } echo $inizio_2riga; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga; ?></a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l6 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l4 center<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l6 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l3 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 center<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l4 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 center<?php } ?>
  <?php } ?>
  "><a href="?turno=t<?php echo $inizio_2riga+1; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga+1; ?></a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l4 left-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l3 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 left-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>l4 center<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 left-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t<?php echo $inizio_2riga+2; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga+2; ?></a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l3 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 right-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 right-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t<?php echo $inizio_2riga+3; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga+3; ?></a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 center<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 right-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 center<?php } ?>
  <?php } ?>
  "><a href="?turno=t<?php echo $inizio_2riga+4; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga+4; ?></a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 left-align<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>l2 left-align<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 left-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t<?php echo $inizio_2riga+5; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga+5; ?></a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 right-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t<?php echo $inizio_2riga+6; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga+6; ?></a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l2 center<?php } ?>
  <?php } ?>
  "><a href="?turno=t<?php echo $inizio_2riga+7; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga+7; ?></a></div>
  <div class="col
  <?php if ($set['set_numero_giorni'] == 4) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 5) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>hide<?php } ?>
  <?php } ?>
  <?php if ($set['set_numero_giorni'] == 6) { ?>
    <?php if ($set['set_turni_per_giorno'] == 1) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 2) { ?>hide<?php } ?>
    <?php if ($set['set_turni_per_giorno'] == 3) { ?>l1 left-align<?php } ?>
  <?php } ?>
  "><a href="?turno=t<?php echo $inizio_2riga+8; ?>" class="waves-effect waves-light btn z-depth-1 <?php echo $set['set_colore_bottoni']; ?>  <?php echo $set['set_colore_bottoni_scritte']; ?>-text">T<?php echo $inizio_2riga+8; ?></a></div>
</div>
