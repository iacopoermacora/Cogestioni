<div class="main_hero_and_content">
  <div style="height: 50vh;" class="<?php echo $set['set_colore_base']; ?>">

    <script>
      $(document).ready(function(){
        var str = "<?php echo $set['set_colore_base']; ?>";
        var res = str.replace(" ", ".");
        $("path").attr("fill",$('.' + res).css("backgroundColor"));
      });
    </script>

  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill-opacity="1" d="M0,192L60,208C120,224,240,256,360,256C480,256,600,224,720,192C840,160,960,128,1080,144C1200,160,1320,224,1380,256L1440,288L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
  </svg>
  <section style="position: absolute; top: 0px;" class="main_hero">
    <div>
      <div class="row">
        <img class="row" src="/images/base/<?php if ($_SERVER['PHP_SELF'] == '/iscrizionipersonali.php') {
          echo 'iscrizioni';
        } elseif ($_SERVER['PHP_SELF'] == '/main/infocogestione.php') {
          echo 'informazioni';
        } else {
          if ($set['set_nome_cogestione'] == 'cogestione') {
            echo 'cogestione';
          } else {
            echo 'autogestione';
          }
        } ?>.png">
      </div>
    </div>
  </section>
</div>
