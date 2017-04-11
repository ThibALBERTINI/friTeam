<?php 

?>
<section>
	<h2>AJOUT D'UNE FICHE FORMATION</h2>
	<form action="" method="POST" enctype="multipart/form-data">

		<div class="form-group">
			<label for="img_formation">Illustration</label><br>
			<input type="text" name="img_formation" id="img_formation" class="form-control"><br>
		</div>

		<div class="form-group">
			<label for="titre_formation">Titre de la formation</label><br>
			<input type="text" name="titre_formation" id="titre_formation" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="presentation_formation">Présentation</label><br>
			<textarea type="text" name="presentation_formation" id="presentation_formation" class="form-control" required cols="60" rows="5"></textarea><br>
		</div>

		<div class="form-group">
			<label for="chapo_formation">Chapô</label><br>
			<textarea type="text" name="chapo_formation" id="chapo_formation" class="form-control" required cols="60" rows="5"></textarea><br>
		</div>

		<div class="form-group">
			<label for="objectif_formation">Objectifs</label><br>
			<input type="text" name="objectif_formation" id="objectif_formation" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="public_formation">Public concerné</label><br>
			<input type="text" name="public_formation" id="public_formation" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="conditions_formation">Conditions</label><br>
			<input type="text" name="conditions_formation" id="conditions_formation" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="duree_formation">Durée</label><br>
			<input type="text" name="duree_formation" id="duree_formation" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="date_formation">Date de formation</label><br>
			<input type="date" name="date_formation" id="date_formation" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="lieu_formation">Lieu</label><br>
			<input type="text" name="lieu_formation" id="lieu_formation" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="intervenant_formation">Intervenant(s)</label><br>
			<input type="text" name="intervenant_formation" id="intervenant_formation" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="programme_formation">Programme</label><br>
			<textarea type="text" name="programme_formation" id="programme_formation" class="form-control" required cols="60" rows="5"></textarea><br>
		</div>

		<div class="form-group">
			<label for="lien_catalogue">Lien vers Catalogue en ligne</label><br>
			<input type="text" name="lien_catalogue" id="lien_catalogue" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="url">URl</label><br>
			<input type="text" name="url" id="url" class="form-control" required><br>
		</div>

		<button type="submit">Créer une nouvelle Formation</button>

		<!-- Info technique pour préciser l'action que le visiteur veut réaliser -->
		<input type="hidden" name="operation" value="creer">

		<div class="message">
			<?php if (isset($message)) echo $message ?>
		</div>

	</form>
</section>


<section>
	<h2>Liste des Formations déjà enregistrées dans la Base de Donnée</h2>
	<table>
		<thead>
<?php
	//création d'un nouvel objet
	$objetFormationModel = new \Model\FormationModel;
	//fincAll renvoie un tableau associatif de l'objet créé
	$tabResult = $objetFormationModel->findAll("id", "DESC", 1);
	//exploitation du tableau associatif avec boucle pour chaque ligne trouvée
	foreach($tabResult as $tabLigne)
	{
		echo "<tr>";
		//BOucle pour parcourir les colonnes
		foreach($tabLigne as $nomColonne => $valeurColonne)
		{
			//affichage de la colonne
			echo "<th>$nomColonne</th>";
		}
		//Ajouter les colonnes MODIFIER SUPPRIMER
		echo "<th>MODIFIER</th>";
		echo "<th>SUPPRIMER</th>";

		echo "</tr>";
	}

 ?>
		</thead>
		<tbody>
<?php 
	//acces a la table
	$tabResult = $objetFormationModel->findAll("id", "DESC");
	//Boucle pour parcourir chaque ligne
	foreach($tabResult as $tabLigne)
	{
		echo "<tr>";
		//boucle pour parcourir chaque colonne
		foreach($tabLigne as $nomColonne => $valeurColonne)
		{
			echo "<td>$valeurColonne</td>";
		}

		//je recupere l'id de la ligne courante
		$id = $tabLigne["id"];

		$hrefModifier = $this->url("admin_formation_update", [ "id" => $id ]);
		$hrefSupprimer = "?id=$id&operation=supprimer";

		//Ajouter les colonnes MODIFIER et SUPPRIMER
		echo 
<<<CODEHTML
	<td><a href="$hrefModifier">MODIFIER</td>
	<td><a href="$hrefSupprimer">SUPPRIMER</td>
	</tr>
CODEHTML;

	}

 ?>
		</tbody>
	</table>
</section>