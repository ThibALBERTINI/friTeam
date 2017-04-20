<div class="container-fluid"> 
	<div class="row"> 
		<div class="col-xs-12 col-md-6 col-md-offset-3">
			<div id="bonjour"> <?php if (isset($w_user["login"])) {echo "<p> Bonjour ".$w_user["login"]. "!</p>";} ?> </div>
				<form method="post">
					<!-- < ? = est équivalent à < ? php echo -->
					<input type="hidden" name="idClient" value="<?= $w_user["id"]; ?>" />
					<div class="form-group">
						<label for="password">Ancien mot de passe</label>
						<input type="password" name="passwordOld" class="form-control" />
					</div>
					<div class="form-group">
						<label for="password">Nouveau mot de passe <span class="minip">(5 caractères min)</span></label>
						<input id="passw" type="password" name="passwordNew" class="form-control" />
					</div>
					<div class="form-group">
						<label for="password">Confirmez votre mot de passe</label>
						<input type="password" name="confirmPasswordNew" class="form-control" />
					</div>
					<div class="form-group text-center">
						<input type="submit" name="btnSub" value="Modifier"
									 class="btn btn-success" />
					</div>
				</form>
			<div class="message"> 
				<?php if (isset($message)) echo $message ?>	
			</div>
			</div>
		</div>	
	</div>

<script>
	$('#passw').on('focus', function(){
		$('.minip').css('font-size', '1.5em');
		
	});
	$('#passw').on('focusout', function(){
		$('.minip').css('font-size', '1em');
	});
</script>