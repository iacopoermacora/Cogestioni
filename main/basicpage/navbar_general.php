<!--Inizio Navbar-->
<div class="navbar-fixed">
<nav class="<?php echo $set['set_colore_base']; ?> z-depth-0">
  <div class="nav-wrapper container">
    <a href="/index" style="font-size: 16px;" class="hide-on-med-and-up brand-logo <?php echo $set['set_colore_base_scritte']; ?>-text"><?php echo $set['set_nome_scuola']; ?></a>
    <a href="/index" style="font-size: 25px;" class="hide-on-small-only brand-logo <?php echo $set['set_colore_base_scritte']; ?>-text"><?php echo $set['set_nome_scuola']; ?></a>
    <a href="#" data-target="mobile-links" class="sidenav-trigger"><i class="material-icons <?php echo $set['set_colore_base_scritte']; ?>-text">menu</i></a>
    <ul class="right hide-on-med-and-down">
    <?php if ($set['set_status_cogestione'] == 'cogestione_hidden') {
          } elseif ($set['set_status_cogestione'] == 'cogestione_form') { ?>
      <li><a style="border-radius: 20px;" class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/main/formcogestione"><?php echo ucfirst($set['set_nome_cogestione']); ?></a></li>
    <?php } elseif ($set['set_status_cogestione'] == 'cogestione_on_hold') { ?>
      <li><a style="border-radius: 20px;" class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/main/cogestioneonhold"><?php echo ucfirst($set['set_nome_cogestione']); ?></a></li>
    <?php } elseif ($set['set_status_cogestione'] == 'cogestione_only_view' || $set['set_status_cogestione'] == 'cogestione_open' || $set['set_status_cogestione'] == 'cogestione_momentaneamente_chiusa' || $set['set_status_cogestione'] == 'cogestione_chiusa') { ?>
      <li><a style="border-radius: 20px;" class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/index">Home</a></li>
      <?php
        if($_SESSION["loggedin_coge"] == true) {
       ?>
      <li><a style="border-radius: 20px;" class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/iscrizionipersonali">Iscrizioni</a></li>
      <?php } ?>
      <li><a style="border-radius: 20px;" class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/main/infocogestione">Info</a></li>
    <?php } ?>
    <?php
      if($_SESSION["loggedin_coge"] == true) {
        if($_SESSION["ruolo_coge"] == "professore" || $_SESSION["ruolo_coge"] == "professore_admin") {
          if ($set['set_status_cogestione'] == "cogestione_chiusa") {
        ?>
        <li><a style="border-radius: 20px;" class="waves-effect waves-light btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="/main/docenti/appello.php">APPELLO</a></li>
        <?php
        }}}
    ?>
    <?php
      if($_SESSION["loggedin_coge"] == true) {
        if($_SESSION["ruolo_coge"] == "professore_admin") {
          if ($set['set_status_cogestione'] == "cogestione_form" || $set['set_status_cogestione'] == "cogestione_on_hold") {
        ?>
        <li><a style="border-radius: 20px;" class="waves-effect waves-light btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="/main/docenti/approvazione_cogestione">ADMIN</a></li>
        <?php
        }}}
    ?>
    <?php
      if($_SESSION["loggedin_coge"] == true) {
        if($_SESSION["ruolo_coge"] == "studente_admin") {
        ?>
        <li><a style="border-radius: 20px;" class="waves-effect waves-light btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="/admin/admincogestione">ADMIN</a></li>
        <?php
        }}
    ?>
      <?php
      if($_SESSION["loggedin_coge"] == true) {

        ?>
        <li><a style="border-radius: 20px;" class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/main/system/logout">LOGOUT</a></li>
        <?php

        } else {
        ?>
        <li><a style="border-radius: 20px;" class="waves-effect waves-light btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="/main/system/login">Login</a></li>
        <?php
        }
        ?>
    </ul>
  </div>
</nav>
</div>
       <ul class="sidenav" id="mobile-links">
         <?php if ($set['set_status_cogestione'] == 'cogestione_hidden') {
               } elseif ($set['set_status_cogestione'] == 'cogestione_form') { ?>
           <li><a style="border-radius: 20px;" href="/main/formcogestione">Cogestione</a></li>
         <?php } elseif ($set['set_status_cogestione'] == 'cogestione_on_hold') { ?>
           <li><a style="border-radius: 20px;" href="/main/cogestioneonhold">Cogestione</a></li>
         <?php } elseif ($set['set_status_cogestione'] == 'cogestione_only_view' || $set['set_status_cogestione'] == 'cogestione_open' || $set['set_status_cogestione'] == 'cogestione_momentaneamente_chiusa' || $set['set_status_cogestione'] == 'cogestione_chiusa') { ?>
           <li><a style="border-radius: 20px;" href="/index">Home</a></li>
           <?php
             if($_SESSION["loggedin_coge"] == true) {
            ?>
           <li><a style="border-radius: 20px;" href="/iscrizionipersonali">Iscrizioni</a></li>
           <?php } ?>
           <li><a style="border-radius: 20px;" href="/main/infocogestione">Info</a></li>
         <?php } ?>
         <?php
           if($_SESSION["loggedin_coge"] == true) {
             if($_SESSION["ruolo_coge"] == "professore" || $_SESSION["ruolo_coge"] == "professore_admin") {
               if ($set['set_status_cogestione'] == "cogestione_chiusa") {
             ?>
             <li><a style="border-radius: 20px;" class="waves-effect waves-light btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="/main/docenti/appello.php">APPELLO</a></li>
             <?php
             }}}
         ?>
         <?php
           if($_SESSION["loggedin_coge"] == true) {
             if($_SESSION["ruolo_coge"] == "professore_admin") {
               if ($set['set_status_cogestione'] == "cogestione_form" || $set['set_status_cogestione'] == "cogestione_on_hold") {
               ?>
               <li><a style="border-radius: 20px;" class="waves-effect waves-light btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="/main/docenti/approvazione_cogestione">ADMIN</a></li>
               <?php
               }}}
         ?>
         <?php
           if($_SESSION["loggedin_coge"] == true) {
             if($_SESSION["ruolo_coge"] == "studente_admin") {
             ?>
             <li><a style="border-radius: 20px;" class="waves-effect waves-light btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="/admin/admincogestione">ADMIN</a></li>
             <?php
             }}
         ?>
           <?php
           if($_SESSION["loggedin_coge"] == true) {

             ?>
             <li><a style="border-radius: 20px;" href="/main/system/logout">LOGOUT</a></li>
             <?php

             } else {
             ?>
             <li><a style="border-radius: 20px;" class="waves-effect waves-light btn <?php echo $set['set_colore_bottoni']; ?> <?php echo $set['set_colore_bottoni_scritte']; ?>-text" href="/main/system/login">Login</a></li>
             <?php
             }
             ?>
        </ul>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>  $(document).ready(function(){
$('.sidenav').sidenav();
$(".dropdown-trigger").dropdown();
})
</script>
