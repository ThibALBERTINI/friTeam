<?php

$objetFicheDetailModel = new \Model\FormationModel;
$tabResult = $objetFicheDetailModel->search(["url"=>$url]);

  foreach ($tabResult as $index => $tabInfo)
  {
    $titre = $tabInfo["titre_formation"];
    $img = $tabInfo["img"];
    $date = $tabInfo["date_formation"];
    $duree = $tabInfo["duree_formation"];
    $chapo = $tabInfo["chapo_formation"];
    $lieu = $tabInfo["lieu_formation"];
    $presentation = $tabInfo["presentation_formation"];
    $objectif = $tabInfo["objectif_formation"];
    $public = $tabInfo["public_formation"];
    $conditions = $tabInfo["conditions_formation"];
    $intervenant = $tabInfo["intervenant_formation"];
    $programme = $tabInfo["programme_formation"];
    $catalogue = $tabInfo["programme_formation"];

    var_dump($img);

    $cheminAsset = $this->assetUrl("../");
echo

<<<CODEHTML

<!-- DETAILS FORMATIONS -->

<div class="container detail-formation">
  <!-- Titre de la Formation -->
  <div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1">
      <h2>$titre</h2>

      <div class="ligne"></div>
    </div>
  </div>

  <!-- Durée / Date / Lieu -->
  <div class="row">
    <!-- Date -->
    <div class="col-md-2 col-md-offset-2 icon-formation">
      <span class="icon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
      <p>
        $date
      </p>
    </div>

    <!-- Durée -->
    <div class="col-md-2 icon-formation">
      <span class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
      <p>
        $duree
      </p>
    </div>

    <!-- Lieu -->
    <div class="col-md-4 icon-formation">
      <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
      <p>
        $lieu
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

      <h3>Programme</h3>

      <div class="ligne"></div>

      <p>
        $programme
      </p>

      <div class="text-center">
        <a href="$catalogue" class="btn btn-default brochure-formation">Telecharger la brochure</a>
      </div>

    </div>

  <!-- Colonne de droite -->
    <div class=" col-xs-12 col-md-4 encard-droit">

      <h4 class="titre-col-droite">Objectifs</h4>
      <p>
        $objectif
      </p>

      <h4 class="titre-col-droite">Tarifs</h4>
      <p>
        a rajouter dans la base de données
      </p>

      <h4 class="titre-col-droite">Conditions</h4>
      <p>
        $conditions
      </p>

      <h4 class="titre-col-droite">Public</h4>
      <p>
        $public
      </p>

      <h4 class="titre-col-droite">Intervenants</h4>
      <p>
        $intervenant
      </p>

      <div class="text-center">
        <a href="" class="btn btn-default inscription-formation">Se Préinscrire</a>
      </div>
    </div>
  </div>

</div> <!-- Fin du container -->

CODEHTML;
}

?>
