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
	<h2>AJOUT D'UNE FICHE ACCOMPAGNEMENT</h2>

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
			<label for="titre_acc">Entête de la Section Accompagnement</label><br>
			<input type="text" name="titre_acc" id="titre_acc" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="citation_acc">Citation</label><br>
			<textarea type="text" name="citation_acc" id="citation_acc" class="form-control" required cols="60" rows="5"></textarea><br>
		</div>

		<div class="form-group">
			<label for="resume_acc">C'est Quoi ?</label><br>
			<textarea type="text" name="resume_acc" id="resume_acc" class="form-control ckeditor" required cols="60" rows="5"></textarea><br>
		</div>

		<div class="form-group">
			<label for="presentation_acc">Comment ça marche ?</label><br>
			<textarea type="text" name="presentation_acc" id="presentation_acc" class="form-control ckeditor" required cols="60" rows="5"></textarea><br>
		</div>

		<div class="form-group">
			<label for="formateur_acc">Par qui ?</label><br>
			<input type="text" name="formateur_acc" id="formateur_acc" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="utilite_acc">A quoi ça sert ?</label><br>
			<input type="text" name="utilite_acc" id="utilite_acc" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="url">URl</label><br>
			<input type="text" name="url" id="url" class="form-control" required><br>
		</div>

		<button type="submit">Créer une nouvelle fiche Accompagnement</button>

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
				<h2>Liste des Fiches Accompagnement déjà enregistrées dans la Base de Donnée</h2>
				<div class="scroll-table">	
					<table class="table table-striped table-responsive">
						<thead>
				<?php
					//création d'un nouvel objet
					$objetAccompagnementModel = new \Model\AccompagnementModel;
					//fincAll renvoie un tableau associatif de l'objet créé
					$tabResult = $objetAccompagnementModel->findAll("id", "DESC", 1);
					//exploitation du tableau associatif avec boucle pour chaque ligne trouvée
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//BOucle pour parcourir les colonnes
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "titre_acc":
				    			case "formateur_acc":
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
					$tabResult = $objetAccompagnementModel->findAll("id", "DESC");
					//Boucle pour parcourir chaque ligne
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//boucle pour parcourir chaque colonne
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "titre_acc":
				    			case "formateur_acc":
				        			echo "<td>$valeurColonne</td>";
				        			break;
							}
							//echo "<td>$valeurColonne</td>";
						}

						//je recupere l'id de la ligne courante
						$id = $tabLigne["id"];

						$hrefModifier = $this->url("admin_accompagnement", [ "id" => $id ]);
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
				</div>
			</div>
		</div>
	</div>
</section>