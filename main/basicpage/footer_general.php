<!--Footer inizio-->
<footer class="page-footer <?php echo $set['set_colore_base']; ?>">
  <div class="container">
    <p><?php echo ucfirst($set['set_intestazione_sito']); ?></p>
  </div>
  <div class="footer-copyright">
    <div class="container">
      <p>Sviluppato con <3 da <a style="text-decoration: underline;" class="white-text" href="mailto: iacopo01@gmail.com">Iacopo Ermacora</a></p>
      <a href="https://www.iubenda.com/privacy-policy/92968300" class="iubenda-black iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
      <a href="https://www.iubenda.com/termini-e-condizioni/92968300" class="iubenda-black iubenda-noiframe iubenda-embed iubenda-noiframe " title="Termini e Condizioni ">Termini e Condizioni</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
    </div>
  </div>
</footer>

<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="/js/materialize.min.js"></script>

<?php
mysqli_close($link);
?>
