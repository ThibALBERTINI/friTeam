<?php

$objetAccompagnementModel = new \Model\AccompagnementModel;
$tabResult = $objetAccompagnementModel->search(["url"=>$url]);

  foreach ($tabResult as $index => $tabInfo)
  {
    $img = $tabInfo["img"];
    $titre = $tabInfo["titre_acc"];
    $citation = $tabInfo["citation_acc"];
    $resume = $tabInfo["resume_acc"];
    $presentation = $tabInfo["presentation_acc"];
    $formateur = $tabInfo["formateur_acc"];
    $utilite = $tabInfo["utilite_acc"];
    $url = $tabInfo["url"];

    // var_dump($img);

    $cheminAsset = $this->assetUrl("");
echo

<<<CODEHTML

<!-- DETAILS ACCOMPAGNEMENT -->

<div class="container detail-formation">
  <!-- Titre de l'accompagnement -->
  <div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1">
      <h2>$titre</h2>

      <div class="ligne"></div>
    </div>
  </div>

    <!-- Formateur -->
    <div class="col-md-2 icon-formation">
      <span class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
      <p>
        $formateur
      </p>
    </div> 

    <!-- Lieu -->
    <div class="col-md-4 icon-formation">
      <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
      <p>
        $citation
      </p>
    </div>
  </div>

  <!-- Image -->
  <div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1 image-formation">
      <img src="$cheminAsset/$img" alt="developper-son-activite-par-le-crowdfunding">
    </div>
  </div>

  <!-- Colonne de Gauche  -->
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-1 colonne-gauche">
      <p class="explication-formation">
        $presentation
      </p>

      <h3>$resume</h3>

      <div class="ligne"></div>

      <p>
        $presentation
      </p>

    </div>

<!--
  <!-- Colonne de droite -->
    <div class=" col-xs-12 col-md-4 encard-droit">

      <h4 class="titre-col-droite">A quoi ça sert ?</h4>
      <p>
        $utilite
      </p>

      <h4 class="titre-col-droite">Tarifs</h4>
      <p>
        a rajouter dans la base de données
      </p>

      <h4 class="titre-col-droite">Intervenants</h4>
      <p>
        ceci n'est pas une variable
      </p>

      <div class="text-center">
        <a href="" class="btn btn-default inscription-formation">Se Préinscrire</a>
      </div>
    </div>
  </div>
<!--

</div> <!-- Fin du container -->

CODEHTML;
}

?>
