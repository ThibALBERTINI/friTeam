
<?php

?>

<div class="container-fluid">
  <div class="row row-centered">
    <div class="col-xs-12 col-md-8  col-centered">
      <p class="introduction-formation"></p>
    </div>
  </div>
</div>

<form method="get" class="container formation text-center formation">
        <input type="text" class="form-control" name="recherche" id="recherche" placeholder="Chercher une formation"/><br>
        <button type="submit" class="btn btn-info">Rechercher</button><br><br>
        <a href="<?php echo $this->url('default_formation') ?>">Revenir au catalogue complet </a>
</form>

<div class="container carte-container">
  <div class="row row-centered">
 <!--On créé nos boutons pour filtrer les formations en fonction des categories-->
    <nav class="filtres container formation">
        <!-- chaque categorie, on créé le bouton qui correspond avec un attribut data-filter=".friteam" par exemple -->
        <!-- <span class="recherche">Formations : </span> -->
         <button data-filter="*" type="button" class="btn btn-default btn-formation">Toutes nos formations</button>
                <?php foreach($categs as $categ): ?>

         <button data-filter=".<?php echo strtolower($categ); ?>" type="button" class="btn btn-default btn-formation"><?= $categ ?></button>
        <?php endforeach; ?>
    </nav>


        <section class="text-center">
                    <div class="formation">
                        <div class="row formations">
                <?php foreach($tabResult as $formations => $formation): ?>
                    <!-- Attention, pour chaque <div> on rajoute les classes qui correspondent aux categories -->
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 <?php echo strtolower($formation['categorie_formation']); ?>">
                              <div class="carte-formation">
                                  <div class="image">
                                    <img src="<?php echo $this->assetUrl($formation['img']); ?>" alt="image-carte">
                                  </div>

                                  <div class="contenu">
                                    <h4><a href="<?php echo $this->url("default_formation-detail", ["url"=>$formation['url']]); ?>"><?php echo $formation['titre_formation']; ?></a></h4>
                                    <span class="icon"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $formation['date_formation']; ?></span>
                                    <span class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $formation['duree_formation']; ?></span>
                                    <div class="ligne"></div>
                                    <p class="resume"><?php echo $formation['chapo_formation']; ?></p>
                                    <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $formation['lieu_formation']; ?></span>
                                    <div class="text-center bouton-container">
                                      <a class="bouton" href="<?php echo $this->url("default_formation-detail", ["url"=>$formation['url']]); ?>">En Savoir Plus</a>
                                    </div>
                                  </div>
                              </div>
                            </div>
                <?php endforeach; ?>
                        </div>
                    </div>
        </section>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.1/jquery.autocomplete.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
 <script>

        // Utilisation de Isotope, on créé une variable $grid qui permet de gérer la liste des formations
        // avec isotope
        var $grid = $('.formations').isotope();

        // On dit que lorsqu'on clique sur les boutons qui se trouvent dans la nav qui a la classe filtres
        $('nav.filtres').on( 'click', 'button', function() {

            // On récupère la donnée qui est dans "data-filter" ("".friteam" ou ".complementaire" par exemple)
            var filterValue = $(this).attr('data-filter');
            // On demande à $grid (notre liste de formations gérée avec Isotope) de filtrer les formations
            // avec la catégorie demandée ( )
            $grid.isotope({ filter: filterValue });
        });
    
    </script>
