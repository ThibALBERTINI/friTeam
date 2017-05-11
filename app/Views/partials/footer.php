<?php

  $objetMentionModel = new \Model\MentionModel;
  $tabResult = $objetMentionModel->findAll("id", "ASC");

  if(!empty($tabResult))
  {
    foreach ($tabResult as $index => $tabInfo)
    {
      $contenu_mention = $tabInfo["contenu_mention"];
    }
  }

  $objetCguModel = new \Model\CguModel;
  $tabResult = $objetCguModel->findAll("id", "ASC");

  if(!empty($tabResult))
  {
    foreach ($tabResult as $index => $tabInfo)
    {
      $contenu_cgu = $tabInfo["contenu_cgu"];
    }
  }

  // echo "<pre>";
  // var_dump($url_video);
  // echo "</pre>";

?>

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
          <li><a class="btn social-icon" href="#" target="_blank" role="button"><i class="fa fa-linkedin"></i></a></li>
        </ul>
      </div>

      <div class="ligne"></div>

      <div class="footer-bottom text-center">
        <ul class="list-inline text-center">
          <li><a class="text-footer" href="#" role="button" data-toggle="modal" data-target="#myModal1">Conditions générales d'utilisation</a></li>

          <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Conditions générales d'utilisation</h4>
                </div>
                <div class="modal-body">
                <?php echo $contenu_cgu ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <li><a class="text-footer" href="#" role="button" data-toggle="modal" data-target="#myModal">Mentions Légales</a></li>

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Mentions Légales</h4>
                </div>
                <div class="modal-body">
                <?php echo $contenu_mention ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/jquery.easing.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/bootstrap.js') ?>"></script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/script.js') ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/fullcalendar.js') ?>"></script>
        <script type="text/javascript" src="<?php echo $this->assetUrl('js/gcal.js') ?>"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.1/jquery.autocomplete.min.js"></script>
        <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

        <script>
    $(document).ready(function() {
    $('#calendar').fullCalendar({
        googleCalendarApiKey: 'AIzaSyAj1Zrf1ckdml8FaC8GokT0Zg4XALHay6Q',
        events: {
            googleCalendarId: 'cmne630u9fcbuq5k1ve69ukbfg@group.calendar.google.com',
            className: 'gcal-event'
        }
    });
});
  </script>
    </body>
</html>
