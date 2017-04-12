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
      <form class="form-contact" action="ajoutfournisseur.php" method="post">
          <!-- Nom -->
          <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez votre nom" />
          </div>

          <!-- Prenom -->
          <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Entrez votre prénom" />
          </div>

          <!-- Adresse Mail -->
          <div class="form-group">
            <label for="mail">E-mail</label>
            <input type="mail" name="mail" id="mail" class="form-control" placeholder="Entrez une adresse mail valide" />
          </div>

          <!-- Numéro de téléphone -->
          <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="tel" name="telephone" id="telephone" class="form-control" placeholder="Entrez un numéro de téléphone valide" />
          </div>

          <!-- Message -->
          <div class="form-group">
            <label for="message">Message</label>
            <textarea rows="4" cols="10" name="message" id="message" class="form-control" placeholder="Entrez votre message" /></textarea>
          </div>

          <!-- Bouton Envoyer -->
          <div class="form-group">
            <input type="submit" name="btnSub" value="Envoyer" class="btn btn-default btnSub" />
          </div>
        </form>
    </div>
  </div>
</div>
