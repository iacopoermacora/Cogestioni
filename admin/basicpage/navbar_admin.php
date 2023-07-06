<div class="navbar-fixed hide-on-large-only">
<nav>
  <div class="nav-wrapper <?php echo $set['set_colore_base']; ?>">
    <div class="container">
    <a href="/admin/admincogestione" class="brand-logo">ADMIN</a>
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </div>
</nav>
</div>

<ul id="slide-out" class="sidenav sidenav-fixed <?php echo $set['set_colore_base']; ?>">
      <li><a class="subheader <?php echo $set['set_colore_base_scritte']; ?>-text marginetto_sotto"><h3>Admin</h3></a></li>
      <li <?php if($_SERVER['SCRIPT_NAME']=="/admin/admincogestione.php") { echo 'class="active"'; } ?>><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/admincogestione"><i class="material-icons <?php echo $set['set_colore_base_scritte']; ?>-text">home</i>Home</a></li>
      <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/users/upload_users_coge.php" || $_SERVER['SCRIPT_NAME']=="/admin/users/admin_users_coge.php" || $_SERVER['SCRIPT_NAME']=="/admin/users/assegnaruoli.php" || $_SERVER['SCRIPT_NAME']=="/admin/users/pre_autoiscrizioni.php" || $_SERVER['SCRIPT_NAME']=="/admin/users/downloadsusers.php"){ echo 'active '.$set['set_colore_base']; } ?>">
            <a style="padding-left: 30px;" class="collapsible-header <?php echo $set['set_colore_base_scritte']; ?>-text"><i class="material-icons <?php echo $set['set_colore_base_scritte']; ?>-text">person</i>Users<i class="material-icons right <?php echo $set['set_colore_base_scritte']; ?>-text">arrow_drop_down</i></a>
            <div class="collapsible-body <?php echo $set['set_colore_base']; ?>">
              <ul>
                <li  class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/users/upload_users_coge.php"){ echo $set['set_colore_base'].' darken-1';} ?>"><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/users/upload_users_coge"><i style="margin-left: 30px;" class="material-icons tiny <?php echo $set['set_colore_base_scritte']; ?>-text">play_arrow</i>Aggiungi utenti</a></li>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/users/admin_users_coge.php"){ echo $set['set_colore_base'].' darken-1';} ?>"><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/users/admin_users_coge"><i style="margin-left: 30px;" class="material-icons tiny <?php echo $set['set_colore_base_scritte']; ?>-text">play_arrow</i>Gestisci utenti</a></li>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/users/assegnaruoli.php"){ echo $set['set_colore_base'].' darken-1';} ?>"><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/users/assegnaruoli"><i style="margin-left: 30px;" class="material-icons tiny <?php echo $set['set_colore_base_scritte']; ?>-text">play_arrow</i>Gestisci STAFF</a></li>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/users/pre_autoiscrizioni.php"){ echo $set['set_colore_base'].' darken-1';} ?>"><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/users/pre_autoiscrizioni"><i style="margin-left: 30px;" class="material-icons tiny <?php echo $set['set_colore_base_scritte']; ?>-text">play_arrow</i>Autoiscrizioni</a></li>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/users/downloadsusers.php"){ echo $set['set_colore_base'].' darken-1';} ?>"><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/users/downloadsusers"><i style="margin-left: 30px;" class="material-icons tiny <?php echo $set['set_colore_base_scritte']; ?>-text">play_arrow</i>Downloads Users</a></li>
              </ul>
            </div>
          </li>
          <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/collettivi/admincollettivi.php" || $_SERVER['SCRIPT_NAME']=="/admin/collettivi/admincollettivieliminati.php" || $_SERVER['SCRIPT_NAME']=="/admin/collettivi/downloadscollettivi.php" || $_SERVER['SCRIPT_NAME']=="/admin/collettivi/appello_admin.php"){ echo 'active '.$set['set_colore_base']; } ?>">
            <a style="padding-left: 30px;" class="collapsible-header <?php echo $set['set_colore_base_scritte']; ?>-text"><i class="material-icons <?php echo $set['set_colore_base_scritte']; ?>-text">book</i><?php echo ucfirst($set['set_nome_collettivi']); ?><i class="material-icons right <?php echo $set['set_colore_base_scritte']; ?>-text">arrow_drop_down</i></a>
            <div class="collapsible-body <?php echo $set['set_colore_base']; ?>">
              <ul>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/collettivi/admincollettivi.php"){ echo $set['set_colore_base'].' darken-1';} ?>"><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/collettivi/admincollettivi"><i style="margin-left: 30px; word-wrap: break-word;" class="material-icons tiny <?php echo $set['set_colore_base_scritte']; ?>-text">play_arrow</i>Gestisci <?php echo ucfirst($set['set_nome_collettivi']); ?></a></li>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/collettivi/admincollettivieliminati.php"){ echo $set['set_colore_base'].' darken-1'; } ?>"><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/collettivi/admincollettivieliminati"><i style="margin-left: 30px;" class="material-icons tiny <?php echo $set['set_colore_base_scritte']; ?>-text">play_arrow</i><?php echo ucfirst($set['set_nome_collettivi']); ?> Eliminati</a></li>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/collettivi/appello_admin.php"){ echo $set['set_colore_base'].' darken-1';} ?>"><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/collettivi/appello_admin"><i style="margin-left: 30px;" class="material-icons tiny <?php echo $set['set_colore_base_scritte']; ?>-text">play_arrow</i>Appello</a></li>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/collettivi/downloadscollettivi.php"){ echo $set['set_colore_base'].' darken-1'; } ?>"><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/collettivi/downloadscollettivi.php"><i style="margin-left: 30px;" class="material-icons tiny <?php echo $set['set_colore_base_scritte']; ?>-text">play_arrow</i>Downloads <?php echo ucfirst($set['set_nome_collettivi']); ?></a></li>
              </ul>
            </div>
          </li>
          <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/collettivi/questionario_gradimento_results.php"){ echo 'active '.$set['set_colore_base']; } ?>">
            <a style="padding-left: 30px;" class="collapsible-header <?php echo $set['set_colore_base_scritte']; ?>-text"><i class="material-icons <?php echo $set['set_colore_base_scritte']; ?>-text">shuffle</i>Others<i class="material-icons right <?php echo $set['set_colore_base_scritte']; ?>-text">arrow_drop_down</i></a>
            <div class="collapsible-body <?php echo $set['set_colore_base']; ?>">
              <ul>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=="/admin/collettivi/questionario_gradimento_results.php"){ echo $set['set_colore_base'].' darken-1';} ?>"><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/collettivi/questionario_gradimento_results"><i style="margin-left: 30px; word-wrap: break-word;" class="material-icons tiny <?php echo $set['set_colore_base_scritte']; ?>-text">play_arrow</i>Questionario finale</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
      <li <?php if($_SERVER['SCRIPT_NAME']=="/admin/settings/settingvariabili.php") { echo 'class="active"'; } ?>><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/admin/settings/settingvariabili"><i class="material-icons <?php echo $set['set_colore_base_scritte']; ?>-text">settings</i>Settings</a></li>
      <li><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" target=”_blank” href="https://iacopoermacora.notion.site/Cogestioni-Support-ab4191827a474b13946d2175afd96ed7"><i class="material-icons <?php echo $set['set_colore_base_scritte']; ?>-text">help</i>Support</a></li>
      <hr>
      <li><a class="<?php echo $set['set_colore_base_scritte']; ?>-text" href="/"><i class="material-icons <?php echo $set['set_colore_base_scritte']; ?>-text">arrow_back</i>Torna al sito</a></li>
    </ul>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
  })
</script>

<style media="screen">
header, body, footer {
    padding-left: 300px;
  }

  @media only screen and (max-width : 992px) {
    header, body, footer {
      padding-left: 0;
    }
  }
</style>
