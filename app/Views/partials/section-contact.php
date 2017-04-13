<!-- Carte Google -->
<div class="container-fluid contact map-responsive">
  <div class="row">
    <div class="col-xs-12">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2901.5745328355088!2d5.429278815482356!3d43.34409147913302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9bfcdc25b14c7%3A0x34a9c878b91ef928!2sHotel+technoptic!5e0!3m2!1sfr!2sfr!4v1491937886952" width="2000" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </div>
</div>

<!-- Nous Contacter -->

<div class="container-fluid contact">
  <div class="row">
    <h2 class="text-center">Nous Contacter</h2>

    <div class="ligne"></div>

    <div class="col-xs-12 col-md-5 text-center">
      <p class="nom-contact">Murielle Villain</p>
      <p class="adresse-contact">2 rue Marc Donadille<br />13013 Marseille</p>
      <p class="telephone-contact"> 01.02.03.04.05</p>
      <p class="adresse-mail-contact"><a>murielle-villain@friteam.com</a></p>
    </div>


    <!-- Formulaire de Contact -->
    <div class="col-xs-12 col-md-5">
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
  </div>
</div>
