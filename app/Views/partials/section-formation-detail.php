<?php

$objetFicheDetailModel = new \Model\FormationModel;
$tabResult = $objetFicheDetailModel->search(["url"=>$url]);

// echo '<pre>';
// var_dump($url);
// echo '</pre>';


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

    // var_dump($img);

    $cheminAsset = $this->assetUrl("/");
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
        <a href="" class="btn btn-default inscription-formation" data-toggle="modal" data-target="#myModal">Se Préinscrire</a>
      </div>
    </div>
  </div>

</div> <!-- Fin du container -->

CODEHTML;
}

?>

<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

          <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Formulaire de préinscription</h4>
              </div>
              <div class="modal-body">
                <form class="form-contact" action="" method="GET">

                 <!-- Civilité -->
                <div class="form-group">
                  <label>Civilité</label>
                <div>
                  <input type="radio" name="civilite_contact" id="civilite_madame" value="madame" required />
                  <label for="civilite_madame">Madame</label>
                </div>
                <div>
                  <input type="radio" name="civilite_contact" id="civilite_monsieur" value="monsieur" required />
                  <label for="civilite_monsieur">Monsieur</label>
                </div>
              </div>

              <!-- Nom -->
              <div class="form-group">
                <label for="nom_contact">Nom</label>
                <input type="text" name="nom_contact" id="nom_contact" class="form-control" placeholder="Entrez votre nom" />
              </div>

              <!-- Prenom -->
              <div class="form-group">
                <label for="prenom_contact">Prénom</label>
                <input type="text" name="prenom_contact" id="prenom_contact" class="form-control" required placeholder="Entrez votre prénom" />
              </div>

              <!-- Adresse Mail -->
              <div class="form-group">
                <label for="email_contact">E-mail</label>
                <input type="email" name="email_contact" id="email_contact" class="form-control" required placeholder="Entrez une adresse mail valide" />
              </div>

              <!-- Numéro de téléphone -->
              <div class="form-group">
                <label for="tel_contact">Téléphone</label>
                <input type="text" name="tel_contact" id="tel_contact" class="form-control" required placeholder="Entrez un numéro de téléphone valide" />
              </div>

              <!-- Adresse-->
              <div class="form-group">
                <label for="adresse_contact">Adresse</label>
                <input type="text" name="adresse_contact" id="adresse_contact" required class="form-control" required placeholder="Entrez une adresse valide" />
              </div>

              <!-- Code Postal-->
              <div class="form-group">
                <label for="cp_contact">Code Postal</label>
                <input type="text" name="cp_contact" id="cp_contact" required class="form-control" required placeholder="Entrez un code postal" />
              </div>

              <!-- Ville-->
              <div class="form-group">
                <label for="ville_contact">Ville</label>
                <input type="text" name="ville_contact" id="ville_contact" required class="form-control" required placeholder="Entrez le nom de votre ville" />
              </div>

              <!-- Message -->
              <div class="form-group">
                <label for="message_contact">Message</label>
                <textarea rows="4" cols="10" name="message_contact" id="message_contact" class="form-control" required placeholder="Entrez votre message" /></textarea>
              </div>

              <!-- Bouton Envoyer -->
              <div class="form-group">
                <input type="submit" name="btnSub" value="Envoyer" class="btn btn-default btnSub" />
              </div>

              <!-- INFOS TECHNIQUES -->
              <input type="hidden" name="operation" value="contact">

              <div class="message">
                <?php if(isset($message)) echo $message ?>
              </div>
            </form>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              </div>
            </div>

          </div>
        </div>
