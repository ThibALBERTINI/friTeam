<?php

  $objetVideoModel = new \Model\VideoModel;
  $tabResult = $objetVideoModel->findAll("id", "ASC");

  if(!empty($tabResult))
  {
    foreach ($tabResult as $index => $tabInfo)
    {
      $contenu_friteam = $tabInfo["contenu_friteam"];
      $url_video       = $tabInfo["url_video"];
    }
  }

  // echo "<pre>";
  // var_dump($url_video);
  // echo "</pre>";

?>


    <!-- Qui Sommes-Nous ? -->
    <div class="container-fluid qui-sommes-nous" id="qui-sommes-nous">
      <div class="row">

        <!-- Texte Friteam -->
        <div class="col-sm-12 col-md-6">
          <h2 class="text-center">FRI TEAM C'est Quoi ?</h2>

          <div class="ligne"></div>

          <div>
            <?php echo $contenu_friteam; ?>
          </div>

          <!-- Bouton -->
          <div class="text-center bouton-formation">
            <a class="btn btn-default" href="<?php echo $this->url('default_formation') ?>" role="button">Voir Nos Formations</a>
          </div>
        </div>


        <!-- Video Friteam -->
        <div class="video col-xs-12 col-md-6 col-lg-5">
          <iframe class="popup" src="<?php echo $url_video; ?>" frameborder="0" allowfullscreen></iframe>
        </div>

      </div>
    </div>





    <!-- Nos Points Forts -->
    <div class="container-fluid points-forts">
      <div class="row">
        <!-- Titre Section -->
        <h2 class="text-center">Nos Points Forts</h2>

        <div class="ligne"></div>

        <?php

        $objetPointModel = new \Model\PointModel;
        $tabResult = $objetPointModel->findAll("id", "ASC");

        if(!empty($tabResult))
        {
          foreach($tabResult as $index => $tabInfo)
          {
            $titre_point = $tabInfo["titre_point"];
            $contenu_point = $tabInfo["contenu_point"];

            echo
<<<CODEHTML



        <!-- Les Points Forts -->
        <div class="col-xs-12 col-md-4 point-fort">
          <span><i class="fa fa-star" aria-hidden="true"></i></span>
          <h3>$titre_point</h3>
          <p>
            $contenu_point
          </p>
        </div>
CODEHTML;
          }
        }

        ?>
      </div>
    </div>


    <!-- NEWSLETTER -->

   <section>
     <!-- <h2>h2 de Views/partials/section-home</h2> -->


     <div class="container-fluid newsletter">
        <div class="centrer">
           <h2 class="h3-section-home text-center">Notre catalogue de formation</h2>

           <div class="ligne"></div>

           <p class="text-center">
              Pour recevoir notre catalogue, veuillez remplir le formulaire ci-dessous
           </p>

           <form class="form-ajax col-xs-12 col-md-6 col-md-offset-3 form-contact" method="GET" action="piege-a-hacker.php">
              <div class="form-group">
               <label for="email"></label>
               <input type="email" name="email" required placeholder="Entrez une adresse mail valide" class="form-control" id="email">
              </div>
             <button class="catalogue-newsletter" type="submit">Recevoir le catalogue !</button>

           <!-- INFOS TECHNIQUES -->
           <input type="hidden" name="operation" value="newsletter">
           <div class="message"></div>
       </form>
     </div>
   </div>
   </section>




    <!-- TEMOIGNAGES -->
    <div class="container-fluid temoignages">
        <h2 class="text-center">Témoignages</h2>

        <div class="ligne"></div>

        <!-- Carousel -->
        <div class='row'>
            <div class='col-md-offset-2 col-md-8'>
                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                    <!-- Bottom Carousel Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#quote-carousel" data-slide-to="1"></li>
                        <li data-target="#quote-carousel" data-slide-to="2"></li>
                        <li data-target="#quote-carousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Carousel Slides / Quotes -->
                    <div class="carousel-inner" role="listbox">

                      <?php

                      $objetTemoignageModel = new \Model\TemoignageModel;
                      $tabResult = $objetTemoignageModel->findAll("id", "ASC");

                      if(!empty($tabResult))
                      {
                        $i = 0 ;
                        foreach($tabResult as $index => $tabInfo)
                        {
                          $img = $tabInfo["img"];
                          $temoignage_temoignage = $tabInfo["temoignage_temoignage"];
                          $entreprise_temoignage = $tabInfo["entreprise_temoignage"];
                          $nom_temoignage = $tabInfo["nom_temoignage"];
                          $alt = $tabInfo["alt"];

                          $cheminAsset = $this->assetUrl("/");
                          if($i==0)
                          {
                            ?>

                          <div class="item active">
                            <blockquote>
                              <div class="row">
                                <div class="col-sm-3 text-center">
                                  <img class="img-circle" src="<?php echo $cheminAsset. "/" .$img; ?>" alt="<?php echo $alt; ?>">
                                </div>
                                <div class="col-sm-9">
                                  <p><?php echo $temoignage_temoignage; ?></p>
                                  <span class="nom"><?php echo $nom_temoignage; ?></span>
                                  <span class="companie"><?php echo $entreprise_temoignage; ?></span>
                                </div>
                              </div>
                            </blockquote>
                          </div>

                          <?php

                          $i++;
                          }
                          else
                          {

                          ?>

                          <div class="item">
                            <blockquote>
                              <div class="row">
                                <div class="col-sm-3 text-center">
                                  <img class="img-circle" src="<?php echo $cheminAsset. '/' .$img; ?>" alt="<?php echo $alt; ?>">
                                </div>
                                <div class="col-sm-9">
                                  <p><?php echo $temoignage_temoignage; ?></p>
                                  <span class="nom"><?php echo $nom_temoignage; ?></span>
                                  <span class="companie"><?php echo $entreprise_temoignage; ?></span>
                                </div>
                              </div>
                            </blockquote>
                          </div>
<?php

                          }
                        }
                      }
?>
                    </div>


        <!-- Carousel Buttons Next/Prev -->
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>

<div class="ligne"></div>

<!-- partenaires -->
<section>
  <div class="container-fluid temoignages">
      <h2 class="text-center">Nos Partenaires</h2>

      <div class="ligne"></div>

      <div class="row row-centered">
        <?php
        $objetPartenaireModel = new \Model\PartenaireModel;
        $tabResult = $objetPartenaireModel->findAll("id", "ASC");

        if(!empty($tabResult))
        {
          foreach ($tabResult as $index => $tabInfo)
          {
            $img = $tabInfo["img"];
            $lien = $tabInfo["lien"];
            $alt = $tabInfo["alt"];

            $cheminAsset = $this->assetUrl("/");

        ?>

        <div class="col-xs-12 col-md-4">
        <div class="test">
            <div class="partenaire-img">
              <a href="<?php echo $lien; ?>"><img src="<?php echo $cheminAsset. "/" .$img; ?>" alt="<?php echo $alt; ?>"></a>
            </div>
          </div>
        </div>

        <?php

      }
    }

        ?>
      </div>
</section>
