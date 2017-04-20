</main>

<!-- Footer -->
<footer>
  <div class="container-fluid">
    <div class="row">
      <div class="footer-top">
        <ul class="list-inline text-center">
          <li><a class="btn social-icon" href="https://www.facebook.com/Friteam/?fref=ts" target="_blank" role="button"><i class="fa fa-facebook"></i></a></li>
          <li><a class="btn social-icon" href="https://twitter.com/provencebooster?lang=fr" target="_blank" role="button"><i class="fa fa-twitter"></i></a></li>
          <li><a class="btn social-icon" href="https://www.instagram.com/provence_booster/" target="_blank" role="button"><i class="fa fa-instagram"></i></a></li>
          <li><a class="btn social-icon" href="https://www.youtube.com/channel/UCavDn2zM6Hc9HwpHpiTdT9w" target="_blank" role="button"><i class="fa fa-youtube-play"></i></a></li>
        </ul>
      </div>

      <div class="ligne"></div>

      <div class="footer-bottom text-center">
        <ul class="list-inline text-center">
          <li><a class="text-footer" href="#" role="button">Nos Partenaires</a></li>
          <li><a class="text-footer" href="#" role="button">Termes Et Conditions</a></li>
          <li><a class="text-footer" href="#" role="button">Mentions Légales</a></li>
        </ul>
        <ul class="list-inline text-center">
          <li><a class="text-footer" href="<?php echo $this->url('users_login') ?>" role="button">Connexion Administrateurs</a></li>
        </ul>
      </div>

    </div>
  </div>
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
        <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/jquery.easing.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/bootstrap.js') ?>"></script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/script.js') ?>"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.1/jquery.autocomplete.min.js"></script>
        <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    </body>
</html>
