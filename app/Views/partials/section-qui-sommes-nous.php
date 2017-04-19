<div class="container profil-container">
  <div class="row ">

<?php

$objetProfilModel = new \Model\ProfilModel;
$tabResult = $objetProfilModel->findAll("ordre_apparition", "ASC");

if(!empty($tabResult))
{
  foreach ($tabResult as $index => $tabInfo)
  {
    $id = $tabInfo["id"];
    $ordre = $tabInfo["ordre_apparition"];
    $img = $tabInfo["img"];
    $nom = $tabInfo["nom_profil"];
    $prenom = $tabInfo["prenom_profil"];
    $citation = $tabInfo["citation_profil"];
    $motivation = $tabInfo["motivation_profil"];
    $interets = $tabInfo["interets_profil"];
    $vision = $tabInfo["vision_profil"];
    $competence = $tabInfo["competence_profil"];
    $domaines = $tabInfo["domaines_inter"];
    $entreprise = $tabInfo["entreprise_profil"];
    $linkedin = $tabInfo["linkedin"];
    $alt = $tabInfo["alt"];

    $cheminAsset = $this->assetUrl("/");

?>


<section>
<!-- Petit Format -->
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 carte-profil">
    <div class="img-circle img-profil">
      <img src="<?php echo $cheminAsset . "/" . $img; ?>" alt="<?php echo $alt; ?>">
    </div>

    <div class="profil">
        <h3 class="text-center nom-profil"><?php echo $prenom ." ". $nom; ?></h3>
        <p class="text-center">Directrice FRI TEAM</p>

        <blockquote class="citation-profile">
          <?php echo $citation; ?>
        </blockquote>

        <div class="text-center">
            <a href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
        </div>

        <!-- Trigger the modal with a button -->
        <button type="button" class="bouton-popup text-center" data-toggle="modal" data-target="#myModal">En Savoir Plus</button>


        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo $nom . $prenom; ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="img-circle img-popup">
                            <img src="<?php echo $cheminAsset . "/" . $img; ?>" alt="<?php echo $alt; ?>">
                        </div>

                        <h4 class="titre-profil">Citation</h4>
                        <p><?php echo $citation; ?></p>

                        <h4 class="titre-profil">Compétences clés</h4>
                        <p><?php echo $competence; ?></p>

                        <h4 class="titre-profil">FRI TEAM Action</h4>
                        <p><?php echo $domaines; ?></p>

                        <h4 class="titre-profil">Motivations</h4>
                        <p><?php echo $motivation; ?></p>

                        <h4 class="titre-profil">Entreprise</h4>
                        <p><?php echo $entreprise; ?></p>

                        <h4 class="titre-profil">Sa vision de demain</h4>
                        <p><?php echo $vision; ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
  }
}

?>

</section>

<!-- <script>
$(document).ready(function(){
    $('div#imgprof:even').addClass("col-sm-push-9");
    $('div#contenuprof:even').addClass("col-sm-pull-2");
});

</script> -->
