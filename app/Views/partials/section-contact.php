
	<section>
		<h2>h2 de Views/partials/section-contact</h2>
	</section>

	<section>
	    <h3 class="h3-section-contact">Contactez-nous !</h3>
	    <form method="GET" action="">

	    	<div class="form-group">
	    		<p>Civilité :</p>
	    		<label for="civilite_madame">Madame</label>
	        	<input type="radio" name="civilite_contact" id="civilite_madame" required class="form-control" value="madame">

    		    <label for="civilite_monsieur">Monsieur</label>
	        	<input type="radio" name="civilite_contact" id="civilite_monsieur" required class="form-control" value="monsieur">
	        </div>

			<div class="form-group">
	    		<label for="nom_contact">Nom :</label>
	        	<input type="text" name="nom_contact" required class="form-control">
	        </div>
	    	
			<div class="form-group">
	    		<label for="prenom_contact">Prénom :</label>
	        	<input type="text" name="prenom_contact" required class="form-control">
	        </div>

	        <div class="form-group">
	    		<label for="email_contact">Email :</label>
	        	<input type="email" name="email_contact" required class="form-control">
	        </div>

	        <div class="form-group">
	    		<label for="tel_contact">Numéro de téléphone :</label>
	        	<input type="text" name="tel_contact" required class="form-control">
	        </div>

			<div class="form-group">
	    		<label for="adresse_contact">Adresse :</label>
	        	<input type="text" name="adresse_contact" required class="form-control">
	        </div>
	    	
			<div class="form-group">
	    		<label for="cp_contact">Code Postal :</label>
	        	<input type="text" name="cp_contact" required class="form-control">
	        </div>

	        <div class="form-group">
	    		<label for="ville_contact">Ville :</label>
	        	<input type="text" name="ville_contact" required class="form-control">
	        </div>

	        <div class="form-group">
	    		<label for="message_contact">Message</label>
	        	<textarea type="text" name="message_contact" id="message_contact" class="form-control" required cols="60" rows="5"></textarea>
	        </div>

	        <button type="submit">Valider</button>
	            
	        <!-- INFOS TECHNIQUES -->
	        <input type="hidden" name="operation" value="contact">

	        <div class="message">
	        	<?php if(isset($message)) echo $message ?>
	        </div>
	    </form>
	</section>          
