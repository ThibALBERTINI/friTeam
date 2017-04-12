</main>
        <footer>
            <p>tous droits réservés</p>
        </footer>

        <!-- CHARGER JQUERY AVANT MON CODE -->
        <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"></script>
  
          <script type="text/javascript">
// PASSER DES INFOS DE PHP VERS JAVASCRIPT
var urlAjax = '<?php echo $this->url("default_ajax"); ?>';

          </script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/jquery-3.2.0.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/bootstrap.js') ?>"></script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/script.js') ?>"></script>
    </body>
</html>