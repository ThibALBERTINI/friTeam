
	<form method="post" action="updatePass.php">
		<!-- < ? = est équivalent à < ? php echo -->
		<input type="hidden" name="idClient" value="<?= $idClient; ?>" />
		<div class="form-group">
			<label for="password">Nouveau mot de passe</label>
			<input type="password" name="password" class="form-control" />
		</div>
		<div class="form-group text-center">
			<input type="submit" name="btnSub" value="Modifier"
						 class="btn btn-success" />
		</div>
	</form>
	
