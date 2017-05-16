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
    $lien_catalogue = $tabInfo["lien_catalogue"];
    $alt = $tabInfo["alt"];
    $prix = $tabInfo["prix"];
    $url = $tabInfo["url"];


    // var_dump($img);

$cheminAsset = $this->assetUrl("/");
//$catalogue = $cheminAsset . "pdf/" . $url . ".pdf";
$lien_catalogue = $cheminAsset . $lien_catalogue;
//echo
?>
<div class="container-fluid detail-formation">
    <div class="row">
      <div class="col-xs-12 col-md-10 col-md-offset-1">
        <!-- Titre de la Formation -->
        <h2><?php echo $titre ?></h2>

        <!-- Ligne de séparation -->
        <div class="ligne"></div>
      </div>
    </div>

    <!-- Durée / Date / Lieu -->
    <div class="row">
      <!-- Date de la formation -->
      <div class="col-md-2 col-md-offset-1 icon-formation">
        <span class="icon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
        <p>
          <?php echo $date ?>
        </p>
      </div>

      <!-- Durée de la Formation -->
      <div class="col-md-2 icon-formation">
        <span class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
        <p>
          <?php echo $duree ?>
        </p>
      </div>

      <!-- Lieu de la Formation -->
      <div class="col-md-4 icon-formation">
        <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
        <p>
          <?php echo $lieu ?>
        </p>
      </div>
    </div>

    <!-- Colonne de Gauche -->
    <div class="flexivite">
    <div class="row">

      <!-- Image d'illustraion Formation -->
      <div class="col-xs-12 col-md-6 col-md-offset-1">
        <div class="img">
          <div class="image-formation">
            <img src="<?php echo $cheminAsset . '/' . $img ?>" atl="<?php echo $alt ?>">
          </div>
        </div>

        <div class="colonne-gauche">
          <!-- Texte Introduction Formation -->
          <p class="explication-formation">
            <?php echo $presentation ?>
          </p>

          <!-- Lien Vers le PDF de la Formation -->
          <div class="text-center">
            <a href="<?php echo $lien_catalogue ?>" class="brochure-formation">Télécharger la Brochure</a>
          </div>
        
          <!-- Programme de la Formation -->
          <h3 class="programme">Programme</h3>

          <!-- Ligne de séparation -->
          <div class="ligne"></div>

          <p>
            <?php echo $programme ?>
          </p>
        
        </div>
      </div>

      <!-- Colonne de Droite -->
      <div class="row">
        <div class="col-xs-12 col-md-4 encard-droit">

          <!-- Bouton de Préinscription -->
          <div class="text-center">
            <button type="button" class="btn btn-default inscription-formation" data-toggle="modal" data-target="#myModal">Se Préinscrire</button>
          </div>
        
          <!-- Objectifs de la Formation -->
          <h4 class="titre-col-droite">Objectifs</h4>
          <p>
            <?php echo $objectif ?>
          </p>

          <!-- Tarifs de la Formation -->
          <h4 class="titre-col-droite">Tarifs</h4>
          <p>
            <?php echo $prix ?>
          </p>

          <!-- Conditions d'entrée dans la formation -->
          <h4 class="titre-col-droite">Conditions</h4>
          <p>
            <?php echo $conditions ?>
          </p>

          <!-- Public de la Formation -->
          <h4 class="titre-col-droite">Public</h4>
          <p>
            <?php echo $public ?>
          </p>

          <!-- Intervenants de la Formation -->
          <h4 class="titre-col-droite">Intervenant</h4>
          <p>
            <?php echo $intervenant ?>
          </p>
        </div>
      </div>
    </div>

    </div>
  </div> <!-- Fin de la div Container-fluid -->

<?php
}

?>

<div id="myModal" class="modal fade ma-modal" role="dialog">
        <div class="modal-dialog modal-md">

          <!-- Modal content-->
            <div class="modal-content modal-contenu">
              <div class="modal-header modal-titre">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Formulaire de préinscription</h4>
              </div>
              <div class="modal-body">
                <form class="form-contact" action="" method="GET">

                 <!-- Civilité -->
                <div class="form-group">
                  <label>Civilité</label>
                  <div class="mister-miss">
                    <input type="radio" name="civilite_contact" id="civilite_madame" value="madame" required />
                    <label for="civilite_madame">Madame</label>
                    <input type="radio" name="civilite_contact" id="civilite_monsieur" value="monsieur" required />
                    <label for="civilite_monsieur">Monsieur</label>
                  </div>
              </div>

              <!-- Nom -->
              <div class="form-group">
                <!-- <label for="nom_contact">Nom</label> -->
                <input type="text" name="nom_contact" id="nom_contact" class="form-control" placeholder="Nom" />
              </div>

              <!-- Prenom -->
              <div class="form-group">
                <!-- <label for="prenom_contact">Prénom</label> -->
                <input type="text" name="prenom_contact" id="prenom_contact" class="form-control" required placeholder="Prénom" />
              </div>

              <!-- Adresse Mail -->
              <div class="form-group">
                <!-- <label for="email_contact">E-mail</label> -->
                <input type="email" name="email_contact" id="email_contact" class="form-control" required placeholder="Adresse E-Mail" />
              </div>

              <!-- Numéro de téléphone -->
              <div class="form-group">
                <!-- <label for="tel_contact">Téléphone</label> -->
                <input type="text" name="tel_contact" id="tel_contact" class="form-control" required placeholder="Numéro de Téléphone" />
              </div>

              <!-- Adresse-->
              <div class="form-group">
                <!-- <label for="adresse_contact">Adresse</label> -->
                <input type="text" name="adresse_contact" id="adresse_contact" required class="form-control" required placeholder="Adresse" />
              </div>

              <!-- Code Postal-->
              <div class="form-group">
                <!-- <label for="cp_contact">Code Postal</label> -->
                <input type="text" name="cp_contact" id="cp_contact" required class="form-control" required placeholder="Code Postal" />
              </div>

              <!-- Ville-->
              <div class="form-group">
                <!-- <label for="ville_contact">Ville</label> -->
                <input type="text" name="ville_contact" id="ville_contact" required class="form-control" required placeholder="Ville" />
              </div>

              <!-- Message -->
              <div class="form-group">
                <!-- <label for="message_contact">Message</label> -->
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
