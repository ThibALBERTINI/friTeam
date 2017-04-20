<!-- Texte d'introduction -->
<div class="container-fluid">
  <div class="row row-centered">
  <section>
      <div class="col-xs-12 col-md-8 col-md-offset-2 philosophie">
          <h2 class="text-center">Notre Philosophie</h2>
          
          <div class="ligne"></div>
              
          <h3>Accompagnement</h3>
          <p>
              Un nouveau monde émerge, dynamisé par les réseaux sociaux, l'innovation et la culture du partage. L’heure de la troisième révolution industrielle a-t-elle sonné ?
          </p>
          <p>
            Les organisations et les femmes et hommes qui la composent ont une formidable opportunité d’inventer leur propre modèle remettant l’humain au coeur des dispositifs tout en s’appuyant sur des technologies innovantes. 
            Nous mettons à disposition nos compétences pour vous accompagner dans cette évolution 
          </p>
      </div>
  </section>
  </div>
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
    $alt = $tabInfo["alt"];


    $href = $this->url("default_accompagnement-detail", [ "url" => $url ]);

    $cheminAsset = $this->assetUrl("");
echo
<<<CODEHTML

      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 carte-formation col-centered">
        <div class="image">
          <img src="$cheminAsset/$img" alt="$alt">
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
