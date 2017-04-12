
<h2>Réinitialisation du mot de passe : </h2>
<p> (Un mail vous sera envoyé) <p>
<form method="post">
	<div class="form-group">
		<label for="email">Veuillez entrer votre Email ou votre pseudo</label>
		<input type="text" name="usernameOrEmail" id="usernameOrEmail" class="form-control" />
		
	</div>
	<div class="form-group text-center">
		<input type="submit" name="btnSub" value="Envoyer"
					 class="btn btn-success" />
	</div>
	<div class="message"> 
	<?php if (isset($message)) echo $message ?></div>
</form>