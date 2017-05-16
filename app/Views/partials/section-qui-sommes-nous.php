<?php

  $objetPhilosophieModel = new \Model\PhilosophieModel;
  $tabResult = $objetPhilosophieModel->findAll("id", "ASC");

  if(!empty($tabResult))
  {
    foreach ($tabResult as $index => $tabInfo)
    {
      $contenu_philosophie = $tabInfo["contenu_philosophie"];
    }
  }

  // echo "<pre>";
  // var_dump($url_video);
  // echo "</pre>";

?>

<div class="container profil-container">
  <div class="row">
  
  <section>
      <div class="col-xs-12 col-md-8 col-md-offset-2 philosophie">
          <h2 class="text-center">Notre Philosophie</h2>
          
          <div class="ligne"></div>

          <div><?php echo $contenu_philosophie ?></div>              

      </div>
  </section>
  
  <section>
  <div class="col-xs-12 col-md-8 col-md-offset-2 philosophie">
      <h2 class="text-center">Notre Equipe</h2>
  
      <div class="ligne"></div>
  </div>

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
    $twitter = $tabInfo["twitter"];
    $instagram = $tabInfo["instagram"];
    $alt = $tabInfo["alt"];

    $cheminAsset = $this->assetUrl("/");

?>

<!-- Petit Format -->
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 carte-profil">
    <div class="img-circle img-profil">
      <img src="<?php echo $cheminAsset . "/" . $img; ?>" alt="<?php echo $alt; ?>">
    </div>

    <div class="profil">
        <h3 class="text-center nom-profil"><?php echo $prenom ." ". $nom; ?></h3>

        <blockquote class="citation-profile">
          <?php echo $citation; ?>
        </blockquote>

        <div class="text-center">
            <a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
            <a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        </div>

        <!-- Trigger the modal with a button -->
        <button type="button" class="bouton-popup text-center" data-toggle="modal" data-target="#myModal<?php echo '-'.$id; ?>">En Savoir Plus</button>


        <!-- Modal -->
        <div id="myModal<?php echo '-'.$id; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo $prenom . " " . $nom; ?></h4>
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
