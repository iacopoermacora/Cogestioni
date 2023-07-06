<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/settings/variabili.php'; ?>
<!--Footer inizio-->
<footer class="page-footer hide-on-large-only <?php echo $set['set_colore_base']; ?>">
  <div class="footer-copyright">
    <div class="container">
      <?php echo ucfirst($set['set_nome_cogestione']); ?> - Pannello Admin
    </div>
  </div>
</footer>

<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="/js/materialize.min.js"></script>

<?php
mysqli_close($link);
?>
