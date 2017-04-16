<!-- Texte d'introduction -->
<div class="container-fluid">
  <div class="row row-centered">
    <div class="col-xs-12 col-md-8  col-centered">
      <p class="introduction-formation">affichage ?</p>
    </div>
  </div>
</div>

<!-- Onglets recherche par catégories -->
<div class="onglets-categories text-center">
  <ul>
    <li>Touts les Accompagnements</li>
    <li>CATEGORIE 1</li>
    <li>CATEGORIE 2</li>
  </ul>
</div>

<div class="container carte-container">
  <div class="row row-centered">


<?php

$objetAccompagnementModel = new \Model\AccompagnementModel;
$tabResult = $objetAccompagnementModel->findAll("id", "ASC");

if(!empty($tabResult))
{
  foreach ($tabResult as $index => $tabInfo)
  {
    $img = $tabInfo["img"];
    $titre = $tabInfo["titre_acc"];
    // Pas utilisée dans HTML ci-dessous
    $citation = $tabInfo["citation_acc"];
    $resume = $tabInfo["resume_acc"];
    // Pas utilisée ici
    $presentation = $tabInfo["presentation_acc"];
    $formateur = $tabInfo["formateur_acc"];
    // Pas utilisée ici
    $utilite = $tabInfo["utilite_acc"];
    // Pas utilisée ici
    $url = $tabInfo["url"];

    $href = $this->url("default_accompagnement-detail", [ "url" => $url ]);

    $cheminAsset = $this->assetUrl("");
echo
<<<CODEHTML

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 carte-formation col-centered">
        <div class="image">
          <img src="$cheminAsset/$img" alt="image-carte">
        </div>

        <div class="contenu">
          <h4><a href="$href">$titre</a></h4>

          <div class="ligne"></div>

          <p class="resume">$resume</p>

          <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i>$formateur</span>

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
