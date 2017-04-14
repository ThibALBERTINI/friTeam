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
	<h2>AJOUT D'UN ARTICLE</h2>
	<form action="" method="POST" enctype="multipart/form-data">


		<div class="form-group">
			<label for="titre_actualite">Titre de l'Article</label><br>
			<input type="text" name="titre_actualite" id="titre_actualite" class="form-control" required><br>
		</div>


		<div class="form-group">
			<label for="chapo_actualite">Chapô</label><br>
			<textarea type="text" name="chapo_actualite" id="chapo_actualite" class="form-control" required cols="60" rows="5"></textarea><br>
		</div>

		<div class="form-group">
			<label for="contenu_actualite">Corps de l'article</label><br>
			<textarea type="text" name="contenu_actualite" id="contenu_actualite" class="form-control" required cols="60" rows="5"></textarea><br>
		</div>

		<div class="form-group">
			<label for="auteur_actualite">Auteur</label><br>
			<input type="text" name="auteur_actualite" id="auteur_actualite" class="form-control" required><br>
		</div>

		<div class="form-group">
			<label for="img">Illustration</label><br>
			<input type="file" name="img" id="img" class="form-control"><br>
		</div>

		<div class="form-group">
			<label for="url">URl</label><br>
			<input type="text" name="url" id="url" class="form-control" required><br>
		</div>

		<button type="submit">Créer une nouvel Article</button>

		<!-- Info technique pour préciser l'action que le visiteur veut réaliser -->
		<input type="hidden" name="operation" value="creer">

		<div class="message">
			<?php if (isset($message)) echo $message ?>
		</div>

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
				<h2>Liste des Articles déjà enregistrées dans la Base de Donnée</h2>
				<div class="scroll-table">	
					<table class="table table-striped table-responsive">
						<thead>
				<?php
					//création d'un nouvel objet
					$objetActualiteModel = new \Model\ActualiteModel;
					//fincAll renvoie un tableau associatif de l'objet créé
					$tabResult = $objetActualiteModel->findAll("id", "DESC", 1);
					//exploitation du tableau associatif avec boucle pour chaque ligne trouvée
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//BOucle pour parcourir les colonnes
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "titre_actualite":
				    			case "chapo_actualite":
				    			case "auteur_actualite":
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
					$tabResult = $objetActualiteModel->findAll("id", "DESC");
					//Boucle pour parcourir chaque ligne
					foreach($tabResult as $tabLigne)
					{
						echo "<tr>";
						//boucle pour parcourir chaque colonne
						foreach($tabLigne as $nomColonne => $valeurColonne)
						{
							switch ($nomColonne)
							{
				    			case "titre_actualite":
				    			case "chapo_actualite":
				    			case "auteur_actualite":
				        			echo "<td>$valeurColonne</td>";
				        			break;
							}
							//echo "<td>$valeurColonne</td>";
						}

						//je recupere l'id de la ligne courante
						$id = $tabLigne["id"];

						$hrefModifier = $this->url("admin_blog", [ "id" => $id ]);
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