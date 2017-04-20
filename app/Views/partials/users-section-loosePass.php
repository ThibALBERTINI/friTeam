<div class="container-fluid"> 
	<div class="row"> 
		<div class="col-xs-12 col-md-6 col-md-offset-3">
			<h3 id="login" class="text-center">Réinitialisation du mot de passe : </h3>
			<p class="text-center"> (Un email vous sera envoyé) </p>
			<form method="post">
				<div id="pass" class="form-group">
					<label for="email">Veuillez entrer votre Email ou votre pseudo</label>
					<input type="text" name="usernameOrEmail" id="usernameOrEmail" class="form-control" />
					
				</div>
				<div id="pass" class="form-group text-center">
					<input type="submit" name="btnSub" value="Envoyer"
								 class="btn btn-success" />
				</div>
				<div id="pass" class="message"> 
				<?php if (isset($message)) echo $message ?></div>
			</form>
		</div>
	</div>
</div>