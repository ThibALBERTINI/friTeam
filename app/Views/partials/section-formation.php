<!-- Texte d'introduction -->
<div class="container-fluid">
  <div class="row row-centered">
    <div class="col-xs-12 col-md-8  col-centered">
      <p class="introduction-formation">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti, accusantium atque ex iste sint dicta. Amet delectus, libero voluptatum odit cum ipsum repudiandae praesentium! Mollitia, ex! Vitae, cum eos corporis repellendus lorem ipsum dolor si. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti, accusantium atque ex iste sint dicta. Amet delectus, libero voluptatum odit cum ipsum repudiandae praesentium! Mollitia, ex! Vitae, cum eos corporis repellendus lorem ipsum dolor si.</p>
    </div>
  </div>
</div>

<!-- Onglets recherche par catégories -->
<div class="onglets-categories text-center">
  <ul>
    <li>Toutes les Formations</li>
    <li>Formations FRI TEAM</li>
    <li>Formations Complémentaires</li>
  </ul>
</div>

<div class="container carte-container">
  <div class="row row-centered">


<?php

$objetFicheModel = new \Model\FormationModel;
$tabResult = $objetFicheModel->findAll("date_formation", "ASC");

if(!empty($tabResult))
{
  foreach ($tabResult as $index => $tabInfo)
  {
    $titre = $tabInfo["titre_formation"];
    $img = $tabInfo["img"];
    $date = $tabInfo["date_formation"];
    $duree = $tabInfo["duree_formation"];
    $chapo = $tabInfo["chapo_formation"];
    $lieu = $tabInfo["lieu_formation"];
    $url = $tabInfo["url"];

    $href = $this->url("default_formation-detail", [ "url" => $url ]);

    $cheminAsset = $this->assetUrl("../");
echo
<<<CODEHTML

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 carte-formation col-centered">
        <div class="image">
          <img src="$cheminAsset/$img" alt="image-carte">
        </div>

        <div class="contenu">
          <h4><a href="$href">$titre</a></h4>

          <span class="icon"><i class="fa fa-calendar" aria-hidden="true"></i> $date</span>
          <span class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i> $duree</span>

          <div class="ligne"></div>

          <p class="resume">$chapo</p>

          <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i>$lieu</span>

          <div class="text-center bouton-container">
            <a class="bouton" href="$href">En Savoir Plus</a>
          </div>
        </div>
    </div>
CODEHTML;
  }
}

?>

</div>
</div>
