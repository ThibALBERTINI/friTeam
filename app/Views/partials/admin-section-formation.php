<!-- <?php 
// ON VA ALLER CHERCHER LES INFOS DE LA FORMATION DANS LA TABLE MYSQL formation
// APPROCHE PAR DELEGATION
$objetFormationModel = new \Model\FormationModel;
$tabFormation = $objetFormationModel->find($id);

//if (!empty($tabFormation)) :
    // ON CREE DES VARIABLES LOCALES AVEC LE MEME NOM
    // QUE LA CLE DANS LE TABLEAU ASSOCIATIF
    extract($tabFormation);
?> -->
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<h2>AJOUT D'UNE FICHE FORMATION</h2>

                <div class="message classe-ok">
                    <?php if (isset($messageOK)) echo $messageOK; ?><br> 
                </div>
                <div class="message classe-ko">
                     <?php if (isset($messageKO)) echo $messageKO; ?><br>
                </div>

				<form action="" method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<label for="img">Illustration</label><br>
						<input type="file" name="img" id="img" class="form-control"><br>
					</div>

					<div class="form-group">
						<label for="alt">Texte alternatif de l'image (référencement de l'image)</label><br>
						<input type="text" name="alt" id="alt" placeholder="Champs limité à 100 caractères" class="form-control"><br>
					</div>

					<div class="form-group">
						<label for="titre_formation">Titre de la formation</label><br>
						<input type="text" name="titre_formation" id="titre_formation" class="form-control" required><br>
					</div>

					<div class="form-group">
						<label for="categorie_formation">Catégorie</label>
						<input type="text" name="categorie_formation" id="categorie_formation" class="form-control" required><br>
<!-- 						<select name="categorie_formation" id="categorie_formation" class="form-control" required>
							<option value="Friteam">Friteam</option>
							<option value="Complementaire">Complémentaire</option>
						</select> -->
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
						<textarea type="text" name="objectif_formation" id="objectif_formation" class="form-control" cols="60" rows="5" required></textarea><br>
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
                        <label for="prix">Prix</label><br>
                        <textarea type="text" name="prix" id="prix" class="form-control ckeditor" required cols="60" rows="5"></textarea><br>
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
						<textarea type="text" name="programme_formation" id="programme_formation" class="form-control ckeditor" required cols="60" rows="5"></textarea><br>
					</div>

					<div class="form-group">
						<label for="lien_catalogue">Lien vers Catalogue en ligne</label><br>
						<input type="file" name="lien_catalogue" id="lien_catalogue" class="form-control" required><br>
					</div>

					<div class="form-group">
						<label for="url">URl</label><br>
						<input type="text" name="url" id="url" class="form-control" required><br>
					</div>

					<button type="submit">Créer une nouvelle Formation</button>

					<!-- Info technique pour préciser l'action que le visiteur veut réaliser -->
					<input type="hidden" name="operation" value="creer">

				</form>
			</div>
		</div>
	</div>
</section>
<!-- <?php
//endif;
?> -->

<section>
	<div class="container-fluid table-admin">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2 ">
				<h2>Liste des Formations déjà enregistrées dans la Base de Donnée</h2>
				<div class="scroll-table">	
					<table class="table table-striped table-responsive">
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
							switch ($nomColonne)
							{
				    			case "titre_formation":
				    			case "date_formation":
				    			case "intervenant_formation":
				        			echo "<th>$nomColonne</th>";
				        			break;
							}
							//affichage de la colonne
							//echo "<th>$nomColonne</th>";
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
							switch ($nomColonne)
							{
				    			case "titre_formation":
				    			case "date_formation":
				    			case "intervenant_formation":
				        			echo "<td>$valeurColonne</td>";
				        			break;
							}
							//echo "<td>$valeurColonne</td>";
						}

						//je recupere l'id de la ligne courante
						$id = $tabLigne["id"];

						$hrefModifier = $this->url("admin_formation_update", [ "id" => $id ]);
						$hrefSupprimer = "?id=$id&operation=supprimer";

						//Ajouter les colonnes MODIFIER et SUPPRIMER
						echo 
<<<CODEHTML
	<td><a href="$hrefModifier">MODIFIER</td>
 	<td><a href="$hrefSupprimer" class="suppFd">SUPPRIMER</td>
 	</tr>
CODEHTML;

				}

				?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>